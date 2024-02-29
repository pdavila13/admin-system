<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserT3;

class UserT3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserT3::factory()->count(25)->create();
    }
}