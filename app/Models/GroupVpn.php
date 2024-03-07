<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Model;

class GroupVpn extends Model
{
    use HasFactory;

    protected $table = 'groups_vpn3e';

    protected $fillable = [
        'name',
        'network',
        'description',
        'company_id'
    ];

    public function company() : hasMany
    {
        return $this->hasMany(Company::class);
    }
}