<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vCenterVM extends Model
{
    use HasFactory;

    protected $table = 'vcenter_vms';

    protected $fillable = [
        'vm_id',
        'name',
        'power_state',
        // 'creation_date',
        // 'annotation',
        'guest_OS',
        // 'criticality',
        'tools_version_status',
        'hardware_version',
        // 'upgrade_status',
    ];
}
