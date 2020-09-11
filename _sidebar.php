      <!-- Sidebar -->
<ul class="navbar-nav gradient-deepblue sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= url('index.php') ?>">
    <div class="sidebar-brand-icon">
      <img src="<?= url('assets/img/dryer.png') ?>" style="width: 50px;" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">APLAUN</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?php if($page == 'dashboard'){ echo 'active';} ?>">
    <a class="nav-link" href="<?= url('index.php') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <?php if($_SESSION['level'] != 'owner') : ?>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Transaksi
  </div>
  <li class="nav-item <?php if($page == 'transaksi'){ echo 'active';} ?>">
      <a class="nav-link" href="<?= url('transaksi/transaksi.php')?>">
          <i class="fas fa-fw fa-money-bill-wave"></i>
          <span>Transaksi</span>
      </a>
  </li>
  <?php endif; ?>
  <?php if($_SESSION['level'] != 'owner') : ?>
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Data
  </div>
  <?php endif; ?>
  <?php if($_SESSION['level'] == 'admin') : ?>
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item <?php if($page == 'outlet'){ echo 'active';} ?>">
      <a class="nav-link" href="<?= url('outlet/outlet.php')?>">
          <i class="fas fa-fw fa-store-alt"></i>
          <span>Outlet</span>
      </a>
  </li>
  <li class="nav-item <?php if($page == 'paket'){ echo 'active';} ?>">
      <a class="nav-link" href="<?= url('paket/paket.php')?>">
          <i class="fas fa-fw fa-box"></i>
          <span>Paket</span>
      </a> 
  </li>
  <?php endif; ?>
  <?php if($_SESSION['level'] != 'owner') : ?>
  <li class="nav-item <?php if($page == 'pelanggan'){ echo 'active';} ?>">  
      <a class="nav-link" href="<?= url('pelanggan/pelanggan.php')?>">
          <i class="fas fa-fw fa-user"></i>
          <span>Pelanggan</span>
      </a>
  </li>
  <?php endif; ?>
  <?php if($_SESSION['level'] == 'admin') : ?>
  <li class="nav-item <?php if($page == 'users'){ echo 'active';} ?>">
      <a class="nav-link" href="<?= url('users/user.php')?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
      </a>
  </li>
  <?php endif; ?>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Report
  </div>
  <li class="nav-item <?php if($page == 'laporan'){ echo 'active';} ?>">
      <a class="nav-link" href="<?= url('laporan/laporan.php')?>">
          <i class="fas fa-fw fa-print"></i>
          <span>Laporan</span>
      </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <!-- Nav Item - Search Dropdown (Visible Only XS) -->
      <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
          <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>      

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-skyline small" style="text-transform: uppercase;"><?= $_SESSION['user'] ?></span>
          <div class="topbar-divider d-none d-sm-block"></div>
          <span class="mr-2 d-none d-lg-inline text-orange small" style="text-transform: uppercase;"><?= $_SESSION['level'] ?></span>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->
