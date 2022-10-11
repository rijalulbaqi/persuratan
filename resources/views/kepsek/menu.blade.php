<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('kepsek')}}" class="brand-link text-center">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text">Arsip Surat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('img/foto/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('kepsek')}}" class="nav-link <?php echo ($active == 1) ? "active" : ""; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('kepsek/pengguna')}}" class="nav-link <?php echo ($active == 2) ? "active" : ""; ?>">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('kepsek/suratmasuk')}}" class="nav-link <?php echo ($active == 3) ? "active" : ""; ?>">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Surat Masuk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('kepsek/suratkeluar')}}" class="nav-link <?php echo ($active == 4) ? "active" : ""; ?>">
              <i class="nav-icon fas fa-inbox"></i>
              <p>
                Surat Keluar
              </p>
            </a>
          </li>
          
          <!-- <li class="nav-header">Praktik Kerja Lapangan</li> -->
          <li class="nav-item">
            <a href="{{url('kepsek/ubahpassword')}}" class="nav-link <?php echo ($active == 5) ? "active" : ""; ?>">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="nav-link">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </form>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>