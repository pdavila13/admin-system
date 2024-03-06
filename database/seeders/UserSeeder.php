<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'SysAdmin',
            'email' => 'sysadmin@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('admin');
        
        \App\Models\User::factory()->create([
             'name' => 'User',
             'email' => 'user@gmail.com',
             'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('user');

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'vendor@gmail.com',
            'password' => bcrypt('p$ssw#rd'),
        ])->assignRole('vendor');
    }
}
