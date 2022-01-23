@extends('admin.layout.master')
@section('title') Ukiran  @endsection
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
            <h4 class="my-1 text-success font-weight-bold">Daftar Ukiran</h4>
            <p class="my-1">Berikut adalah daftar Ukiran yang tersedia pada Bedug Langgeng</p>
          </div>
          <div class="col-md-3 col-12">
            <button type="button" data-toggle="modal" data-target="#create" class="btn btn-success btn-block" ><i class="material-icons mr-2">add_circle</i>Tambah Ukiran</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
  <div class="col-12">
  <div class="alert alert-success alert-with-icon" data-notify="container">
    <i class="material-icons" data-notify="icon">cancel</i>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span data-notify="message">{{ $message }}</span>
  </div>
  </div>
  @endif
  <!-- modal tambah Ukiran -->
  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-md-8 col-8">
              <h5 class="modal-title mt-2">Tambah Ukiran</h5>
            </div>
            <div class="col-md-4 col-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <form id="createukiran" action="{{ route('admin.ukiran.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <p class="mb-0 font-weight-normal">Nama Ukiran</p>
                  <input type="text" name="nama_ukiran" class="form-control" required>
                </div>
                <div class="card mt-2">
                  <div class="card-body bg-success pb-1">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" required>
                      <label class="custom-file-label text-white">Klik untuk tambah foto</label>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div align="right">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" form="createukiran" class="btn btn-success">Buat</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- card list Ukiran -->
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-8 col-12 my-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text padding-src">
                  <i class="material-icons">search</i>
                </span>
              </div>
              <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Cari...">
            </div>
          </div>
          <div class="col-md-8 col-12 mb-3">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-success">
                  <th>
                    No
                  </th>
                  <th>
                    Nama Ukiran
                  </th>
                  <th>
                    Aksi
                  </th>
                </thead>
                <tbody>
                  @for($i=0;$i<count($ukiran);$i++)
                    <tr>
                      <td>{{$i+1}}</td>
                      <td>{{$ukiran[$i]->nama_ukiran}}</td>
                      <td class="td-actions">
                        <!-- lihat foto -->
                        <button type="button" data-toggle="modal" data-target="#foto{{$i}}" rel="tooltip" title="Lihat Foto" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">insert_photo</i>
                        </button>
                        <!-- edit Ukiran -->
                        <button type="button" data-toggle="modal" data-target="#edit{{$i}}" rel="tooltip" title="Edit Ukiran" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </button>
                        <!-- hapus Ukiran (kecuali Ukiran pertama!) -->
                        @if($ukiran[$i]->id!=1)
                        <!--<button type="button" data-toggle="modal" data-target="#delete{{$i}}" rel="tooltip" title="Hapus Ukiran" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>
                        </button>-->
                        @endif
                      </td>
                      <!-- modal foto -->
                      <div class="modal fade" id="foto{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row mb-3">
                                <div class="col-md-8 col-8">
                                  <h5 class="modal-title mt-2">Foto Ukiran</h5>
                                </div>
                                <div class="col-md-4 col-4">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12" align="center">
                                  <img src="{{asset($ukiran[$i]->url_photo)}}" class="w-50" alt="">
                                </div>
                              </div>
                              <div align="right">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal edit -->
                      <div class="modal fade" id="edit{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row mb-3">
                                <div class="col-md-8 col-8">
                                  <h5 class="modal-title mt-2">Edit Ukiran</h5>
                                </div>
                                <div class="col-md-4 col-4">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12">
                                  <form id="editukiran{{$i}}" action="{{ route('admin.ukiran.update',['id'=>$ukiran[$i]->id]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                      <p class="mb-0 font-weight-normal">Nama Ukiran</p>
                                      <input type="text" name="nama_ukiran" class="form-control" value="{{$ukiran[$i]->nama_ukiran}}" required>
                                    </div>
                                    <div class="card mt-2">
                                      <div class="card-body bg-success pb-1">
                                        <div class="custom-file">
                                          <input type="file" name="image" class="custom-file-input">
                                          <label class="custom-file-label text-white">Klik untuk ganti foto</label>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                              <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="editukiran{{$i}}" class="btn btn-success">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- modal hapus -->
                      <div class="modal fade" id="delete{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row mb-3">
                                <div class="col-md-8 col-8">
                                  <h5 class="modal-title mt-2">Hapus Ukiran</h5>
                                </div>
                                <div class="col-md-4 col-4">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12">
                                  <form id="deleteukiran{{$i}}" action="{{ route('admin.ukiran.destroy',['id'=>$ukiran[$i]->id]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  <p class="mb-1">Apakah anda yakin menghapus Ukiran <b>{{$ukiran[$i]->nama_ukiran}}</b>?</p>
                                  <p>Seluruh produk yang menggunakan Ukiran ini akan dipindah menjadi Ukiran <b>{{$ukiran[0]->nama_ukiran}}</b></p>
                                </form>
                                </div>
                              </div>
                              <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="deleteukiran{{$i}}" class="btn btn-danger">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                  @endfor
                </tbody>
              </table>
              @if(count($ukiran)==0)
              <div class="mt-5" align="center">
                <p class="text-secondary">Belum ada ukiran yang tersedia</p>
              </div>
              @endif
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
  $("#ukiran").addClass("active");

  //buat upload file dokumen
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
@endsection
