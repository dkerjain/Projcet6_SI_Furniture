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
Route::get('/tracking', 'PublicController@tracking')->name('public.tracking');
Route::get('/produk/{id}', 'PublicController@produkShow')->name('public.produk.show');
Route::get('/hapusSession/{id}','PublicController@hapusSession')->name('public.hapus-session');
Route::post('/checkout','PublicController@checkout')->name('public.checkout');
Route::get('/kontak-kami', 'PublicController@kontak')->name('public.kontak');
Route::get('/pembayaran/{id}', 'PublicController@pembayaran')->name('public.pembayaran');
Route::post('/pembayaran/{id}', 'PublicController@pembayaranStore')->name('public.pembayaran.store');
Route::get('/downloadnota/{id}','PublicController@downloadnota')->name('public.pembayaran.downloadnota');



Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@loginProcess')->name('login.submit');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Auth::routes();

  //route admin
  Route::group(['prefix' => 'admin'],function(){
    Route::get('/','AdminController@dashboard')->name('admin.dashboard');
    Route::get('/laporan', 'AdminController@laporan')->name('admin.penjualan.laporan');
    Route::get('/export-pdf', 'AdminController@exportPDF');
    Route::get('/logout','UserController@logout')->name('admin.logout');
    //penjualan
    Route::group(['prefix' => 'penjualan'], function () {
      Route::get('/','OrderController@index')->name('admin.order');
      Route::get('/history','OrderController@history')->name('admin.history');
      Route::get('/create','OrderController@create')->name('admin.order.create');
      Route::post('/store','OrderController@store')->name('admin.order.store');
      Route::post('/update', 'OrderController@update')->name('admin.order.update');
      Route::get('/{id}','OrderController@show')->name('admin.order.show');
      Route::get('/print/{id}','OrderController@print')->name('admin.order.print');
      Route::get('/print-view/{id}','OrderController@printView')->name('admin.order.print.view');
      Route::get('/download/{id}','OrderController@download')->name('admin.order.download');
      Route::post('/delete/{id}','OrderController@destroy')->name('admin.order.destroy');
      });
  
    //pembayaran
    Route::group(['prefix' => 'pembayaran'], function () {
      Route::get('/','PembayaranController@index')->name('admin.pembayaran');
      //Route::get('/create','PembayaranController@create')->name('admin.pembayaran.create');
      Route::post('/store','PembayaranController@store')->name('admin.pembayaran.store');
      Route::get('/update/{id}', 'PembayaranController@edit')->name('admin.pembayaran.edit');
      Route::post('/update/{id}', 'PembayaranController@update')->name('admin.pembayaran.update');
      Route::get('/{id}','PembayaranController@show')->name('admin.pembayaran.show');
    });

    //produk
    Route::group(['prefix' => 'produk'], function () {
      Route::get('/','ProdukController@index')->name('admin.produk');
      Route::get('/create','ProdukController@create')->name('admin.produk.create');
      Route::post('/store','ProdukController@store')->name('admin.produk.store');
      Route::get('/update/{id}', 'ProdukController@edit')->name('admin.produk.edit');
      Route::post('/update', 'ProdukController@update')->name('admin.produk.update');
      Route::get('/{id}','ProdukController@show')->name('admin.produk.show');
      Route::post('/delete/{id}','ProdukController@destroy')->name('admin.produk.destroy');
    });
    // foto
    Route::group(['prefix' => 'picture'], function () {
      Route::post('/delete/{id}','PictureController@destroy')->name('admin.produk.picture.destroy');
    });
  
    //Kategori
    Route::group(['prefix' => 'kategori'], function () {
      Route::get('/','KategoriController@index')->name('admin.kategori');
      Route::get('/create','KategoriController@create')->name('admin.kategori.create');
      Route::post('/store','KategoriController@store')->name('admin.kategori.store');
      Route::get('/update/{id}', 'KategoriController@edit')->name('admin.kategori.edit');
      Route::post('/update', 'KategoriController@update')->name('admin.kategori.update');
      Route::get('/{id}','KategoriController@show')->name('admin.kategori.show');
      Route::post('/delete/{id}','KategoriController@destroy')->name('admin.kategori.destroy');
    });

  });
