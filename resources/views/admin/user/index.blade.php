@extends('admin.layout.master')
@section('title') User @endsection
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
          <h1><b>User</b></h1>
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
                      <h3 class="card-title mt-3"><b>Data User</b></h3>
                  </div>
                  <div class="col-2">
                      <button  class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-user">Tambah User</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background: white; color:black;">
                      <th>Id User</th>
                      <th>Nama User</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user as $u)
                    <tr>
                      <td>{{$u->id}}</td>
                      <td>{{$u->name}}</td>
                      <td>{{$u->email}}</td>
                      <td class="hidetext">{{$u->password}}</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-user{{$u->id}}"><i class="nav-icon fas fa-edit" ></i></button>
                        <!-- /.modal Edit-->
                          <div class="modal fade" id="edit-user{{$u->id}}">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h4 class="modal-title">Edit Data User</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data">
                                          {{ csrf_field() }}         
                                          
                                          <input type="hidden" class="form-control" required id="id" name="id" value="{{$u->id}}">
                                          <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama User</label>
                                                <input type="text" class="form-control" required id="exampleInputPassword1" name="nama" placeholder="Masukkan Nama User" value="{{$u->name}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Email</label>
                                                <input type="text" class="form-control" required id="exampleInputPassword1" name="email" value="{{$u->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" value="{{$u->password}}">
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
        <div class="modal fade" id="modal-user">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}         
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama User</label>
                                <input type="text" class="form-control" required id="exampleInputPassword1" name="nama" placeholder="Masukkan Nama User">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="email" class="form-control" required id="exampleInputPassword1" name="email" placeholder="your-@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" required id="exampleInputPassword1" name="password" placeholder="Masukkan Password">
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

<!-- <script>
    $(function(){
    .hidetext { -webkit-text-security: circle; /* Default */ }
    })
    
</script> -->

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
