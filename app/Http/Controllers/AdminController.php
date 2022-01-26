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
use DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $total_biaya = DB::table('order')->whereBetween('created_at', [$start, $end])->SUM('biaya_total_produk');
        $total_kirim = DB::table('order')->whereBetween('created_at', [$start, $end])->SUM('biaya_pengiriman');
        $total_pemasukan = $total_biaya+$total_kirim;
        $total_barang= DB::table('order')->whereBetween('created_at', [$start, $end])->SUM('jumlah_item');
        $total_pesanan= DB::table('order')->whereBetween('created_at', [$start, $end])->where('status',1)->COUNT('id');
        
      if(!Session::get('login')){
        return redirect()->route('login');
      }else{
        return view('admin.dashboard',compact('total_pemasukan','total_pesanan','total_barang'));
      }
    }

}
