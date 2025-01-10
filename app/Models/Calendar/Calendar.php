<?php

namespace App\Models\Calendar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIF', 'PrimerCognom', 'SegonCognom', 'Nom', 'DataInici', 'DataFi'
    ];
}