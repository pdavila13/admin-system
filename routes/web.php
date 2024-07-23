<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\LoginWithOTPController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('locale/{locale}', function ($locale) {
    //App:setlocale($locale);
    session()->put('locale', $locale);
    return Redirect::back();
});

// Auth routes
require __DIR__.'/auth.php';
// Admin Routes
require('admin.php');
