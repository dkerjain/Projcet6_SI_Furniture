<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Overpass&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
      *{
        font-family: 'Overpass', sans-serif;
      }
      /* The side navigation menu */
      .sidebar {
        height: 100%; /* 100% Full-height */
        width: 0; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 1; /* Stay on top */
        top: 0; /* Stay at the top */
        left: 0;
        background-color: #4CAF50; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
         /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
      }

      /* The navigation menu links */
      .sidebar a {
        padding: 8px 8px 8px 8px;
        text-decoration: none;
        font-size: 25px;
        color: white;
        display: block;
        transition: 0.3s;
        margin-left: 20px;
      }

      /* When you mouse over the navigation links, change their color */
      .sidebar a:hover {
        color: #f1f1f1;
      }
      .logo-sidebar{
        background-color: white;
        padding: 8px 8px 8px 8px;
        margin-bottom: 30px;
      }
      .logo-sidebar img{
          height: 60px;
          margin-left: 50px;
          margin-top: 25px;
          margin-bottom: 15px;
      }
      .logo-sidebar a {
        padding: 8px 8px 8px 8px;
        font-size: 25px;
        color: #4CAF50;
        transition: 0.3s;
        display :inline;
      }
      /* Position and style the close button (top right corner) */
      .logo-sidebar .closebtn {
        position: absolute;
        top: 15px;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }
      .topnav {
        overflow: hidden;
      }

      .topnav img {
        height: 60px;
        margin-left: 50px;
        margin-top: 20px;
      }

      .topnav a {
        float: left;
        display: block;
        color: #4CAF50;
        text-align: center;
        padding: 16px 16px;
        text-decoration: none;
        font-size: 20px;
      }

      .topnav a:hover {
        color: #ddd;
      }

      .topnav .icon {
        display: none;
      }

      @media screen and (max-width: 650px) {
        .topnav a {display: none;}
        .topnav a.icon {
          float: right;
          display: block;
        }
        .right{
          margin-right: 5% !important;
          margin-top: 5% !important;
        }
        .topnav img {
          margin-left: 20% !important;
          margin-top: 20% !important;
        }
        .topnav i{
          font-size: 40px !important;
        }
        .sidebar i{
          font-size: 40px !important;
          margin-right: 10px !important;
          margin-top: 15px !important;
        }
        .social-footer .social-footer-icons li:last-of-type {
          margin-right: 0px !important;
        }
        .social-footer{
          padding: 0 !important;
        }
        .social-footer .social-footer-icons{
          margin:0 auto !important;
        }
        .social-footer-icons img{
          height:35px !important;
        }
        .social-footer-left p{
          margin-left:0 !important;
        }
        .hidden{
          display: none;
        }
        .show{
          display:block !important;
        }
      }

      @media screen and (max-width: 650px) {
        .topnav.responsive {position: relative;}
        .topnav.responsive .icon {
          position: absolute;
          right: 0;
          top: 0;
        }
        .topnav.responsive a {
          float: none;
          display: block;
          text-align: left;
        }
      }
      .right{
        margin-right: 40px;
        margin-top: 20px;
      }
      .hijau{
        color: #4CAF50;
      }
      .social-footer {
        padding: 1rem;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
            -ms-flex-align: center;
                align-items: center;
        -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
                justify-content: space-between;
      }

      .social-footer .social-footer-icons li:last-of-type {
        margin-right: 50px;
      }

      .social-footer .social-footer-icons .fa {
        font-size: 40px;
        color: #4CAF50;
      }
      .social-footer-icons li{
        display: inline;
        margin-right: 20px;
      }
      .social-footer-icons img{
        margin-top: 5px;
        height:40px;
      }
      .social-footer-left p {
        font-size: 14px;
        color: #4CAF50;
        margin-left: 60px;
      }
      .social-footer-left .header {
        font-size: 20px;
        margin-bottom: -10px;
      }
      .show{
        display:none;
      }
      .dropdown-content{
        width: 200px !important;
      }
      .dropdown-content a{
        color: #4CAF50 !important;
      }
      .expandable {
        background: #fff;
        overflow: hidden;
        display: none;
       }
       .expandable a {
         color: #4CAF50;
      }
      .hijau-jameela{
        color:#4CAF50 !important;
      }
      .font-jameela{
        color:#4CAF50 !important;
      }
    </style>
    @yield('style')
    <title>@yield('title')</title>
  </head>
  <body>
    <div class="row">
      <div id="mySidebar" class="sidebar">
        <div class="logo-sidebar">
          <img src="{{asset('image/logo-jameela.png')}}">
          <a href="javascript:void(0);" class="closebtn" onclick="closeNav()">
            <i class="material-icons">close</i>
          </a>
        </div>
        <a href="{{route('public.index')}}">Beranda</a>
        <a id="navbtn" href="javascript:void(0);" onclick="openKategori()">Kategori</a>
        <div class="expandable" id="nav">
          @for($i=0;$i<(count($kategori));$i++)
            <a href="{{ url('kategori/'.$kategori[$i]->id_kategori)}}">{{$kategori[$i]->nama_kategori}}</a>
          @endfor
        </div>
        <a href="#contact">Kontak</a>
      </div>
      <div id="myTopnav" class="topnav">
        <div class="col left">
          <img src="{{asset('image/logo-jameela.png')}}">
        </div>
        <div class="col right">
          <a href="{{route('public.index')}}">Beranda</a>
          <a class='dropdown-trigger' href='#' data-target='dropdown1'>Kategori</a>
          <!-- Dropdown Structure -->
          <ul id='dropdown1' class='dropdown-content'>
            @for($i=0;$i<(count($kategori));$i++)
              <li><a href="{{ url('kategori/'.$kategori[$i]->id_kategori)}}">{{$kategori[$i]->nama_kategori}}</a></li>
            @endfor
          </ul>
          <a href="#contact">Kontak</a>
          <a href="javascript:void(0);" class="icon" onclick="openNav()">
            <i class="material-icons">apps</i>
          </a>
        </div>
      </div>
      </div>
      @yield('content')
      <footer class="social-footer">
          <div class="social-footer-left hidden">
            <p class="header"><b>Butik Jameela</b></p>
            <p>Jl. Siberut No.1, Banyudono, Kec. Ponorogo, <br> Kabupaten Ponorogo, Jawa Timur 63411</p>
          </div>
          <div class="social-footer-icons">
            <div class="social-footer-left show">
              <p class="header"><b>Butik Jameela</b></p>
              <p>Jl. Siberut No.1, Banyudono, Kec. Ponorogo, <br> Kabupaten Ponorogo, Jawa Timur 63411</p>
            </div>
            <ul>
              <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/shopee_green.png')}}"></a></li>
              <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/lazada_green.png')}}"></a></li>
              <li><a href="https://twitter.com/?lang=en"><img src="{{asset('image/facebook_green.png')}}"></a></li>
              <li><a href="https://www.instagram.com/?hl=en"><img src="{{asset('image/instagram_green.png')}}"></a></li>
            </ul>
          </div>
      </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script>

      M.AutoInit();

      function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
          x.className += " responsive";
        } else {
          x.className = "topnav";
        }
      }
      /* Open the sidebar */
      function openNav() {
        document.getElementById("mySidebar").style.width = "100%";
      }

      function openKategori() {
        document.getElementById("nav").style.display = "block";
        document.getElementById("navbtn").onclick = function(){closeKategori()};
      }
      function closeKategori() {
        document.getElementById("nav").style.display = "none";
        document.getElementById("navbtn").onclick = function(){openKategori()};
      }

      /* Close/hide the sidebar */
      function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
      }

      /* animation text */
    </script>
    @yield('script')
  </body>
</html>
