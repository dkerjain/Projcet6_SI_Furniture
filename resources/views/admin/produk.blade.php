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
  .card-brand{
    font-size: 14px !important;
  }
  .card-title{
    color:#4CAF50;
    font-size: 22px !important;
  }
  .card-content{
    height: 120px;
  }
  .card-image{
    height: 230px;
  }
  .card-tambah{
    height: 350px;
    background-color: #4CAF50;
  }
  .card-tambah i{
    font-size: 100px;
    color: white;
    padding-top: 70px;
  }
  .card-tambah p{
    font-size: 25px;
    color: white;
    margin:0;
    padding-top: 60px;
    font-weight: 400;
  }
  .hapus{
    position: absolute;
    z-index: 2;
    margin-top: 210px;
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
</style>
@endsection
@section('content')
<div class="jarak">
  <div class="welcome color-jameela">
    <h4>Produk</h4>
    <p>Berikut adalah produk toko jameela</p>
  </div>
  <div class="row">
    <div class="search-product">
      <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari produk disini ...">
    </div>
  </div>
  <div class="row">
    <div class="col m6 s12">
      @if (!empty($success))
      <div class="alert success" style="font-size:16px;">
        <span class="closebtn">&times;</span>
        <strong>Berhasil! </strong>{{$success}}
      </div>
      @endif
      @if (!empty($alert))
      <div class="alert pink darken-1" style="font-size:16px;">
        <span class="closebtn">&times;</span>
        <strong>Gagal! </strong>{{$alert}}
      </div>
      @endif
    </div>
  </div>
  <ul id="product" class="row">
     <div class="row">
      @for ($i=0;$i<count($produk);$i++)
      @if($i%4==0)
      </div>
      <div class="row">
      @endif
      <?php
        $j = -1;
        $found = false;
        while(($found==false)&&($j<count($picture))&&(count($picture)!=0)){
          $j++;
          if(($produk[$i]->id_produk)==($picture[$j]->id_produk)){
            $found=true;
          }
        }
       ?>
      <li>
        <div class="col s12 m3">
          <a href="{{url('/admin/produk/'.$produk[$i]->id_produk)}}">
          <div class="card">
            <div class="hapus">
              <form id="deleteProduk-{{$produk[$i]->id_produk}}" action="{{route('admin.produk.hapus')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="id_produk" value="{{$produk[$i]->id_produk}}">
              </form>
              <button form="deleteProduk-{{$produk[$i]->id_produk}}"type="submit" class="btn pink darken-1"><i class="material-icons left">delete</i>Hapus</button>
            </div>
            <div class="card-image waves-effect waves-block waves-light img-produk">
              @if($found==true)
              <img class="activator" src="{{url($picture[$j]->url_photo)}}">
              @else
              <img class="activator" src="{{asset('image/not-available.jpg')}}">
              @endif
            </div>
            <div class="card-content">
              <span class="card-brand grey-text">{{$produk[$i]->brand->nama_brand}}</span>
              <span class="card-title activator">{{$produk[$i]->nama_produk}}</span>
            </div>
          </div>
        </a>
        </div>
      </li>
      @endfor
      <li>
        <div class="col s12 m3">
          <a href="{{route('admin.produk.create')}}">
            <div class="card card-tambah">
              <div class="center">
                <i class="material-icons">add_circle</i>
              </div>
              <p class="center">Tambah Produk</p>
            </div>
          </a>
        </div>
      </li>
      </div>
    </div>
  </ul>
</div>
@endsection
@section('script')
<script type="text/javascript">
  document.getElementById("produk").style = "color : white ; background-color : #4CAF50;";
  function searchFunction() {
    var input, filter, div, title, a, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("product");
    li = div.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        txtValue1 = a.textContent || a.innerText;
        b = li[i].getElementsByTagName("span")[1];
        txtValue2 = b.textContent || b.innerText;
        if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
  }

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
