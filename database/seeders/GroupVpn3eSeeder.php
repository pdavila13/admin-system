<?php

namespace Database\Seeders;

use App\Models\GroupVpn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupVpn3eSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GroupVpn::factory()->count(20)->create();
    }
}
