@extends('layouts.admin')
@section('title') Produk @endsection
@section('style')
<style>
  .jarak{
    margin-left: 60px;
    margin-right: 50px;
  }
  .welcome{
    margin-top: 30px;
    margin-bottom: 50px;
  }
  .hijau-background{
    background-color: #4CAF50;
  }

  .alert {
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
  }

  .alert.success {background-color: #4CAF50;}
  .alert.info {background-color: #2196F3;}
  .alert.warning {background-color: #ff9800;}

  .closebtn {
    padding-right: 15px;
    padding-top: 3px;
    color: white;
    float: right;
    font-size: 25px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  .closebtn:hover {
    color: black;
  }
  .overlay {
  position: absolute;
  z-index:1;
  }
</style>
@endsection
@section('content')
<div class="jarak">
  <div class="welcome color-jameela">
    <a class="color-jameela" href="{{route('admin.produk')}}">
    <div class="row" style="margin-bottom:0;">
      <div class="col" style="padding: 0;">
        <i class="material-icons" style="font-size:25px;">chevron_left</i>
      </div>
      <div class="col" style="padding: 0;">
        <p style="margin:0; font-size:18px;">Kembali</p>
      </div>
    </div>
    </a>
    <h4 style="margin-top:10px;"> Tambah Produk</h4>
    <p>Isi form berikut untuk menambah produk baru</p>
  </div>
  <div class="row">

    <h5 class="color-jameela">Keterangan Produk</h5>
    <form id="tambah_produk" action="{{route('admin.produk.tambahSubmit')}}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="nama_produk" type="text" class="validate" name="nama_produk" data-length="40">
          <label for="nama_produk">Nama Produk</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="kode_barang" type="text" class="validate" name="kode_barang">
          <label for="kode_barang">Kode Barang</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <select name="id_brand" id="id_brand" required>
            @for($i=0;$i<count($brand);$i++)
            <option value="{{$brand[$i]->id_brand}}">{{$brand[$i]->nama_brand}}</option>
            @endfor
          </select>
          <label for="id_brand">Brand</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <select name="id_kategori" id="id_kategori" required>
            @for($i=0;$i<count($kategori);$i++)
            <option value="{{$kategori[$i]->id_kategori}}">{{$kategori[$i]->nama_kategori}}</option>
            @endfor
          </select>
          <label for="id_kategori">Kategori</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="stok" type="number" class="validate" name="stok">
          <label for="stok">Stok</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="harga" type="number" class="validate" name="harga">
          <label for="harga">Harga</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <textarea id="keterangan" class="materialize-textarea" name="keterangan" wrap="hard"></textarea>
          <label for="keterangan">Keterangan</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="url_shopee" type="text" class="validate" name="url_shopee">
          <label for="url_shopee">Link Shopee</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input id="url_lazada" type="text" class="validate" name="url_lazada">
          <label for="url_lazada">Link Lazada</label>
        </div>
      </div>
      <div class="file-field input-field col m6 s12">
        <div class="btn hijau-background">
          <span>Upload Foto</span>
          <input type="file" name="image[]" multiple>
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col m6 s12">
      <div class="right">
        <button class="btn hijau-background" form="tambah_produk" type="submit" method="post">button</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    //ijo mySidebar
    document.getElementById("produk").style = "color : white ; background-color : #4CAF50;";

    //notifikasi
    var close = document.getElementsByClassName("closebtn");
    var i;
    for (i = 0; i < close.length; i++) {
      close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
      }
    }
</script>
@endsection
