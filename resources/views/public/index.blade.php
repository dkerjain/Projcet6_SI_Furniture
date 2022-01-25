@extends('public.layout.master')
@section('title') Home - DOMUS  @endsection
@section('style')
<style>
  .parallax {
  /* The image used */
  background-image: url("{{asset('image/carousel/carousel-4.jpg')}}");
  /* Full height */
  height: 100vh;
  width: 100vw;
  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  }
  .produk-diskon
  {
  	font-size: 14px;
  	font-weight: 400;
  	color: #FFFFFF;
  	text-shadow: 2px 2px 3px #000000;
  	text-decoration: line-through;
  }
  .produk-diskon-bubble
  {
  	position: absolute;
  	right: 25px;
  	top: 25px;
  	font-size: 14px;
  	font-weight: 400;
  	color: #FFFFFF;
  }
  .produk-lain-nav
  {
  	position: absolute;
  	top: 50%;
  	-webkit-transform: translateY(-50%);
  	-moz-transform: translateY(-50%);
  	-ms-transform: translateY(-50%);
  	-o-transform: translateY(-50%);
  	transform: translateY(-50%);
  	right: -20px;
  	width: 90px;
  	height: 90px;
  	background: #2F4F4F;
  	border-radius: 50%;
  	cursor: pointer;
  	-webkit-transition: all 200ms ease;
  	-moz-transition: all 200ms ease;
  	-ms-transition: all 200ms ease;
  	-o-transition: all 200ms ease;
  	transition: all 200ms ease;
  	z-index: 10;
  }
  .produk-lain-nav span
  {
  	display:none;
  }
  .produk-lain-nav i
  {
  	display:block;
  }
  .produk-lain-nav:hover
  {
  	width: 250px;
  	border-radius: 50px;
  }
  .produk-lain-nav:hover span
  {
  	display: block;
  }
  .produk-lain-nav:hover i
  {
  	display:none;
  }
</style>
@endsection
@section('content')
<!-- Home -->

<div class="home">
  <div class="home_background" style="background-image:url({{asset('image/carousel/carousel-3-1.png')}})"></div>
  <div class="home_content">
    <div class="home_content_inner">
    </div>
  </div>
</div>

<!-- Top Destinations -->

<div class="top">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title text-center">
          <h2>Produk Terbaru</h2>
          <div>lihat koleksi produk terbaru dari kami</div>
        </div>
      </div>
    </div>
    <div class="row top_content justify-content-md-center">
      @if(count($produk)>=4)
        @for($i=0;$i<4;$i++)
        <div class="col-lg-3 col-md-6 top_col">
          <div class="top_item">
            <a href="{{route('public.produk.show',['id'=>$produk[$i]->id])}}">
              <div class="top_item_image">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    @for($j=0;$j<count($produk[$i]->picture);$j++)
                    <div class="carousel-item @if($j==0) active @endif">
                      <img style="object-fit: cover; object-position: 100% 0; height: 350px;" src="{{$produk[$i]->picture[$j]->url_photo}}" alt="">
                    </div>
                    @endfor
                  </div>
                </div>
              </div>
              @if($produk[$i]->status_diskon==1)
              <div class="produk-diskon-bubble rounded-circle background-color-jameela pt-2 pl-2" style="width:40px; height:40px;">{{$produk[$i]->diskon}}%</div>
              @endif
              <div class="top_item_content">
                @if($produk[$i]->status_diskon==1)
                <div class="produk-diskon">Rp {{  number_format($produk[$i]->harga, 0, ',', '.') }}</div>
                <div class="top_item_price">Rp {{  number_format($produk[$i]->harga - ($produk[$i]->harga * $produk[$i]->diskon/100), 0, ',', '.')}}</div>
                @else
                <div class="top_item_price">Rp {{ number_format($produk[$i]->harga, 0, ',', '.') }}</div>
                @endif
                <div class="top_item_text">{{$produk[$i]->nama_produk}}</div>
              </div>
            </a>
          </div>
        </div>
        @endfor
        <a class="d-md-block d-none" href="{{route('public.produk')}}">
          <div class="produk-lain-nav d-flex flex-column align-items-center justify-content-center">
            <span class="text-white">Lihat Seluruh Koleksi</span>
            <i class="fa fa-chevron-right text-white" aria-hidden="true"></i>
          </div>
        </a>
      @else
        @for($i=0;$i<count($produk);$i++)
        <div class="col-lg-3 col-md-6 top_col">
          <div class="top_item">
            <a href="{{route('public.produk.show',['id'=>$produk[$i]->id])}}">
              <div class="top_item_image">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    @for($j=0;$j<count($produk[$i]->picture);$j++)
                    <div class="carousel-item @if($j==0) active @endif">
                      <img style="object-fit: cover; object-position: 100% 0; height: 350px;" src="{{$produk[$i]->picture[$j]->url_photo}}" alt="">
                    </div>
                    @endfor
                  </div>
                </div>
              </div>
              @if($produk[$i]->status_diskon==1)
              <div class="produk-diskon-bubble rounded-circle background-color-jameela pt-2 pl-2" style="width:40px; height:40px;">{{$produk[$i]->diskon}}%</div>
              @endif
              <div class="top_item_content">
                @if($produk[$i]->status_diskon==1)
                <div class="produk-diskon">Rp {{$produk[$i]->harga}}</div>
                <div class="top_item_price">Rp {{$produk[$i]->harga - ($produk[$i]->harga * $produk[$i]->diskon/100)}}</div>
                @else
                <div class="top_item_price">Rp {{$produk[$i]->harga}}</div>
                @endif
                <div class="top_item_text">{{$produk[$i]->nama_produk}}</div>
              </div>
            </a>
          </div>
        </div>
        @endfor
      @endif
    </div>
  </div>
</div>

<!-- Find Form -->
<div class="find">
  <!-- Image by https://unsplash.com/@garciasaldana_ -->
  <div class="find_background parallax-window" data-parallax="scroll" data-image-src="{{asset('image/carousel/carousel-3.png')}}" data-speed="0.8"></div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="find_title text-center font-weight-normal">Cari Furniture Unik di DOMUS</div>
      </div>
      <div class="col-12">
        <div class="find_form_container">
            {{-- <form action="" id="find_form" class="find_form d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-between justify-content-start flex-wrap"> --}}
            <div class="row w-100 px-3">
              <div class="col-10">
                <div class="find_item w-100">
                  <input type="text" name="search" class="find_input" required="required" placeholder="Cari disini">
                </div>
              </div>
              <div class="col-2">
                <button class="btn background-color-jameela rounded-0 py-md-3 px-md-5 text-white" type="submit">Cari</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Popular -->


<!-- Special -->

<div class="special">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title text-center">
          <h2>Kategori</h2>
          <div> Best Furniture DOMUS</div>
        </div>
      </div>
    </div>
  </div>
  <div class="special_content">
    <div class="special_slider_container">
      <div class="owl-carousel owl-theme special_slider">
        @for($i=0;$i<count($kategori);$i++)
        <div class="owl-item">
          <div class="special_item">
            <div class="special_item_background"><img src="{{asset($kategori[$i]->url_photo)}}" alt=""></div>
            <div class="special_item_content text-center">
              <div class="special_category">Kategori</div>
              <div class="special_title"><a href="{{route('public.produk',['kategori'=>$kategori[$i]->id])}}">{{$kategori[$i]->nama_kategori}}</a></div>
            </div>
          </div>
        </div>
        @endfor
      </div>
      <div class="special_slider_nav d-flex flex-column align-items-center justify-content-center">
        <i class="fa fa-chevron-right text-white" aria-hidden="true"></i>
      </div>
    </div>
  </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
  <!-- Image by https://unsplash.com/@garciasaldana_ -->
  <div class="newsletter_background" style="background-image:url({{asset('image/carousel/carousel-3.png')}})"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="newsletter_content">
          <div class="newsletter_title text-center font-weight-normal">Bedug Terbaik di Indonesia</div>
        
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')

<script>
$("#beranda-nav").addClass("active");
</script>

<script type="text/javascript">
    
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>
@endsection
