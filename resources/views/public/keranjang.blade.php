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
          <h2>Keranjang</h2>
          <div>Berikut adalah produk terbaik yang anda pilih</div>
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
      <form id="buat_nota" action="{{route('public.checkout')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <p id="teks_keranjang_kosong" class="d-none text-center text-secondary">Belum ada item dalam keranjang</p>
      @for($i=0;$i<count($produk);$i++)
       <div id="produk{{$i}}" class="row mb-3 mx-md-5 px-md-5">
          <div class="col-5">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @for($j=0;$j<count($produk[$i]->picture);$j++)
                <div class="carousel-item @if($j==0) active @endif">
                  <img class="image-produk" src="{{$produk[$i]->picture[$j]->url_photo}}" alt="">
                </div>
                @endfor
              </div>
            </div>
          </div>
          <div class="col-7">
            <h3 class="judul-produk color-jameela mt-md-3">{{$produk[$i]->nama_produk}}</h3>
            <p class="deskripsi-produk mb-2">{{$produk[$i]->keterangan}}</p>
            @if($produk[$i]->status_diskon==1)
            <p class="deskripsi-produk mb-0"> Harga Satuan : Rp <span style="text-decoration: line-through;">{{$produk[$i]->harga}}</span> {{$produk[$i]->harga - ($produk[$i]->harga*$produk[$i]->diskon/100)}}</p>
            @else
            <p class="deskripsi-produk mb-0"> Harga Satuan : Rp {{$produk[$i]->harga}}</p>
            @endif
            <div class="number">
              @if($produk[$i]->status_diskon==1)
              <p id="subtotal{{$i}}" class="deskripsi-produk">Subtotal : Rp {{($produk[$i]->harga - ($produk[$i]->harga*$produk[$i]->diskon/100)) * $cart[$i]['quantity']}}</p>
              @else
              <p id="subtotal{{$i}}" class="deskripsi-produk">Subtotal : Rp {{$produk[$i]->harga * $cart[$i]['quantity']}}</p>
              @endif
            	<span class="minus" onclick="kurangProduk({{$i}})"><i class="fa fa-minus" aria-hidden="true"></i></span>
            	<input type="number" value="{{$cart[$i]['quantity']}}" name="jumlah_pembelian[]" max="{{$produk[$i]->stok}}"/>
            	<span class="plus" onclick="tambahProduk({{$i}})"><i class="fa fa-plus" aria-hidden="true"></i></span>
              <div class="mt-md-3">
                <a id="hapus_item{{$i}}" href="{{route('public.hapus-session',['id'=>$i])}}" class="btn btn-danger text-white btn-sm px-3 mt-2">Hapus dari keranjang</a>
              </div>
            </div>
            <input type="hidden" name="id_produk[]" value="{{$produk[$i]->id}}">
          </div>
       </div>
       @endfor
       <div class="row container mt-md-5 mx-md-5 pr-md-5">
         <div class="col-12">
           <h3 class="color-jameela">Data Pemesan</h3>
         </div>
         <div class="col-12 mt-3">
            <div class="form-group">
              <label>Nama Pemesan <span class="text-success">*</span></label>
              <input type="text" class="form-control" placeholder="contoh : Annisa Putri Karlina" name="nama_customer" value="{{ old('nama_customer') }}">
            </div>
            <div class="form-group">
              <label>Alamat <span class="text-success">*</span></label>
              <input type="text" class="form-control" placeholder="contoh : Dsn Ngudikidul 614" name="alamat" value="{{ old('alamat') }}">
            </div>
           
             <div class="form-group">
              <label for="exampleFormControlSelect1">Provinsi</label>
                <select class="form-control" id="provinsi" name="provinsi">
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Kota</label>
                <select class="form-control" id="kota" name="kota">
              </select>
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlSelect1">Kecamatan</label>
                <select class="form-control" id="kecamatan" name="kecamatan">
              </select>
            </div>
             <div class="form-group">
              <label for="exampleFormControlSelect1">Kelurahan - Kode Pos</label>
                <select class="form-control" id="kelurahan" name="kelurahan">
              </select>
            </div>
           {{--  <div class="form-group">
              <label>Kode Pos <span class="text-success">*</span></label>
              <input type="text" class="form-control" placeholder="contoh : 61351" name="kode_pos" value="{{ old('kode_pos') }}">
            </div> --}}
            <div class="form-group">
              <label>Nomor Telepon (Whatsapp) <span class="text-success">*</span></label>
              <input type="text" class="form-control" placeholder="contoh : 085804997774" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="contoh : Annisa.putri.karlina@gmail.com" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <label>Catatan</label>
              <input type="text" class="form-control" placeholder="contoh : Kirim saat jam kantor" name="catatan" value="{{ old('catatan') }}">
            </div>
              <input type="hidden"  name="biaya_pengiriman" value="0">
            <div class="form-group">
              <label>Jasa Kurir <span class="text-success">*</span></label>
              <br> Jika diambil sendiri maka biaya pengiriman Rp. 0
              <br> Jika diserahkan kepada Bedug Langgeng akan dikenakan biaya. Yang akan kami infokan melalui invoice. <br> <br>
              
      
              <select class="form-control" name="jasa_kurir" data-style="btn btn-link" name="jasa_kurir" value="{{ old('jasa_kurir') }}" required>
                <option value="0">Bedug Langgeng</option>
                <option value="1">Sendiri</option>
              </select>
                
            </div>
            <div class="form-group">
              <label>Berat Total (kg)<span class="text-success">*</span></label>
              <input id="berat_total" type="number" name="berat_total" class="form-control text-secondary" readonly>
            </div>
            <div class="form-group">
              <label>Biaya Total <span class="text-success">*</span></label>
              <input id="total_biaya_produk" type="text" name="biaya_total_produk" class="form-control text-secondary" readonly>
            </div>
         </div>
         <div class="col-12 d-flex justify-content-center mt-3">
           <button class="btn btn-success" data-toggle="modal" data-target="#modalSaya" type="button" name="button">Lakukan Proses Pembelian</button>
         </div>
          <!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSayaLabel">Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah data yang dikirim sudah benar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Oke</button>
      </div>
    </div>
  </div>
</div>
       </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
$("#keranjang-nav").addClass("active");
// definisi variabel
var stok = [
  @for($i=0;$i<count($produk);$i++)
  {{$produk[$i]->stok}},
  @endfor
];
var jumlah_item = [
  @for($i=0;$i<count($produk);$i++)
  {{$cart[$i]['quantity']}},
  @endfor
];
var harga_item = [
  @for($i=0;$i<count($produk);$i++)
  {{$produk[$i]->harga - ($produk[$i]->harga*$produk[$i]->diskon/100)}},
  @endfor
];
var berat_item = [
  @for($i=0;$i<count($produk);$i++)
  {{$produk[$i]->berat}},
  @endfor
];
var subtotal = [
  @for($i=0;$i<count($produk);$i++)
  {{$produk[$i]->harga - ($produk[$i]->harga*$produk[$i]->diskon/100)}},
  @endfor
];
var produk = {{count($produk)}};

cekTotalProduk();
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
      if($input.val() < $input.attr('max')){
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        cekTotalProduk();
      }
      return false;
    });
  });
  //fungsi tambahProduk
  function tambahProduk(index){
    if(jumlah_item[index] < stok[index]){
      jumlah_item[index]++;
      ubahSubtotal(index);
      cekTotalProduk();
    }
  }
  //fungsi kurangProduk
  function kurangProduk(index){
    if(jumlah_item[index] > 1){
      jumlah_item[index]--;
      ubahSubtotal(index);
      cekTotalProduk();
    }
  }
  // fungsi ubah Subtotal
  function ubahSubtotal(index){
    subtotal[index] = harga_item[index]*jumlah_item[index];
    console.log(subtotal[index]);
    $('#subtotal'+index).html('Subtotal Rp '+subtotal[index]);
  }
  // fungsi cek total produk
  function cekTotalProduk(){
    if(produk==0){
      $('#teks_keranjang_kosong').removeClass('d-none');
    }else{
      berat_total = 0;
      total_biaya_produk = 0;
      for (var i = 0; i < jumlah_item.length; i++) {
        berat_total = berat_total + (jumlah_item[i]*berat_item[i]);
        total_biaya_produk = total_biaya_produk + subtotal[i];
      }
      $('#berat_total').val(berat_total);
      $('#total_biaya_produk').val(total_biaya_produk);
    }
  }

  $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/provinsi",
      cache: false,
      success: function(data){
        var province = "";
        for (var i = 0; i < data.provinsi.length; i++) {
        province=province+'<option value="'+data.provinsi[i]['ID_PROVINSI']+'">'+data.provinsi[i]['NAMA_PROVINSI']+'</option>';
        }
       console.log(data);
      $("#provinsi").append(province);

      }
  });
  $('#kota').html("<option selected disabled>--- Pilih provinsi terlebih dahulu ---</option>");
    $('#kecamatan').html("<option selected disabled>--- Pilih kota terlebih dahulu ---</option>");
    $('#kelurahan').html("<option selected disabled>--- Pilih kecamatan terlebih dahulu ---</option>");
   
   //ambil kota berdasarkan provinsi yang dipilih
    $('#provinsi').change(function(){
    $('#provinsi_input').val($('#provinsi option:selected').html());
    $('#kota').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
    var province_id = $(this).val();
    console.log(province_id);
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/kota/"+province_id,
      cache: false,
      success: function(data){
        var city = "";
        for (var i = 0; i < data.kota.length; i++) {
        city = city+'<option value="'+data.kota[i]['ID_KOTA']+'">'+data.kota[i]['NAMA_KOTA']+'</option>';
        }
       console.log(data);
       $("#kota").append(city);
      }
  });
});

     //ambil kecamatan berdasarkan provinsi yang dipilih
    $('#kota').change(function(){
    $('#kota_input').val($('#provinsi option:selected').html());
    $('#kecamatan').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
    var city_id = $(this).val();
    console.log(city_id);
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/kecamatan/"+city_id,
      cache: false,
      success: function(data){
        var kec = "";
        for (var i = 0; i < data.kecamatan.length; i++) {
        kec = kec+'<option value="'+data.kecamatan[i]['ID_KECAMATAN']+'">'+data.kecamatan[i]['NAMA_KECAMATAN']+'</option>';
        }
       console.log(data);
       $("#kecamatan").append(kec);
      }
  });
});

     //ambil kelurahan berdasarkan provinsi yang dipilih
    $('#kecamatan').change(function(){
    $('#kecamatan_input').val($('#kecamatan option:selected').html());
    $('#kelurahan').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
    var kec_id = $(this).val();
    console.log(kec_id);
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/kelurahan/"+kec_id,
      cache: false,
      success: function(data){
        var kel = "";
        for (var i = 0; i < data.kelurahan.length; i++) {
        kel = kel+'<option value="'+data.kelurahan[i]['ID_KELURAHAN']+'">'+data.kelurahan[i]['NAMA_KELURAHAN']+' - ' +data.kelurahan[i]['KODEPOS']+'</option>';
        }
       console.log(data);
       $("#kelurahan").append(kel);
      }
    });
  });
</script>
@endsection


