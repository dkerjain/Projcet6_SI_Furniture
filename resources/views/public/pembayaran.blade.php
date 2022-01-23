@extends('public.layout.master')
@section('title')
@endsection
@section('style')
<style>
.number{
  margin-top: 0px;
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
.image-produk{
  object-fit: cover;
  object-position: 100% 0;
  height: 300px;
  width: 250px;
}
.deskripsi-produk{
  font-size: 16px;
}
.judul-produk{
  font-size: 24px;
}
@media only screen and (max-width: 400px)
{
  .image-produk{
    height: 200px;
    width: 150px;
  }
  .deskripsi-produk{
    font-size: 12px;
  }
  .judul-produk{
    font-size: 16px;
  }
  .minus, .plus{
    width:28px;
    height:28px;
    padding:3px 3px 3px 3px;
  }
  .minus i, .plus i{
    font-size: 12px;
  }
  .number input{
    height:28px;
    width: 80px;
    font-size: 16px;
  }
}
</style>
@endsection
@section('content')
<div class="produk_background">
  <div class="produk_background_background parallax-window" data-parallax="scroll" data-image-src="{{asset('public_assets/images/cart.jpg')}}" data-speed="0.8"></div>
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
      <div class="col">
        <div class="section_title text-center">
          <h2>Form Pembayaran</h2>
          <div>Transfer ke BRI 123456789 A.N Budi Nur Cahyo 
            <br>BNI 123456789 A.N Budi Nur Cahyo </div>

        </div>
      </div>
    </div>
    <div class="top_content">
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
        <i class="fa fa-times text-danger"></i>
        <span data-notify="message">{{ $message }}</span>
      </div>
      </div>
      @endif

       <div class="row container mt-md-5 mx-md-5 pr-md-5">
         @for($i=0;$i<count($order->orderList);$i++)
       <div id="produk{{$i}}" class="row mb-3 mx-md-5 px-md-5">
          <div class="col-5">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @for($j=0;$j<count($order->orderList[$i]->produk->picture);$j++)
                <div class="carousel-item @if($j==0) active @endif">
                  <img class="image-produk" src="{{url($order->orderList[$i]->produk->picture[$j]->url_photo)}}" alt="">
                </div>
                @endfor
              </div>
            </div>
          </div>
          <div class="col-7">
            <h3 class="judul-produk color-jameela mt-md-3">{{$order->orderList[$i]->produk->nama_produk}}</h3>
            <p class="deskripsi-produk mb-2">{{$order->orderList[$i]->produk->keterangan}}</p>
            @if($order->orderList[$i]->produk->status_diskon==1)
            <p class="deskripsi-produk mb-0"> Harga Satuan : Rp <span style="text-decoration: line-through;">{{$order->orderList[$i]->produk->harga}}</span> {{$order->orderList[$i]->produk->harga - ($order->orderList[$i]->produk->harga*$order->orderList[$i]->produk->diskon/100)}}</p>
            @else
            <p class="deskripsi-produk mb-0"> Harga Satuan : Rp {{$order->orderList[$i]->produk->harga}}</p>
            @endif
            <div class="number">
              @if($order->orderList[$i]->produk->status_diskon==1)
              <p id="subtotal{{$i}}" class="deskripsi-produk">Subtotal : Rp {{($order->orderList[$i]->produk->harga - ($order->orderList[$i]->produk->harga*$order->orderList[$i]->produk->diskon/100)) * $order->orderList[$i]->jumlah}}</p>
              @else
              <p id="subtotal{{$i}}" class="deskripsi-produk">Subtotal : Rp {{$order->orderList[$i]->produk->harga * $order->orderList[$i]->jumlah}}</p>
              @endif


            </div>
            <input type="hidden" name="id_produk[]" value="{{$order->orderList[$i]->produk->id}}">
          </div>
       </div>
       @endfor
          <div class="col-12 mt-3">


          <div class="form-group">
          <div class="col-md-3 col-12">
            @if($order->pembayaran->status_pembayaran==0)
            <a href="{{route('public.pembayaran.downloadnota',['id'=>$order->id])}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2"></i>Download Invoice</a>
            @else
            <a href="{{route('public.pembayaran.downloadnota',['id'=>$order->id])}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2"></i>Download Nota</a>
            @endif
          </div>
          <form id="tambah_produk" action="{{ route('public.pembayaran.store',['id'=>$order->id]) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          @if($order->pembayaran->status_pembayaran==0)
         <div class="col-12 mt-3">
          <div class="form-group">
              <label>Sub Total Produk <span class="text-success">*</span></label> 
              <input disabled type="text" class="form-control" value="{{$order->biaya_total_produk}}" name="biaya_pengiriman">
            </div>
          <div class="form-group">
              <label>Biaya Pengiriman <span class="text-success">*</span></label> 
              <input disabled type="text" class="form-control" value="{{$order->biaya_pengiriman}}" name="biaya_pengiriman">
            </div>
          <div class="form-group">
              <label>Biaya Total <span class="text-success">*</span></label> 
              <input disabled type="text" class="form-control" value="{{$order->biaya_total_produk+$order->biaya_pengiriman}}" name="nama_customer"">
            </div>
            <div class="form-group">
              <label>Nama Pemesan <span class="text-success">*</span></label> 
              <input disabled type="text" class="form-control" value="{{$order->customer->nama_customer}}" name="nama_customer">
            </div>
            <div class="form-group">
              <label>Bank Pengirim <span class="text-success">*</span></label>
              <input type="text" class="form-control" placeholder="contoh : BRI" name="bank_pembayaran" >
            </div>
            <div class="col-12 col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <p class="mb-0 font-weight-normal">Bukti Transfer</p>
                  <div class="multi-field-wrapper">
                    <div class="multi-fields">
                      <div class="multi-field">
                        <div class="card bg-success">
                          <div class="card-body">
                            <div class="input-group">
                              <div class="custom-file mt-2">
                                <input type="file" name="image[]" class="custom-file-input">
                                <label class="custom-file-label text-light">Klik untuk tambah foto</label>
                              </div>
                              <div class="input-group-append">
                                <button class="btn btn-danger remove-field" type="button">Hapus</button>
                              </div>
                            </div>
                            <img src="#" class="d-none" style="max-width:100%" />
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
         <div class="col-12 d-flex justify-content-center mt-3">
           <button class="btn btn-success" data-toggle="modal" data-target="#modalSaya" type="button" name="button">Lakukan Proses Pembayaran</button>
       </div>
       <!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSayaLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        Apakah data yang dikirim sudah benar??
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Oke</button>
      </div>
    </div>
  </div>
</div>
       @endif
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $("#produk").addClass("active");
    //buat upload file dokumen
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

      readURL(this);
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            console.log(e.target.result);
            $(input).parent('.custom-file').parent('.input-group').parent('.card-body').find('img').attr('src', e.target.result);
            $(input).parent('.custom-file').parent('.input-group').parent('.card-body').find('img').attr('class','');
          }
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }
    });
    // buat populate input Tag
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        // untuk dokumen
        $(".add-field", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            $('.multi-field:last-child',$wrapper).find('label').html('Klik untuk tambah foto');
            $('.multi-field:last-child',$wrapper).find('img').attr('src','');
            $('.multi-field:last-child',$wrapper).find('img').attr('class','d-none');
        });
        $('.input-group-append .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.input-group-append').parent('.input-group').parent('.card-body').parent('.card').parent('.multi-field').remove();
        });
    });
    document.getElementById('get_photo').onclick = function() {
      document.getElementById('my_photo').click();
    };
</script>
@endsection
