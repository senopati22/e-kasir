<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success - </strong> Nama toko / perusahaan berhasil di-<b>UPDATE</b>. <small>*Jika ingin melihat perubahannya, logout terlebih dahulu dan login kembali</small>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<form action="" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Edit Toko / Perusahaan</h6>
    </div>
    <div class="card-body">

      <?php
        $idtoko     = $this->session->userdata('idtoko');
        $site_name  = $this->session->userdata('site_name');
        $alamat     = $this->session->userdata('alamat');
        $kota       = $this->session->userdata('kota');
        $prov       = $this->session->userdata('prov');
        $telp       = $this->session->userdata('telp');
        $foto       = $this->session->userdata('foto');
      ?>

      <input type="hidden" name="idtoko" value="<?= $idtoko ?>">

      <div class="row">
        <div class="col-md-6">

          <!-- NAMA -->
          <div class="form-group">
            <label>Nama Toko / Perusahaan</label>
            <input type="text" value="<?= strtoupper($site_name) ?>" style="text-transform: uppercase;" class="form-control" required autocomplete="off" name="site_name" placeholder="Masukkan Nama Toko / Perusahaan">
          </div>

          <!-- PROVINSI -->
          <div class="form-group">
            <label>Nama Provinsi</label>
            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih supplier" data-live-search="true" name="prov" required>
              <option value="">--- Provinsi ---</option>
              <?php
                $qq = $this->db->query("SELECT * from provinces")->result();
                foreach($qq as $qw)
                {
                  ?>
                  <option value="<?= $qw->id ?>" <?php if($qw->id == $prov){echo "selected";} ?>><?= $qw->name ?></option>
                  <?php
                }
              ?>
            </select>
          </div>

          <!-- KOTA -->
          <div class="form-group">
            <label>Nama Kota</label>
            <input type="text" value="<?= ucwords($kota) ?>" style="text-transform: capitalize;" class="form-control" required autocomplete="off" name="kota" placeholder="Masukkan Nama Kota">
          </div>

          <!-- ALAMAT -->
          <div class="form-group">
            <label>Alamat Toko / Perusahaan</label>
            <input type="text" value="<?= ucwords($alamat) ?>" style="text-transform: capitalize;" class="form-control" required autocomplete="off" name="alamat" placeholder="Masukkan Alamat Toko / Perusahaan">
          </div>

          <!-- NO TELP -->
          <div class="form-group">
            <label>No. Telp</label>
            <input type="text" value="<?= $telp ?>" class="form-control notelp" required autocomplete="off" name="telp" placeholder="Masukkan No. Telp">
          </div>

        </div>

        <div class="col-md-6">

          <div class="form-group">
            <label>Upload Logo Toko</label>
            <div class="custom-file">
              <input style="cursor: pointer;" type="file" id="gambarpreview1" class="custom-file-input" id="customFile" name="foto" accept="image/*">
              <input type="hidden" name="foto1" value="<?= $foto ?>">
              <label class="custom-file-label" for="customFile"><?= $foto ?></label>
            </div>
            <img id="gambarpreview" style="width: 750px; height: 420px; margin-top: 10px;" src="<?php echo base_url('upload/logotoko/'.$foto) ?>" class="img-thumbnail rounded" alt="Foto Toko">
            <small>*Logo Toko</small>
          </div>
          
        </div>

      </div>
    </div>

    <div class="card-footer">
      <button type="submit" name="submit" class="btn btn-primary btn-icon-split pull-right">
        <span class="icon text-white-50">
          <i class="fa fa-save"></i>
        </span>
        <span class="text">Update Toko</span>
      </button>
    </div>
  </div>
</form>