<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukiran extends Model
{
  protected $table = 'ukiran';
  protected $primaryKey = 'id';
  protected $fillable = ['nama_ukiran, url_photo'];

  public function produk()
  {
      return $this->hasMany('App\Produk','id_ukiran');
  }
}
