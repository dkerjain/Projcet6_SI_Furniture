@extends('admin.layout.master')
@section('title') Produk @endsection
@section('style')
<style>
  .font-kurir{
    font-size: 18px;
  }
</style>
@endsection
@section('content')
<div class="row">
  <div class="col-12 mb-0">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-1 col-2 pt-1">
            <a href="{{route('admin.order')}}">
              <i class="material-icons text-success">arrow_back</i>
            </a>
          </div>
          <div class="col-md-11 col-10 no-padding">
            <h4 class="my-1 text-success font-weight-bold">Edit Nota Pemesanan</h4>
            <p class="my-1">Ubah form berikut untuk memperbarui nota pemesanan produk</p>
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
  <div class="col-12">
  <div class="alert alert-danger alert-with-icon" data-notify="container">
    <i class="material-icons" data-notify="icon">cancel</i>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span data-notify="message">{{ $message }}</span>
  </div>
  </div>
  @endif
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
          <div class="row mx-md-2 my-md-3">
            <div class="col-12 mb-2">
              <p class="mb-1 font-weight-normal">Langkah 1</p>
              <h4 class="text-success font-weight-bold">Cari Produk</h4>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text padding-src">
                    <a onclick="getProduk()"><i class="material-icons">search</i></a>
                  </span>
                </div>
                <input type="text" class="form-control" id="keyProduk" placeholder="Masukkan Kode Barang / Nomor Barcode">
              </div>
            </div>
            <div id="message" class="col-12"></div>
            <form id="update_nota" class="col-12" action="{{ route('admin.order.update',['id'=>$order->id]) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="col-12">
              <div id="produk_detail" class="row">
                @for($i=0;$i<count($order->orderList);$i++)
                <div id="produk{{$i}}" class="col-md-3 col-12">
                  <div class="card card-chart">
                    <div class="card-header card-header-success p-0">
                      <div id="carouselExampleIndicators{{$i}}" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          @for($j=0;$j<count($order->orderList[$i]->produk->picture);$j++)
                            @if($j==0)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$j}}" class="active"></li>
                            @else
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$j}}" class=""></li>
                            @endif
                          @endfor
                        </ol>
                        <div class="carousel-inner">
                          @for($j=0;$j<count($order->orderList[$i]->produk->picture);$j++)
                            @if($j==0)
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="{{asset($order->orderList[$i]->produk->picture[$j]->url_photo)}}" alt="First slide" style="object-fit: cover; object-position: 100% 0; height: 210px;">
                            </div>
                            @else
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{asset($order->orderList[$i]->produk->picture[$j]->url_photo)}}" alt="First slide" style="object-fit: cover; object-position: 100% 0; height: 210px;">
                            </div>
                            @endif
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
                      <div class="card-body">
                        <h4 class="card-title font-weight-normal text-success"> {{$order->orderList[$i]->produk->nama_produk}} </h4>
                        <p class="card-category font-weight-normal">Kode Barang :  {{$order->orderList[$i]->produk->kode_barang}} </p>
                        <p class="card-category font-weight-normal">Stok :  {{$order->orderList[$i]->produk->stok}} </p>
                        <p class="card-category font-weight-normal">Berat : @ {{$order->orderList[$i]->produk->berat}}  kg</p>
                        @if($order->orderList[$i]->produk->diskon!=null)
                        <p class="card-category font-weight-normal">Harga : Rp  {{$order->orderList[$i]->produk->harga - (($order->orderList[$i]->produk->harga*$order->orderList[$i]->produk->diskon)/100)}} (setelah diskon)</p>
                        <button type="button" class="btn btn-sm btn-success" name="button">Diskon {{$order->orderList[$i]->produk->diskon}}%</button>
                        @else
                        <p class="card-category font-weight-normal">Harga : Rp  {{$order->orderList[$i]->produk->harga}} (setelah diskon)</p>
                        <button type="button" class="btn btn-sm btn-danger" name="button">Tidak Diskon</button>
                        @endif
                        <div class="card my-1 py-0">
                          <div class="card-body rounded bg-success text-light px-2 py-2" style="box-shadow:none;">
                            <div class="form-group mt-0">
                              <p class="mb-0 font-weight-normal">Jumlah Pembelian</p>
                              <input id="jumlah_pembelian{{$i}}" onkeyup="jumlahPembelian({{$i}})" style="color:white !important" type="number" name="jumlah_pembelian[]" class="form-control py-0" step="1" min="0" max="{{$order->orderList[$i]->produk->stok + $order->orderList[$i]->jumlah}}" value="{{$order->orderList[$i]->jumlah}}" required>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id_produk[]" value="{{$order->orderList[$i]->produk->id}}">
                      </div>
                    <div class="card-footer">
                      <div class="pull-right">
                        <a id="hapus_produk{{$i}}" href="#" onclick="hapusProduk({{$i}})" class="text-danger"><i class="material-icons">close</i></a>
                      </div>
                    </div>
                  </div>
                </div>
                @endfor
              </div>
            </div>
            <div id="form" class="col-12 mt-2">
              <p class="mb-1 font-weight-normal">Langkah 2</p>
              <h4 class="text-success font-weight-bold">Lengkapi Form Berikut</h4>
                <div class="row">
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Nama Konsumen <span class="text-success">*</span></p>
                      <input type="text" name="nama_customer" class="form-control" placeholder="contoh : Annisa Putri K" value="{{$order->customer->nama_customer}}" required>
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Alamat <span class="text-success">*</span></p>
                      <input type="text" name="alamat" class="form-control" placeholder="contoh : Jl. Pahlawan No 15" value="{{$order->customer->alamat}}" required>
                    </div>
                  </div>
            <div class="col-md-8 col-12 mb-1">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Provinsi</label>
                <select class="form-control" id="provinsi" name="provinsi">
              </select>
            </div>
          </div>
          <div class="col-md-8 col-12 mb-1">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Kota</label>
                <select class="form-control" id="kota" name="kota">
              </select>
            </div>
            </div>
            <div class="col-md-8 col-12 mb-1">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Kecamatan</label>
                <select class="form-control" id="kecamatan" name="kecamatan">
              </select>
            </div>
          </div>
          <div class="col-md-8 col-12 mb-1">
             <div class="form-group">
              <label for="exampleFormControlSelect1">Kelurahan - Kode Pos</label>
                <select class="form-control" id="kelurahan" name="kelurahan">
              </select>
            </div>
          </div>
                 
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Nomor Telepon <span class="text-success">*</span></p>
                      <input type="text" name="nomor_telepon" class="form-control" placeholder="contoh : 081234567" value="{{$order->customer->nomor_telepon}}" required>
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Email</p>
                      <input type="text" name="email" class="form-control" placeholder="contoh : email@gmail.com" value="{{$order->customer->email}}">
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Catatan</p>
                      <input type="text" name="catatan" class="form-control" value="{{$order->catatan}}">
                    </div>
                  </div>
                    <div class="text-success font-weight-normal font-kurir mb-2">
                      <i class="material-icons mr-2" style="vertical-align:bottom">speed</i>
                      <span id="berat_total">Berat</span>
                    </div>
                    <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Jasa Kurir <span class="text-success">*</span></p>
                      <select class="form-control" name="jasa_kurir" data-style="btn btn-link" required>
                        <option value="0" @if($order->jasa_kurir==0) selected @endif>Bedug Langgeng</option>
                        <option value="1" @if($order->jasa_kurir==1) selected @endif>Sendiri</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Biaya Pengiriman <span class="text-success">*</span></p>
                      <input id="biaya_pengiriman" type="number" name="biaya_pengiriman" class="form-control" placeholder="Jika tidak ada biaya kirim, isi dengan 0" value="{{$order->biaya_pengiriman}}" required>
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Total Biaya</p>
                      <div class="card mt-1 mb-1">
                        <div class="card-body bg-success">
                          <p id="total_biaya" class="font-weight-normal text-light mb-0">Rp {{$order->biaya_total_produk + $order->biaya_pengiriman}}</p>
                        </div>
                      </div>
                      <input id="total_biaya_input" type="hidden" class="form-control" name="biaya_total_produk">
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Status Pembayaran <span class="text-success">*</span></p>
                      <select class="form-control" name="status_pembayaran" data-style="btn btn-link" required>
                        <option value="0" @if($order->pembayaran->status_pembayaran==0) selected @endif>Belum Lunas</option>
                        <option value="1" @if($order->pembayaran->status_pembayaran==1) selected @endif>Lunas</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Bank Pembayaran <span class="text-success">*</span></p>
                      <input type="text" name="bank_pembayaran" class="form-control" value="{{$order->pembayaran->bank_pembayaran}}" >
                    </div>
                  </div>
                  <div class="col-md-8 col-12 mb-1">
                    <div class="form-group">
                      <p class="mb-0 font-weight-normal">Status Tindakan <span class="text-success">*</span></p>
                      <select class="form-control" name="status" data-style="btn btn-link" required>
                        <option value="0" @if($order->status==0) selected @endif>Sedang diProses</option>
                        <option value="1" @if($order->status==1) selected @endif>Dalam Pengiriman</option>
                        <option value="2" @if($order->status==2) selected @endif>Selesai</option>
                      </select>
                    </div>
                    <p class="mt-3"><span class="text-success font-weight-normal">*</span> Wajib diisi</p>
                  </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalSaya" form="update_nota" type="button" method="post">Perbarui Nota Pemesanan</button>
                  </div>
                  <!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSayaLabel">Perbarui Nota Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah sudah mengecek kembali produk yang dibeli customer sebelum disimpan?
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Oke</button>
      </div>
    </div>
  </div>
</div>
                </div>
            </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
    $("#penjualan").addClass("active");

    $("#keyProduk").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
          getProduk()
        }
    });
    // variabel global
    var berat = [
      @for($i=0;$i<count($order->orderList);$i++)
        {{$order->orderList[$i]->produk->berat}},
      @endfor
    ];
    var jumlah_pembelian = [
      @for($i=0;$i<count($order->orderList);$i++)
        {{$order->orderList[$i]->jumlah}},
      @endfor
    ];
    var biaya_produk = [
      @for($i=0;$i<count($order->orderList);$i++)
        @if($order->orderList[$i]->produk->diskon!=null)
        {{$order->orderList[$i]->produk->harga - (($order->orderList[$i]->produk->harga*$order->orderList[$i]->produk->diskon)/100)}},
        @else
        {{$order->orderList[$i]->produk->harga}},
        @endif
      @endfor
    ];
    var id_produk = [
      @for($i=0;$i<count($order->orderList);$i++)
        {{$order->orderList[$i]->produk->id}},
      @endfor
    ];
    var produk = {{count($order->orderList)}};
    // ganti tulisan di estimasi tarif
    $('#kota_input').change(function(){
      var kota = $('#kota_input').val();
      if(kota != null || kota != ''){
        $('#rute').html('Ponorogo ke '+$('#kota_input').val());
      }else{
        $('#rute').html('Pilih kota tujuan');
      }
    });
    //mengganti jumlah pembelian
    function jumlahPembelian(index){
      var jumlah_pembelian_get = $('#jumlah_pembelian'+index).val();
      if(jumlah_pembelian_get >= 0){
        jumlah_pembelian[index] = jumlah_pembelian_get;
      }
      hitungBerat();
      biayaTotal();
    }
    // menghitung total berat
    function hitungBerat(){
      if(berat.length!=0){
        var berat_total = 0;
        for (var i = 0; i < berat.length; i++) {
          berat_total = berat_total+ (berat[i]*jumlah_pembelian[i]);
        }
        $('#berat_total').html('Berat total '+berat_total+' gram');
      }
    }
    // hapus produk
    function hapusProduk(index){
      //hapus berat
      berat.splice(index, 1);
      biaya_produk.splice(index,1);
      jumlah_pembelian.splice(index,1);
      $('#produk'+index).remove();
      if(produk >= 1){
        for (var i = index+1; i < produk; i++) {
          $('#produk'+i).attr('id','produk'+(i-1));
          $('#hapus_produk'+i).attr('onclick','hapusProduk('+(i-1)+')');
          $('#hapus_produk'+i).attr('id','hapus_produk'+(i-1));
          $('#jumlah_pembelian'+i).attr('onkeyup','jumlahPembelian('+(i-1)+')');
          $('#jumlah_pembelian'+i).attr('id','jumlah_pembelian'+(i-1));
        }
      }
      produk = produk - 1;
      if(produk==0){
        $('#form').addClass('d-none')
      }
      hitungBerat();
      biayaTotal();
    }
    //trigger jika biaya pengiriman diisi
    $('#biaya_pengiriman').on('keyup',function(){
      biayaTotal();
    });
    //menghitung biaya total
    function biayaTotal(){
      var biaya_total_produk = 0;
      var biaya_pengiriman = parseInt($('#biaya_pengiriman').val());
      if (!isNaN(biaya_pengiriman)) {
        for (var i = 0; i < biaya_produk.length; i++) {
          biaya_total_produk = biaya_total_produk + (biaya_produk[i]*jumlah_pembelian[i]);
        }
        biaya_total_produk = biaya_total_produk+biaya_pengiriman;
        $('#total_biaya').html('Rp '+biaya_total_produk);
        $('total_biaya_input').val(biaya_total_produk);
      }else{
        $('#total_biaya').html('Setelah form lengkap, Sistem otomatis menghitung biaya total');
        $('total_biaya_input').val(0);
      }
    }
    // Rajaongkir api
    // untuk mengambil data provinsi dari rajaongkir
    getProvinsi();
    function getProvinsi(){
      $.ajax({
         type : "GET",
         url : "https://api.rajaongkir.com/starter/province?key=f6fc048e43de76756f28209b00d7a6d1",
         crossDomain: true,
         dataType: "json",
         cors: true ,
         headers :{
           'Access-Control-Allow-Origin': '*',
         },
         success : function(result) {
             $('#provinsi_field').html('<div class="form-group">'+
               '<p class="mb-0 font-weight-normal">Provinsi</p>'+
               '<select class="form-control" data-style="btn btn-link" id="provinsi" required>'+
                 '<option selected disabled>--- Pilih Salah Satu ---</option>'+
               '</select>'+
               '<input id="provinsi_input" type="hidden" name="provinsi" class="form-control" required>'+
               '</div>');
             $('#estimasi_tarif').html('<div id="jasa_kurir_field" class="col-md-8 col-12 mb-1">'+
               '<div class="form-group">'+
                 '<p class="mb-0 font-weight-normal">Jasa Kurir</p>'+
                 '<select class="form-control" name="id_kategori" data-style="btn btn-link" id="jasa_kurir" required>'+
                   '<option selected disabled>--- Pilih Salah Satu ---</option>'+
                 '</select>'+
               '</div>'+
             '</div>'+
             '<div id="tarif">'+
             '</div>'+
             '<p class="mb-1">Pilihan estimasi harga lainnya</p>'+
             '<span>'+
               '<a href="https://berdu.id/cek-ongkir" target="_blank" class="btn btn-sm btn-primary">Berdu Cek Ongkos kirim</a>'+
               '<a href="https://cektarif.com/" target="_blank" class="btn btn-sm btn-primary">Cektarif.com </a>'+
             '</span>');
             var provinsi = '';
             var provinsi_get = result.rajaongkir.results;
             for (var key in provinsi_get) {
               provinsi = provinsi + '<option value="'+provinsi_get[key].province_id+'" >'+provinsi_get[key].province+'</option>';
             }
             $('#provinsi').append(provinsi);
             $('#kota_field').html('<div class="form-group">'+
               '<p class="mb-0 font-weight-normal">Kota</p>'+
               '<select class="form-control" data-style="btn btn-link" id="kota" required>'+
                 '<option selected disabled>--- Pilih Provinsi Terlebih Dahulu ---</option>'+
               '</select>'+
               '<input id="kota_input" type="hidden" name="kota" class="form-control" required>'+
               '</div>');
             //ambil kota berdasarkan provinsi yang dipilih
             $('#provinsi').change(function(){
               $('#provinsi_input').val($('#provinsi option:selected').html());
               $('#kota').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
               $('#kurir').html("<option selected disabled>--- Pilih Kota Terlebih Dahulu ---</option>");
               $('#rute').html('Pilih kota tujuan');
               var province_id = $(this).val();
               console.log(province_id);
               $.ajax({
                  type : "GET",
                  url : "https://api.rajaongkir.com/starter/city?key=f6fc048e43de76756f28209b00d7a6d1&province="+province_id,
                  crossDomain: true,
                  dataType: "json",
                  success : function(result) {
                      var kota = '';
                      var kota_get = result.rajaongkir.results;
                      for (var key in kota_get) {
                        kota = kota + '<option value="'+kota_get[key].city_id+'" >'+kota_get[key].city_name+'</option>';
                      }
                      $('#kota').append(kota);
                  },
                  error : function(result) {
                    console.log(result.status);
                  }
                });
             });
             //menampilkan pilihan kurir
             $('#kota').change(function(){
                 $('#kota_input').val($('#kota option:selected').html());
                 $('#rute').html('Ponorogo ke '+$('#kota_input').val());
                 $('#jasa_kurir').html('<option selected disabled>--- Pilih Salah Satu ---</option>');
                 $('#jasa_kurir').append('<option value="jne">JNE</option>');
                 $('#jasa_kurir').append('<option value="pos">Pos Indonesia</option>');
                 $('#jasa_kurir').append('<option value="tiki">Tiki</option>');
             });
             //menampilkan pilihan kurir
             $('#jasa_kurir').change(function(){
               $('#tarif').html('');
                 getTarif();
             });
         },
         error : function(result) {
           console.log(result.status);
         }
       });
    }
    // data tarif rajaongkir
    function getTarif(){
      if (berat.length!=0) {
        var berat_total = 0;
        for (var i = 0; i < berat.length; i++) {
          berat_total = berat_total+ (berat[i]*jumlah_pembelian[i]);
        }
        $.ajax({
           type : "POST",
           url : "https://api.rajaongkir.com/starter/cost",
           data : {
             key : 'f6fc048e43de76756f28209b00d7a6d1',
             origin : '363',
             destination : $('#kota').val(),
             weight : berat_total,
             courier : $('#jasa_kurir').val(),
           },
           crossDomain: true,
           dataType: "json",
           success : function(result) {
              console.log(result.rajaongkir.results);
               var tarif = '';
               var tarif_get = result.rajaongkir.results;
               var courier = $('#jasa_kurir').val();
               for (var i in tarif_get) {
                 for (var j in tarif_get[i].costs) {
                   var cost ;
                   var est_hari ;
                   for (var k in tarif_get[i].costs[j].cost) {
                     cost = tarif_get[i].costs[j].cost[k].value;
                     est_hari = tarif_get[i].costs[j].cost[k].etd;
                   }
                   tarif = tarif+'<div class="row">'+
                     '<div class=" col-md-3 col-4">'+
                       '<p class=" mb-1 font-weight-normal ml-4 pl-2">'+courier+' '+tarif_get[i].costs[j].service+'</p>'+
                     '</div>'+
                     '<div class="col-md-9 col-8">'+
                       '<p class="mb-1">Rp '+cost+' ('+est_hari+' hari)</p>'+
                     '</div>'+
                   '</div>';
                 }
               }
               $('#tarif').append(tarif);
           },
           error : function(result) {
             console.log(result.rajaongkir);
           }
         });
      }
    }

    //untuk mengambil data produk
    function getProduk(){
      var id = document.getElementById('keyProduk').value;
      var url = 'http://127.0.0.1:8000/api/produk/'+id;
      fetch(url)
            .then(response => response.json())
            .then(function (data) {
                if(data.status=='success'){
                  var check = false;
                  for (var i = 0; i < id_produk.length; i++) {
                    if(id_produk[i]==data.produk.id){
                      check = true;
                    }
                  }
                  if(check==false){
                    var carousel_pict = '';
                    var carousel_nav = '';
                    var picture = data.produk.picture;
                    for (var key in picture) {
                        console.log(picture[key].url_photo);
                        if(key==0){
                          carousel_nav = carousel_nav+
                                          '<li data-target="#carouselExampleIndicators" data-slide-to="'+key+'"class="active"></li>';
                          carousel_pict = carousel_pict+
                                          '<div class="carousel-item active">'+
                                            '<img class="d-block w-100" src="http://127.0.0.1:8000/'+picture[key].url_photo+'" alt="First slide" style="object-fit: cover; object-position: 100% 0; height: 210px;">'+
                                          '</div>';
                        }else{
                          carousel_nav = carousel_nav+
                                          '<li data-target="#carouselExampleIndicators" data-slide-to="'+key+'"class=""></li>';
                          carousel_pict = carousel_pict+
                                          '<div class="carousel-item">'+
                                            '<img class="d-block w-100" src="http://127.0.0.1:8000/'+picture[key].url_photo+'" alt="First slide" style="object-fit: cover; object-position: 100% 0; height: 210px;">'+
                                          '</div>';
                        }
                    }
                    var diskon;
                    var harga = data.produk.harga;
                    if(data.produk.diskon!=null){
                      if(data.produk.status_diskon==0){
                        diskon = '<button type="button" class="btn btn-sm btn-danger" name="button">Tidak Diskon</button>';
                      }else if(data.produk.status_diskon==1){
                        diskon = '<button type="button" class="btn btn-sm btn-success" name="button">Diskon '+data.produk.diskon+'%</button>';
                        harga = data.produk.harga-((data.produk.harga*data.produk.diskon)/100);
                      }
                    }else{
                      diskon = '<button type="button" class="btn btn-sm btn-danger" name="button">Tidak Diskon</button>';
                    }
                    $('#produk_detail').append(
                      '<div id="produk'+produk+'" class="col-md-3 col-12">'+
                        '<div class="card card-chart">'+
                          '<div class="card-header card-header-success p-0">'+
                            '<div id="carouselExampleIndicators'+produk+'" class="carousel slide" data-ride="carousel">'+
                              '<ol class="carousel-indicators">'+
                                 carousel_nav +
                              '</ol>'+
                              '<div class="carousel-inner">'+
                                 carousel_pict +
                              '</div>'+
                              '<a class="carousel-control-prev" href="#carouselExampleIndicators'+produk+'" role="button" data-slide="prev">'+
                                '<span class="carousel-control-prev-icon" aria-hidden="true"></span>'+
                                '<span class="sr-only">Previous</span>'+
                              '</a>'+
                              '<a class="carousel-control-next" href="#carouselExampleIndicators'+produk+'" role="button" data-slide="next">'+
                                '<span class="carousel-control-next-icon" aria-hidden="true"></span>'+
                                '<span class="sr-only">Next</span>'+
                              '</a>'+
                            '</div>'+
                          '</div>'+
                            '<div class="card-body">'+
                              '<h4 class="card-title font-weight-normal text-success">'+ data.produk.nama_produk +'</h4>'+
                              '<p class="card-category font-weight-normal">Kode Barang : '+ data.produk.kode_barang +'</p>'+
                              '<p class="card-category font-weight-normal">Stok : '+ data.produk.stok +'</p>'+
                              '<p class="card-category font-weight-normal">Berat : @'+ data.produk.berat +' gram</p>'+
                              '<p class="card-category font-weight-normal">Harga : Rp '+ harga +' (setelah diskon)</p>'+
                                diskon+
                              '<div class="card my-1 py-0">'+
                                '<div class="card-body rounded bg-success text-light px-2 py-2" style="box-shadow:none;">'+
                                  '<div class="form-group mt-0">'+
                                    '<p class="mb-0 font-weight-normal">Jumlah Pembelian</p>'+
                                    '<input id="jumlah_pembelian'+produk+'" onkeyup="jumlahPembelian('+produk+')" style="color:white !important" type="number" name="jumlah_pembelian[]" class="form-control py-0" step="1" min="0" max="'+data.produk.stok+'" value="1" required>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'+
                              '<input type="hidden" name="id_produk[]" value="'+data.produk.id+'">'+
                            '</div>'+
                          '<div class="card-footer">'+
                            '<div class="pull-right">'+
                              '<a id="hapus_produk'+produk+'" href="#" onclick="hapusProduk('+produk+')" class="text-danger"><i class="material-icons">close</i></a>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>');
                    //tambah jumlah produk
                    produk = produk + 1;
                    //tambah berat produk yg dibeli
                    berat.push(data.produk.berat);
                    //tambah jumlah pembelian
                    jumlah_pembelian.push(1);
                    //mencatat id produk
                    id_produk.push(data.produk.id);
                    //mencatat harga produk
                    biaya_produk.push(harga)
                    //hitung berat
                    hitungBerat();
                    //hitung biaya total
                    biayaTotal();
                    // aktifkan form
                    document.getElementById('form').classList.remove('d-none');
                  }else{
                    $('#message').append(
                      '<div class="alert alert-danger alert-with-icon" data-notify="container">'+
                        '<i class="material-icons" data-notify="icon">cancel</i>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                          '<i class="material-icons">close</i>'+
                        '</button>'+
                        '<span data-notify="message">Produk '+data.produk.nama_produk+' telah diinputkan, silahkan ubah jumlah pembelian pada produk yang dimaksud</span>'+
                      '</div>'
                    );
                  }
                }else{
                  $('#message').append(
                    '<div class="alert alert-danger alert-with-icon" data-notify="container">'+
                      '<i class="material-icons" data-notify="icon">cancel</i>'+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<i class="material-icons">close</i>'+
                      '</button>'+
                      '<span data-notify="message">Produk tidak ditemukan</span>'+
                    '</div>'
                  );
                }
            }).catch(function(error) {
                console.log(error);
            });
    }
    
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/provinsi",
      cache: false,
      success: function(data){
        var province = "";
        for (var i = 0; i < data.provinsi.length; i++) {
           if  (data.provinsi[i]['ID_PROVINSI'] == {{$provinsi->ID_PROVINSI}} ){
             province=province+'<option value="'+data.provinsi[i]['ID_PROVINSI']+'"selected>'+data.provinsi[i]['NAMA_PROVINSI']+'</option>';
             }else {
               province=province+'<option value="'+data.provinsi[i]['ID_PROVINSI']+'">'+data.provinsi[i]['NAMA_PROVINSI']+'</option>';
             }       
        }
       console.log(data);
      $("#provinsi").append(province);
      }
    });

    var province_id = {{ $provinsi->ID_PROVINSI }} ;
    console.log(province_id);
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/kota/"+province_id,
      cache: false,
      success: function(data){
        var city = "";
        for (var i = 0; i < data.kota.length; i++) {
          if  (data.kota[i]['ID_KOTA'] == {{$kota->ID_KOTA}} ){
            city = city+'<option value="'+data.kota[i]['ID_KOTA']+'"selected>'+data.kota[i]['NAMA_KOTA']+'</option>';
          }else {
              city = city+'<option value="'+data.kota[i]['ID_KOTA']+'">'+data.kota[i]['NAMA_KOTA']+'</option>';          
           }        
        }
       console.log(data);
       $("#kota").append(city);
      }
    });

    var city_id = {{ $kota->ID_KOTA}}
    console.log(city_id);
    $.ajax ({
      url: "http://127.0.0.1:8000/api/alamat/kecamatan/"+city_id,
      cache: false,
      success: function(data){
        var kec = "";
        for (var i = 0; i < data.kecamatan.length; i++) {
           if  (data.kecamatan[i]['ID_KECAMATAN'] == {{$kecamatan->ID_KECAMATAN}} ){ 
              kec = kec+'<option value="'+data.kecamatan[i]['ID_KECAMATAN']+'">'+data.kecamatan[i]['NAMA_KECAMATAN']+'</option>';
           }else {
                kec = kec+'<option value="'+data.kecamatan[i]['ID_KECAMATAN']+'">'+data.kecamatan[i]['NAMA_KECAMATAN']+'</option>';
           }
        }
       console.log(data);
       $("#kecamatan").append(kec);
      }
     });

     var kec_id = {{ $kecamatan->ID_KECAMATAN }}
      console.log(kec_id);
      $.ajax ({
        url: "http://127.0.0.1:8000/api/alamat/kelurahan/"+kec_id,
        cache: false,
        success: function(data){
          var kel = "";
          for (var i = 0; i < data.kelurahan.length; i++) {
            if  (data.kelurahan[i]['ID_KELURAHAN'] == {{$kelurahan->ID_KELURAHAN}} ){ 
            kel = kel+'<option value="'+data.kelurahan[i]['ID_KELURAHAN']+'">'+data.kelurahan[i]['NAMA_KELURAHAN']+' - ' +data.kelurahan[i]['KODEPOS']+'</option>';
            }else{
              kel = kel+'<option value="'+data.kelurahan[i]['ID_KELURAHAN']+'">'+data.kelurahan[i]['NAMA_KELURAHAN']+' - ' +data.kelurahan[i]['KODEPOS']+'</option>';
            }
          }
        console.log(data);
        $("#kelurahan").append(kel);
        }
      });


   
   //ambil kota berdasarkan provinsi yang dipilih
   $('#provinsi').change(function(){
    $('#provinsi_input').val($('#provinsi option:selected').html());
    $('#kota').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
    $('#kecamatan').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
    $('#kelurahan').html("<option selected disabled>--- Pilih Salah Satu ---</option>");
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
