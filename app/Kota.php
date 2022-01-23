<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kota extends Model
{

    protected $table = 'kota';
    protected $primaryKey = 'ID_KOTA';
    protected $fillable = ['ID_PROVINSI','NAMA_KOTA'];


      public function Provinsi()
    {
        return $this->belongsTo('App\Provinsi','ID_PROVINSI');
    }
}
