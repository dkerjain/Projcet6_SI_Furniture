<div class="logo">
  <a href="{{route('admin.dashboard')}}" class="simple-text logo-normal">
    <img src="{{asset('image/logo.png')}}" style="max-width:80%">
  </a>
</div>
<div class="sidebar-wrapper">
  <ul class="nav">
    <li class="nav-item" id="dashboard">
      <a class="nav-link" href="{{route('admin.dashboard')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item" id="penjualan">
      <a class="nav-link" href="{{route('admin.order')}}">
        <i class="material-icons">person</i>
        <p>Penjualan</p>
      </a>
    </li>

    
    <li class="nav-item" id="produk">
      <a class="nav-link" href="{{route('admin.produk')}}">
        <i class="material-icons">content_paste</i>
        <p>Produk</p>
      </a>
    </li>
    <li class="nav-item" id="kategori">
      <a class="nav-link" href="{{route('admin.kategori')}}">
        <i class="material-icons">library_books</i>
        <p>Kategori</p>
      </a>
    </li>
    <li class="nav-item" id="brand">
      <a class="nav-link" href="{{route('admin.ukiran')}}">
        <i class="material-icons">bubble_chart</i>
        <p>Ukiran</p>
      </a>
    </li>
  </ul>
</div>
