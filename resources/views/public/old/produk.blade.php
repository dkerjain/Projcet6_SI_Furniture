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
    .header-product{
      font-size:45px;
      font-family: 'Courgette', cursive;
      color:#4CAF50;
      margin-top: 20px;
      margin-bottom: 20px;
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
        font-size: 16px !important;
      }
      .breadcrumb:before {
        font-size: 16px !important;
      }
      .slidemySlides img{
        width:100% !important;
      }
      .jarak{
        margin-left: 5%;
        margin-left: 5%;
      }
      .header-product{
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 40px;
      }
      .slidenext {
        margin-left: 85% !important;
      }
      .stok{
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
    .stok{
      margin:0 auto;
      font-size:17px;
    }


    /* css slide*/
    .slide img {
      vertical-align: middle;
    }
    /* Position the image container (needed to position the left and right arrows) */
    .slidecontainer {
      position: relative;
    }
    /* Hide the images by default */
    .slidemySlides {
      display: none;
    }
    .slidemySlides img{
      width:360px;
    }
    /* Next & previous buttons */
    .slideprev,
    .slidenext {
      cursor: pointer;
      position: absolute;
      top: 40%;
      width: auto;
      padding: 16px;
      margin-top: -50px;
      color: white;
      font-weight: bold;
      font-size: 20px;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }
    /* Position the "next button" to the right */
    .slidenext {
      margin-left: 315px;
      border-radius: 3px 0 0 3px;
    }
    /* On hover, add a black background color with a little bit see-through */
    .slideprev:hover,
    .slidenext:hover {
      background-color: rgba(0, 0, 0, 0.8);
    }
    /* Number text (1/3 etc) */
    .slidenumbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    /* Container for image text */
    .slidecaption-container {
      text-align: center;
      background-color: #222;
      padding: 2px 16px;
      color: white;
    }
    .sliderow:after {
      content: "";
      display: table;
      clear: both;
    }
    /* Six columns side by side */
    .slidecolumn {
      float: left;
      width: 16.66%;
    }
    /* Add a transparency effect for thumnbail images */
    .slidedemo {
      opacity: 0.6;
    }
    .slideactive,
    .slidedemo:hover {
      opacity: 1;
    }
  </style>
@endsection
@section('content')
<div class="row">
  <div class="parallax-container">
      <div class="parallax"><img src="{{asset('image/carousel/carousel-4.jpg')}}"></div>
  </div>
</div>
<div class="row container">
  <div class="col m6 s12 navigasi-kategori">
    <div class="slidecontainer slide">
      @for($i=0;$i<count($picture);$i++)
      <a class="modal-trigger" href="#modal-img{{$i+1}}">
        <div class="slidemySlides">
          <div class="slidenumbertext">{{$i+1}}/{{count($picture)}}</div>
          <img src="{{url($picture[$i]->url_photo)}}">
        </div>
      </a>
      <!-- Modal Structure -->
      <div id="modal-img{{$i+1}}" class="modal modal-fixed-footer">
        <div class="modal-content">
          <img src="{{url($picture[$i]->url_photo)}}">
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn" style="background-color: #4CAF50;">Tutup</a>
        </div>
      </div>
      @endfor
      <a class="slideprev" onclick="plusSlides(-1)">❮</a>
      <a class="slidenext" onclick="plusSlides(1)">❯</a>
      <div class="sliderow">
        @for($i=0;$i<count($picture);$i++)
        <div class="slidecolumn">
          <img class="slidedemo" src="{{url($picture[$i]->url_photo)}}" style="width:100%;" onclick="currentSlide({{$i}})">
        </div>
        @endfor
      </div>
    </div>
  </div>
  <div class="col m6 s12 navigasi-kategori">
    <div class="row nav-wrapper" style="margin:25px 0 0 0;">
      <a href="{{route('public.index')}}" class="breadcrumb">Kategori</a>
      <a href="{{url('/kategori/'.$id_kategori)}}" class="breadcrumb">{{$nama_kategori[0]->nama_kategori}}</a>
      <a href="{{url('/kategori/'.$id_kategori.'/'.$id_produk)}}" class="breadcrumb">{{$produk[0]->nama_produk}}</a>
    </div>
    <div class="row" style="margin-left:0px; margin-bottom:0;">
      <b><p class="left header-product">{{$produk[0]->nama_produk}}</p></b>
    </div>
    <div class="card-panel" style="background-color: #4CAF50; padding: 10px 5px 10px 5px;width:150px;">
      <p class="white-text center stok">
        Rp. {{$produk[0]->harga}}
      </p>
    </div>
    <div class="row navigasi-kategori" style="margin-left:0px;">
      <p class="hijau-jameela" style="font-size:20px; margin-bottom:0;"><b>
        Stok : {{$produk[0]->stok}}
      </b></p>
    </div>
    <div class="row" style="margin-left:0px;">
      <p class="hijau-jameela" style="font-size:20px; margin-bottom:0;"><b>
        Kode Barang :
      </b></p>
      <p class="hijau-jameela" style="font-size:18px; margin-top:0;margin-bottom:0">
        {{$produk[0]->kode_barang}}
      </p>
    </div>
    <div class="row" style="margin-left:0px;">
      <p class="hijau-jameela" style="font-size:20px; margin-bottom:0;"><b>
        Deskripsi :
      </b></p>
      <p class="hijau-jameela" style="font-size:17px; margin-top:0;">
        {{$produk[0]->keterangan}}
      </p>
    </div>
    <div class="row navigasi-kategori" style="margin-left:0px;">
      <p class="hijau-jameela" style="font-size:20px; margin-bottom:0;"><b>
        Dapatkan produk ini di
      </b></p>
      <div class="social-footer-icons">
        <ul>
          <li><a href="https://wa.me/?text=Hai%20admin%20jameela%2C%20apakah%20produk%20dengan%20kode%20barang%20%3A%20{{$produk[0]->kode_barang}}%20masih%20ada%3F"><img src="{{asset('image/chat_admin.png')}}"></a></li>
          <li><a href="{{$produk[0]->url_shopee}}"><img src="{{asset('image/shopee_green.png')}}"></a></li>
          <li><a href="{{$produk[0]->url_lazada}}"><img src="{{asset('image/lazada_green.png')}}"></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br><br>
<div class="row container navigasi-kategori">
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
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
  showSlides(slideIndex += n);
  }

  function currentSlide(n) {
  showSlides(slideIndex = n);
  }

  function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slidemySlides");
  var dots = document.getElementsByClassName("slidedemo");
  var captionText = document.getElementById("slidecaption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace("slideactive", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += "slideactive";
  captionText.innerHTML = dots[slideIndex-1].alt;
  }
</script>
@endsection
