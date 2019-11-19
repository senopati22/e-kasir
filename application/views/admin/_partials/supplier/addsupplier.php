<?php 
  if ($this->session->flashdata('success'))
  {
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success - </strong> Data Supplier berhasil di-<b>TAMBAH</b>.
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
    <strong>Peringatan - </strong> Data Supplier <b>SUDAH ADA</b>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
  }
?>

<form action="<?php base_url('admin/supplier/add') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Tambah Supplier</h6>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" class="form-control" required name="nama" style="text-transform: uppercase;" autocomplete="off" placeholder="Masukkan nama supplier">
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" required name="alamat" placeholder="Masukkan alamat supplier" cols="30" rows="4"></textarea>
          </div>

          <div class="form-group">
            <label>No. Telp (Kantor)</label>
            <input type="text" class="form-control telpkantor" name="telp" autocomplete="off" placeholder="Masukkan no telp kantor supplier">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>E-Mail</label>
            <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Masukkan email supplier">
          </div>

          <div class="form-group">
            <label>No. Whatsapp</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-whatsapp" style="color: green;"></i></span>
              </div>
              <input type="text" class="form-control nowh" name="nowa" autocomplete="off" placeholder="Masukkan no telp kantor supplier">
            </div>            
          </div>
        </div>

      </div>
    </div>

    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary btn-icon-split pull-right">
        <span class="icon text-white-50">
          <i class="fa fa-save"></i>
        </span>
        <span class="text">Simpan Data</span>
      </button>
      <a href="<?= site_url('admin/supplier') ?>">
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