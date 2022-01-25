@extends('admin.layout.master')
@section('title') Penjualan @endsection
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('/assets/plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><b>Penjualan</b></h1>
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
                  <div class="col-3">
                    <a href="{{route('admin.penjualan.create')}}"><button  class="btn btn-primary btn-block">Tambah Penjualan</button></a>
                  </div>
                  <div class="col-6">
                  </div>
                  <div class="col-3">
                      <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                <form action="/laporan/report" method="get">
                                  <div class="input-prepend input-group">
                                    <input type="text" name="date" class="form-control float-right" id="reservation">
                                    <button class="btn btn-secondary" type="submit">Filter</button>
                                  </div>
                                </form>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background: white; color:black;">
                      <th>Id Penjualan</th>
                      <th>Tanggal Penjualan</th>
                      <th>Nama Pembeli</th>
                      <th>No Telfon</th>
                      <th>Jasa Kurir</th>
                      <th>Biaya Pengiriman</th>
                      <th>Biaya Produk</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>PEN001</td>
                      <td>16 Januari 2022</td>
                      <td>Rista</td>
                      <td>0897234567</td>
                      <td>J&T</td>
                      <td>Rp. 20.000</td>
                      <td>Rp. 350.000</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail-penjualan"><i class="nav-icon fas fa-edit" ></i></button>
                         
                          <!-- /.modal Detail Penjualan-->
                            <div class="modal fade" id="detail-penjualan">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Detail Data Penjualan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                    <div class="row">
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>ID Penjualan</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <input type="text" class="form-control" placeholder="PEN001" disabled>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Jasa Kurir</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <input type="text" class="form-control" placeholder="J&T" disabled>
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Biaya Produk</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Rp. 350.000" disabled>
                                          </div>
                                        </div>

                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Biaya Pengiriman</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Rp. 20.000" disabled>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                            <label>Total Pembayaran</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-9">
                                          <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Rp. 370.000" disabled>
                                          </div>
                                        </div>
                                    </div>
                                    <table id="example2" class="table table-bordered table-hover">
                                      <thead>
                                      <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <!-- Code Menampilkan Data -->
                                              <td>PRD001</td>
                                              <td>1</td>
                                              <td>Rp. 350.000</td>
                                          </tr>
                                      </tbody>
                                    </table>
                                    
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                            </div>
                          <!-- /.End modal -->

                        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto-kategori"><i class="nav-icon fas fa-image" ></i></button> -->
                        <!-- <a class="hapus ml-3" href="#" data-toggle="modal"><i class="nav-icon fas fa-trash" ></i></a> -->
                      </td>
                    </tr>
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
                                <input type="text" class="form-control" required id="exampleInputPassword1" name="nama" placeholder="Masukkan Nama Kategori">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
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

      <!-- /.modal Foto -->
        
        <div class="modal fade" id="foto-kategori">
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
                          <img src="{{asset('image/produk/meja1.jpg')}}" style="width:250px; height:250px;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
      <!-- /.modal -->

      <!-- /.modal Edit-->
        <div class="modal fade" id="edit-kategori">
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
                        <div class="modal-body">
                          <div class="form-group">
                              <label for="exampleInputPassword1">Nama Kategori</label>
                              <input type="text" class="form-control" required id="exampleInputPassword1" name="nama" placeholder="Masukkan Nama Kategori">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputFile">Input Foto</label>
                              <div class="input-group">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
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

<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      let start = moment().startOf('month')
      let end = moment().endOf('month')
      
      
      $('#reservation').daterangepicker({
          startDate: start,
          endDate: end
        }, function(first, last) {
            })
  })
</script>

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
