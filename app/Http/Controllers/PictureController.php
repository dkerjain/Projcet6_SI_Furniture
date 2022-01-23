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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Intervention\Image\Facades\Image as Image;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::find($id);
        if(!$picture){
          return Redirect::back()->with(['error'=>'Foto tidak ditemukan!']);
        }
        //hapus data
        if(Storage::disk('public')->exists('produk/'.$picture->id_produk.'/'.$picture->file_name)){
            Storage::disk('public')->delete('produk/'.$picture->id_produk.'/'.$picture->file_name);
        }
        //hapus attachment
        $picture->delete();
        //return
        return redirect()->route('admin.produk.edit',['id'=>$picture->id_produk])->with(['success' => 'Foto berhasil dihapus']);
    }
}
