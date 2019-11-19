<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success - </strong> Data Dinas Untuk Satuan Kerja <?= $this->session->userdata('nmsatker') ?> berhasil diedit.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<form action="<?php base_url('admin/dinas/edit') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Edit Dinas Untuk Satuan Kerja <?= $this->session->userdata('nmsatker') ?></h6>
    </div>
    <div class="card-body">
      <div class="row">

        <input type="hidden" name="iddinas" value="<?= $dinas->iddinas ?>">
        <div class="col-md-6">
          <div class="form-group">
            <label>Nama Dinas</label>
            <input type="text" class="form-control" value="<?= $dinas->namadinas ?>" required autocomplete="off" name="namadinas" placeholder="Masukkan Nama Dinas">
          </div>
        </div>
        
        <input type="hidden" name="idsatker" value="<?= $this->session->userdata('idsatker') ?>">

      </div>
    </div>

    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary btn-icon-split pull-right">
        <span class="icon text-white-50">
          <i class="fa fa-save"></i>
        </span>
        <span class="text">Edit Dinas</span>
      </button>
      <a href="<?= site_url('admin/dinas') ?>">
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