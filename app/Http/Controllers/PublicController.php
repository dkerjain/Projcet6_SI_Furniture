<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Storage;
use PDF;
use Carbon\Carbon;
use App\Produk;
use App\Kategori;
use App\Ukiran;
use App\Picture;
use App\User;
use App\Customer;
use App\Order;
use App\OrderList;
use App\Pembayaran;
use App\Kelurahan;
use App\Kecamatan;
use App\Kota;
use App\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image as Image;

class PublicController extends Controller
{
    public function validator($data, $rules, $message){
        return Validator::make($data, $rules, $message);
    }
    public function index()
    {
      $kategori = Kategori::all();
      $produk = Produk::with('kategori')->where('status_produk',1)->orderBy('created_at','DESC')->get();
      return view('public.index',compact('produk','kategori'));
    }
    public function kontak(){
      return view('public.kontak');
    }
    public function produk(Request $request){
      $kategori = Kategori::all();
      $produk = Produk::with('kategori','picture')->where('status_produk',1)
                ->when($request->search, function ($query) use ($request) {
                        $query->where('nama_produk', 'like', "%{$request->search}%")
                        ->orWhere('keterangan', 'like', "%{$request->search}%");
                })->get();
      if($request->has('kategori') && $request->kategori!='all'){
        $produk = Produk::with('kategori','picture')->where('id_kategori',$request->kategori)->where('status_produk',1)->get();
      }
      if($request->has('nama_produk')){
        $produk = Produk::with('kategori','picture')->orderBy('nama_produk',$request->nama_produk)->where('status_produk',1)->get();
      }
      if($request->has('created_at')){
        $produk = Produk::with('kategori','picture')->orderBy('created_at',$request->created_at)->where('status_produk',1)->get();
      }
      return view('public.produk.index',compact('produk','kategori'));
    }
    public function produkShow($id){
      $produk = Produk::with('kategori','picture')->where('id',$id)->first();
      return view('public.produk.show',compact('produk'));
    }
    public function produkTambahKeranjang(Request $request){
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                [
                    "id" => $request->id_produk,
                    "quantity" => $request->jumlah_item,
                ]
            ];
            session()->put('cart', $cart);
        }elseif($cart) {
            $check = false;
            for ($i=0; $i <count($cart); $i++) {
              if($cart[$i]['id'] == $request->id_produk){
                  $check = true;
                  $produk = Produk::find($request->id_produk);
                  if(($cart[$i]['quantity'] + $request->jumlah_item) <= $produk->stok){
                      $cart[$i]['quantity'] = $cart[$i]['quantity'] + $request->jumlah_item;
                  }
              }
            }
            if(!$check){
              $add_item = [
                  "id" => $request->id_produk,
                  "quantity" => $request->jumlah_item,
              ];
              array_push($cart, $add_item);
            }
            session()->put('cart', $cart);
        }
        // dd(session('cart'));
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }
    public function hapusSession($id)
    {
      $cart = session()->get('cart');
      $status ='error';
      if($cart) {
        array_splice($cart,$id,1);
        $status = 'success';
        session()->put('cart', $cart);
      }
      return redirect()->route('public.keranjang');
    }
    
    public function keranjang(){
      $cart = session()->get('cart');
      $produk = [];
      if($cart){
        for ($i=0; $i <count($cart) ; $i++) {
          $get_produk = Produk::find($cart[$i]['id']);
          if($get_produk){
            array_push($produk,$get_produk);
          }
        }
      }
      return view('public.keranjang',compact('produk','cart'));
      }  
    
    public function checkout(Request $request){

      //validator
      $message = [
        'nama_customer.required' => 'Nama pemesan belum diisi',
        'alamat.required' => 'Alamat belum diisi',
        'provinsi.required' => 'Provinsi belum diisi',
        'kota.required' => 'Kota belum diisi',
        'kecamatan.required' => 'Kecamatan belum diisi',
        'kelurahan.required' => 'Kelurahan belum diisi',
        'jasa_kurir.required' => 'Jasa kurir belum diisi',
        'biaya_pengiriman.required' => 'Biaya pengiriman belum diisi',
       ];
       $rules = [
         'id_produk.*' => 'required',
         'jumlah_pembelian.*' => 'required',
         'nama_customer' => 'required',
         'alamat' => 'required',
         'provinsi' => 'required',
         'kota' => 'required',
         'kecamatan' => 'required',
         'kelurahan' => 'required',
         'jasa_kurir' => 'required',
         'biaya_pengiriman' => 'required',
       ];
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error'=>$validator->errors()->first()]);
       }
       // //Alamat
       // $provinsi = Provinsi::where('ID_PROVINSI', $request->provinsi)->first();
       // $kota = Kota::where('ID_KOTA', $request->kota)->first();
       // $kecamatan = Kecamatan::where('ID_KECAMATAN', $request->kecamatan)->first();
       // $kelurahan = Kelurahan::where('ID_KELURAHAN', $request->kelurahan)->first();


       //cek produk apakah ada atau pesanan melebihi Stok
       for ($i=0; $i < count($request->id_produk); $i++) {
         $produk = Produk::find($request->id_produk[$i]);
         if(!$produk){
           return Redirect::back()->withInput()->with(['error'=>'Ada produk yang tidak ditemukan !']);
         }elseif ($produk->stok < $request->jumlah_pembelian[$i]) {
           return Redirect::back()->withInput()->with(['error'=>'Produk '.$produk->nama_produk.' yang dipesan melebihi stok yang ada!']);
         }
       }
       //cek dan simpan customer dahulu
       $customer = Customer::where('nomor_telepon',$request->nomor_telepon)->first();
       if(!$customer){
         $customer = new Customer;
         $customer->nama_customer = $request->nama_customer;
         $customer->nomor_telepon = $request->nomor_telepon;
         $customer->email = $request->email;
         $customer->alamat = $request->alamat;
         $customer->ID_KELURAHAN = $request->kelurahan;
         // $customer->provinsi = $provinsi;
         // $customer->kota = $kota;
         // $customer->kecamatan = $kecamatan;
         // $customer->kelurahan = $kelurahan;
         // $customer->kode_pos = $request->kode_pos;
         $customer->save();
       }

       //simpan order
       $order = new Order;
       $order->id_customer = $customer->id;
       $order->jasa_kurir = $request->jasa_kurir;
       $order->jumlah_item = 0;
       $order->berat_total = 0;
       $order->biaya_total_produk = 0;
       $order->biaya_pengiriman = $request->biaya_pengiriman;
       //$order->status_pembayaran = 0;
       $order->status = 0;
       $order->catatan = $request->catatan;
       $order->save();
       $pembayaran= new Pembayaran;
       $pembayaran->id_customer = $customer->id;
       $pembayaran->id_order = $order->id; 
       $pembayaran->status_pembayaran = 0;
       $pembayaran->bank_pembayaran = '';
       $pembayaran->bukti_pembayaran = '';
       $pembayaran->save();
       //simpan orderlist
       $jumlah_item = 0;
       $berat_total = 0;
       $biaya_total = 0;
       for ($i=0; $i < count($request->id_produk); $i++) {
         $produk = Produk::find($request->id_produk[$i]);
         //membuat orderlist
         $order_list = new OrderList;
         $order_list->id_order = $order->id;
         $order_list->id_produk = $produk->id;
         $order_list->jumlah = $request->jumlah_pembelian[$i];
         if($produk->diskon!=null && $produk->status_diskon==1){
           $order_list->harga = $produk->harga - ($produk->harga * ($produk->diskon/100));
         }else{
           $order_list->harga = $produk->harga;
         }
         $order_list->harga_subtotal = $order_list->harga * $order_list->jumlah;
         $order_list->save();
         $jumlah_item = $jumlah_item + $request->jumlah_pembelian[$i];
         $berat_total = $berat_total + ($produk->berat * $request->jumlah_pembelian[$i]);
         $biaya_total = $biaya_total + $order_list->harga_subtotal;
         //mengurangi stok produk
         $produk->stok = $produk->stok - $request->jumlah_pembelian[$i];
         $produk->save();
       }
       $order->jumlah_item = $jumlah_item;
       $order->berat_total = $berat_total;
       $order->biaya_total_produk = $biaya_total;
       $order->save();
       session()->forget('cart');
       //return
       return view('public.thanks',compact('order'));
    }
}
