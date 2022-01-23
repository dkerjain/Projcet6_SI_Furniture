  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{asset('image/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI Furniture</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="/index" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Data Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dataJabatan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Jabatan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/dataPegawai" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pegawai</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/dataKategori" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ketegori Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/dataBarang" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang</p>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="nav-item">
              <a href="/pemeriksaan" class="nav-link">
                <i class="nav-icon fas fa-eye"></i>
                <p>
                  Pemeriksaan
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/pemesanan" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Pemesanan
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="/penjualan" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Penjualan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pembayaran" class="nav-link">
                <i class="nav-icon fas fa-calculator"></i>
                <p>
                  Pembayaran
                </p>
              </a>
            </li>
          
            <li class="nav-header">Akun</li>
            <li class="nav-item">
              <a href="/profile" class="nav-link btn-info">
                <i class="nav-icon fas fa-user"></i>
                <p>Edit Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/logoutCek" class="nav-link btn-secondary">
                <i class="nav-icon fas fa-power-off"></i>
                <p>Logout Akun</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>