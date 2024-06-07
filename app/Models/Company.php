<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cif',
        'description',
        'active',
    ];
    
    public function groupVpn(): BelongsTo
    {
        return $this->belongsTo(GroupVpn::class);
    }

    public function userT3(): BelongsToMany
    {
        return $this->belongsToMany(UserT3::class);
    }

    public function petitions(): HasMany
    {
        return $this->hasMany(Petition::class);
    }
}
