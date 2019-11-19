<?php 
  if ($this->session->flashdata('success'))
  {
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success - </strong> Data Login berhasil di-<b>TAMBAH</b>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php 
  }
  else if($this->session->flashdata('error'))
  {
?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Peringatan - </strong> Username <b>SUDAH ADA</b>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
  }
?>

<form action="<?php base_url('admin/users/add') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Tambah User <?= $this->session->userdata('site_name') ?></h6>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" required name="uname" style="text-transform: lowercase;" placeholder="Masukkan Username anda">
            <input type="hidden" name="idtoko" value="<?= $this->session->userdata('idtoko') ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" required name="pass" placeholder="Masukkan password anda">
          </div>
        </div>

      </div>
    </div>

    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary btn-icon-split pull-right">
        <span class="icon text-white-50">
          <i class="fa fa-save"></i>
        </span>
        <span class="text">Simpan User</span>
      </button>
      <a href="<?= site_url('admin/users') ?>">
        <button type="button" class="btn btn-warning btn-icon-split pull-left">
          <span class="icon text-white-50">
            <i class="fa fa-reply"></i>
          </span>
          <span class="text">Kembali</span>
        </button>
      </a>
    </div>
  </div>
</form>