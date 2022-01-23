<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'customer';
  protected $primaryKey = 'id';
  protected $fillable = ['ID_KELURAHAN','nama_customer','nomor_telepon','email','alamat'];

  public function order()
  {
      return $this->hasMany('App\Order','id_customer');
  }
  public function kelurahan()
  {
      return $this->belongsTo('App\Kelurahan','ID_KELURAHAN');
  }
}
