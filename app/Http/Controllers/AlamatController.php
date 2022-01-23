<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelurahan;
use App\Kecamatan;
use App\Kota;
use App\Provinsi;


class AlamatController extends Controller
{
   public function getprovinsi() 
   {
   	$provinsi = Provinsi::all();
   	return response()->json(compact('provinsi'));
   }



    public function getkota($ID_PROVINSI) 

   {
   	$kota = Kota::where('ID_PROVINSI',$ID_PROVINSI)->get();
   	return response()->json(compact('kota'));
   }

   public function getkecamatan($ID_KOTA) 

   {
   	$kecamatan = Kecamatan::where('ID_KOTA',$ID_KOTA)->get();
   	return response()->json(compact('kecamatan'));
   }

   public function getkelurahan($ID_KECAMATAN) 

   {
   	$kelurahan = Kelurahan::where('ID_KECAMATAN',$ID_KECAMATAN)->get();
   	return response()->json(compact('kelurahan'));
   }

}
