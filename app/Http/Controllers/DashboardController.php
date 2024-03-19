<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();

        $petitions = DB::table('petitions')
                    ->where('datepicker', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
                    ->get();

        return view('dashboard', compact('petitions'));
    }
}
