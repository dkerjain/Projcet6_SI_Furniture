@extends('admin.layout.master')
@section('title') Kategori @endsection
@section('css')
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Kategori</b></h1>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <!-- Tanggal dan Pegawai -->
    
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-10">
                      <h3 class="card-title mt-3"><b>Data Kategori</b></h3>
                  </div>
                  <div class="col-2">
                      <button  class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-kategori">Tambah Kategori</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background: white; color:black;">
                      <th>Id Kategori</th>
                      <th>Nama Kategori</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kategori as $k)
                    <tr>
                      <td>{{$k->id}}</td>
                      <td>{{$k->nama_kategori}}</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-kategori{{$k->id}}"><i class="nav-icon fas fa-edit" ></i></button>
                        <!-- /.modal Edit-->
                          <div class="modal fade" id="edit-kategori{{$k->id}}">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Edit Data Kategori</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form action="{{ route('admin.kategori.update') }}" method="POST" enctype="multipart/form-data">
                                          {{ csrf_field() }}         
                                          
                                          <input type="hidden" class="form-control" required id="id" name="id" value="{{$k->id}}">
                                          <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Kategori</label>
                                                <input type="text" class="form-control" required id="exampleInputPassword1" name="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{$k->nama_kategori}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Input Foto</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                          </div>
                                      </form>
                                  </div>
                                  <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                          </div>
                        <!-- /.modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto-kategori{{$k->id}}"><i class="nav-icon fas fa-image" ></i></button>
                        <!-- /.modal Foto -->
        
                          <div class="modal fade" id="foto-kategori{{$k->id}}">
                              <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Foto Kategori</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="item form-group" style="text-align:center;">
                                            <img src="{{asset($k->url_photo)}}" style="width:250px; height:250px;">
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                        <!-- /.modal -->
                        <!-- <a class="hapus ml-3" href="#" data-toggle="modal"><i class="nav-icon fas fa-trash" ></i></a> -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      
    </div>
  </section>

  <!-- Modall -->
      <!-- /.modal Input-->
        <div class="modal fade" id="modal-kategori">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}         
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Kategori</label>
                                <input type="text" class="form-control" required id="exampleInputPassword1" name="nama_kategori" placeholder="Masukkan Nama Kategori">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
      <!-- /.modal -->

      

@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@if (session('login'))
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: 'Anda Berhasil Login'
    })
  </script>
@endif

@if (session('success'))
  <script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Data Barang Berhasil Disimpan',
          showConfirmButton: false,
          timer: 2000
      }); 
  </script>
@endif

@endsection
