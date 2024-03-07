<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PetitionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function petitions(): HasMany
    {
        return $this->hasMany(Petition::class);
    }
}