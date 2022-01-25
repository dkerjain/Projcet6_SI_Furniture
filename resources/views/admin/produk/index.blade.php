@extends('admin.layout.master')
@section('title') Produk @endsection
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
          <h1><b>Produk</b></h1>
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
                      <h3 class="card-title mt-3"><b>Data Produk</b></h3>
                  </div>
                  <div class="col-2">
                      <button  class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-kategori">Tambah Produk</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr style="background: white; color:black;">
                      <th>Id Produk</th>
                      <th>Kategori </th>
                      <th>Nama Produk</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>PRD001</td>
                      <td>Meja</td>
                      <td>Meja Nakas</td>
                      <td>10</td>
                      <td>Rp. 340.000</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-produk"><i class="nav-icon fas fa-edit" ></i></button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto-produk"><i class="nav-icon fas fa-image" ></i></button>
                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-produk"><i class="nav-icon fas fa-trash" ></i></button> -->
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
                        <h4 class="modal-title">Tambah Data Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}         
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kategori <span class="required">*</span></label>
                                <select class="form-control" required name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Produk <span class="required">*</span></label>
                                <input type="text" class="form-control" required id="nama" name="nama" placeholder="Masukkan Nama Produk">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Stok <span class="required">*</span></label>
                                <input type="number" class="form-control" min="0" required id="stok" name="stok" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Harga <span class="required">*</span></label>
                                <input type="text" class="form-control" min="0" required id="harga" name="harga" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto<span class="required">*</span> </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Deskripsi Produk</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan Produk"></textarea>
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
        <div class="modal fade" id="foto-produk">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Foto Produk</h4>
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
        <div class="modal fade" id="edit-produk">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.produk.update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}         
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kategori <span class="required">*</span></label>
                                <select class="form-control" required name="kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Produk <span class="required">*</span></label>
                                <input type="text" class="form-control" required id="nama" name="nama" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Stok <span class="required">*</span></label>
                                <input type="number" class="form-control" min="0" required id="stok" name="stok" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Harga <span class="required">*</span></label>
                                <input type="text" class="form-control" min="0" required id="harga" name="harga" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto<span class="required">*</span> </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/png, image/jpg, image/jpeg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Deskripsi Produk</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan Produk"></textarea>
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

<script type="text/javascript">
		
		var rupiah = document.getElementById('harga');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value);
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
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
          title: 'Data Produk Berhasil Disimpan',
          showConfirmButton: false,
          timer: 2000
      }); 
  </script>
@endif

@if (session('update'))
  <script>
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Data Produk Berhasil Diupdate',
          showConfirmButton: false,
          timer: 2000
      }); 
  </script>
@endif

<script>
  $("#produk").addClass("active");
</script>

@endsection
