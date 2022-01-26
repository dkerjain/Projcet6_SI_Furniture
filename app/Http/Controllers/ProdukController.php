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
      $produk = Produk::all();
      $kategori = Kategori::all();
      $picture = Picture::all();
      return view('admin.produk.index',compact('produk','kategori','picture'));
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
      $produk->nama_produk= $request->nama;
      $produk->kode_barang= $request->kode_barang;
      $produk->stok= $request->stok;
      $harga = str_replace(".","",$request->harga);
      $produk->harga= $harga;
      $produk->berat= $request->berat;
      $produk->diskon= $request->diskon;
      $produk->status_diskon = $request->status_diskon;
      $produk->status_produk = 1;
      $produk->keterangan= $request->keterangan;
      $produk->save();

        $file = $request->file('image');
        $nama_foto = $produk->id.'_'.$request->file('image')->getClientOriginalName();
        $path_foto = '/image/produk/'.$nama_foto;

        // Simpan file ke public
        $file->move('image/produk', $nama_foto);
        Picture::create([
          'id_produk' => $produk->id,
          'url_photo' => $path_foto,
          'file_name' => $nama_foto
        ]);
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
    public function update(Request $request)
    {

      $path = null;
        if($request->foto)
        {
            $file = $request->file('image');
            $nama_foto = $produk->id.'_'.$request->file('image')->getClientOriginalName();
            $path = '/image/produk/'.$nama_foto;   
            // Simpan file ke public
            $file->move('image/produk', $nama_foto);
            Picture::where('id_produk',$request->id)->update([
              'url_photo' => $path,
              'file_name' => $nama_foto
            ]);     
        }   
        else{
            $path = $request->image;
        }

      $produk = Produk::find($request->id);
      $produk->id_kategori = $request->id_kategori;
      $produk->nama_produk= $request->nama;
      $produk->kode_barang= $request->kode_barang;
      $produk->stok= $request->stok;
      $harga = str_replace(".","",$request->harga);
      $produk->harga= $harga;
      $produk->berat= $request->berat;
      $produk->diskon= $request->diskon;
      $produk->status_diskon = $request->status_diskon;
      $produk->status_produk= $request->status_produk;
      $produk->keterangan= $request->keterangan;
      $produk->save();

        
        
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
