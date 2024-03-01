<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'name',
        'cif',
        'description',
    ];

    public function groupVpn()
    {
        return $this->belongsTo(GroupVpn::class,'group_vpn_id');
    }
}
