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
                      <th>Kode Barang</th>
                      <th>Kategori </th>
                      <th>Nama Produk</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Deskripsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($produk as $p)
                    <tr>
                      <td>{{ $p->kode_barang }}</td>
                      @foreach($kategori as $k)
                        @if($k->id==$p->id_kategori)
                          <td>{{ $k->nama_kategori }}</td>
                        @endif
                      @endforeach
                      <td>{{ $p->nama_produk }}</td>
                      <td>{{ $p->stok }}</td>
                      <td>Rp. {{ number_format($p->harga) }}</td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-produk{{$p->id}}"><i class="nav-icon fas fa-edit" ></i></button>
                        <!-- /.modal Edit-->
                        <div class="modal fade" id="edit-produk{{$p->id}}">
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
                                          <input type="hidden" class="form-control" required id="id" name="id" value="{{$p->id}}">
                                              <div class="form-group">
                                                  <label>Kategori <span class="required">*</span></label>
                                                  <select class="form-control" required name="id_kategori">
                                                      @foreach($kategori as $k)                                                          
                                                          <option value="{{ $k->id }}" @if($p->id_kategori === $k->id) selected @endif> {{ $k->nama_kategori }}</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                <label for="exampleInputPassword1">Kode Barang <span class="required">*</span></label>
                                                <input type="text" class="form-control" required id="kode_barang" name="kode_barang" value="{{$p->kode_barang}}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Nama Produk <span class="required">*</span></label>
                                                  <input type="text" class="form-control" required id="nama" name="nama" value="{{$p->nama_produk}}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Stok <span class="required">*</span></label>
                                                  <input type="number" class="form-control" min="0" required id="stok" name="stok" value="{{$p->stok}}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Harga <span class="required">*</span></label>
                                                  <input type="text" class="form-control" min="0" required id="harga" name="harga" value="{{$p->harga}}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Berat <span class="required">*</span></label>
                                                  <input type="text" class="form-control" min="0" required id="berat" name="berat" value="{{$p->berat}}">
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Diskon <span class="required"></span></label>
                                                  <input type="text" class="form-control" min="0" id="diskon" name="diskon" value="{{$p->diskon}}">
                                              </div>
                                              <div class="form-group">
                                                  <label>Status Diskon <span class="required">*</span></label>
                                                  @if($p->status_diskon==0)
                                                  <select class="form-control" required name="status_diskon">
                                                    <option value="0">Non-Aktif</option>    
                                                    <option value="1">Aktif</option>
                                                  </select>
                                                  @elseif($p->status_diskon==1)
                                                  <select class="form-control" required name="status_diskon">
                                                    <option value="1">Aktif</option>    
                                                    <option value="0">Non-Aktif</option>
                                                  </select>
                                                  @endif
                                              </div>
                                              <div class="form-group">
                                                  <label>Status Produk <span class="required">*</span></label>
                                                  @if($p->status_produk==0)
                                                  <select class="form-control" required name="status_produk">
                                                    <option value="0">Non-Aktif</option>    
                                                    <option value="1">Aktif</option>
                                                  </select>
                                                  @elseif($p->status_produk==1)
                                                  <select class="form-control" required name="status_produk">
                                                    <option value="1">Aktif</option>    
                                                    <option value="0">Non-Aktif</option>
                                                  </select>
                                                  @endif
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputFile">Input Foto<span class="required">*</span> </label>
                                                  <div class="input-group">
                                                      <div class="custom-file">
                                                          @foreach($picture as $pic)
                                                          @if($pic->id_produk==$p->id)
                                                          <input type="file" value="{{$pic->url_photo}}" class="custom-file-input" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
                                                          <label class="custom-file-label" for="exampleInputFile">{{ $pic->file_name }}</label>
                                                          @endif
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="exampleInputPassword1">Deskripsi Produk</label>
                                                  <textarea class="form-control" id="keterangan" name="keterangan">{{$p->keterangan}}</textarea>
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
                        
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#foto-produk{{$p->id}}"><i class="nav-icon fas fa-image" ></i></button>
                        <!-- /.modal Foto -->
                        <div class="modal fade" id="foto-produk{{$p->id}}">
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
                                            @foreach($picture as $pc)
                                              @if($pc->id_produk == $p->id)
                                              <img src="{{ asset($pc->url_photo) }}" style="width:250px; height:250px;">
                                              @endif
                                            @endforeach
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <!-- /.modal -->
                        <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-produk"><i class="nav-icon fas fa-trash" ></i></button> -->
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
                                <select class="form-control" required name="id_kategori">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Kode Barang <span class="required">*</span></label>
                                <input type="text" class="form-control" required id="kode_barang" name="kode_barang" placeholder="Masukkan Kode Barang">
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
                                <label for="exampleInputPassword1">Berat <span class="required">*</span></label>
                                <input type="text" class="form-control" min="0" required id="berat" name="berat" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Diskon <span class="required"></span></label>
                                <input type="text" class="form-control" min="0" id="diskon" name="diskon" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label>Status Diskon <span class="required">*</span></label>
                                <select class="form-control" required name="status_diskon">
                                  <option value="0">Non-Aktif</option>    
                                  <option value="1">Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Input Foto<span class="required">*</span> </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="image" accept="image/png, image/jpg, image/jpeg">
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
