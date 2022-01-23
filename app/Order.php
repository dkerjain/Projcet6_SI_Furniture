<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table = 'order';
  protected $primaryKey = 'id';
  protected $fillable = ['id_customer','jasa_kurir','jumlah_item','berat_total','biaya_total_produk','status','biaya_pengiriman','status_pembayaran','catatan','bank_pembayaran','bukti_pembayaran'];

  public function customer()
  {
      return $this->belongsTo('App\Customer','id_customer');
  }
  public function orderList()
  {
      return $this->hasMany('App\OrderList','id_order');
  }
   public function pembayaran()
  {
      return $this->hasOne('App\Pembayaran','id_order');
  }
}
