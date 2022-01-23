<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
  protected $table = 'pembayaran';
  protected $primaryKey = 'id';
  protected $fillable = ['id_customer','id_order','status_pembayaran','bank_pembayaran','bukti_pembayaran'];

  public function customer()
  {
      return $this->belongsTo('App\Customer','id_customer');
  }
  public function order()
  {
      return $this->belongsTo('App\Order','id_order');
  }

}
