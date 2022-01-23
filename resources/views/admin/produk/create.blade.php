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
            <h4 class="my-1 text-success font-weight-bold">Tambah Produk</h4>
            <p class="my-1">Isi form berikut untuk menambahkan produk</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <form id="tambah_produk" action="{{ route('admin.produk.store') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Nama Produk</p>
                <input type="text" name="nama_produk" class="form-control" required>
              </div>
            </div>
            <div class="col-6 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Kode Barang</p>
                <input id="kode-produk-field" type="text" name="kode_barang" class="form-control" required>
              </div>
            </div>
            <div class="col-6 mb-1">
              <a class="btn btn-success text-white" id="kode-produk">Buat kode barang</a>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Nomor Barcode</p>
                <input type="text" name="nomor_barcode" class="form-control">
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Berat</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="berat" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <p class="mt-2 mb-0"><b>kg</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Kategori</p>
                <select class="form-control" name="id_kategori" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  <option selected disabled>--- Pilih Salah Satu ---</option>
                  @for($i=0;$i<count($kategori);$i++)
                    <option value="{{$kategori[$i]->id}}">{{$kategori[$i]->nama_kategori}}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Ukiran</p>
                <select class="form-control" name="id_ukiran" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  <option selected disabled>--- Pilih Salah Satu ---</option>
                  @for($i=0;$i<count($ukiran);$i++)
                    <option value="{{$ukiran[$i]->id}}">{{$ukiran[$i]->nama_ukiran}}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Stok</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="stok" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <p class="mt-2 mb-0"><b>Buah</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Harga</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="harga" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <p class="mt-2 mb-0"><b>Rupiah</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Diskon</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="diskon" class="form-control">
                  </div>
                  <div class="col-4">
                    <p class="mt-2 mb-0"><b>%</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Status Diskon</p>
                <select class="form-control" name="status_diskon" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  <option value="0" >Tidak Aktif</option>
                  <option value="1" >Aktif</option>
                </select>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Status Produk</p>
                <select class="form-control" name="status_produk" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  <option value="1">Aktif (Produk ditampilkan untuk dijual)</option>
                  <option value="0">Tidak Aktif (Produk tidak ditampilkan untuk dijual)</option>
                </select>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Keterangan Produk</p>
                <textarea rows="5" type="text" name="keterangan" class="form-control"></textarea>
              </div>
            </div>
            <!-- upload foto -->
            <div class="col-12 col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <p class="mb-0 font-weight-normal">Foto Produk</p>
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
                  <button type="button" class="add-field btn btn-info btn-sm">Tambah Foto</button>
                </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="row mt-3">
          <div class="col-12">
            <div class="float-right">
              <button class="btn btn-success" form="tambah_produk" type="submit" method="post">Tambah Produk</button>
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
    //buat generate kode produk
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $('#kode-produk').click(function(){
          let result = ' ';
          const charactersLength = characters.length;
          for ( let i = 0; i < 5; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
          console.log(result);
          $('#kode-produk-field').val(result);
    });
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
