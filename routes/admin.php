<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GroupVpnController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\SubCateoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCateoryController::class);
    Route::resource('collection',CollectionController::class);
    Route::resource('group_vpn',GroupVpnController::class);
    Route::resource('company',CompanyController::class);
    Route::resource('petition',PetitionController::class);
    Route::get('/get/subcategory',[GroupVpnController::class,'getsubcategory'])->name('getsubcategory');
    Route::get('/remove-external-img/{id}',[GroupVpnController::class,'removeImage'])->name('remove.image');
});
