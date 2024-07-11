<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\JenisPelanggaranContoller;
use App\Http\Controllers\SuratKerjaContoller;
use App\Http\Controllers\PelanggaranContoller;
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

Route::resource('parpols', ParpolController::class)->middleware(['auth', 'verified']);

Route::resource('jenispelanggarans', JenisPelanggaranContoller::class)->middleware(['auth', 'verified']);

Route::resource('suratkerjas', SuratKerjaContoller::class)->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pelanggarans', PelanggaranContoller::class);
});


require __DIR__.'/auth.php';
