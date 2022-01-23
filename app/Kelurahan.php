<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kelurahan extends Model
{

    protected $table = 'kelurahan';
    protected $primaryKey = 'ID_KELURAHAN';
    protected $fillable = ['ID_KECAMATAN','NAMA_KELURAHAN','KODE_POS'];


      public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan','ID_KECAMATAN');
    }
}
