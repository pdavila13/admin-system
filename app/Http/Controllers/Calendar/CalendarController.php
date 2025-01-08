<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function __construct() {
        //
    }

    public function index()
    {
        return view('admin.calendar.index');
    }
}