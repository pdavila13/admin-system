<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'Data', 'Descripcio', 'idCalendari'
    ];
}