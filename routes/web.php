<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\ConsumenController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WorkOrderController;
use App\Models\WorkOrder;
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
    Route::get('/item/{id}/edit',[ItemController::class,'edit'])->name('itemedit');

    Route::get('/teknisi',[TeknisiController::class,'index'])->name('teknisi');
    Route::post('/teknisi/create', [TeknisiController::class, 'create'])->name('teknisicreate');
    Route::get('/teknisi/{id}/edit', [TeknisiController::class, 'edit'])->name('teknisiedit');
    Route::delete('/teknisi/{id}/delete', [TeknisiController::class, 'delete'])->name('teknisidelete');

    Route::get('/consumen', [ConsumenController::class, 'index'])->name('consumen');
    Route::post('/consumen/create', [ConsumenController::class, 'create'])->name('consumencreate');
    Route::get('/consumen/{id}/edit', [ConsumenController::class, 'edit'])->name('consumenedit');
    Route::delete('/consumen/{id}/delete', [ConsumenController::class, 'delete'])->name('consumendelete');


    Route::get('/pimpinan', [PimpinanController::class, 'index'])->name('pimpinan');
    Route::post('/pimpinan/create', [PimpinanController::class, 'create'])->name('pimpinancreate');
    Route::get('/pimpinan/{id}/edit', [PimpinanController::class, 'edit'])->name('pimpinanedit');
    Route::delete('/pimpinan/{id}/delete', [PimpinanController::class, 'delete'])->name('pimpinandelete');

    Route::get('/paket', [PaketController::class, 'index'])->name('paket');
    Route::post('/paket/create', [PaketController::class, 'create'])->name('paketcreate');
    Route::delete('/paket/{id}/delete', [PaketController::class, 'delete'])->name('paketdelete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier/create', [SupplierController::class, 'create'])->name('suppliercreate');
    Route::delete('/supplier/{id}/delete', [SupplierController::class, 'delete'])->name('supplierdelete');

    Route::get('/barang_keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');
    Route::post('/barang_keluar/create', [BarangKeluarController::class, 'create'])->name('barangkeluarcreate');
    Route::delete('/barang_keluar/{id}/delete', [BarangKeluarController::class, 'delete'])->name('barangkeluardelete');

    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');
    Route::post('/workorder/create', [WorkOrderController::class, 'create'])->name('workordercreate');
    Route::delete('/workorder/{id}/delete', [WorkOrderController::class, 'delete'])->name('workorderdelete');

    Route::get('/pengajuan_instalasi', [InstalasiController::class, 'index'])->name('instalasi');

    Route::post('/pengajuan_instalasi/create', [InstalasiController::class, 'create'])->name('instalasicreate');
    Route::delete('/pengajuan_instalasi/{id}/delete', [InstalasiController::class, 'delete'])->name('instalasidelete');
    Route::get('/pengajuan_instalasi/{id}/edit', [InstalasiController::class, 'edit'])->name('instalasiedit');
    Route::get('/pengajuan_instalasi/laporan', [InstalasiController::class, 'laporan'])->name('instalasilaporan');
    Route::post('/pengajuan_instalasi/download', [InstalasiController::class, 'download'])->name('instalasidownload');

    Route::get('/laporan',[LaporanController::class,'index'])->name('laporan');

});
Route::prefix('teknisi')->middleware('auth', 'role:teknisi')->name('teknisi_')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');
    Route::get('/workorder/proseswo/{id}', [WorkOrderController::class, 'proseswo'])->name('proseswo');
    Route::get('/workorder/selesaiwo/{id}', [WorkOrderController::class, 'selesaiwo'])->name('selesaiwo');

});


Route::prefix('pimpinan')->middleware('auth', 'role:pimpinan')->name('pimpinan_')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/item', [ItemController::class, 'index'])->name('item');
    Route::post('/item/create', [ItemController::class, 'create'])->name('itemcreate');
    Route::delete('/item/{id}/delete', [ItemController::class, 'delete'])->name('itemdelete');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('itemedit');


    Route::get('/paket', [PaketController::class, 'index'])->name('paket');
    Route::post('/paket/create', [PaketController::class, 'create'])->name('paketcreate');
    Route::delete('/paket/{id}/delete', [PaketController::class, 'delete'])->name('paketdelete');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier/create', [SupplierController::class, 'create'])->name('suppliercreate');
    Route::delete('/supplier/{id}/delete', [SupplierController::class, 'delete'])->name('supplierdelete');

    Route::get('/barang_keluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');
    Route::post('/barang_keluar/create', [BarangKeluarController::class, 'create'])->name('barangkeluarcreate');
    Route::delete('/barang_keluar/{id}/delete', [BarangKeluarController::class, 'delete'])->name('barangkeluardelete');

    Route::get('/workorder', [WorkOrderController::class, 'index'])->name('workorder');
    Route::post('/workorder/create', [WorkOrderController::class, 'create'])->name('workordercreate');
    Route::delete('/workorder/{id}/delete', [WorkOrderController::class, 'delete'])->name('workorderdelete');

    Route::get('/pengajuan_instalasi', [InstalasiController::class, 'index'])->name('instalasi');

    Route::post('/pengajuan_instalasi/create', [InstalasiController::class, 'create'])->name('instalasicreate');
    Route::delete('/pengajuan_instalasi/{id}/delete', [InstalasiController::class, 'delete'])->name('instalasidelete');
    Route::get('/pengajuan_instalasi/laporan', [InstalasiController::class, 'laporan'])->name('instalasilaporan');
    Route::post('/pengajuan_instalasi/download', [InstalasiController::class, 'download'])->name('instalasidownload');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});
