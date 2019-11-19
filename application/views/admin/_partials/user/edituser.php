<?php 
  if ($this->session->flashdata('success'))
  {
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success - </strong> Data Login berhasil di-<b>UBAH</b>.
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
    <strong>Peringatan - </strong> Nama username <b>SUDAH ADA</b>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
  }
?>

<form action="<?php base_url('admin/users/edit') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Edit User <?= $this->session->userdata('site_name') ?></h6>
    </div>
    <div class="card-body">
      <div class="row">

        <input type="hidden" name="id" value="<?= $user->id ?>">
        <input type="hidden" name="idtoko" value="<?= $user->idtoko ?>">
        <input type="hidden" name="pass" value="<?= $user->pass ?>">

        <div class="col-md-6">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?= $user->uname ?>" required name="uname" style="text-transform: lowercase;" placeholder="Masukkan username anda">
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