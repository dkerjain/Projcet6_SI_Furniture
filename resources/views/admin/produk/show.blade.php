@extends('admin.layout.master')
@section('title') Produk @endsection
@section('style')
<style>
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-0">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-1 col-2 pt-1">
            <a href="{{route('admin.produk')}}">
              <i class="material-icons text-success">arrow_back</i>
            </a>
          </div>
          <div class="col-md-11 col-10 no-padding">
            <h4 class="my-1 text-success font-weight-bold">Detail Produk</h4>
            <p class="my-1">Berikut adalah detail produk {{$produk->nama_produk}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 col-12">
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
            <div class="mt-2" align="center">
              <svg id="barcode"></svg>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="my-5 mx-md-4">
              <h3 class="pt-md-4 font-weight-bold text-success">{{$produk->nama_produk}}</h3>
              <h5 style="white-space: pre-wrap;">{{$produk->keterangan}}</h5>
            </div>
            <div class="mx-md-4 w-50">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><h5>Detail Barang</h5></td>
                    </tr>
                    <tr>
                      <td>Ukiran</td>
                      <td>{{$produk->ukiran->nama_ukiran}}</td>
                    </tr>
                    <tr>
                      <td>Kategori</td>
                      <td>{{$produk->kategori->nama_kategori}}</td>
                    </tr>
                    <tr>
                      <td>Kode Barang</td>
                      <td>{{$produk->kode_barang}}</td>
                    </tr>
                    <tr>
                      <td>Nomor Barcode</td>
                      <td>{{$produk->nomor_barcode}} @if($produk->nomor_barcode==null) Tidak ada nomor barcode @endif</td>
                    </tr>
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
                      <td>Rp {{$produk->harga}}</td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $("#produk").addClass("active");
    //barcode
    JsBarcode("#barcode", "{{$produk->nomor_barcode}}");
</script>
@endsection
