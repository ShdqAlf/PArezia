<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KelolaUser;
use App\Http\Controllers\Admin\KelolaTes;
use App\Http\Controllers\Admin\KelolaLokerController;
use App\Http\Controllers\Admin\KelolaBobotController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pelamar\PelamarController;
use App\Http\Controllers\Pelamar\TesController;
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
    Route::post('/prosespendaftaran', [AuthController::class, 'proses_register'])->name('proses.pendaftaran');
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/email/verifikasi', [AuthController::class, 'verifikasi'])->name('verification.notice');
    Route::get('/email/verifikasi/{id}/{hash}', [AuthController::class, 'handler_verification'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verifikasi-notification', [AuthController::class, 'resend_email'])->middleware('throttle:6,1')->name('verification.send');

    // pelamar
    Route::middleware(['verified', 'role:Pelamar'])->prefix('/pelamar')->name('pelamar')->group(function () {
        // lowongan - tes
        Route::get('/', [PelamarController::class, 'index'])->name('.dashboard');
        Route::get('/teskemampuan/{id}', [TesController::class, 'index'])->name('.test.kemampuan');
        Route::get('/teskemampuan/download/{file}', [TesController::class, 'download_file'])->name('.download.file');
    });


    // admin
    Route::middleware('role:Admin')->prefix('/admin')->name('admin')->group(function () {
        // dashboard
        Route::get('/', [AdminController::class, 'index'])->name('.dashboard');

        // kelola user
        Route::get('/kelolauser', [KelolaUser::class, 'index'])->name('.kelolauser.index');
        Route::post('/kelolauser/tambah-pengguna', [KelolaUser::class, 'tambahPengguna'])->name('.kelolauser.tambah-pengguna');
        Route::delete('/kelolauser/{user}', [KelolaUser::class, 'hapusPengguna'])->name('.kelolauser.hapus-pengguna');
        Route::put('/kelolauser/{user}', [KelolaUser::class, 'edit'])->name('.kelolauser.edit');

        // kelola tes
        Route::get('/kelolates', [KelolaTes::class, 'index'])->name('.kelolates.index');
        Route::post('/kelolates/tambah-tes', [KelolaTes::class, 'tambahTes'])->name('.kelolates.tambah-tes');
        Route::delete('/kelolates/hapus-tes/{id}', [KelolaTes::class, 'hapusTes'])->name('.kelolates.hapus-tes');
        Route::put('/kelolates/{tes}', [KelolaTes::class, 'edit'])->name('.kelolates.edit');

        // kelola lowongan
        Route::get('/kelolaloker', [KelolaLokerController::class, 'index'])->name('.kelolaloker.index');
        Route::post('/kelolaloker/tambah-loker', [KelolaLokerController::class, 'tambahLoker'])->name('.kelolaloker.tambah-loker');
        Route::delete('/kelolaloker/{id}', [KelolaLokerController::class, 'hapusLoker'])->name('.kelolaloker.hapus-loker');
        Route::put('/kelolaloker/{row}', [KelolaLokerController::class, 'editLoker'])->name('.kelolaloker.edit');

        // kelola bobot
        Route::get('/kelolabobot', [KelolaBobotController::class, 'index'])->name('.kelolabobot.index');
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
