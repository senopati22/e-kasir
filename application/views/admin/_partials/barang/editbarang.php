<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success - </strong> Data Barang berhasil di-<b>UPDATE</b>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<form action="<?php base_url('admin/barang/edit') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Edit Data Barang</h6>
    </div>
    <div class="card-body">

      <?php
        function formatAngka($angka)
        {
          $hasil = number_format($angka, 0, '.', '.');
          return $hasil;
        }
      ?>

      <input type="hidden" name="id" value="<?= $barang->id ?>">

      <div class="row">
        <div class="col-md-6">

          <!-- NAMA -->
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" value="<?= ucwords($barang->nama) ?>" style="text-transform: capitalize;" class="form-control" required autocomplete="off" name="nama" placeholder="Masukkan Nama Barang">
          </div>

          <!-- JENIS -->
          <div class="form-group">
            <label>Jenis</label>
            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih jenis" data-live-search="true" name="idjenis">
              <option value="">--- Jenis Barang ---</option>
              <?php
                $q = $this->db->query("SELECT * from jenis")->result();
                foreach($q as $qq)
                {
                  ?>
                  <option value="<?= $qq->idjenis ?>" <?php if($qq->namajns == $barang->namajns){echo"selected";} ?>><?= $qq->namajns ?></option>
                  <?php
                }
              ?>
            </select>
          </div>

          <!-- SUPLIER -->
          <div class="form-group">
            <label>Suplier</label>
            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih supplier" data-live-search="true" name="idsupplier">
              <option value="">--- Jenis Barang ---</option>
              <?php
                $q = $this->db->query("SELECT * from supplier")->result();
                foreach($q as $qq)
                {
                  ?>
                  <option value="<?= $qq->idsupplier ?>" <?php if($qq->namasp == $barang->namasp){echo"selected";} ?>><?= $qq->namasp ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        </div>

        <div class="col-md-6">

          <!-- Modal -->
          <div class="form-group">
            <label>Modal</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" autocomplete="off" value="<?= formatAngka($barang->modal) ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required name="modal" placeholder="Masukkan Modal">
            </div>
          </div>

          <!-- HARGA -->
          <div class="form-group">
            <label>Harga</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" autocomplete="off" value="<?= formatAngka($barang->harga) ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required name="harga" placeholder="Masukkan Harga">
            </div>
          </div>

          <!-- PROSES -->
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" value="<?= $barang->jumlah ?>" required name="jumlah" autocomplete="off" placeholder="Masukkan Jumlah" onkeydown="return numbersonly(this, event);">
          </div>

          <input type="hidden" name="sisa" value="<?= $barang->sisa ?>">
        </div>

      </div>
    </div>

    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary btn-icon-split pull-right">
        <span class="icon text-white-50">
          <i class="fa fa-save"></i>
        </span>
        <span class="text">Update Data</span>
      </button>
      <a href="<?= site_url('admin/barang') ?>">
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