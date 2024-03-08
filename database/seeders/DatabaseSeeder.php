<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(GroupVpn3eSeeder::class);
        $this->call(UserT3Seeder::class);
        $this->call(PetitionTypeSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(PetitionSeeder::class);
    }
}