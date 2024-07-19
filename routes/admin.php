<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupVpnController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\Inventory\MarcaModelController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('group_vpn',GroupVpnController::class);
    Route::resource('company',CompanyController::class);
    Route::resource('petition',PetitionController::class);

    Route::resource('inventary',InventoryController::class);
    Route::resource('integration',IntegrationController::class);

    Route::get('/marca-model', [MarcaModelController::class, 'index'])->name('marca-model.index');
    Route::post('/marca-model/store', [MarcaModelController::class, 'store'])->name('marca-model.store');

    Route::get('/get-marcas', [MarcaModelController::class, 'getMarcas'])->name('get-marcas');
    Route::get('/get-modelos', [MarcaModelController::class, 'getModelos'])->name('get-modelos');

    Route::get('/get-models/{trademark}', [App\Http\Controllers\InventoryController::class, 'getModels'])->name('get.models');
    Route::get('/get-centers/{zona}', [App\Http\Controllers\InventoryController::class, 'getCenters'])->name('get.centers');
    Route::get('/get-plantas/{centroId}', [App\Http\Controllers\InventoryController::class, 'getPlantas'])->name('get.plantas');
});
