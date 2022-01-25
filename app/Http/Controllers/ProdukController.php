<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Storage;
use Carbon\Carbon;
use App\Produk;
use App\Kategori;
use App\Ukiran;
use App\Picture;
use App\User;
use App\Customer;
use App\Order;
use App\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image as Image;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $produk = Produk::with('ukiran','kategori','picture')->get();
      $kategori = Kategori::all();
      return view('admin.produk.index',compact('produk','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ukiran = Ukiran::all();
        $kategori = Kategori::all();
        return view('admin.produk.create',compact('ukiran','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $produk = new Produk;
      $produk->id_kategori = $request->id_kategori;
      $produk->id_ukiran= $request->id_ukiran;
      $produk->nama_produk= $request->nama_produk;
      $produk->kode_barang= $request->kode_barang;
      $produk->nomor_barcode= $request->nomor_barcode;
      $produk->stok= $request->stok;
      $produk->harga= $request->harga;
      $produk->berat= $request->berat;
      $produk->diskon= $request->diskon;
      $produk->status_diskon= $request->status_diskon;
      $produk->status_produk= $request->status_produk;
      $produk->keterangan= $request->keterangan;
      $produk->save();

      if($request->hasfile('image')){
            //membuat path storage foto
            $path = 'produk/'.$produk->id;
            //proses cek direktori
            if(!Storage::disk('public')->exists($path)){
              Storage::disk('public')->makeDirectory($path);
            }
            //proses upload
            foreach($request->image as $file){
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->storeAs($path, $filename, 'public');
            //save ke database
            Picture::create([
              'id_produk' => $produk->id,
              'url_photo' => 'storage/'.$path.'/'.$filename,
              'file_name' => $filename
            ]);
          }
      }
      return redirect()->route('admin.produk')->with(['success' => 'Produk berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $produk = Produk::where('id',$id)->with('ukiran','kategori','picture')->first();
      return view('admin.produk.show',compact('produk'));
    }

    //request api
    public function showApi($id)
    {
      //id adalah kode barang atau nomor barcode
      $produk = Produk::where('kode_barang',$id)->orWhere('nomor_barcode',$id)->with('ukiran','kategori','picture')->first();
      $status ='';
      if(!$produk){
        $status = 'error';
      }else{
        $status = 'success';
      }
      return response()->json(compact('status','produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $produk = Produk::where('id',$id)->with('ukiran','kategori','picture')->first();
      $ukiran = Ukiran::all();
      $kategori = Kategori::all();
      return view('admin.produk.edit',compact('produk','ukiran','kategori'));
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
      $produk = Produk::find($id);
      $produk->id_kategori = $request->id_kategori;
      $produk->id_ukiran= $request->id_ukiran;
      $produk->nama_produk= $request->nama_produk;
      $produk->kode_barang= $request->kode_barang;
      $produk->nomor_barcode= $request->nomor_barcode;
      $produk->stok= $request->stok;
      $produk->harga= $request->harga;
      $produk->berat= $request->berat;
      $produk->diskon= $request->diskon;
      $produk->status_diskon= $request->status_diskon;
      $produk->status_produk= $request->status_produk;
      $produk->keterangan= $request->keterangan;
      $produk->save();

      if($request->hasfile('image')){
            //membuat path storage foto
            $path = 'produk/'.$produk->id;
            //proses cek direktori
            if(!Storage::disk('public')->exists($path)){
              Storage::disk('public')->makeDirectory($path);
            }
            //proses upload
            foreach($request->image as $file){
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->storeAs($path, $filename, 'public');
            //save ke database
            Picture::create([
              'id_produk' => $produk->id,
              'url_photo' => 'storage/'.$path.'/'.$filename,
              'file_name' => $filename
            ]);
          }
      }
      return redirect()->route('admin.produk')->with(['success' => 'Produk berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::where('id',$id)->with('picture')->first();
        //cek produk
        if(!$produk){
          return Redirect::back()->with(['error'=>'Produk tidak ditemukan!']);
        }
        //hapus folder foto
        if(Storage::disk('public')->exists('produk/'.$produk->id)){
            Storage::disk('public')->deleteDirectory('produk/'.$produk->id);
        }
        //hapus foto di database
        for ($i=0; $i <count($produk->picture) ; $i++) {
          $picture = Picture::find($produk->picture[$i]->id);
          $picture->delete();
        }
        //hapus produk
        $produk->delete();
        return redirect()->route('admin.produk')->with(['success' => 'Produk berhasil dihapus']);
    }
}
