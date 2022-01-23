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
    <h4 style="margin-top:10px;">Produk</h4>
    <p>Berikut adalah produk toko jameela</p>
  </div>
  <div class="row">
    <h5 class="color-jameela">Foto<h5>
    <!-- notifikasi upload -->
    @if ($message = Session::get('success'))
    <div class="alert success" style="font-size:16px;">
      <span class="closebtn">&times;</span>
      <strong>Berhasil! </strong>{{$message}}
    </div>
    @endif

    @if ($message = Session::get('alert'))
    <div class="alert pink darken-1" style="font-size:16px;">
      <span class="closebtn">&times;</span>
      <strong>Gagal! </strong>{{$message}}
    </div>
    @endif
    <div class="row">
      @for($i=0;$i<count($picture);$i++)
      <div class="col m2 s12 foto">
        <div class="overlay">
          <form id="deleteFoto-{{$picture[$i]->id_picture}}" action="{{route('admin.produk.deleteFoto')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id_picture" value="{{$picture[$i]->id_picture}}">
            <input type="hidden" name="id_produk" value="{{$picture[$i]->id_produk}}">
          </form>
          <button form="deleteFoto-{{$picture[$i]->id_picture}}" value="Submit" type="submit" class="btn-flat" style="padding:0; margin-top:160px; height:40px; width:150px; color:white;">
          <div class="hijau-background" style="">
              <i class="material-icons left" style="margin:0; margin-left:10px;">delete</i>Hapus Foto
          </div>
          </button>
        </div>
        <img src="{{url($picture[$i]->url_photo)}}" style="height:200px; width:150px;">
      </div>
      @endfor
      <div class="col m2 s12" style="margin-top:0px;">
        <a class="modal-trigger" href="#modal1">
          <div class="hijau-background" style="height:200px; width:150px;">
            <div class="center" style="padding-top:50px;">
              <i class="material-icons" style="font-size:40px; color:white;">add_circle</i>
            </div>
            <p class="center" style="font-size:15px; color:white;">Tambah Foto</p>
          </div>
        </a>
        <!-- Modal Structure -->
        <div id="modal1" class="modal" style="height:230px;">
          <div class="modal-content">
            <h5>Upload Foto (1 Foto)</h5>
            <form id="foto" class="col s12" action="{{route('admin.produk.uploadFoto')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
              </div>
              <input type="hidden" name="id_produk" value="{{$produk[0]->id_produk}}">
            </form>
          </div>
          <div class="modal-footer" style="padding-right:35px;">
            <button type="submit" form="foto" value="Submit" class="modal-close btn">Upload</button>
          </div>
        </div>
      </div>
    </div><br>
    <h5 class="color-jameela">Keterangan Produk<h5>
    <form id="edit_produk" action="#" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->nama_produk}}" id="nama_produk" type="text" class="validate" name="nama_produk" data-length="40">
          <label for="nama_produk">Nama Produk</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->kode_barang}}" id="kode_barang" type="text" class="validate" name="kode_barang">
          <label for="kode_barang">Kode Barang</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <select name="id_brand" id="id_brand" required>
            @for($i=0;$i<count($brand);$i++)
            @if(($produk[0]->id_brand)==($brand[$i]->id_brand))
            <option value="{{$brand[$i]->id_brand}}" selected>{{$brand[$i]->nama_brand}}</option>
            @else
            <option value="{{$brand[$i]->id_brand}}">{{$brand[$i]->nama_brand}}</option>
            @endif
            @endfor
          </select>
          <label for="id_brand">Brand</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <select name="id_kategori" id="id_kategori" required>
            @for($i=0;$i<count($kategori);$i++)
            @if(($produk[0]->id_kategori)==($kategori[$i]->id_kategori))
            <option value="{{$kategori[$i]->id_kategori}}" selected>{{$kategori[$i]->nama_kategori}}</option>
            @else
            <option value="{{$kategori[$i]->id_kategori}}">{{$kategori[$i]->nama_kategori}}</option>
            @endif
            @endfor
          </select>
          <label for="id_kategori">Kategori</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->stok}}" id="stok" type="number" class="validate" name="stok">
          <label for="stok">Stok</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->harga}}" id="harga" type="number" class="validate" name="harga">
          <label for="harga">Harga</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <textarea id="keterangan" class="materialize-textarea" name="keterangan" wrap="hard">{{$produk[0]->keterangan}}</textarea>
          <label for="keterangan">Keterangan</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->url_shopee}}" id="url_shopee" type="text" class="validate" name="url_shopee">
          <label for="url_shopee">Link Shopee</label>
        </div>
      </div>
      <div class="row" style="margin:0;">
        <div class="input-field col m6 s12">
          <input value="{{$produk[0]->url_lazada}}" id="url_lazada" type="text" class="validate" name="url_lazada">
          <label for="url_lazada">Link Lazada</label>
        </div>
      </div>
    </form>
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
