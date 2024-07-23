<?php

namespace App\Ldap\Handlers;

use Spatie\Permission\Models\Role;
use App\Models\User as DatabaseUser;
use LdapRecord\Models\ActiveDirectory\Group;
use LdapRecord\Models\ActiveDirectory\User as LdapUser;

class UserAttributeHandler
{
    public function handle(LdapUser $ldap, DatabaseUser $database)
    {
        // Sync the user's attributes from LDAP to the database
        $database->name = $ldap->getFirstAttribute('cn');
        $database->email = $ldap->getFirstAttribute('mail');
        $database->username = $ldap->getFirstAttribute('samaccountname');
        $database->phone = $ldap->getFirstAttribute('telephonenumber');
        
        // Save the user to the database
        $database->save();

        // Defined the LDAP group to role mapping for the application
        $rolesMap = [
            'Admin' => 'CN=Informatica,OU=Administradors Informàtica,DC=parcsanitari,DC=local',
            'User SAP' => 'CN=Oficina SAP,OU=Grups d\'Usuaris,DC=parcsanitari,DC=local',
            'User GEE' => 'CN=Electromedicina,OU=Grups d\'Usuaris,DC=parcsanitari,DC=local',
        ];

        $assignedRoles = [];

        // Assign the user roles based on their LDAP group membership status
        foreach ($rolesMap as $roleName => $groupDn) {
            $group = Group::find($groupDn);
            if ($ldap->groups()->recursive()->exists($group)) {
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $assignedRoles[] = $role->id;
                }
            }
        }

        // Sync the user's roles
        $database->roles()->sync($assignedRoles);

        // Assign the avatar URL to the user
        $avatarUrl = config('app.avatar_url') . $database->username;
        $database->avatar = $avatarUrl;

        // Save the user to the database
        $database->save();
    }
}