@extends('public.layout.master')
@section('title')
Kontak - DOMUS
@endsection
@section('style')
<style>
  .phone-button{
    border-radius: 45px;
    padding-left: 20px;
    padding-right: 20px;
  }
</style>
@endsection
@section('content')
<div class="produk_background">
  <div class="produk_background_background parallax-window" data-parallax="scroll" data-image-src="{{asset('image/carousel/carousel-3-1.png')}}" data-speed="0.8"></div>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="produk_background_content">
          <div class="produk_background_content_inner">
            <div class="produk_background_title"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="offers">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title text-center">
          <h2>Kontak Kami</h2>
          <div>Hubungi atau kunjungi tempat kami</div>
        </div>
      </div>
    </div>
    <div class="row center_content  mt-5">
        <div class="row">
          <div class="col-md-6 col-12">
            <a href="https://www.google.co.id/maps/place/DOMUS+Furniture+%26+Home+Decor/@-7.2719576,112.7413857,17z/data=!3m1!4b1!4m5!3m4!1s0x2dd7fbdc2700b5a3:0x7974a63354c238c0!8m2!3d-7.2719773!4d112.7435658?hl=en-id"><img src="{{asset('image/domus.jpg')}}" style="height:400px;"></a>
          </div>
          <div class="col-md-6 col-12 mt-10">
            <p class="mt-10"><br><br><br>Alamat  :
                <br>Jl. Sono Kembang No.1, Embong Kaliasin, Kec. Genteng - Surabaya JAWA TIMUR 
                <br>60271</p>
            <a href="#" class="btn btn-success background-color-jameela phone-button"><i class="fa fa-phone mr-2" aria-hidden="true"></i> Hubungi Kami</a>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
