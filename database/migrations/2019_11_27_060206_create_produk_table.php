<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->unsigned();
            $table->integer('id_ukiran')->unsigned();
            $table->text('nama_produk');
            $table->text('kode_barang');
            $table->text('nomor_barcode')->nullable();
            $table->text('keterangan');
            $table->integer('stok');
            $table->integer('harga');
            $table->integer('berat');
            $table->integer('status_diskon');
            $table->integer('status_produk');
            $table->integer('diskon')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
