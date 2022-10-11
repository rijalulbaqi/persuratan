<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\RegisterController;
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
    return redirect('login');
});
Route::fallback(function () {
    return view('lost');
});


Auth::routes();

Route::middleware(['auth'])->group(function () {
 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 
    Route::middleware(['admin'])->group(function () {
        //Home
        Route::get('admin', [AdminController::class, 'index']);
        //ubah password
        Route::get('admin/ubahpassword', [AdminController::class,'ubahpassword']);
        Route::post('admin/ubahpassword', [AdminController::class,'simpanpassword']);
        //Menu pengguna
        Route::get('admin/pengguna', [AdminController::class,'pengguna']);
        Route::post('tambahpengguna', [AdminController::class,'tambahpengguna']);
        Route::get('admin/datapengguna', [AdminController::class,'datatablepengguna']);
        Route::post('admin/pengguna/ubahpassword', [AdminController::class,'ubahpasswordpengguna']);
        Route::post('deletepengguna/{id}', [AdminController::class,'deletepengguna']);
        //Menu Surat Masuk
        Route::get('admin/suratmasuk', [AdminController::class,'suratmasuk']);
        Route::post('tambahsuratmasuk', [AdminController::class,'tambahsuratmasuk']);
        Route::get('admin/datasuratmasuk', [AdminController::class,'datatablesuratmasuk']);
        Route::get('showsuratmasuk/{id}', [AdminController::class,'showsuratmasuk']);
        Route::get('editsuratmasuk/{id}', [AdminController::class,'editsuratmasuk']);
        Route::post('admin/ubahsuratmasuk', [AdminController::class,'ubahsuratmasuk']);
        Route::post('deletesuratmasuk/{id}', [AdminController::class,'deletesuratmasuk']);
        Route::post('admin/cetaklaporansuratmasuk', [AdminController::class,'exportsuratmasuk']);
        Route::post('admin/filterlaporansuratmasuk', [AdminController::class,'filtersuratmasuk']);
        //jenis surat
        Route::get('admin/jenissurat', [AdminController::class,'jenissurat']);
        Route::post('admin/tambahjenissurat', [AdminController::class,'tambahjenissurat']);
        Route::get('admin/datajenissurat', [AdminController::class,'datatablejenissurat']);
        Route::get('editjenissurat/{id}', [AdminController::class,'editjenissurat']);
        Route::post('admin/ubahjenissurat', [AdminController::class,'ubahjenissurat']);
        Route::post('deletejenissurat/{id}', [AdminController::class,'deletejenissurat']);
        //jenis surat
        Route::get('admin/perihal', [AdminController::class,'perihal']);
        Route::post('admin/tambahperihal', [AdminController::class,'tambahperihal']);
        Route::get('admin/dataperihal', [AdminController::class,'datatableperihal']);
        Route::get('editperihal/{id}', [AdminController::class,'editperihal']);
        Route::post('admin/ubahperihal', [AdminController::class,'ubahperihal']);
        Route::post('deleteperihal/{id}', [AdminController::class,'deleteperihal']);
        //pengaturan
        Route::get('admin/pengaturan', [AdminController::class,'pengaturan']);
        Route::post('admin/updatepengaturan', [AdminController::class,'updatepengaturan']);
        //Menu Surat Keluar
        Route::get('admin/suratkeluar', [AdminController::class,'suratkeluar']);
        Route::post('tambahsuratkeluar', [AdminController::class,'tambahsuratkeluar']);
        Route::get('admin/datasuratkeluar', [AdminController::class,'datatablesuratkeluar']);
        Route::get('showsuratkeluar/{id}', [AdminController::class,'showsuratkeluar']);
        Route::get('editsuratkeluar/{id}', [AdminController::class,'editsuratkeluar']);
        Route::post('admin/ubahsuratkeluar', [AdminController::class,'ubahsuratkeluar']);
        Route::post('deletesuratkeluar/{id}', [AdminController::class,'deletesuratkeluar']);
        Route::get('printsuratkeluar/{id}', [AdminController::class,'printsuratkeluar']);
        Route::post('admin/resetnomor', [AdminController::class,'resetnomor']);
        Route::get('admin/uploadsuratkeluar/{id}', [AdminController::class,'unggahsuratkeluar']);
        Route::post('admin/uploadsuratkeluar', [AdminController::class,'uploadsuratkeluar']);
        Route::post('admin/filterlaporansuratkeluar', [AdminController::class,'filtersuratkeluar']);
        Route::post('admin/cetaklaporansuratkeluar', [AdminController::class,'exportsuratkeluar']);
    });

    Route::middleware(['kepsek'])->group(function () {
        //Home
        Route::get('kepsek', [KepsekController::class, 'index']);
        Route::get('kepsek/ubahpassword', [KepsekController::class,'ubahpassword']);
        Route::post('kepsek/ubahpassword', [KepsekController::class,'simpanpassword']);
        //Menu pengguna
        Route::get('kepsek/pengguna', [KepsekController::class,'pengguna']);
        Route::get('kepsek/datapengguna', [KepsekController::class,'datatablepengguna']);
        //Menu Surat Masuk
        Route::get('kepsek/suratmasuk', [KepsekController::class,'suratmasuk']);
        Route::get('kepsek/datasuratmasuk', [KepsekController::class,'datatablesuratmasuk']);
        //Menu Surat Masuk
        Route::get('kepsek/suratkeluar', [KepsekController::class,'suratkeluar']);
        Route::get('kepsek/datasuratkeluar', [KepsekController::class,'datatablesuratkeluar']);
        
    });
    
    Route::get('/lost', [App\Http\Controllers\HomeController::class, 'lost']);
 
});










