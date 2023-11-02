<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/cetak_home/{id}', 'App\Http\Controllers\HomeController@cetak');

//KRITERIA
Route::get('/kriteria', 'App\Http\Controllers\KriteriaController@index');;
Route::get('/kriteria_tambah', 'App\Http\Controllers\KriteriaController@create');
Route::post('/kriteria_simpan', 'App\Http\Controllers\KriteriaController@store');
Route::get('/kriteria_ubah/{id}', 'App\Http\Controllers\KriteriaController@show');
Route::post('/kriteria_ubah_simpan/{id}', 'App\Http\Controllers\KriteriaController@update');
Route::get('/kriteria_hapus/{id}', 'App\Http\Controllers\KriteriaController@destroy');

//ALTERNATIF
Route::get('/alternatif', 'App\Http\Controllers\AlternatifController@index');;
Route::get('/alternatif_tambah', 'App\Http\Controllers\AlternatifController@create');
Route::post('/alternatif_simpan', 'App\Http\Controllers\AlternatifController@store');
Route::get('/alternatif_ubah/{id}', 'App\Http\Controllers\AlternatifController@show');
Route::post('/alternatif_ubah_simpan/{id}', 'App\Http\Controllers\AlternatifController@update');
Route::get('/alternatif_hapus/{id}', 'App\Http\Controllers\AlternatifController@destroy');

// RELASI
Route::get('/relasi', 'App\Http\Controllers\RelasiController@index');;
Route::get('/relasi_ubah/{id}', 'App\Http\Controllers\RelasiController@show');
Route::post('/relasi_ubah_simpan/{id}', 'App\Http\Controllers\RelasiController@update');


// RELASI
Route::get('/rel_kriteria', 'App\Http\Controllers\Rel_kriteriaController@index');;
Route::post('/rel_kriteria_ubah', 'App\Http\Controllers\Rel_kriteriaController@update');

// HITUNG
Route::get('/perhitungan', 'App\Http\Controllers\HitungController@index');

Route::get('/cetak_hasil/{id}/{id2}', 'App\Http\Controllers\HitungController@cetak_hasil');