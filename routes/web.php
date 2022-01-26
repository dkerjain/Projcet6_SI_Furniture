<?php

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

Route::get('/', 'PublicController@index')->name('public.index');
Route::get('/produk', 'PublicController@produk')->name('public.produk');
Route::post('/produk/tambah-keranjang', 'PublicController@produkTambahKeranjang')->name('public.produk.tambah-keranjang');
Route::get('/keranjang', 'PublicController@keranjang')->name('public.keranjang');
Route::get('/produk/{id}', 'PublicController@produkShow')->name('public.produk.show');
Route::get('/hapusSession/{id}','PublicController@hapusSession')->name('public.hapus-session');
Route::post('/checkout','PublicController@checkout')->name('public.checkout');
Route::get('/kontak-kami', 'PublicController@kontak')->name('public.kontak');



Route::get('/login', 'UserController@login')->name('login');
Route::post('/login/submit', 'UserController@loginProcess')->name('login.submit');


  //route admin
  Route::group(['prefix' => 'admin'],function(){
    Route::get('/','AdminController@dashboard')->name('admin.dashboard');
    Route::get('/logout','UserController@logout')->name('admin.logout');
    //penjualan
    Route::group(['prefix' => 'penjualan'], function () {
      Route::get('/','OrderController@index')->name('admin.order');
      Route::post('/store','OrderController@store')->name('admin.order.store');
      Route::post('/update', 'OrderController@update')->name('admin.order.update');
      });
  
    //pembayaran
    Route::group(['prefix' => 'pembayaran'], function () {
      Route::post('/update', 'OrderController@bayar')->name('admin.pembayaran.update');
    });

    //user
    Route::group(['prefix' => 'user'], function () {
      Route::get('/', 'UserController@index')->name('admin.user');
      Route::post('/update', 'UserController@update')->name('admin.user.update');
      Route::post('/store', 'UserController@store')->name('admin.user.store');
    });

    //produk
    Route::group(['prefix' => 'produk'], function () {
      Route::get('/','ProdukController@index')->name('admin.produk');
      Route::post('/store','ProdukController@store')->name('admin.produk.store');
      Route::post('/update', 'ProdukController@update')->name('admin.produk.update');
    });
  
    //Kategori
    Route::group(['prefix' => 'kategori'], function () {
      Route::get('/','KategoriController@index')->name('admin.kategori');
      Route::post('/store','KategoriController@store')->name('admin.kategori.store');
      Route::post('/update', 'KategoriController@update')->name('admin.kategori.update');
    });

  });
