<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::controller(AdminController::class)->group(function () {
    Route::get('admin', 'index');
    Route::get('panel/dashboard', 'dashboard');
    Route::get('panel/logkaryadaftar', 'logkaryadaftar');
    Route::get('panel/karyadaftar', 'karyadaftar');
    Route::post('panel/karyadaftarcari', 'karyadaftarcari');
    Route::get('panel/karyatambah', 'karyatambah');
    Route::post('panel/karyatambahsimpan', 'karyatambahsimpan');
    Route::get('panel/karyaedit/{id}', 'karyaedit');
    Route::post('panel/karyaeditsimpan/{id}', 'karyaeditsimpan');
    Route::get('panel/karyahapus/{id}', 'karyahapus');

    // kursus
    Route::get('panel/kursusdaftar', 'kursusdaftar');
    Route::post('panel/kursusdaftarcari', 'kursusdaftarcari');
    Route::get('panel/kursustambah', 'kursustambah');
    Route::post('panel/kursustambahsimpan', 'kursustambahsimpan');
    Route::get('panel/kursusedit/{id}', 'kursusedit');
    Route::post('panel/kursuseditsimpan/{id}', 'kursuseditsimpan');
    Route::get('panel/kursushapus/{id}', 'kursushapus');
    Route::get('panel/kursusdetail/{id}', 'kursusdetail');
    Route::get('panel/kursusdetailtambah/{id}', 'kursusdetailtambah');
    Route::post('panel/kursusdetailtambahsimpan', 'kursusdetailtambahsimpan');
    Route::get('panel/kursusdetailhapus/{id}', 'kursusdetailhapus');

    // materi
    Route::get('panel/materidaftar', 'materidaftar');
    Route::post('panel/materidaftarcari', 'materidaftarcari');
    Route::get('panel/materitambah', 'materitambah');
    Route::post('panel/materitambahsimpan', 'materitambahsimpan');
    Route::get('panel/materiedit/{id}', 'materiedit');
    Route::post('panel/materieditsimpan/{id}', 'materieditsimpan');
    Route::get('panel/materihapus/{id}', 'materihapus');

    // Guru
    Route::get('panel/gurudaftar', 'gurudaftar');
    Route::post('panel/gurudaftarcari', 'gurudaftarcari');
    Route::get('panel/gurutambah', 'gurutambah');
    Route::post('panel/gurutambahsimpan', 'gurutambahsimpan');
    Route::get('panel/guruedit/{id}', 'guruedit');
    Route::post('panel/gurueditsimpan/{id}', 'gurueditsimpan');
    Route::get('panel/guruhapus/{id}', 'guruhapus');

    // Pendaftaran Kursus
    Route::get('panel/pendaftarankursus', 'pendaftarankursus');
    Route::get('panel/pendaftarankursusdetail/{id}', 'pendaftarankursusdetail');
    Route::post('panel/pendaftarankursusupdate/{id}', 'pendaftarankursusupdate');
    Route::get('panel/pendaftarankursushapus/{idpendaftaran}/{idkursus}', 'pendaftarankursushapus');

    Route::get('panel/profil', 'profil');
    Route::get('panel/profiledit', 'profiledit');
    Route::post('panel/profileditsimpan', 'profileditsimpan');
    Route::get('panel/logout', 'logout');
    Route::get('panel/siswadaftar', 'siswadaftar');
    Route::get('panel/siswatambah', 'siswatambah');
    Route::post('panel/siswatambahsimpan', 'siswatambahsimpan');
    Route::get('panel/siswaedit/{id}', 'siswaedit');
    Route::post('panel/siswaeditsimpan/{id}', 'siswaeditsimpan');
    Route::get('panel/siswahapus/{id}', 'siswahapus');
    Route::get('panel/ulasandaftar/{id}', 'ulasandaftar');
    Route::get('panel/ulasanhapus/{idkarya}/{idulasan}', 'ulasanhapus');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('kursusdaftar', 'kursusdaftar');
    Route::post('kursusdaftarcari', 'kursusdaftarcari');
    Route::get('kursusdetail/{id}', 'kursusdetail');

    // Detail Materi
    Route::get('materidetail/{id}', 'materidetail');
    Route::post('updatemateristatus/{id}', 'updatemateristatus');
    Route::post('markasdone/{id}', 'markasdone');

    // pendaftaran kursus
    Route::get('pendaftarankursus/{id}', 'pendaftarankursus');
    Route::post('prosespendaftarankursus', 'prosespendaftarankursus');
    Route::get('riwayatpendaftaran', 'riwayatpendaftaran');

    // profile
    Route::get('profile', 'profile');
    Route::post('profileupdate', 'profileupdate');

    Route::get('tentang', 'tentang');
    Route::post('ulasansimpan', 'ulasansimpan');
    Route::get('loginakun', 'login');
    Route::post('logincek', 'logincek');
    Route::get('logout', 'logout');

    Route::get('daftar', 'daftar');
    Route::post('daftarsimpan', 'daftarsimpan');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
