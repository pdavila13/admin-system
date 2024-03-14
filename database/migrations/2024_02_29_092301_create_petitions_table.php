<?php

use App\Models\Company;
use App\Models\PetitionType;
use App\Models\State;
use App\Models\User;
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
            $table->foreignIdFor(Company::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(PetitionType::class)->constrained()->onUpdate('cascade');
            $table->foreignIdFor(State::class)->constrained()->onUpdate('cascade');
            $table->foreignIdFor(User::class)->constrained()->onUpdate('cascade');
            $table->string('description')->nullable();
            $table->dateTime('datepicker')->nullable();
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