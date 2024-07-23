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
        Schema::create('vcenter_vms', function (Blueprint $table) {
            $table->id();
            $table->string('vm_id')->unique();
            $table->string('name');
            $table->string('power_state');
            $table->boolean('template');
            $table->integer('guest_state');
            $table->string('creation_date');
            $table->string('annotation')->nullable();
            $table->string('guest_OS');
            $table->string('criticality')->nullable();
            $table->string('tools_version');
            $table->string('vm_version');
            $table->string('upgrade_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vcenter_vms');
    }
};
