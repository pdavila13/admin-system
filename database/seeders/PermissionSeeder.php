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
            'admin.dashboard',

            'admin.user.index',
            'admin.user.create',
            'admin.user.edit',
            'admin.user.delete',

            'admin.role.index',
            'admin.role.create',
            'admin.role.edit',
            'admin.role.delete',

            'admin.permission.index',
            'admin.permission.create',
            'admin.permission.edit',
            'admin.permission.delete',

            'admin.company.create',
            'admin.company.edit',
            'admin.company.delete',
            'admin.company.index',

            'admin.group_vpn.index',
            'admin.group_vpn.create',
            'admin.group_vpn.edit',
            'admin.group_vpn.delete',

            'admin.petition.index', 
            'admin.petition.create', 
            'admin.petition.edit', 
            'admin.petition.delete',

            'admin.inventory.index',
            'admin.inventory.create',
            'admin.inventory.edit',
            'admin.inventory.delete',

            'admin.integration.index',
            'admin.integration.create',
            'admin.integration.edit',
            'admin.integration.delete', 
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName])->syncRoles(['admin']);
        }
    }
}
