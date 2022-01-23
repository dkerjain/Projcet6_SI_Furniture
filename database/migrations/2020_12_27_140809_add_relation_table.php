<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('produk', function (Blueprint $table) {
            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->foreign('id_ukiran')->references('id')->on('ukiran');

        });

        Schema::table('picture', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id')->on('produk');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('id_customer')->references('id')->on('customer');
        });

        Schema::table('order_list', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('order');
            $table->foreign('id_produk')->references('id')->on('produk');
        });

        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('id_customer')->references('id')->on('customer');
            $table->foreign('id_order')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
