<?php

use App\Http\Controllers\InfaqController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KurbanController;
use App\Http\Controllers\KurbanHewanController;
use App\Http\Controllers\KurbanPesertaController;
use App\Http\Controllers\MasjidBankController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserProfilController;
use App\Http\Middleware\EnsureDataMasjidCompleted;
use Illuminate\Support\Facades\Auth;
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

Route::get('logout-user', function () {
    Auth::logout();
    return redirect('/');
})->name('logout-user');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::resource('masjid', MasjidController::class);

    Route::middleware(EnsureDataMasjidCompleted::class)->group(function () {
        Route::resource('infaq', InfaqController::class);

        Route::resource('kurbanhewan', KurbanHewanController::class);
        
        Route::resource('kurban', KurbanController::class);
        Route::get('/exportkurbanpdf', [KurbanHewanController::class, 'exportkurbanpdf'])->name('exportkurbanpdf');
        
        Route::resource('masjidbank', MasjidBankController::class);
        Route::get('/exportbankpdf', [MasjidBankController::class, 'exportbankpdf'])->name('exportbankpdf');
        Route::get('/exportbankexcel', [MasjidBankController::class, 'exportbankexcel'])->name('exportbankexcel');
        Route::post('/importbankexcel', [MasjidBankController::class, 'importbankexcel'])->name('importbankexcel');

        Route::resource('informasi', InformasiController::class);
        Route::get('/exportinfopdf', [InformasiController::class, 'exportinfopdf'])->name('exportinfopdf');

        Route::resource('kategori', KategoriController::class);
        Route::get('/exportkategoriinformasipdf', [KategoriController::class, 'exportkategoriinformasipdf'])->name('exportkategoriinformasipdf');
        Route::get('/exportkategoriinformasiexcel', [KategoriController::class, 'exportkategoriinformasiexcel'])->name('exportkategoriinformasiexcel');
        Route::post('/importkategoriinformasiexcel', [KategoriController::class, 'importkategoriinformasiexcel'])->name('importkategoriinformasiexcel');
        
        Route::resource('profil', ProfilController::class);
        Route::get('/exportprofilpdf', [ProfilController::class, 'exportprofilpdf'])->name('exportprofilpdf');
        Route::get('/exportprofilexcel', [ProfilController::class, 'exportprofilexcel'])->name('exportprofilexcel');
        Route::post('/importprofilexcel', [ProfilController::class, 'importprofilexcel'])->name('importprofilexcel');

        Route::resource('kas', KasController::class);
        Route::get('/exportkaspdf', [KasController::class, 'exportkaspdf'])->name('exportkaspdf');
        Route::get('/exportkasexcel', [KasController::class, 'exportkasexcel'])->name('exportkasexcel');
        // Route::post('/importkasexcel', [KasController::class, 'importkasexcel'])->name('importkasexcel');
        
        Route::resource('userprofil', UserProfilController::class);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
    });
});
