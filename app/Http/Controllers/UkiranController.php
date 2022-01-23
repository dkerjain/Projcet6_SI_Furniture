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

class UkiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ukiran = Ukiran::orderBy('id')->get();
      return view('admin.ukiran.index',compact('ukiran'));
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
      $tambah = new Ukiran;
      $tambah->nama_ukiran = $request->nama_ukiran;
      $tambah->save();
      if($request->hasfile('image')){
        //membuat path storage foto
        $path = 'ukiran/'.$tambah->id;
        //proses cek direktori
        if(!Storage::disk('public')->exists($path)){
          Storage::disk('public')->makeDirectory($path);
        }
        //proses upload
        $extension = $request->image->getClientOriginalExtension();
        $filename = $tambah->nama_ukiran.'.'.$extension;
        $request->image->storeAs($path, $filename, 'public');
        //save ke database
        $tambah->url_photo = 'storage/'.$path.'/'.$filename;
      }
      $tambah->save();
      return redirect()->route('admin.ukiran')->with(['success' => 'Ukiran berhasil ditambahkan']);
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
        $ukiran = Ukiran::find($id);
        $ukiran->nama_ukiran = $request->nama_ukiran;
        if($request->hasfile('image')){
          //membuat path storage foto
          $path = 'ukiran/'.$ukiran->id;
          //proses cek direktori
          if(!Storage::disk('public')->exists($path)){
            Storage::disk('public')->makeDirectory($path);
          }
          //proses upload
          $extension = $request->image->getClientOriginalExtension();
          $filename = $ukiran->nama_ukiran.'.'.$extension;
          $request->image->storeAs($path, $filename, 'public');
          //save ke database
          $ukiran->url_photo = 'storage/'.$path.'/'.$filename;
        }
        $ukiran->save();
        return redirect()->route('admin.ukiran')->with(['success' => 'Ukiran berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $ukiran = Ukiran::find($id);
      if(!$ukiran || $id==1){
        return redirect()->route('admin.ukiran')->with(['error' => 'Uiran tidak ditemukan']);
      }
      //pindah ukiran produk ke 'Umum'
      $produk = Produk::where('id_ukiran',$id)->get();
      for ($i=0; $i <count($produk) ; $i++) {
        $update_produk = Produk::find($produk[$i]->id);
        $update_produk->id_ukiran = 1;
        $update_produk->save();
      }
      //hapus ukiran
      $ukiran->delete();
      return redirect()->route('admin.ukiran')->with(['success' => 'Ukiran berhasil dihapus']);
    }
}
