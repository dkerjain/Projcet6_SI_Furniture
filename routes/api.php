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

Route::group(['prefix' => 'produk'], function () {
  Route::get('/{id}','ProdukController@showApi')->name('api.produk.show');
});

Route::group(['prefix' => 'alamat'], function () {
  Route::get('provinsi/','AlamatController@getprovinsi')->name('api.alamat.provinsi');
  Route::get('kota/{ID_PROVINSI}','AlamatController@getkota')->name('api.alamat.kota');
  Route::get('kecamatan/{ID_KOTA}','AlamatController@getkecamatan')->name('api.alamat.kecamatan'); 
  Route::get('kelurahan/{ID_KECAMATAN}','AlamatController@getkelurahan')->name('api.alamat.kelurahan');
});
