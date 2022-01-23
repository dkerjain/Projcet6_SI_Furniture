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
            <h4 class="my-1 text-success font-weight-bold">Edit Produk</h4>
            <p class="my-1">Edit form berikut untuk memperbarui produk</p>
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
        <form id="tambah_produk" action="{{ route('admin.produk.update',['id'=>$produk->id]) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Nama Produk</p>
                <input type="text" name="nama_produk" class="form-control" value="{{$produk->nama_produk}}" required>
              </div>
            </div>
            <div class="col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Kode Barang</p>
                <input type="text" name="kode_barang" class="form-control" value="{{$produk->kode_barang}}" required>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Nomor Barcode</p>
                <input type="text" name="nomor_barcode" class="form-control" value="{{$produk->nomor_barcode}}">
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Berat</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="berat" class="form-control" required value="{{$produk->berat}}">
                  </div>
                  <div class="col-4">
                    <p class="mt-2 mb-0"><b>gram</b></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Kategori</p>
                <select class="form-control" name="id_kategori" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  @for($i=0;$i<count($kategori);$i++)
                    <option value="{{$kategori[$i]->id}}" @if($kategori[$i]->id==$produk->id_kategori) selected @endif>{{$kategori[$i]->nama_kategori}}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Ukiran</p>
                <select class="form-control" name="id_ukiran" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  @for($i=0;$i<count($ukiran);$i++)
                    <option value="{{$ukiran[$i]->id}}" @if($ukiran[$i]->id==$produk->id_ukiran) selected @endif>{{$ukiran[$i]->nama_ukiran}}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-6 col-12 mb-1">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Stok</p>
                <div class="row">
                  <div class="col-8">
                    <input type="number" name="stok" class="form-control" value="{{$produk->stok}}" required>
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
                    <input type="number" name="harga" class="form-control" value="{{$produk->harga}}" required>
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
                    <input type="number" name="diskon" class="form-control" value="{{$produk->diskon}}">
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
                  <option value="0" @if($produk->status_diskon==0) selected @endif>Tidak Aktif</option>
                  <option value="1" @if($produk->status_diskon==1) selected @endif>Aktif</option>
                </select>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Status Produk</p>
                <select class="form-control" name="status_produk" data-style="btn btn-link" id="exampleFormControlSelect1" required>
                  <option value="1" @if($produk->status_produk==1) selected @endif>Aktif (Produk ditampilkan untuk dijual)</option>
                  <option value="0" @if($produk->status_produk==0) selected @endif>Tidak Aktif (Produk tidak ditampilkan untuk dijual)</option>
                </select>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <p class="mb-0 font-weight-normal">Keterangan Produk</p>
                <textarea rows="5" type="text" name="keterangan" class="form-control">{{$produk->keterangan}}</textarea>
              </div>
            </div>
            <!-- <div class="col-12 mb-2 mt-2">
              <div class="form-group form-file-upload form-file-multiple">
                <input type="file" name="image[]" multiple class="inputFileHidden" id="my_photo" accept="image/*"/>
                <div class="input-group">
                    <input type="text" class="form-control inputFileVisible" placeholder="Upload Foto Produk">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-success" id="get_photo">
                            <i class="material-icons">attach_file</i>
                        </button>
                    </span>
                </div>
              </div>
            </div> -->
            <!-- upload foto -->
            <div class="col-12 col-md-6">
              <div class="row">
                <div class="col-md-12">
                  <p class="mb-0 font-weight-normal">Foto Produk</p>
                  @for($i=0;$i<count($produk->picture);$i++)
                  <div class="multi-field">
                    <div class="card bg-success">
                      <div class="card-body">
                        <div class="input-group">
                          <div class="custom-file mt-2">
                            <label class="custom-file-label text-light">Foto {{$i+1}}</label>
                          </div>
                          <div class="input-group-append">
                            <button data-toggle="modal" data-target="#delete{{$i}}" class="btn btn-danger remove-field" type="button">Hapus</button>
                          </div>
                        </div>
                        <img src="{{asset($produk->picture[$i]->url_photo)}}" style="max-width:100%" />
                      </div>
                    </div>
                  </div>
                  @endfor
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
        <!-- modal hapus foto (harus diluar tag form utama)-->
        @for($i=0;$i<count($produk->picture);$i++)
        <div class="modal fade" id="delete{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row mb-3">
                  <div class="col-md-8 col-8">
                    <h5 class="modal-title mt-2 text-dark">Hapus Foto</h5>
                  </div>
                  <div class="col-md-4 col-4">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-12">
                    <form id="deletepicture{{$i}}" action="{{ route('admin.produk.picture.destroy',['id'=>$produk->picture[$i]->id]) }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <p class="mb-1 text-dark">Apakah anda yakin menghapus foto ini?</p>
                    </form>
                  </div>
                </div>
                <div align="right">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" form="deletepicture{{$i}}" class="btn btn-danger">Hapus</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endfor
        <div class="row mt-3">
          <div class="col-12">
            <div class="float-right">
              <button class="btn btn-success" form="tambah_produk" type="submit" method="post">Perbarui Produk</a>
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
