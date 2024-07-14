<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\JenisPelanggaranContoller;
use App\Http\Controllers\SuratKerjaContoller;
use App\Http\Controllers\PelanggaranContoller;
use App\Http\Controllers\LaporanPelanggaranController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('parpols', ParpolController::class);
    Route::get('printAllParpols', [ReportController::class, 'printAllParpols'])->name('printAllParpols');
    Route::get('printAllParpolsById/{id}', [ReportController::class, 'printAllParpolsById'])->name('printAllParpolsById');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('jenispelanggarans', JenisPelanggaranContoller::class);
    Route::get('printAllJenisPelanggarans', [ReportController::class, 'printAllJenisPelanggarans'])->name('printAllJenisPelanggarans');
    Route::get('printAllJenisPelanggaransById/{id}', [ReportController::class, 'printAllJenisPelanggaransById'])->name('printAllJenisPelanggaransById');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('suratkerjas', SuratKerjaContoller::class);
    Route::get('printAllSuratKerjas', [ReportController::class, 'printAllSuratKerjas'])->name('printAllSuratKerjas');    
    Route::get('printAllSuratKerjasById/{id}', [ReportController::class, 'printAllSuratKerjasById'])->name('printAllSuratKerjasById');
    Route::get('parpols/{id}/pelanggarans', [ParpolController::class, 'pelanggaran'])->name('parpols.pelanggarans');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('jenispelanggarans', JenisPelanggaranContoller::class)->middleware(['auth', 'verified']);


    Route::get('jenispelanggarans/{id}/pelanggarans', [JenisPelanggaranContoller ::class, 'pelanggaran'])->name('jenispelanggarans.pelanggarans');
});

Route::resource('suratkerjas', SuratKerjaContoller::class)->middleware(['auth', 'verified']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pelanggarans', PelanggaranContoller::class);
    Route::get('printAllPelanggarans', [ReportController::class, 'printAllPelanggarans'])->name('printAllPelanggarans');    
    Route::get('printAllPelanggaransById/{id}', [ReportController::class, 'printAllPelanggaransById'])->name('printAllPelanggaransById');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('laporanpelanggarans', LaporanPelanggaranController::class);
    Route::get('laporanpelanggarans/regency/{province_id}', [LaporanPelanggaranController::class, 'getRegency']);
    Route::get('laporanpelanggarans/districts/{regency_id}', [LaporanPelanggaranController::class, 'getDistricts']);
    Route::get('laporanpelanggarans/villages/{district_id}', [LaporanPelanggaranController::class, 'getVillages']);
    Route::patch('laporanpelanggarans/{laporanpelanggaran}/verif', [LaporanPelanggaranController::class, 'verify'])->name('laporanpelanggarans.verif');
    Route::patch('laporanpelanggarans/{laporanpelanggaran}/reject', [LaporanPelanggaranController::class, 'reject'])->name('laporanpelanggarans.reject');
    Route::get('printAllLaporanPelanggaran', [ReportController::class, 'printAllLaporanPelanggaran'])->name('printAllLaporanPelanggaran');    
    Route::get('printAllLaporanPelanggaranById/{id}', [ReportController::class, 'printAllLaporanPelanggaranById'])->name('printAllLaporanPelanggaranById');
});

require __DIR__.'/auth.php';
