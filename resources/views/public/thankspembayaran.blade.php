@extends('public.layout.master')
@section('title')
@endsection
@section('style')
@endsection
@section('content')
<div class="home">
  <div class="home_background" style="background-image:url({{asset('public_assets/images/cart.jpg')}})"></div>
  <div class="home_content">
    <div class="home_content_inner">
      <div class="home_text_large">Thanks</div>
      <div class="home_text_small" style="font-size:32px;">Terima Kasih Telah Melakukan Pembayaran
        <br>Tunggu konfirmasi Tim Kami Untuk Memvalidasi Pembayaran

      </div>
    </div>
     <div class="col-12 mt-3">
          <div class="form-group">
          <div class="col-md-3 col-12">
            <div class="center">
            @if($order->pembayaran->status_pembayaran==0)
            <a href="{{route('public.pembayaran.downloadnota',['id'=>$order->id])}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2"></i>Download Invoice</a>
            @else
            <a href="{{route('public.pembayaran.downloadnota',['id'=>$order->id])}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2"></i>Download Nota</a>
            @endif
          </div>
        </div>
        </div>
      </div>
  </div>
</div>




@endsection
@section('script')
@endsection
