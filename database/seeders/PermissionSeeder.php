<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'petition', 
            'petition-create', 
            'petition-edit', 
            'petition-delete', 
            'company',
            'company-create',
            'company-edit',
            'company-delete',
            'user',
            'user-create',
            'user-edit',
            'user-delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

    }
}
