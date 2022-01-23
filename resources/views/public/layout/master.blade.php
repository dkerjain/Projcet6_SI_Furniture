<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Destino project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{asset('public_assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link href="{{asset('public_assets/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/styles/main_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public_assets/styles/responsive.css')}}">
<style>
  .logo-jameela{
    height: 80px;
    width: auto;
  }
  .search-icon{
    font-size: 40px;
    color:#ffffff;
  }
  .color-jameela{
    color:#D2691E !important;
  }
  .background-color-jameela{
    background:#D2691E !important;
  }
  .social-media-logo-md{
    display:block;
  }
  .social-media-logo-sm{
    display:none;
  }
  @media only screen and (max-width: 200px){
    .social-media-logo-md{
      display:none;
    }
    .social-media-logo-sm{
      display:block;
    }
  }
</style>
@yield('style')
</head>
<body>

<div class="super_container">

  <!-- Header -->

  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="header_container d-flex flex-row align-items-center justify-content-start">

            <!-- Logo -->
            <div class="logo_container">
              <img class="logo-jameela mb-2 ml-3" src="{{asset('image/logo.png')}}" alt="">
            </div>

            <!-- Main Navigation -->
            <nav class="main_nav ml-auto">
              <ul class="main_nav_list">
                <li id="beranda-nav" class="main_nav_item" ><a href="{{route('public.index')}}"class="color-jameela">Home</a></li>
                <li id="produk-nav" class="main_nav_item"><a href="{{route('public.produk')}}"class="color-jameela">Produk</a></li>
                <li id="kontak-nav" class="main_nav_item"><a href="{{route('public.kontak')}}"class="color-jameela">Kontak Kami</a></li>
                <li id="kontak-nav" class="main_nav_item"><a href="{{route('public.tracking')}}"class="color-jameela">Tracking</a></li>
                <li id="keranjang-nav" class="main_nav_item"><a href="{{route('public.keranjang')}}"><i class="fa fa-shopping-cart icon-nav color-jameela" aria-hidden="true"><span class="ml-1 mb-3 color-jameela">@if(session('cart')) {{count(session('cart'))}} @else 0 @endif</span></i></a></li>
              </ul>
            </nav>

            <!-- Search -->
            <div class="search">
              <form action="#" class="search_form">
                <input type="search" name="search_input" class="search_input ctrl_class"><i class="color-jameela" required="required" placeholder="Keyword"></i>
                <button type="submit" class="search_button ml-auto ctrl_class"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
              </form>
            </div>

            <!-- Hamburger -->
            <div class="hamburger ml-auto"><i class="fa fa-bars color-jameela mt-2" aria-hidden="true"></i></div>

          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Menu -->

  <div class="menu_container menu_mm">

    <!-- Menu Close Button -->
    <div class="menu_close_container">
      <div class="menu_close"></div>
    </div>

    <!-- Menu Items -->
    <div class="menu_inner menu_mm">
      <div class="menu menu_mm">
        <ul class="menu_list menu_mm">
          <li class="menu_item menu_mm"><a href="{{route('public.index')}}" class="color-jameela">Home</a></li>
          <li class="menu_item menu_mm"><a href="{{route('public.produk')}}" class="color-jameela">Produk</a></li>
          <li class="menu_item menu_mm"><a href="{{route('public.kontak')}}" class="color-jameela">Kontak Kami</a></li>
          <li class="menu_item menu_mm"><a href="{{route('public.kontak')}}" class="color-jameela">Tracking</a></li>
          <li class="menu_item menu_mm"><a href="{{route('public.keranjang')}}" class="color-jameela"><i class="fa fa-shopping-cart icon-nav color-jameela" aria-hidden="true"><span class="ml-1 mb-3">@if(session('cart')) {{count(session('cart'))}} @else 0 @endif</span></i></a></li>
        </ul>

        <div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
      </div>

    </div>

  </div>
  @yield('content')
  <!-- Footer -->
  <footer>
    <div class="container" style="height:30vh">
      <div class="row mt-5 pt-3">
        <div class="col-md-6 col-12 justify-content-start">
          <h3 class="color-jameela"><b>Bedug Langgeng</b></h3>
          <p class="color-jameela">Rumah Pemasaran : 
            <br>Jl. Raya Gempolkerep 183 Gedeg - Mojokerto JAWA TIMUR
            <br>Bengkel Kerja :
            <br>Jl. Raya Kedungsari (Simpang Tiga) Kec. Kemlagi - Mojokerto.
            <br>(Jalur Mojokerto Menuju Ploso JOMBANG) JAWA TIMUR </p>

        <div class="col-md-6 col-12 social-media-logo-md">
          <div class="d-flex justify-content-end mt-4">
            <a href="https://api.whatsapp.com/send?phone=628563071834&text=Hai%20admin%20Bedug%20Langgeng"><img class="mr-2" style="width:40px;" src="{{asset('image/wa1-logo.png')}}"></a>
            <a href="https://www.facebook.com/BedugLanggeng/"><img class="mr-2" style="width:40px;" src="{{asset('image/fb-logo.png')}}"></a>
            <a href="https://www.instagram.com/bedug_langgeng/?hl=id"><img style="width:40px;" src="{{asset('image/ig-logo.png')}}"></a>
          </div>
        </div>





        <div class="col-12 mt-5" align="center">
          <div class="color-jameela" style="opacity:0.5; font-size:12px;">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is based from <a href="https://colorlib.com/wp/template/destino/" class="color-jameela" target="_blank">Destino</a> template by <a href="https://colorlib.com" class="color-jameela" target="_blank">Colorlib</a> and modified by <a href="https://www.instagram.com/annisaputrikar/?hl=id" class="color-jameela" target="_blank">Annisa Putri Karlina</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
<script src="{{asset('public_assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('public_assets/styles/bootstrap4/popper.js')}}"></script>
<script src="{{asset('public_assets/styles/bootstrap4/bootstrap.min.js')}}"></script>
<script src="{{asset('public_assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
<script src="{{asset('public_assets/plugins/easing/easing.js')}}"></script>
<script src="{{asset('public_assets/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('public_assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public_assets/js/custom.js')}}"></script>
<script src="{{asset('admin_assets/assets/js/JsBarcode.all.min.js')}}"></script>
@yield('script')
</body>
</html>
