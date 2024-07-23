<?php

namespace App\Http\Controllers;

use Carbon\Carbon; 
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:admin.dashboard')->only('index');
    }

    public function index()
    {
        $petitions = Petition::where('datepicker', '>=', DB::raw('DATE_SUB(CURDATE(), INTERVAL 30 DAY)'))
                    ->orderBy('datepicker','DESC')
                    ->get();

        return view('dashboard', compact('petitions'));
    }
}
