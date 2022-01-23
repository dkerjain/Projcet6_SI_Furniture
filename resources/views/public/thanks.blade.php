@extends('public.layout.master')
@section('title')
@endsection
@section('style')
@endsection
@section('content')
<div class="home">
  <div class="home_background" style="background-image:url({{asset('image/carousel/carousel-3.jpg')}})"></div>
  <div class="home_content">
    <div class="home_content_inner">
      <div class="home_text_large">Thanks</div>
      <div class="home_text_small" style="font-size:32px;">Terima Kasih Telah Melakukan Pembelian
        <br>Tunggu konfirmasi Tim Kami Melalui Whatsapp untuk pembayaran
        <br>Id Nota : {{$order->id}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection
