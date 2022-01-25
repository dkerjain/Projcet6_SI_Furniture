@extends('admin.layout.master')
@section('title') Penjualan @endsection
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('/assets/plugins/daterangepicker/daterangepicker.css')}}">

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
                      <th>Pengiriman</th>
                      <th>Biaya Pengiriman</th>
                      <th>Total Biaya Produk</th>
                      <th>Status Pembayaran</th>
                      <th>Status Order</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($order as $o)
                    <tr>
                      <td>{{$o->id}}</td>
                      <td>{{\Carbon\Carbon::parse($o->created_at)->translatedFormat('d-m-Y')}}</td>
                      @foreach($customer as $c)
                       @if($c->id == $o->id_customer)
                        <td>{{$c->nama_customer}}</td>
                        <td>{{$c->nomor_telepon}}</td>
                        @endif
                      @endforeach
                      @if($o->jasa_kurir==0)
                        <td>Diambil</td>
                      @else
                        <td>Jasa Kurir</td>
                      @endif
                      <td>Rp. {{ number_format($o->biaya_pengiriman) }}</td>
                      <td>Rp. {{ number_format($o->biaya_total_produk) }}</td>
                      @foreach($pembayaran as $pb)
                        @if($pb->id_order == $o->id)
                          @if($pb->status_pembayaran == 0)
                            <td><button type="button" class="btn btn-danger">Belum Dibayar</button></td>
                          @else
                            <td><button type="button" class="btn btn-success">Lunas</button></td>
                          @endif
                        @endif
                      @endforeach
                      @if($o->status == 0)
                        <td><button type="button" class="btn btn-danger">Belum Diproses</button></td>
                      @elseif($o->status == 1)
                        <td><button type="button" class="btn btn-info">Sedang Diproses</button></td>
                      @elseif($o->status == 2)
                        <td><button type="button" class="btn btn-success">Selesai</button></td>
                      @endif
                      
                      <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detail-penjualan{{$o->id}}"><i class="nav-icon fas fa-sticky-note" ></i></button>
                        <!-- /.modal Detail Penjualan-->
                        <div class="modal fade" id="detail-penjualan{{$o->id}}">
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
                                            <input type="text" class="form-control" value="{{$o->id}}" disabled>
                                          </div>
                                        </div>
                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Pengiriman</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            @if($o->jasa_kurir==0)
                                            <input type="text" class="form-control" value="Diambil" disabled>
                                            @else
                                            <input type="text" class="form-control" value="Jasa Kurir" disabled>
                                            @endif
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
                                            <input type="text" class="form-control" value="Rp. {{number_format($o->biaya_total_produk)}}" disabled>
                                          </div>
                                        </div>

                                        <div class="col-sm-2">
                                          <div class="form-group">
                                            <label>Biaya Pengiriman</label>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <input type="text" class="form-control" value="Rp. {{number_format($o->biaya_pengiriman)}}" disabled>
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
                                            <input type="text" class="form-control" value="Rp. {{number_format($o->biaya_pengiriman+$o->biaya_total_produk)}}" disabled>
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
                                        @foreach($order_list as $ol)
                                          @if($ol->id_order == $o->id)
                                          <tr>
                                              <!-- Code Menampilkan Data -->
                                              @foreach($produk as $pr)
                                                @if($ol->id_produk == $pr->id)
                                                  <td>{{$pr->nama_produk}}</td>
                                                @endif
                                              @endforeach
                                              <td>{{$ol->jumlah}}</td>
                                              <td>Rp. {{number_format($ol->harga_subtotal)}}</td>
                                          </tr>
                                          @endif
                                        @endforeach
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-penjualan{{$o->id}}"><i class="nav-icon fas fa-edit" ></i></button>
                         
                                <!-- /.modal Edit-->
                                  <div class="modal fade" id="edit-penjualan{{$o->id}}">
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Edit Data Penjualan</h4>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <form action="{{ route('admin.order.update') }}" method="POST" enctype="multipart/form-data">
                                                  {{ csrf_field() }}         
                                                  <div class="modal-body">
                                                  <input type="hidden" class="form-control" required id="id" name="id" value="{{ $o->id }}">
                                                      <div class="form-group">
                                                          <label for="exampleInputPassword1">Pengiriman</label>
                                                          <select class="form-control" required name="jasa_kurir">
                                                              <option value="">-- Pilih Pengiriman --</option>
                                                              <option value="0">Diambil</option>
                                                              <option value="1">Jasa Kurir</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputPassword1">Biaya Pengiriman</label>
                                                          <input type="text" class="form-control" required id="biaya_pengiriman" name="biaya_pengiriman" value="{{ $o->biaya_pengiriman }}">
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="exampleInputPassword1">Total Biaya Produk</label>
                                                          <input type="text" class="form-control bg-success color-palette" required id="biaya_produk" name="biaya_produk" value="Rp. {{ number_format($o->biaya_total_produk) }}" readonly>
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Status Pembayaran</label>
                                                          <select class="form-control" required name="status_pembayaran">
                                                              <option value="">-- Pilih Status Pembayaran --</option>
                                                              <option value="0">Belum Lunas</option>
                                                              <option value="1">Lunas</option>
                                                          </select>
                                                      </div>
                                                      <div class="form-group">
                                                          <label>Status Penjualan</label>
                                                          <select class="form-control" required name="status_penjualan">
                                                              <option value="">-- Pilih Status Penjualan --</option>
                                                              <option value="0">Belum Diproses</option>
                                                              <option value="1">Sedang Diproses</option>
                                                              <option value="2">Selesai Diproses</option>
                                                          </select>
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


                        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto-kategori"><i class="nav-icon fas fa-image" ></i></button> -->
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

<!-- date-range-picker -->
<script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

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
