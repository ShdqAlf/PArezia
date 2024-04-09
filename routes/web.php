<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KelolaUser;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pelamar\PelamarController;
use App\Http\Controllers\Pimpinan\PimpinanController;
use App\Http\Controllers\Staff\StaffController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::middleware('guest')->group(function () {
    // login
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');

    // register
    Route::get('/pendaftaran', [AuthController::class, 'register'])->name('pendaftaran');
    Route::get('/prosespendaftaran', [AuthController::class, 'proses_register'])->name('proses.pendaftaran');

});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // pelamar
    Route::middleware('role:Pelamar')->prefix('/pelamar')->name('pelamar')->group(function () {
        // dashboard
        Route::get('/', [PelamarController::class, 'index'])->name('.dashboard');
    });


    // admin
    Route::middleware('role:Admin')->prefix('/admin')->name('admin')->group(function () {
        // dashboard
        Route::get('/', [AdminController::class, 'index'])->name('.dashboard');

        // kelola user
        Route::get('/kelolauser', [KelolaUser::class, 'index'])->name('.kelolauser.index');
        Route::post('/kelolauser/tambah-pengguna', [KelolaUser::class, 'tambahPengguna'])->name('.kelolauser.tambah-pengguna');
    });


    // pimpinan
    Route::middleware('role:Pimpinan')->prefix('/pimpinan')->name('pimpinan')->group(function () {
        // dashboard
        Route::get('/', [PimpinanController::class, 'index'])->name('.dashboard');
    });


    // staff
    Route::middleware('role:Staff')->prefix('/staff')->name('staff')->group(function () {
        // dashboard
        Route::get('/', [StaffController::class, 'index'])->name('.dashboard');
    });
});
