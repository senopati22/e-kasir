<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success - </strong>Data Barang Terjual berhasil di-<b>TAMBAH</b>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Peringatan - </strong>Maaf, Stok barang <b>tidak mencukupi</b>!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<form action="<?php base_url('admin/barang_laku/add') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-success">Tambah Data Terjual</h6>
    </div>
    <div class="card-body">
      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal</label>
            <?php
              if ($this->session->userdata('level') != "Admin")
              {
                ?>
                <input type="text" class="form-control" required name="tanggal" readonly autocomplete="off" value="<?= date('Y/m/d') ?>" style="width: 30%; cursor: not-allowed;">
                <?php
              }
              else
              {
                ?>
                <input type="text" class="form-control" required name="tanggal" autocomplete="off" id="datetimepicker1" placeholder="Masukkan Tanggal" style="width: 30%;">
                <?php
              }
            ?>
          </div>

          <div class="form-group">
            <label>Nama Barang</label>
            <!-- <input type="text" list="data_barang" name="nama" id="nama" class="form-control" required autocomplete="off" placeholder="Masukkan Nama Barang" onchange="return autofill();"> -->

            <select class="custom-select form-control selectpicker show-menu-arrow show-tick" autocomplete="off" data-size="6" data-header="Silahkan pilih nama barang" data-live-search="true" name="nama" id="nama" onchange="return autofill();">
              <option value="">--- Nama ---</option>
              <?php
                function formatAngka($angka)
                {
                  $hasil = number_format($angka, 0, '.', '.');
                  return $hasil;
                }
                $q = $this->db->query("SELECT * from barang")->result();
                foreach($q as $qq)
                {
                  ?>
                  <option value="<?= $qq->nama ?>" data-subtext="Rp. <?= formatAngka($qq->harga) ?> - Sisa stok <?= $qq->jumlah ?>" <?php if($qq->jumlah <= 0){echo"disabled";} ?>><?= $qq->nama ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Harga</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp.</span>
              </div>
              <input type="text" class="form-control" id="harga" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" readonly style="cursor: not-allowed;" required name="harga" placeholder="Masukkan Harga">
            </div>
          </div>

          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" onkeydown="return numbersonly(this, event);" required name="jumlah" id="jumlah" autocomplete="off" placeholder="Masukkan Jumlah">
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
      <a href="<?= site_url('admin/barang_laku') ?>">
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

<datalist id="data_barang">
    <?php
    $rr = $this->db->query("SELECT * from barang")->result();
    foreach ($rr as $b)
    {
        echo "<option value='$b->nama'>$b->harga - Jumlah stok $b->jumlah</option>";
    }
    ?>
    
</datalist>
<script>
  function autofill()
  {
    var nama = document.getElementById('nama').value;
    $.ajax({
      url:"<?php echo base_url();?>admin/barang_laku/cari",
      data:'&nama='+nama,
      success:function(data)
      {
        var hasil = JSON.parse(data);  
        
        $.each(hasil, function(key,val)
        { 
      
          document.getElementById('nama').value = val.nama;
          document.getElementById('harga').value = tandaPemisahTitik(val.harga);
          document.getElementById('jumlah').value = tandaPemisahTitik(val.jumlah);	
        });
      }
    });          
  }
</script>