<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupVpn extends Model
{
    use HasFactory;

    protected $table = 'group_vpn';

    protected $fillable = [
        'name',
        'network',
        'description',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
}
