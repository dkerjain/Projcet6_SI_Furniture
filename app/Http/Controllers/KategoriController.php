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
        
        $file = $request->file('image');
        $nama_foto = $tambah->id.'_'.$request->file('image')->getClientOriginalName();
        $path_foto = '/image/kategori/'.$nama_foto;

        // Simpan file ke public
        $file->move('image/kategori', $nama_foto);
        //save ke database
        $tambah->url_photo = $path_foto;
        $tambah->save();
        return redirect()->route('admin.kategori')->with(['success' => 'Kategori berhasil ditambahkan']);
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
        $kategori = Kategori::find($request->id);
        $kategori->nama_kategori = $request->nama_kategori;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $nama_foto = $request->id.'_'.$request->file('image')->getClientOriginalName();
            $path_foto = '/image/kategori/'.$nama_foto;

            // Simpan file ke public
            $file->move('image/kategori', $nama_foto);
            //save ke database
            $kategori->url_photo = $path_foto;
            $kategori->save();
        }
        
        return redirect()->route('admin.kategori')->with(['success' => 'Kategori berhasil diperbarui']);
    }

}
