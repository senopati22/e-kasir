<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('admin/overview') ?>">
    <div class="sidebar-brand-icon">
      <i class="fas fa-store-alt"></i>
    </div>
    <div class="sidebar-brand-text mx-3 mt-4" style="text-align: center;">
      <p><?= $this->session->userdata('site_name') ?></p>
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <li class="nav-item <?php echo $this->uri->segment(2) == 'overview' ? 'active': '' ?>">
    <a class="nav-link" href="<?php echo site_url('admin/overview') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-item <?php echo $this->uri->segment(2) == 'jenis' ? 'active': '' ?> <?php echo $this->uri->segment(2) == 'supplier' ? 'active': '' ?> <?php echo $this->uri->segment(2) == 'barang' ? 'active': '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-sliders-h fa-fw"></i>
      <span>Master Barang</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu:</h6>
        <a class="collapse-item <?php echo $this->uri->segment(2) == 'jenis' ? 'active': '' ?>" href="<?php echo site_url('admin/jenis') ?>">Data jenis barang</a>
        <a class="collapse-item <?php echo $this->uri->segment(2) == 'supplier' ? 'active': '' ?>" href="<?php echo site_url('admin/supplier') ?>">Data supplier</a>
        <a class="collapse-item <?php echo $this->uri->segment(2) == 'barang' ? 'active': '' ?>" href="<?php echo site_url('admin/barang') ?>">Data barang</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?php echo $this->uri->segment(2) == 'barang_laku' ? 'active': '' ?>">
    <a class="nav-link" href="<?php echo site_url('admin/barang_laku') ?>">
      <i class="fas fa-cash-register"></i>
      <span>Entry Penjualan</span>
    </a>
  </li>

  <li class="nav-item <?php echo $this->uri->segment(2) == 'grafik' ? 'active': '' ?>">
    <a class="nav-link" href="<?php echo site_url('admin/grafik') ?>">
      <i class="fas fa-chart-bar"></i>
      <span>Laporan Grafik</span>
    </a>
  </li>

  <?php
    if ($this->session->userdata('level') == "Admin")
    {
      ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <div class="sidebar-heading">
        <i class="fas fa-cogs"></i> Setting
      </div>
      
      <li class="nav-item <?php echo $this->uri->segment(2) == 'users' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin/users') ?>">
          <i class="fas fa-user-cog"></i>
          <span>User</span>
        </a>
      </li>

      <li class="nav-item <?php echo $this->uri->segment(2) == 'toko' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin/toko') ?>">
          <i class="fas fa-store-alt"></i>
          <span>Toko / Perusahaan</span>
        </a>
      </li>
      <?php
    }
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>