<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Defined permissions
        $permissions = [
            'admin.dashboard',
            'admin.user.index','admin.user.create','admin.user.edit','admin.user.delete',
            'admin.role.index','admin.role.create','admin.role.edit','admin.role.delete',
            'admin.permission.index','admin.permission.create','admin.permission.edit','admin.permission.delete',
            'admin.company.index','admin.company.create','admin.company.edit','admin.company.delete',
            'admin.group_vpn.index','admin.group_vpn.create','admin.group_vpn.edit','admin.group_vpn.delete',
            'admin.petition.index','admin.petition.create','admin.petition.edit','admin.petition.delete',
            'admin.inventory.index','admin.inventory.create','admin.inventory.edit','admin.inventory.delete',
            'admin.integration.index','admin.integration.create','admin.integration.edit','admin.integration.delete', 
        ];

        // Create permissions if they do not exist
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Defining roles and permissions to assign to them
        $rolesPermissions = [
            'Admin' => [
                'admin.dashboard',
                'admin.user.index', 'admin.user.create', 'admin.user.edit', 'admin.user.delete',
                'admin.role.index', 'admin.role.create', 'admin.role.edit', 'admin.role.delete',
                'admin.permission.index', 'admin.permission.create', 'admin.permission.edit', 'admin.permission.delete',
                'admin.company.index', 'admin.company.create', 'admin.company.edit', 'admin.company.delete',
                'admin.group_vpn.index', 'admin.group_vpn.create', 'admin.group_vpn.edit', 'admin.group_vpn.delete',
                'admin.petition.index', 'admin.petition.create', 'admin.petition.edit', 'admin.petition.delete',
                'admin.inventory.index', 'admin.inventory.create', 'admin.inventory.edit', 'admin.inventory.delete',
                'admin.integration.index', 'admin.integration.create', 'admin.integration.edit', 'admin.integration.delete',
            ],
            'User' => [
                'admin.inventory.index',
            ],
            'User SAP' => [
                'admin.inventory.index',
                'admin.integration.index',
                'admin.integration.edit',
            ],
            'User GEE' => [
                'admin.inventory.index',
                'admin.integration.index',
                'admin.integration.create',
                'admin.integration.edit',
            ],
        ];

        // Assign permissions to existing roles
        foreach ($rolesPermissions as $roleName => $rolePermissions) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->syncPermissions($rolePermissions);
            }
        }
    }
}
