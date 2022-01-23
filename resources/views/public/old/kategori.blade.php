@extends('public.layout.master')
@section('title')Beranda - Jameela @endsection
@section('style')
  <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
  <style>
    .css-typing {
      color: #4CAF50;
      text-align: center;
      white-space: nowrap;
      overflow: hidden;
      font-size:20px;
      width: 100%;
      margin: 0 auto !important;
      animation: type 3s steps(60, end);
    }
    .css-typing .header{
      font-size:60px;
      font-family: 'Courgette', cursive;
    }
    .css-typing:nth-child(2){
      animation: type2 3s steps(60, end);
    }
    @keyframes type{
      from { width: 0; }
    }
    @keyframes type2{
      0%{width: 0;}
      50%{width: 0;}
      100%{ width: 100; }
    }
    .parallax-container {
      height: 100vh;
    }
    .css-typing .social-footer-icons img{
      height:40px;
    }
    .kategori{
      margin-left:10%;
      margin-right:10%;
    }
    .css-typing .header-product{
      font-size:40px;
      font-family: 'Courgette', cursive;
    }
    .judul-kategori{
      font-size:25px;
      color:white;
    }
    .img-produk{
      height:250px !important;
    }
    .card-brand{
      font-size: 14px !important;
    }
    .card-title{
      color:#4CAF50;
      font-size: 22px !important;
    }
    .search-product{
      margin-left: 18%;
      margin-right: 18%;
    }
    .alamat{
      margin:20% 20% 20% 20%;
    }
    .alamat-text{
      margin:35% 20% 20% 20%;
    }
    .card-content{
      height: 150px;
    }
    .card-image{
      height: 250px;
    }
    @media screen and (max-width: 650px) {
      .css-typing .header {
        font-size:35px;
      }
      .alamat{
        margin:10% 10% 10% 10%;
      }
      .alamat img{
        height: 300px !important;
      }
      .navigasi-kategori{
        margin-top: 30px !important;
      }
      .breadcrumb, .breadcrumb:last-child {
        font-size: 14px !important;

      }
      .breadcrumb:before {
        font-size: 14px !important;
      }
    }
    .breadcrumb, .breadcrumb:last-child {
      color: #4CAF50;
      font-size: 18px;

    }
    .breadcrumb:before {
      color: #4CAF50;
      font-size: 18px;
    }
    .navigasi-kategori{
      margin-top: 50px;
    }
    .maaf{
      font-size: 20px;
      margin-top: 20px;
      margin-bottom: 20px;
    }
  </style>
@endsection
@section('content')
<div class="row">
  <div class="parallax-container">
      <div class="parallax"><img src="{{asset('image/carousel/carousel-4.jpg')}}"></div>
  </div>
</div>
<div class="navigasi-kategori">
  <div class="container nav-wrapper">
    <div class="col s12">
      <a href="{{route('public.index')}}" class="breadcrumb">Kategori</a>
      <a href="{{url('/kategori/'.$id)}}" class="breadcrumb">{{$nama_kategori[0]->nama_kategori}}</a>
    </div>
  </div>
</div>
<div class="row">
  <div class=" css-typing box-welcome animation">
    <b><p class="header-product">{{$nama_kategori[0]->nama_kategori}}</p></b>
  </div>
  <div class="search-product">
    <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Cari produk disini ...">
  </div>
</div>
<ul id="product" class="row">
   <div class="row container">
    @if(count($produk)==0)
      <br><p class="center font-jameela maaf">" Maaf Kategori Ini Tidak Tersedia "</p><br>
    @else
    @for ($i=0;$i<count($produk);$i++)
    @if($i%4==0)
    </div>
    <div class="row container">
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
        <a href="{{url('/kategori/'.$produk[$i]->id_kategori.'/'.$produk[$i]->id_produk)}}">
        <div class="card">
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
    @endif
    </div>
  </div>
</ul>
<div class="row container">
  <div class=" css-typing box-welcome animation">
    <b><p class="header-product">Visit Our Store</p></b>
  </div>
  <div class="col s12 m6 ">
    <div class="alamat">
    <a href="https://goo.gl/maps/tCjjVfgEAMLrx5WW6"><img src="{{asset('image/maps.png')}}" style="height:400px;"></a>
    </div>
  </div>
  <div class="col s12 m6">
    <div class="alamat-text hidden" style="height:400px;">
      <div class="social-footer-left">
        <img src="{{asset('image/logo-jameela-2.png')}}" style="margin-left:0px !important;">
        <p style="margin-left:0px !important;">Jl. Siberut No.1, Banyudono, Kec. Ponorogo, <br> Kabupaten Ponorogo, Jawa Timur 63411</p>
      </div>
      <div class="social-footer-icons">
        <ul>
          <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/shopee_green.png')}}"></a></li>
          <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/lazada_green.png')}}"></a></li>
          <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/facebook_green.png')}}"></a></li>
          <li><a href="https://www.instagram.com/?hl=en"><img src="{{asset('image/instagram_green.png')}}"></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
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
</script>
@endsection
