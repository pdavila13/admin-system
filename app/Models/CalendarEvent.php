<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'start', 'end', 'backgroundColor', 'borderColor', 'textColor'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
