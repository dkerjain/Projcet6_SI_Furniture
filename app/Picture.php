<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $primaryKey = 'id';
    protected $fillable = ['id_produk','url_photo','file_name'];

    public function produk()
    {
        return $this->belongsTo('App\Produk','id_produk');
    }
}
