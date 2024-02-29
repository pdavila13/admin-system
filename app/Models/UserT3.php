<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserT3 extends Model
{
    use HasFactory;

    protected $table = 't3_users';

    protected $fillable = [
        'name',
        'nif',
        'name',
        'first_name',
        'last_name',
        'phonenumber',
        'email'
    ];
}
