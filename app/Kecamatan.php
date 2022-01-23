<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kecamatan extends Model
{

    protected $table = 'kecamatan';
    protected $primaryKey = 'ID_KECAMATAN';
    protected $fillable = ['ID_KOTA','NAMA_KECAMATAN'];


      public function kota()
    {
        return $this->belongsTo('App\Kota','ID_KOTA');
    }
}
