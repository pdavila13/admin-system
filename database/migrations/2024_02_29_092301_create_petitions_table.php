<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->string('petition_number');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('request_type_id');
            $table->foreign('request_type_id')->references('id')->on('requests_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('t1_users_id');
            $table->foreign('t1_users_id')->references('id')->on('t1_users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('state')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('technical_system_id');
            $table->foreign('technical_system_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};