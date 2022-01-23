@extends('admin.layout.master')
@section('title') Laporan Penjualan Bulan {{date('F Y')}} @endsection

@section('style')
<style>
.phone-button{
  border-radius: 45px !important;
  padding-left: 10px;
  padding-right: 10px;
}
</style>s
@endsection
@section('content')
<div class="row">
  
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

  <div class="row">
  <div class="col-md-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="row">
          <div class="col-md-9 col-12">
            <h4 class="my-1 text-success font-weight">Nilai Transaksi Bulan {{date ('F Y')}}</h4>
            <h3 class="my-1 text-success font-weight-bold">Rp {{$nilai_transaksi}}</h3> 
          </div>
          <!-- <div class="col-md-3 col-12">
            <a href="" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2">get_app</i>Download Laporan</a>
          </div> -->
        

        </div>
      </div>
    </div>
  </div>
  <!-- search -->
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <!-- <div class="input-group mx-md-2 mt-3">
          <div class="input-group-prepend">
            <span class="input-group-text padding-src">
              <i class="material-icons">search</i>
            </span>
          </div>
          <input type="text" class="form-control mr-4" id="myInput" onkeyup="myFunction()" placeholder="Cari...">
        </div> -->
        <div class="row mx-md-3 mt-3 pt-2">
          <div class="col-12">
            <div class="table-responsive">
              <table id="penjualan-table" class="table" style="overflow-x:auto;">
                <thead class="text-success">
                  <th class="font-weight-normal" style="min-width:60px;"><p class="mb-2 mr-3">No</p></th>
                  <th class="font-weight-normal" style="min-width:140px;"><p class="mb-2 mr-3">Tanggal Pembelian</p></th>
                  <th class="font-weight-normal" style="min-width:120px;"><p class="mb-2 mr-3">Nama Customer</p></th>
                  <th class="font-weight-normal" style="min-width:150px;"><p class="mb-2 mr-3">Nomor Telepon</p></th>
                 <th class="font-weight-normal" style="min-width:80px;"><p class="mb-2 mr-3">Bank</p></th>
                  <th class="font-weight-normal" style="min-width:100px;"><p class="mb-2 mr-3">Harga Produk</p></th>
                  <th class="font-weight-normal" style="min-width:100px;"><p class="mb-2 mr-3">Biaya Pengiriman</p></th>
                  <th class="font-weight-normal" style="min-width:80px;"><p class="mb-2 mr-3">Pembayaran</p></th>
                  <th class="font-weight-normal" style="min-width:80px;"><p class="mb-2 mr-3">Tindakan</p></th>
                  <th class="font-weight-normal" style="min-width:120px;"><p class="mb-2 mr-3">Aksi</p></th>
                </thead>
                <tbody>
                  @for($i=0;$i<count($order);$i++)
                    <tr>
                      <td>{{$i+1}}</td>
                      <td>{{date_format($order[$i]->created_at,"d F Y H:i")}}</td>
                      <td>{{$order[$i]->customer->nama_customer}}</td>
                      <td>
                        <a href="https://api.whatsapp.com/send?phone={{$order[$i]->customer->nomor_telepon}}&text=Hai%20{{$order[$i]->customer->nama_customer}}%20,%20kami%20Bedug%20Langgeng%20Silahkan%20Klik%20link%20untuk%20Melakukan%20Transaksi%20{{route('public.pembayaran',['id'=>$order[$i]])}}" class="btn btn-success btn-sm phone-button"><i class="fa fa-phone mr-2" aria-hidden="true"></i>{{$order[$i]->customer->nomor_telepon}}</a>
                      </td>
                      <td>{{$order[$i]->pembayaran->bank_pembayaran}}</td>
                      <td>Rp {{$order[$i]->biaya_total_produk}}</td>
                      <td>{{$order[$i]->biaya_pengiriman}}</td>
                      @if($order[$i]->pembayaran->status_pembayaran==0)
                      <td><button class="btn btn-sm btn-danger">Belum</button></td>
                      @else
                      <td><button class="btn btn-sm btn-success">Lunas</button></td>
                      @endif

                      @if($order[$i]->status==0)
                      <td><button class="btn btn-sm btn-danger">Sedang di Proses</button></td>
                      @elseif($order[$i]->status==1)
                      <td><button class="btn btn-sm btn-danger">Dalam Pengiriman</button></td>
                      @else
                      <td><button class="btn btn-sm btn-success">Selesai</button></td>
                      @endif

                      <td class="td-actions">
                        <!-- Lihat Foto -->
                        <a type="button" data-toggle="modal" data-target="#foto{{$i}}" rel="tooltip" title="Lihat Foto" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">insert_photo</i>
                        </a>
                        <!--Print Nota -->
                        <a href="{{route('admin.order.print',['id'=>$order[$i]->id])}}" type="button" rel="tooltip" title="Print Nota" class="btn btn-success btn-link btn-sm">
                          <i class="material-icons">print</i>
                        </a>
                        <!-- edit order -->
                        <a href="{{route('admin.order.edit',['id'=>$order[$i]->id])}}" type="button" rel="tooltip" title="Edit Nota" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </a>
                        <!-- hapus order -->
                        <!--<button type="button" data-toggle="modal" data-target="#delete{{$i}}" rel="tooltip" title="Hapus Nota" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>-->
                        </button>
                      </td>
                      <!-- modal foto -->
                      <div class="modal fade" id="foto{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row mb-3">
                                <div class="col-md-8 col-8">
                                  <h5 class="modal-title mt-2">Bukti Transfer</h5>
                                </div>
                                <div class="col-md-4 col-4">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12" align="center">
                                  <img src="{{asset($order[$i]->pembayaran->bukti_pembayaran)}}" class="w-50" alt="">
                                </div>
                              </div>
                              <div align="right">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Tutup</button>
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
                                  <h5 class="modal-title mt-2">Hapus Nota</h5>
                                </div>
                                <div class="col-md-4 col-4">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-12">
                                  <form id="deletenota{{$i}}" action="{{ route('admin.order.destroy',['id'=>$order[$i]->id]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  <p class="mb-1">Apakah anda yakin menghapus Nota ini ?</p>
                                </form>
                                </div>
                              </div>
                              <div align="right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" form="deletenota{{$i}}" class="btn btn-danger">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
         
      </div>
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
  $("#penjualan").addClass("active");
  $('#penjualan-table').DataTable();
</script>
@endsection
