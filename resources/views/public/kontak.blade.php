@extends('public.layout.master')
@section('title')
Kontak - Bedug Langgeng
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
  <div class="produk_background_background parallax-window" data-parallax="scroll" data-image-src="{{asset('public_assets/images/cart1.jpg')}}" data-speed="0.8"></div>
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
    <div class="row center_content">
      <div class="col-md-6 col-12">
        <div class="row"
        <a href="https://www.google.co.id/maps/place/BEDUG+LANGGENG+(Rumah+Pemasaran)/@-7.4576177,112.3874811,13z/data=!4m8!1m2!2m1!1sbedug+langgeng!3m4!1s0x2e781232017a9693:0x96c6d64d0dd5356a!8m2!3d-7.457398!4d112.3874779"><img src="{{asset('image/maps1.png')}}" style="height:400px;"></a>
      </div>
      </div>

      <div class="col-md-6 col-12">
        <a href="https://www.google.co.id/maps/place/Bedug+Langgeng+(Bengkel+Bedug)/@-7.4555199,112.3611987,15z/data=!4m8!1m2!2m1!1sbedug+langgeng!3m4!1s0x0:0xb0b3d93201eb6d50!8m2!3d-7.4536455!4d112.3524249"><img src="{{asset('image/maps2.png')}}" style="height:400px;"></a>
      </div>
      <div class="col-md-6 col-12">
        <p class="ml-0">Alamat Rumah Pemasaran : 
            <br>Jl. Raya Gempolkerep 183 Gedeg - Mojokerto JAWA TIMUR </p>

        <p class="ml-0">Alamat Bengkel Kerja :
            <br>Jl. Raya Kedungsari (Simpang Tiga) Kec. Kemlagi - Mojokerto.
            <br>(Jalur Mojokerto Menuju Ploso JOMBANG) JAWA TIMUR </p>
        <a href="https://api.whatsapp.com/send?phone=628563071834&text=Hai%20admin%20Bedug%20Langgeng" class="btn btn-success background-color-jameela phone-button"><i class="fa fa-phone mr-2" aria-hidden="true"></i> Hubungi Kami</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
