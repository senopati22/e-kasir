<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-box"></i> Data BARANG</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="<?php echo site_url('admin/barang/add') ?>">
      <button class="pull-right btn btn-primary"><i class="fas fa-plus"></i> Tambah data Barang</button>
    </a>
    <a target="_blank" href="<?= base_url('admin/barang/printbarang') ?>">
      <button type="button" class="btn btn-info"><i class="fas fa-print"></i> Cetak data barang</button>
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table display nowrap table-bordered table-hover" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Jumlah Stok</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            function formatAngka($angka)
            {
              $hasil = number_format($angka, 0, '.', '.');
              return $hasil;
            }
              foreach($barang as $tampil_brg):
              ?>
                <tr style="text-align: center;">
                  <td <?php if($tampil_brg->jumlah <= 3){echo 'style="color: red;"';} ?>><?= $no++ ?></td>
                  <td <?php if($tampil_brg->jumlah <= 3){echo 'style="color: red;"';} ?>><?= $tampil_brg->nama ?></td>
                  <td <?php if($tampil_brg->jumlah <= 3){echo 'style="color: red;"';} ?>>Rp. <?= number_format_short($tampil_brg->harga) ?></td>
                  <td <?php if($tampil_brg->jumlah <= 3){echo 'style="color: red;"';} ?>><?= formatAngka($tampil_brg->jumlah) ?></td>
                  <td width="250" style="text-align: center;">
                    <?php
                      if ($this->session->userdata('level') == "Admin")
                      {
                        ?>
                        <a href="<?php echo site_url('admin/barang/edit/'.$tampil_brg->id) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah Data"><i class="material-icons">edit</i></a>
                        <a onclick="deleteConfirm('<?php echo site_url('admin/barang/delete/'.$tampil_brg->id) ?>')" data-toggle="tooltip" data-placement="left" title="Hapus Data" href="#" class="btn btn-small btn-danger btn-circle"><i class="material-icons">delete_outline</i></a>
                        <?php
                      }
                    ?>
                    
                    <a data-toggle="modal" data-target="#modal_brg<?= $tampil_brg->id ?>" href="#" data-placement="left" title="Lihat Detail" class="btn btn-small btn-info btn-circle"><i class="material-icons">info</i></a>                      
                  </td>
                </tr>
              <?php
              endforeach;
            ?>
        </tbody>
        <tfoot>
          <tr>
            <td>Total Modal</td>
            <td colspan="4" style="text-align: center;">
              <?php
              $qu = $this->db->query("SELECT sum(modal) as total from barang")->result();
              foreach($qu as $qq)
              {
                echo "<b>Rp. ".formatAngka($qq->total).",-</b>";
              }
              ?>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php
foreach($barang as $tampil_brg):
?>
<!-- Lihat Detail(barang) -->
<div class="modal fade" id="modal_brg<?= $tampil_brg->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" role="document">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-briefcase"></i> Data Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <h4 style="text-align: center; text-transform: uppercase;">
          <?= $tampil_brg->nama ?><br><small>(Rp. <?= formatAngka($tampil_brg->harga) ?>)</small>
        </h4>
        <div class="table-responsive">
          <table align="center" style="width: 100%;" class="table nowrap table-bordered table-striped table-hover">
            <tr>
              <td>Nama</td><td><?= $tampil_brg->nama ?></td>
            </tr>
            <tr>
              <td>Jenis</td><td><?= $tampil_brg->namajns ?></td>
            </tr>
            <tr>
              <td>Suplier</td><td><?= $tampil_brg->namasp ?></td>
            </tr>
            <tr>
              <td>Modal</td><td>Rp. <?= formatAngka($tampil_brg->modal) ?></td>
            </tr>
            <tr>
              <td>Harga</td><td>Rp. <?= formatAngka($tampil_brg->harga) ?></td>
            </tr>
            <tr>
              <td>Jumlah</td><td><?= $tampil_brg->jumlah ?></td>
            </tr>
            <tr>
              <td>Sisa</td><td><?= $tampil_brg->sisa ?></td>
            </tr>            
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class="fa fa-reply"></i> Kembali</button>
        <?php
          if($this->session->userdata('level') == "Admin")
          {
            ?>
            <a style="text-align: center;" onclick="deleteConfirm('<?php echo site_url('admin/barang/delete/'.$tampil_brg->id) ?>')" href="#" class="btn btn-small btn-danger"><i class="fa fa-trash"></i> Hapus Data</a>
            <a href="<?php echo site_url('admin/barang/edit/'.$tampil_brg->id) ?>">
              <button class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Edit</button>
            </a>
            <?php
          }
        ?>
        

      </div>
    </div>
  </div>
</div>
<?php
endforeach;
?>