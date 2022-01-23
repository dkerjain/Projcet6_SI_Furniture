<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use Softdeletes;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kategori','id_ukiran','nama_produk','keterangan','kode_barang','nomor_barcode','stok','harga','berat','diskon','status_diskon','status_produk'];

    public function ukiran()
    {
        return $this->belongsTo('App\Ukiran','id_ukiran');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Kategori','id_kategori');
    }
    public function picture()
    {
        return $this->hasMany('App\Picture','id_produk');
    }
}
