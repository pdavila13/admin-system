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
            $table->string('creation_date')->nullable();
            $table->string('annotation')->nullable();
            $table->string('guest_OS');
            $table->string('criticality')->nullable();
            $table->string('tools_version_status');
            $table->string('hardware_version');
            $table->string('last_reboot')->nullable();
            $table->enum('upgrade_status',['N/A','YES','NO','REBOOT'])->nullable();
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
