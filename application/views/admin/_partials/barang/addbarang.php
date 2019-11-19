<?php 
  if ($this->session->flashdata('success'))
  {
?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success - </strong> Data Barang berhasil di-<b>TAMBAH</b>.
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
    <strong>Peringatan - </strong> Data Barang <b>SUDAH ADA</b>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
  }
?>

<form action="<?php base_url('admin/barang/add') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Tambah Data Barang</h6>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-md-6">

          <!-- SUPLIER -->
          <div class="form-group">
            <label>Suplier</label>
            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih supplier" data-live-search="true" name="idsupplier" id="idsupplier" onchange="return autofill();">
              <option value="">--- Supplier ---</option>
              <?php
                $q = $this->db->query("SELECT * from supplier")->result();
                foreach($q as $qq)
                {
                  ?>
                  <option value="<?= $qq->idsupplier ?>"><?= $qq->namasp ?></option>
                  <?php
                }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Alamat Supplier</label>
            <textarea type="text" disabled style="cursor: not-allowed;" class="form-control" required id="alamat" autocomplete="off" rows="5"></textarea>
          </div>
          
          <div class="form-group">
            <label>No. Telp Supplier</label>
            <input type="text" disabled style="cursor: not-allowed;" class="form-control" id="telp" autocomplete="off">
          </div>

          <div class="form-group">
            <label>E-Mail supplier</label>
            <input type="text" disabled style="cursor: not-allowed;" class="form-control" id="email" autocomplete="off">
          </div>
          
        </div>

        <div class="col-md-6">

          <!-- NAMA -->
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" style="text-transform: capitalize;" required autocomplete="off" name="nama" placeholder="Masukkan Nama Barang">
          </div>

          <!-- JENIS -->
          <div class="form-group">
            <label>Jenis</label>
            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih jenis" data-live-search="true" name="idjenis" onchange="return autofill();">
              <option value="">--- Jenis Barang ---</option>
              <?php
                $q = $this->db->query("SELECT * from jenis")->result();
                foreach($q as $qq)
                {
                  ?>
                  <option value="<?= $qq->idjenis ?>"><?= $qq->namajns ?></option>
                  <?php
                }
              ?>
            </select>
          </div>

          <!-- Modal -->
          <div class="form-group">
            <label>Modal</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" autocomplete="off" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required name="modal" placeholder="Masukkan Modal">
            </div>
          </div>

          <!-- HARGA -->
          <div class="form-group">
            <label>Harga</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" autocomplete="off" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" required name="harga" placeholder="Masukkan Harga">
            </div>
          </div>

          <!-- PROSES -->
          <div class="form-group">
            <label>Jumlah / Stok Barang</label>
            <input type="text" class="form-control" required name="jumlah" onkeydown="return numbersonly(this, event);" autocomplete="off" placeholder="Masukkan Jumlah">
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

<script>
  function autofill()
  {
    var idsupplier = document.getElementById('idsupplier').value;
    $.ajax({
      url:"<?php echo base_url();?>admin/barang/cari",
      data:'&idsupplier='+idsupplier,
      success:function(data)
      {
        var hasil = JSON.parse(data);  
        
        $.each(hasil, function(key,val)
        {      
          document.getElementById('idsupplier').value = val.idsupplier;
          document.getElementById('alamat').value = val.alamat;
          document.getElementById('telp').value = val.telp;
          document.getElementById('email').value = val.email;
        });
      }
    });          
  }
</script>