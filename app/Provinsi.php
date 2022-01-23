<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Provinsi extends Model
{

    protected $table = 'provinsi';
    protected $primaryKey = 'ID_PROVINSI';
    protected $fillable = ['NAMA_PROVINSI'];


   
}
