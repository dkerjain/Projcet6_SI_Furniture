@extends('public.layout.master')
@section('title')
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
.number{
	margin-top: 30px;
}
.minus, .plus{
	width:34px;
	height:34px;
	background:#4CAF50;
  color: #ffffff;
	border-radius:4px;
	padding:6px 5px 6px 5px;
	border:1px solid #ddd;
  display: inline-block;
  vertical-align: middle;
  text-align: center;
}
.number input{
	height:34px;
  width: 100px;
  text-align: center;
  font-size: 16px;
	border:1px solid #ddd;
	border-radius:4px;
  display: inline-block;
  vertical-align: middle;
}
.number span{
  cursor: pointer;
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
            <div class="produk_background_breadcrumbs">
              <ul class="produk_background_breadcrumbs_list">

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="offers">
  <div class="container">
    <div class="row">
      @if ($message = Session::get('success'))
      <div class="col-12 mt-3">
      <div class="alert alert-success background-color-jameela alert-with-icon text-white" data-notify="container">
        <i class="fa fa-check"></i>
        <span data-notify="message">{{ $message }}</span>
      </div>
      </div>
      @endif
      @if ($message = Session::get('error'))
      <div class="col-12 mt-3">
      <div class="alert alert-danger alert-with-icon" data-notify="container">
        <i class="fa fa-times text-white"></i>
        <span data-notify="message">{{ $message }}</span>
      </div>
      </div>
      @endif
      <div class="col-12">
        <div class="row">
          <div class="col-md-6 col-12 pt-2">
            <div id="carouselExampleIndicators" class="carousel slide my-md-5 mx-md-5" data-ride="carousel">
              <ol class="carousel-indicators">
                @for($i=0;$i<count($produk->picture);$i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
                @endfor
              </ol>
              <div class="carousel-inner">
                @for($i=0;$i<count($produk->picture);$i++)
                <div class="carousel-item @if($i==0) active @endif">
                  <img class="d-block w-100" src="{{asset($produk->picture[$i]->url_photo)}}" alt="First slide">
                </div>
                @endfor
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
           <!-- <div align="center">
              <svg id="barcode"></svg>
            </div>-->
          </div>
          <div class="col-md-6 col-12">
            <div class="my-5 mx-md-4">
              <h3 class="pt-md-4 font-weight-bold text-success">{{$produk->nama_produk}}</h3>
              <h5 style="white-space: pre-wrap;">{{$produk->keterangan}}</h5>
            </div>
            <div class="mx-md-4 w-100">
              <p>Detail Barang</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Ukiran</td>
                      <td>{{$produk->ukiran->nama_ukiran}}</td>
                    </tr>
                    <tr>
                      <td>Kategori</td>
                      <td>{{$produk->kategori->nama_kategori}}</td>
                    </tr>
                    <!--<tr>
                      <td>Kode Barang</td>
                      <td>{{$produk->kode_barang}}</td>
                    </tr>-->
                    <tr>
                      <td>Berat</td>
                      <td>{{$produk->berat}} kg</td>
                    </tr>
                    <tr>
                      <td>Stok</td>
                      <td>{{$produk->stok}}</td>
                    </tr>
                    <tr>
                      <td>Harga</td>
                      <td>Rp {{number_format($produk->harga, 0, ',', '.')}}</td>
                    </tr>
                    <tr>
                      <td>Diskon</td>
                      <td>@if($produk->diskon!=null) {{$produk->diskon}}% @endif
                          @if($produk->status_diskon==0)
                            <button type="button" class="btn btn-sm btn-danger ml-2" name="button">Tidak Aktif</button>
                          @else
                            <button type="button" class="btn btn-sm btn-success ml-2" name="button">Aktif</button>
                          @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Status Produk</td>
                      <td>
                          @if($produk->status_produk==0)
                            <button type="button" class="btn btn-sm btn-danger" name="button">Tidak Aktif</button>
                          @else
                            <button type="button" class="btn btn-sm btn-success" name="button">Aktif</button>
                          @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <form id="tambah_keranjang" action="{{ route('public.produk.tambah-keranjang') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="number mx-md-4">
                  <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                	<input type="number" name="jumlah_item" value="1"/>
                	<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
              </div>
              <div class="mt-md-3 mx-md-4">
                <input type="hidden" name="id_produk" value="{{$produk->id}}">
                <button type="submit" class="btn background-color-jameela text-white btn-sm px-3">Tambahkan ke keranjang</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
$("#produk-nav").addClass("active");
//barcode
JsBarcode("#barcode", "{{$produk->nomor_barcode}}");
// counter
$(document).ready(function() {
    $('.minus').click(function () {
      var $input = $(this).parent().find('input');
      var count = parseInt($input.val()) - 1;
      count = count < 1 ? 1 : count;
      $input.val(count);
      $input.change();
      return false;
    });
    $('.plus').click(function () {
      var $input = $(this).parent().find('input');
      if($input.val() < {{$produk->stok}}){
        $input.val(parseInt($input.val()) + 1);
        $input.change();
      }
      return false;
    });
  });
</script>
@endsection
