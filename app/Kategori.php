<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kategori, url_photo'];

    public function produk()
    {
        return $this->hasMany('App\Produk','id_kategori');
    }
}
