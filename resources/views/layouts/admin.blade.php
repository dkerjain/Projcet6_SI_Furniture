<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Jameela</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <style>
      *{
        font-family: 'Open Sans', sans-serif;
      }
      @media screen and (max-width: 650px) {
        .isi{
          margin-left: 0 !important;
        }
        .sidebar{
          display: none;
        }
        .icon-menu{
          display: block !important;
          margin-right: 20px;
        }
        .konten{
          width: 100% !important;
        }
      }
      .color-jameela{
        color : #4CAF50;
      }
      .sidebar{
        height: 100%; /* 100% Full-height */
        width: 20%; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        top: 0; /* Stay at the top */
        left: 0;
        background-color: #F7F7F7; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
      }
      .logo{
        margin-top: 30px;
        margin-bottom: 50px;
      }
      .logo img{
        width: 60%;
      }
      .option{
        width: 100%;
        color: #4CAF50;
        background-color: #F7F7F7;
        font-size: 18px;
        padding-top: 5px;
        padding-bottom: 5px;
      }
      .option:hover{
        color:white;
      }
      .isi{
        margin-left: 20%;
      }
      .profil{
        margin-right: 50px;
        margin-top: 40px;
      }
      .profil img{
        height: 40px;
        width: 40px;
        border-radius: 50%;
      }
      .judul{
        margin-left: 60px;
        margin-top: 18px;
        color : #4CAF50;
        font-size: 25px;
        font-weight: 400;
      }
      .judul .col{
        padding: 0 !important;
      }
      .icon-menu{
        margin-top:28px;
        display: none;
      }
      .icon-menu i{
        color: #4CAF50;
      }
    </style>
    @yield('style')
  </head>
  <body>
    <div class="sidebar z-depth-1">
      <div class="logo center">
        <img src="{{asset('image/logo-jameela.png')}}">
      </div>
      <a href="{{route('admin.dashboard')}}">
        <div id="dashboard" class="option">
          <p class="center">Dashboard</p>
        </div>
      </a>
      <a href="{{route('admin.logout')}}">
        <div id="penjualan" class="option">
          <p class="center">Penjualan</p>
        </div>
      </a>
      <a href="{{route('admin.produk')}}">
        <div id="produk" class="option">
          <p class="center">Produk</p>
        </div>
      </a>
      <a href="{{route('admin.kategori')}}">
        <div id="penjualan" class="option">
          <p class="center">Kategori</p>
        </div>
      </a>
      <a href="{{route('admin.kategori')}}">
        <div id="penjualan" class="option">
          <p class="center">Brand</p>
        </div>
      </a>
      <a href="{{route('admin.logout')}}">
        <div id="keluar" class="option">
          <p class="center">Keluar</p>
        </div>
      </a>
    </div>

    <div class="isi">
      <div class="row">
        <div class="judul left">
          <div class="col icon-menu">
            <a href="javascript:void(0);" class="icon" onclick="openNav()">
              <i class="material-icons">apps</i>
            </a>
          </div>
          <div class="col">
            <p>@yield('title')</p>
          </div>
        </div>
        <div class="profil right">
          <img src="https://www.w3schools.com/howto/img_avatar.png">
        </div>
      </div>
      <div class="row">
        @yield('content')
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
      M.AutoInit();

      function openNav(){
        document.getElementsByClassName('sidebar').style.display = "block";
      }

      </script>
    @yield('script')
  </body>
</html>
