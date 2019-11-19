<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-file-signature"></i> Data Jenis Barang</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="<?php echo site_url('admin/jenis/add') ?>">
      <button class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Tambah data jenis Barang</button>
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table display nowrap table-bordered table-hover" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Jenis</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
              foreach($jenis as $tampil_jns):
              ?>
                <tr style="text-align: center;">
                  <td><?= $no++ ?></td>
                  <td><?= $tampil_jns->namajns ?></td>
                  <td width="250" style="text-align: center;">
                    <?php
                      if ($this->session->userdata('level') == "Admin")
                      {
                        ?>

                        <a href="<?php echo site_url('admin/jenis/edit/'.$tampil_jns->idjenis) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah Data"><i class="material-icons">edit</i></a>
                    
                        <?php
                          $cok = 0;
                          $qry = $this->db->query("SELECT * from barang where idjenis = '$tampil_jns->idjenis'")->result();
                          foreach ($qry as $key)
                          {
                            $cok = $key->idjenis;
                          }
                          if ($cok > 1)
                          {
                          ?>
                          <a href="#" onclick="swal('Ups, Terjadi Kesalahan!', 'Maaf data yang Anda pilih tidak bisa dihapus karena data saat ini masih dipakai oleh sistem. Terimakasih', 'error')" data-toggle="tooltip" data-placement="left" title="Hapus" class="btn btn-small btn-danger btn-circle">
                            <i class="material-icons">delete_outline</i>
                          </a>
                          <?php
                          }
                          else
                          {
                          ?>
                          <a onclick="deleteConfirm('<?php echo site_url('admin/jenis/delete/'.$tampil_jns->idjenis) ?>')" data-toggle="tooltip" data-placement="left" title="Hapus" href="#" class="btn btn-small btn-danger btn-circle">
                            <i class="material-icons">delete_outline</i>
                          </a>
                          <?php
                          }
                        ?>

                        <?php
                      }
                      else
                      {
                        echo "-";
                      }
                    ?>
                    
                  </td>
                </tr>
              <?php
              endforeach;
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>