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


class OrderController extends Controller
{
    public function validator($data, $rules, $message){
        return Validator::make($data, $rules, $message);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('customer','orderList','pembayaran')->where('status',0)->orwhere('status',1)->orderBy('created_at','desc')->get();
        return view('admin.penjualan.index',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function history()
    {   

        $pembayaran = Pembayaran::where('status_pembayaran',1);
        $order = Order::with('customer','orderList','pembayaran')->where('status',2)->orderBy('created_at','desc')->get();
        return view('admin.penjualan.history',compact('order'));
    }

    public function create()
    {
        $produk = Produk::where('nama_produk')->with('picture')->first();
        return view('admin.penjualan.create',compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validator
        $message = [
          'nama_customer.required' => 'Nama konsumen belum diisi',
          'alamat.required' => 'Alamat belum diisi',
          'provinsi.required' => 'Provinsi belum diisi',
          'kota.required' => 'Kota belum diisi',
          'kecamatan.required' => 'Kecamatan belum diisi',
          'kelurahan.required' => 'Kelurahan belum diisi',
          'jasa_kurir.required' => 'Jasa kurir belum diisi',
          'biaya_pengiriman.required' => 'Biaya pengiriman belum diisi',
          'status_pembayaran.required' => 'Status pembayaran belum diisi',
          'status.required' => 'Status tindakan belum diisi',
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
           'status_pembayaran' => 'required',
           'status' => 'required',
         ];
         $validator = $this->validator($request->all(), $rules, $message);
         if ($validator->fails()){
             return Redirect::back()->withInput()->with(['error'=>$validator->errors()->first()]);
         }
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
           $customer->save();
         }else{
          $customer->nama_customer = $request->nama_customer;
          $customer->nomor_telepon = $request->nomor_telepon;
          $customer->email = $request->email;
          $customer->alamat = $request->alamat;
          $customer->ID_KELURAHAN = $request->kelurahan;
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
        // $order->status_pembayaran = $request->status_pembayaran;
         $order->status = $request->status;
         $order->catatan = $request->catatan;
         $order->save();
         //simpan pembayaran
         $pembayaran = new Pembayaran;
         $pembayaran->id_order = $order->id;
         $pembayaran->id_customer = $customer->id;
         $pembayaran->status_pembayaran = $request->status_pembayaran;
         $pembayaran->bank_pembayaran = $request->bank_pembayaran; 
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
         //return
         return redirect()->route('admin.order')->with(['success' => 'Nota berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function print($id)
    {
        $order = Order::where('id',$id)->with('customer','orderList.produk')->first();
        return view('admin.penjualan.print',compact('order'));
    }
    public function printView($id)
    {
        $order = Order::where('id',$id)->with('customer','orderList.produk')->first();
        return view('admin.penjualan.print-view',compact('order'));
    }
    public function download($id)
    {
        $order = Order::where('id',$id)->with('customer','orderList.produk')->first();

        $pdf = PDF::loadview('admin.penjualan.print-view',['order'=>$order]);
	      return $pdf->download('nota-penjualan-'.$order->id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $order = Order::where('id',$id)->with('customer','orderList','pembayaran')->first();

        $kelurahan = Kelurahan::where('ID_KELURAHAN', $order->customer->ID_KELURAHAN)->first();
        $kecamatan = Kecamatan::where('ID_KECAMATAN', $kelurahan->ID_KECAMATAN)->first();
        $kota = Kota::where('ID_KOTA', $kecamatan->ID_KOTA)->first();
        $provinsi = Provinsi::where('ID_PROVINSI', $kota->ID_PROVINSI)->first();

        return view('admin.penjualan.edit',compact('order','kelurahan','kecamatan','kota','provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //validator
      $message = [
        'nama_customer.required' => 'Nama konsumen belum diisi',
        'alamat.required' => 'Alamat belum diisi',
        'provinsi.required' => 'Provinsi belum diisi',
        'kota.required' => 'Kota belum diisi',
        'kecamatan.required' => 'Kecamatan belum diisi',
        'kelurahan.required' => 'Kelurahan belum diisi',
        'jasa_kurir.required' => 'Jasa kurir belum diisi',
        'biaya_pengiriman.required' => 'Biaya pengiriman belum diisi',
        'status_pembayaran.required' => 'Status pembayaran belum diisi',
        'status.required' => 'Status tindakan belum diisi',
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
         'status_pembayaran' => 'required',
         'status' => 'required',
       ];
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error'=>$validator->errors()->first()]);
       }
       //cek order dan delete orderlist
       $order = Order::where('id',$id)->with('orderList')->first();
       if(!$order){
         return Redirect::back()->withInput()->with(['error'=>'Nota tidak ditemukan !']);
       }else{
         //delete orderlist dan menambah stok di produk yang ada
         for ($i=0; $i <count($order->orderList) ; $i++) {
           $produk = Produk::find($order->orderList[$i]->id_produk);
           if($produk){
             $produk->stok = $produk->stok +  $order->orderList[$i]->jumlah;
             $produk->save();
           }
           $order_list = OrderList::find($order->orderList[$i]->id);
           $order_list->delete();
         }
       }
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
        //  $customer->provinsi = $request->provinsi;
        //  $customer->kota = $request->kota;
        //  $customer->kode_pos = $request->kode_pos;
         $customer->save();
       }else{
        $customer->nama_customer = $request->nama_customer;
         $customer->nomor_telepon = $request->nomor_telepon;
         $customer->email = $request->email;
         $customer->alamat = $request->alamat;
         $customer->ID_KELURAHAN = $request->kelurahan;
        $customer->save();
       }
       //simpan order
       $order = Order::find($id);
       $order->id_customer = $customer->id;
       $order->jasa_kurir = $request->jasa_kurir;
       $order->jumlah_item = 0;
       $order->berat_total = 0;
       $order->biaya_total_produk = 0;
       $order->biaya_pengiriman = $request->biaya_pengiriman;
       //$order->status_pembayaran = $request->status_pembayaran;
       $order->status = $request->status;
       $order->catatan = $request->catatan;
       $order->save();
       //simpan pembayaran
         $pembayaran = Pembayaran::where('id_order',$id)->first();
         $pembayaran->id_order = $order->id;
         $pembayaran->id_customer = $customer->id;
         $pembayaran->status_pembayaran = $request->status_pembayaran;
         $pembayaran->bank_pembayaran = $request->bank_pembayaran; 
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
       //return
       return redirect()->route('admin.order')->with(['success' => 'Nota berhasil ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('id',$id)->with('orderList')->first();
        if(!$order){
          return redirect()->route('admin.order')->with(['error' => 'Nota tidak ditemukan, silahkan cek ulang kembali']);
        }
        //hapus orderlst dan menambah stok ulang ke produk
        for ($i=0; $i <count($order->orderList)  ; $i++) {
          $produk = Produk::find($order->orderList[$i]->id_produk);
          if($produk){
            $produk->stok = $produk->stok +  $order->orderList[$i]->jumlah;
            $produk->save();
          }
          $order_list = OrderList::find($order->orderList[$i]->id);
          $order_list->delete();
        }
        //hapus order
        $order->delete();
        // return
        return redirect()->route('admin.order')->with(['success' => 'Nota berhasil dihapus']);
    }

    //public function laporan($id)
   // {

    //    $pembayaran = Pembayaran::where('status_pembayaran',1);
     //   $order = Order::with('customer','orderList','pembayaran')->where('status',2)->orderBy('created_at','desc')->get();
     //   $pdf = PDF::loadview('admin.penjualan.laporan',['order'=>$order]);
      //  return $pdf->download('laporan-bulan-{{date('F Y')}}');
    //}
}
