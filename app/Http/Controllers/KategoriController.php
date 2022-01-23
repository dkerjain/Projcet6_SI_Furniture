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

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kategori = Kategori::orderBy('id')->get();
      return view('admin.kategori.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tambah = new Kategori;
        $tambah->nama_kategori = $request->nama_kategori;
        $tambah->save();
        if($request->hasfile('image')){
          //membuat path storage foto
          $path = 'kategori/'.$tambah->id;
          //proses cek direktori
          if(!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
          }
          //proses upload
          $extension = $request->image->getClientOriginalExtension();
          $filename = $tambah->nama_kategori.'.'.$extension;
          $request->image->storeAs($path, $filename, 'public');
          //save ke database
          $tambah->url_photo = 'storage/'.$path.'/'.$filename;
        }
        $tambah->save();
        return redirect()->route('admin.kategori')->with(['success' => 'Kategori berhasil ditambahkan']);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        if($request->hasfile('image')){
          //membuat path storage foto
          $path = 'kategori/'.$kategori->id;
          //proses cek direktori
          if(!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
          }
          //proses upload
          $extension = $request->image->getClientOriginalExtension();
          $filename = $kategori->nama_kategori.'.'.$extension;
          $request->image->storeAs($path, $filename, 'public');
          //save ke database
          $kategori->url_photo = 'storage/'.$path.'/'.$filename;
        }
        $kategori->save();
        return redirect()->route('admin.kategori')->with(['success' => 'Kategori berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if(!$kategori || $id==1){
          return redirect()->route('admin.kategori')->with(['error' => 'Kategori tidak ditemukan']);
        }
        //pindah kategori produk ke 'Umum'
        $produk = Produk::where('id_kategori',$id)->get();
        for ($i=0; $i <count($produk) ; $i++) {
          $update_produk = Produk::find($produk[$i]->id);
          $update_produk->id_kategori = 1;
          $update_produk->save();
        }
        //hapus folder foto
        if(Storage::disk('public')->exists('kategori/'.$kategori->id)){
            Storage::disk('public')->deleteDirectory('kategori/'.$kategori->id);
        }
        //hapus kategori
        $kategori->delete();
        return redirect()->route('admin.kategori')->with(['success' => 'Kategori berhasil dihapus']);
    }
}
