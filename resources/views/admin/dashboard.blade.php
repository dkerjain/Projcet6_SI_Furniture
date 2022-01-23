@extends('admin.layout.master')
@section('title') Dashboard @endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-12">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">store</i>
            </div>
            <p class="card-category">Nilai Transaksi Bulanan</p>
            <h3 class="card-title"> Rp  {{ number_format($nilai_transaksi, 0, ',', '.') }} </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
             
              <a href="{{route('admin.penjualan.laporan')}}">Klik disini untuk melihat laporan Bulan {{date('F Y')}} </a> 
              
              <br>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">store</i>
            </div>
            <p class="card-category">Item Terjual Bulan Ini</p>
            <h3 class="card-title">{{$item_terjual}} Buah</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Bulan {{date('F Y')}}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">warning</i>
            </div>
            <p class="card-category">Nota yang belum ditindak</p>
            <h3 class="card-title">{{count($order_belum_ditindak)}} Nota</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{route('admin.order')}}">Klik disini untuk melihat list nota</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- stok produk yang hampir habis -->
      <div class="col-12">
        <div class="card card-chart">
          <div class="card-header card-header-success">
            <h5 class="card-title ">Stok Produk Yang Hampir Habis</h5>
          </div>
          <div class="card-body">
            @if(count($produk)!=0)
            <table class="table">
              <thead class="text-success">
                <th style="width:20%">Kode Barang</th>
                <th>Nama Produk</th>
                <th>Stok Tersisa</th>
              </thead>
              <tbody>
                @for($i=0;$i<count($produk);$i++)
                <tr>
                  <td>{{$produk[$i]->kode_barang}}</td>
                  <td><a href="{{route('admin.produk.show',['id'=>$produk[$i]->id])}}">{{$produk[$i]->nama_produk}}</a></td>
                  <td>{{$produk[$i]->stok}}</td>
                </tr>
                @endfor
              </tbody>
            </table>
            @else
            <div class="text-center">
              <p>Tidak ada produk dengan stok hampir habis (kurang dari 3 buah)</p>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $("#dashboard").addClass("active");
</script>
@endsection
