<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
  protected $table = 'order_list';
  protected $primaryKey = 'id';
  protected $fillable = ['id_order','id_produk','jumlah','harga','harga_subtotal'];

  public function produk()
  {
      return $this->belongsTo('App\Produk','id_produk')->withTrashed();
  }
  public function order()
  {
      return $this->belongsTo('App\Order','id_order');
  }
}
