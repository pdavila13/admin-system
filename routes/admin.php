<?php

use Illuminate\Support\Facades\Route;
use App\Models\Inventory\TipusAparell;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VCenterController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GroupVpnController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Inventory\MarcaModelController;
use App\Http\Controllers\Inventory\TipusAparellController;

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
    Route::resource('calendar',CalendarController::class);

    Route::get('/vms/index', [VCenterController::class, 'index'])->name('vms.index');
    Route::post('/update-vm', [VCenterController::class, 'update'])->name('update');
     Route::get('/datatable/vms', [VCenterController::class, 'vms'])->name('datatable.vms');

    Route::post('/clear-upgrade-status', [VCenterController::class, 'clearUpgradeStatus'])->name('clearUpgradeStatus');
 
    Route::resource('integration',IntegrationController::class);

    Route::get('/marca-model', [MarcaModelController::class, 'index'])->name('marca-model.index');
    Route::post('/marca-model/store', [MarcaModelController::class, 'store'])->name('marca-model.store');

    Route::get('/get-marcas', [MarcaModelController::class, 'getMarcas'])->name('get-marcas');
    Route::get('/get-modelos', [MarcaModelController::class, 'getModelos'])->name('get-modelos');

    Route::resource('inventary',InventoryController::class);
    Route::get('/get-inventary', [InventoryController::class, 'getData'])->name('get-inventary');
    Route::get('/get-centers/{zona}', [InventoryController::class, 'getCenters'])->name('get.centers');
    Route::get('/get-models/{trademark}', [InventoryController::class, 'getModels'])->name('get.models');
    Route::get('/get-plantas/{centroId}', [InventoryController::class, 'getPlantas'])->name('get.plantas');

    Route::resource('catalog',CatalogController::class)->only('index');
    Route::post('/catalog/search', [CatalogController::class, 'search'])->name('catalog.search');

    Route::resource('tipus_aparell',TipusAparellController::class)->only('index','store','update');
});
