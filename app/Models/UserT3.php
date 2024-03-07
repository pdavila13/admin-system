<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class UserT3 extends Model
{
    use HasFactory;

    protected $table = 'users_t3';

    protected $fillable = [
        'name',
        'nif',
        'name',
        'first_name',
        'last_name',
        'phonenumber',
        'email',
        'company_id'
    ];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
