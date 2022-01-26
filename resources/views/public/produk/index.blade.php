@extends('public.layout.master')
@section('title')
Produk - DOMUS
@endsection
@section('style')
<style>
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
</style>
@endsection
@section('content')
<div class="produk_background">
  <div class="produk_background_background parallax-window" data-parallax="scroll" data-image-src="{{asset('image/carousel/carousel-3.jpg')}}" data-speed="0.8"></div>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="produk_background_content">
          <div class="produk_background_content_inner">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Offers -->

<div class="offers">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title text-center">
          <h2>Furniture Unik</h2>
          <div>Koleksi Furniture Unik dan Berkualitas</div>
        </div>
      </div>
    </div>
    <div class="row filtering_row">
      <div class="col">
        <form action="{{ url()->current() }}">
        <div class="row justify-content-center sorting_group_1 w-100">
          <ul class="item_sorting">
            <li>
                <input type="search" name="search" class="search_input_produk ctrl_class" required="required" placeholder="Keyword">
            </li>
            <li>
              <span class="sorting_text">Urutkan Berdasarkan</span>
              <i class="fa fa-angle-down"></i>
              <ul>
                <li class="item_sorting_btn"><a href="{{route('public.produk')}}"><span>Default</span></a></li>
                <li class="item_sorting_btn"><a href="{{route('public.produk',['created_at'=>'desc'])}}"><span>Terbaru</span></a></li>
                <li class="item_sorting_btn"><a href="{{route('public.produk',['nama_produk'=>'asc'])}}"><span>Nama A-Z</span></a></li>
                <li class="item_sorting_btn"><a href="{{route('public.produk',['nama_produk'=>'desc'])}}"><span>Nama Z-A</span></a></li>
              </ul>
            </li>
            <li>
              <span class="sorting_text">Kategori</span>
              <i class="fa fa-angle-down"></i>
              <ul>
                <li class="item_sorting_btn"><a href="{{route('public.produk',['kategori'=>'all'])}}"><span>Seluruh Kategori</span></a></li>
                @for($i=0;$i<count($kategori);$i++)>
                <li class="item_sorting_btn"><a href="{{route('public.produk',['kategori'=>$kategori[$i]->id])}}"><span>{{$kategori[$i]->nama_kategori}}</span></a></li>
                @endfor
              </ul>
            </li>
            <li>
              <button class="btn background-color-jameela text-white rounded-0" type="submit" style="font-size: 14px; cursor:pointer;"> Cari</button>
            </li>
          </ul>
        </div>
        </form>
      </div>
    </div>
    <div class="row top_content justify-content-md-center">
        @for($i=0;$i<count($produk);$i++)
        <div class="col-lg-3 col-md-6 top_col mb-4">
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
                <div class="produk-diskon">Rp {{number_format($produk[$i]->harga, 0, ',', '.')}}</div>
                <div class="top_item_price">Rp {{number_format($produk[$i]->harga - ($produk[$i]->harga * $produk[$i]->diskon/100), 0, ',', '.')}}</div>
                @else
                <div class="top_item_price">Rp {{number_format($produk[$i]->harga, 0, ',', '.') }}</div>
                @endif
                <div class="top_item_text">{{$produk[$i]->nama_produk}}</div>
              </div>
            </a>
          </div>
        </div>
        @endfor
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
