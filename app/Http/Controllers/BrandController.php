<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Storage;
use Carbon\Carbon;
use App\Produk;
use App\Kategori;
use App\Brand;
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

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $brand = Brand::orderBy('id')->get();
      return view('admin.brand.index',compact('brand'));
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
      $tambah = new Brand;
      $tambah->nama_brand = $request->nama_brand;
      $tambah->save();
      if($request->hasfile('image')){
        //membuat path storage foto
        $path = 'brand/'.$tambah->id;
        //proses cek direktori
        if(!Storage::disk('public')->exists($path)){
          Storage::disk('public')->makeDirectory($path);
        }
        //proses upload
        $extension = $request->image->getClientOriginalExtension();
        $filename = $tambah->nama_brand.'.'.$extension;
        $request->image->storeAs($path, $filename, 'public');
        //save ke database
        $tambah->url_photo = 'storage/'.$path.'/'.$filename;
      }
      $tambah->save();
      return redirect()->route('admin.brand')->with(['success' => 'Brand berhasil ditambahkan']);
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
        $brand = Brand::find($id);
        $brand->nama_brand = $request->nama_brand;
        if($request->hasfile('image')){
          //membuat path storage foto
          $path = 'brand/'.$brand->id;
          //proses cek direktori
          if(!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
          }
          //proses upload
          $extension = $request->image->getClientOriginalExtension();
          $filename = $brand->nama_brand.'.'.$extension;
          $request->image->storeAs($path, $filename, 'public');
          //save ke database
          $brand->url_photo = 'storage/'.$path.'/'.$filename;
        }
        $brand->save();
        return redirect()->route('admin.brand')->with(['success' => 'Brand berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $brand = Brand::find($id);
      if(!$brand || $id==1){
        return redirect()->route('admin.brand')->with(['error' => 'Brand tidak ditemukan']);
      }
      //pindah brand produk ke 'Umum'
      $produk = Produk::where('id_brand',$id)->get();
      for ($i=0; $i <count($produk) ; $i++) {
        $update_produk = Produk::find($produk[$i]->id);
        $update_produk->id_brand = 1;
        $update_produk->save();
      }
      //hapus kategori
      $brand->delete();
      return redirect()->route('admin.brand')->with(['success' => 'Brand berhasil dihapus']);
    }
}
