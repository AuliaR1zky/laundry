<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
        Route::get('/', function(){
            return Auth::user()->level;
        })->middleware('jwt.verify');

Route::get('user','PetugasController@getAuthenticatedUser');


//pelanggan
Route::post('/simpan_pelanggan','PelangganController@store')->middleware('jwt.verify');
Route::put('/ubah_pelanggan/{id}','PelangganController@update')->middleware('jwt.verify');
Route::delete('/hapus_pelanggan/{id}','PelangganController@hapus')->middleware('jwt.verify');
Route::get('/tampil_pelanggan','PelangganController@tampil')->middleware('jwt.verify');

//jenis
Route::post('/simpan_jenis','JenisController@store')->middleware('jwt.verify');
Route::put('/ubah_jenis/{id}','JenisController@update')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}','JenisController@hapus')->middleware('jwt.verify');
Route::get('/tampil_jenis','JenisController@tampil')->middleware('jwt.verify');

//detail
Route::post('/simpan_detail','TransaksiController@simpan')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','TransaksiController@ubah')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','TransaksiController@destroy')->middleware('jwt.verify');
Route::get('/tampil_detail','TransaksiController@tampil_detail')->middleware('jwt.verify');

//transaksi
Route::post('/simpan_transaksi','TransaksiController@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}','TransaksiController@update')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}','TransaksiController@hapus')->middleware('jwt.verify');
Route::get('/tampil_transaksi','TransaksiController@tampil')->middleware('jwt.verify');

//report
Route::get('/report/{tgl_transaksi}/{tgl_selesai}','TransaksiController@report')->middleware('jwt.verify');

