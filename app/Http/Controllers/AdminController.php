<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use PDF;
use Carbon\Carbon;
use App\Produk;
use App\Kategori;
use App\Ukiran;
use App\Order;
use App\OrderList;
use App\Customer;
use App\Picture;
use App\User;
use App\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image as Image;

class AdminController extends Controller
{
    public function dashboard()
    {
      //mengambil produk dengan stok tipis
      $produk =  Produk::where('stok','<',3)->get();

      //menghitung nilai transaksi dan
      $year = date('Y');
      $month = date('m');
      $pembayaran = Pembayaran::where('status_pembayaran',1);
      $order = Order::with('customer','orderList','pembayaran')->where('status',2)->whereYear('created_at', '=', $year)
              ->whereMonth('created_at', '=', $month)
              ->with('OrderList')->get();
      $nilai_transaksi = 0;
      $item_terjual = 0;
      for ($i=0; $i <count($order) ; $i++) {
        $nilai_transaksi = $nilai_transaksi + $order[$i]->biaya_total_produk;
        $item_terjual = $item_terjual + $order[$i]->jumlah_item;
      }
      //ambil nota yang belum ditindak
      $order_belum_ditindak = Order::where('status',0)->get();
      return view('admin.dashboard',compact('produk','nilai_transaksi','item_terjual','order_belum_ditindak'));
    }
     public function laporan()
    {   
        $year = date('Y');
        $month = date('m');
        $pembayaran = Pembayaran::where('status_pembayaran',1);
        $order = Order::with('customer','orderList','pembayaran')->where('status',2)->whereMonth('created_at', '=', $month)->orderBy('created_at','desc')->get();
         $nilai_transaksi = 0;
      $item_terjual = 0;
      for ($i=0; $i <count($order) ; $i++) {
        $nilai_transaksi = $nilai_transaksi + $order[$i]->biaya_total_produk;
        $item_terjual = $item_terjual + $order[$i]->jumlah_item;
      }

        return view('admin.penjualan.laporan',compact('order','nilai_transaksi'));
    }


    public function exportPDF()
    {
        $year = date('Y');
        $month = date('m');
        $pembayaran = Pembayaran::where('status_pembayaran',1);
        $order = Order::with('customer','orderList','pembayaran')->where('status',2)->whereMonth('created_at', '=', $month)->orderBy('created_at','desc')->get();
         $nilai_transaksi = 0;
      $item_terjual = 0;
      for ($i=0; $i <count($order) ; $i++) {
        $nilai_transaksi = $nilai_transaksi + $order[$i]->biaya_total_produk;
        $item_terjual = $item_terjual + $order[$i]->jumlah_item;
        $pdf = PDF::loadview('admin.penjualan.laporan',compact('order','nilai_transaksi'));
      }
        return $pdf->download('laporan_'.date('F Y').'.pdf');
    }

    



    public function logout(Request $request)
    {
      Auth::logout();
      return redirect('/');
    }
}
