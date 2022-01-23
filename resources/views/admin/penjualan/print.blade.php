@extends('admin.layout.master')
@section('title') Penjualan @endsection
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
            <a href="{{route('admin.order')}}">
              <i class="material-icons text-success">arrow_back</i>
            </a>
          </div>
          <div class="col-md-8 col-10 no-padding">
            <h4 class="my-1 text-success font-weight-bold">Print Nota</h4>
            <p class="my-1">Tampilan nota yang akan di print</p>
          </div>
          <div class="col-md-3 col-12">
            <a href="{{route('admin.order.download',['id'=>$order->id])}}" type="button" class="btn btn-success btn-block" name="button"><i class="material-icons mr-2">get_app</i>Download Nota</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="mx-md-3 my-3">
          <iframe src="{{route('admin.order.print.view',['id'=>$order->id])}}" style="width:100%; height:80vh;" frameBorder="0"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $("#penjualan").addClass("active");
</script>
@endsection
