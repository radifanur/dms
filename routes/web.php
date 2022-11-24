<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\UserController;
use App\Models\Dokumen;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/linkstorage', function () {
    $link = Artisan::call('storage:link');
    if ($link) {
        echo "TRUE";
    }
});

Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});



Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/registrasi', [AuthController::class, 'indexRegistrasi'])->name('registrasi');
Route::post('/daftar', [AuthController::class, 'registrasi'])->name('users.registrasi');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('main');
    
    Route::group(['middleware' => ['admin']], function(){
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{id}/{aktivasi}', [UserController::class, 'aktivasi'])->name('users.aktivasi');
        Route::get('/kategori', [DokumenController::class, 'kategori'])->name('kategori');
        Route::post('/kategori/store', [DokumenController::class, 'kategoriStore'])->name('kategori.store');
        Route::get('/kategori/delete/{id}', [DokumenController::class, 'kategoriDelete'])->name('kategori.delete');
    });
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/pdf-upload', [DokumenController::class, 'pdfUpload'])->name('pdfUpload');
    Route::delete('/pdf-delete', [DokumenController::class, 'pdfDelete'])->name('pdfDelete');
    Route::get('/dokumen/baru', [DokumenController::class, 'baru'])->name('dokumen.baru');
    Route::post('/dokumen/store', [DokumenController::class, 'store'])->name('dokumen.store');
    Route::get('/dokumen/{kategori}/{slug}', [DokumenController::class, 'show'])->name('dokumen.show');
    Route::get('/dokumen/{kategori}', [DokumenController::class, 'filterKategori'])->name('dokumen.kategori');
});
