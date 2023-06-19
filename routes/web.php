<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TuController;
use App\Models\Siswa;
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
    return view('login');
});

//proses login dan buat akun
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');

//login berdasarkan level
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:Guru']], function () {
        Route::resource('Guru', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');

    });
    Route::group(['middleware' => ['cek_login:Tata_usaha']], function () {
        Route::resource('Tata_usaha', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');
    });
});

//data siswa
Route::get('siswa/siswa',[SiswaController::class, 'index'])->name('siswa/siswa');//menampilkan data siswa
Route::get('siswa/tambah_siswa',[SiswaController::class, 'create'])->name('siswa/tambah_siswa');//input siswa
Route::post('siswa/tambah_siswa',[SiswaController::class, 'store'])->name('siswa.store');//proses tambah data siswa
Route::get('siswa/edit_siswa/{id}',[SiswaController::class, 'edit_siswa'])->name('siswa/edit_siswa');//edit datasiswa
Route::post('updatesiswa/{id}',[SiswaController::class, 'update'])->name('updatesiswa');//proses edit data siswa
Route::get('siswa/hapus_siswa/{id}',[SiswaController::class, 'destroy'])->name('hapus_iswa');//proses edit data siswa

//data guru
Route::get('data_guru/guru', [GuruController::class,'index'])->name('guru/guru');//menampilkan data guru
Route::get('profil/tambah_guru',[GuruController::class,'create'])->name('profil/guru');//tambah dara guru
Route::post('profil/tambah_guru',[GuruController::class, 'store'])->name('guru.store');//proses tambah data guru
Route::get('data_guru/hapus_guru/{id}&{id_user}',[GuruController::class, 'destroy'])->name('hapus_guru');//proses edit data guru

//profil
Route::get('profil/profil/{id}',[GuruController::class,'profil'])->name('profil/profil');//menampilkan data profil
Route::get('profil/edit_guru/{id}',[GuruController::class,'edit_guru'])->name('profil/edit_guru');//edit profil
Route::post('updateguru/{id}',[GuruController::class, 'update'])->name('updateguru');//proses update profil

//pengguna
Route::get('pengguna/pengguna', [PenggunaController::class,'index'])->name('pengguna/pengguna');//menampilkan data pengguna
Route::get('pengguna/edit_pengguna/{id}', [PenggunaController::class,'edit_pengguna'])->name('pengguna/edit_pengguna');//edit pengguna
Route::post('updatepengguna/{id}',[PenggunaController::class, 'update'])->name('updatepengguna');//proses upodate pengguna