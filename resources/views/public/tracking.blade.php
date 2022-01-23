@extends('public.layout.master')
@section('title')
Tracking - Bedug Langgeng
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
  <div class="produk_background_background parallax-window" data-parallax="scroll" data-image-src="{{asset('public_assets/images/cart4.jpg')}}" data-speed="0.8"></div>
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
          <h2>Tracking Status Pengiriman</h2>
          <div>Cari Kabar Pemesanan Disini</div>
        </div>
      </div>
    </div>
     <div class="row filtering_row">
      <div class="col">
        <form action="{{ url()->current() }}">
        <div class="row justify-content-center sorting_group_1 w-100">
          <ul class="item_sorting">
            <li>
                <input type="search" name="search" class="search_input_order ctrl_class" required="required" placeholder="Masukkan Nama Pemesan">
            </li>
             <li>
              <button class="btn background-color-jameela text-white rounded-0" type="submit" style="font-size: 14px; cursor:pointer;"> Cari</button>
            </li>
          </ul>
        </div>
            <div class="table-responsive">
              <table class="table">
                <thead class="text-success">
                  <th>
                    No
                  </th>
                  <th>
                    Nama Pemesan
                  </th>
                  <th>
                    Tanggal Pemesanan
                  </th>
                  <th>
                    Status Pemesanan
                  </th>
                </thead>
                <tbody>
                  @for($i=0;$i<count($order);$i++)
                    <tr>
                      <td>{{$i+1}}</td>
                      <td>{{$order[$i]->customer->nama_customer}}</td>
                      <td>{{date_format($order[$i]->created_at,"d F Y H:i")}}</td>
                      @if($order[$i]->status==0)
                      <td><button class="btn btn-sm btn-danger">Sedang di Proses....</button></td>
                      @elseif($order[$i]->status==1)
                      <td><button class="btn btn-sm btn-danger">Dalam Pengiriman</button></td>
                      @else
                      <td><button class="btn btn-sm btn-success">Selesai</button></td>
                      @endif
                  @endfor
                    </tr>
                  </tbody>
                </table>
              </div>
        </form>
      </div>
      </div>
      </div>
    </div>


              



            
@endsection
@section('script')
@endsection
