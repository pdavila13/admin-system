<?php

namespace App\Ldap\Rules;

use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;
use LdapRecord\Models\ActiveDirectory\Group;
use Illuminate\Database\Eloquent\Model as Eloquent;

class AllowedGroups implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, Eloquent $model = null): bool
    {
         // Define the groups that are allowed to access the application
         $allowedGroups = [
            'CN=Sistemes,OU=Administradors Informàtica,DC=parcsanitari,DC=local',
            'CN=Oficina SAP,OU=Grups d\'Usuaris,DC=parcsanitari,DC=local',
            'CN=Electromedicina,OU=Grups d\'Usuaris,DC=parcsanitari,DC=local',
        ];

        // Verify the user is a member of one of the allowed groups
        foreach ($allowedGroups as $groupDn) {
            $group = Group::find($groupDn);
            if ($group && $user->groups()->recursive()->exists($group)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Access denied. You are not a member of an allowed group.';
    }
}