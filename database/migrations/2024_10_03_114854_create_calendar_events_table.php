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
        Schema::create('CalendarEventsTable', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('backgroundColor');
            $table->string('borderColor');
            $table->string('textColor');
            $table->integer('year');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('holiday_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
};
