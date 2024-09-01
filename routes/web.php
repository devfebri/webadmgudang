<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\ConsumenController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[AuthController::class,'login'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware('auth', 'role:admin')->name('admin_')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/item',[ItemController::class,'index'])->name('item');
    Route::post('/item/create',[ItemController::class,'create'])->name('itemcreate');
    Route::delete('/item/{id}/delete',[ItemController::class,'delete'])->name('itemdelete');
    // Route::post('/item/edit',[ItemController::class,'edit'])->name('itemedit');

    Route::get('/teknisi',[TeknisiController::class,'index'])->name('teknisi');
    Route::post('/teknisi/create', [TeknisiController::class, 'create'])->name('teknisicreate');
    Route::delete('/teknisi/{id}/delete', [TeknisiController::class, 'delete'])->name('teknisidelete');

    Route::get('/consumen', [ConsumenController::class, 'index'])->name('consumen');
    Route::post('/consumen/create', [ConsumenController::class, 'create'])->name('consumencreate');
    Route::delete('/consumen/{id}/delete', [ConsumenController::class, 'delete'])->name('consumendelete');

    Route::get('/paket', [PaketController::class, 'index'])->name('paket');
    Route::post('/paket/create', [PaketController::class, 'create'])->name('paketcreate');
    Route::delete('/paket/{id}/delete', [PaketController::class, 'delete'])->name('paketdelete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier/create', [SupplierController::class, 'create'])->name('suppliercreate');
    Route::delete('/supplier/{id}/delete', [SupplierController::class, 'delete'])->name('supplierdelete');

    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');
    Route::post('/workorder/create', [WorkOrderController::class, 'create'])->name('workordercreate');
    Route::delete('/workorder/{id}/delete', [WorkOrderController::class, 'delete'])->name('workorderdelete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pengajuan_instalasi', [InstalasiController::class, 'index'])->name('instalasi');

    Route::post('/pengajuan_instalasi/create', [InstalasiController::class, 'create'])->name('instalasicreate');



});

Route::prefix('consumen')->middleware('auth', 'role:consumen')->name('consumen_')->group(function () {
});
Route::prefix('teknisi')->middleware('auth', 'role:teknisi')->name('teknisi_')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');
    Route::get('/workorder/proseswo/{id}', [WorkOrderController::class, 'proseswo'])->name('proseswo');
    Route::get('/workorder/selesaiwo/{id}', [WorkOrderController::class, 'selesaiwo'])->name('selesaiwo');

});
