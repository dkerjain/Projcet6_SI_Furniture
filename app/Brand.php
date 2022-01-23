<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brand';
  protected $primaryKey = 'id';
  protected $fillable = ['nama_brand, url_photo'];

  public function produk()
  {
      return $this->hasMany('App\Produk','id_brand');
  }
}
