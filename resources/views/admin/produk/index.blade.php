@extends('admin.layout.master')
@section('title') Produk @endsection
@section('style')
<style>

</style>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-9 col-12">
            <h4 class="my-1 text-success font-weight-bold">Daftar Produk</h4>
            <p class="my-1">Berikut adalah daftar produk yang tersedia pada Bedug Langgeng</p>
          </div>
          <div class="col-md-3 col-12">
            <a href="{{route('admin.produk.create')}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2">add_circle</i>Tambah Produk</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
  <div class="col-12">
  <div class="alert alert-success alert-with-icon" data-notify="container">
    <i class="material-icons" data-notify="icon">check_circle</i>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span data-notify="message">{{ $message }}</span>
  </div>
  </div>
  @endif
  @if ($message = Session::get('error'))
  <!--<div class="col-12">
  <div class="alert alert-danger alert-with-icon" data-notify="container">
    <i class="material-icons" data-notify="icon">cancel</i>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span data-notify="message">{{ $message }}</span>
  </div>
  </div>-->
  @endif
  <!-- search -->
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text padding-src">
              <i class="material-icons">search</i>
            </span>
          </div>
          <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari...">
        </div>
      </div>
    </div>
  </div>
  @if(count($produk)==0)
    <div class="col-12">
    <div class="alert alert-success alert-with-icon" data-notify="container">
      <i class="material-icons" data-notify="icon">cancel</i>
      <span data-notify="message">Belum ada list produk tersedia</span>
    </div>
    </div>
  @endif
  @for($i=0;$i<count($produk);$i++)
  <div class="col-md-3">
    <div class="card card-chart">
      <div class="card-header card-header-success p-0">
        <div id="carouselExampleIndicators{{$i}}" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @for($j=0;$j<count($produk[$i]->picture);$j++)
            <li data-target="#carouselExampleIndicators{{$i}}" data-slide-to="{{$j}}" @if($j==0) class="active" @endif></li>
            @endfor
          </ol>
          <div class="carousel-inner">
            @for($j=0;$j<count($produk[$i]->picture);$j++)
            <div class="carousel-item @if($j==0) active @endif">
              <img class="d-block w-100" src="{{asset($produk[$i]->picture[$j]->url_photo)}}" alt="First slide" style="object-fit: cover; object-position: 100% 0; height: 210px;">
            </div>
            @endfor
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators{{$i}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators{{$i}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <a href="{{route('admin.produk.show',['id'=>$produk[$i]->id])}}">
        <div class="card-body">
          <h4 class="card-title">{{$produk[$i]->nama_produk}}</h4>
          <p class="card-category">Kode Barang : {{$produk[$i]->kode_barang}}</p>
          <p class="card-category">Stok : {{$produk[$i]->stok}}</p>
          <p class="card-category font-italic">Klik untuk melihat detail produk</p>
        </div>
      </a>
      <div class="card-footer">
        <div class="pull-right">
          <a href="{{route('admin.produk.edit',['id'=>$produk[$i]->id])}}" class="text-primary"><i class="material-icons">edit</i></a>
          <!--<a href="#" class="text-danger" data-toggle="modal" data-target="#delete{{$i}}"><i class="material-icons">close</i></a> -->
                    
        </div>
        <!-- modal hapus -->
        <div class="modal fade" id="delete{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row mb-3">
                  <div class="col-md-8 col-8">
                    <h5 class="modal-title mt-2">Hapus Produk</h5>
                  </div>
                  <div class="col-md-4 col-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <form id="deleteproduk{{$i}}" action="{{ route('admin.produk.destroy',['id'=>$produk[$i]->id]) }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <p class="mb-1">Apakah anda yakin menghapus produk <b>{{$produk[$i]->nama_produk}}</b>?</p>
                  </form>
                  </div>
                </div>
                <div align="right">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" form="deleteproduk{{$i}}" class="btn btn-danger">Hapus</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endfor
</div>
@endsection
@section('script')
<script>
  $("#produk").addClass("active");
</script>
@endsection
