<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user-tie"></i> Data Supplier</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="<?php echo site_url('admin/supplier/add') ?>">
      <button class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Tambah data supplier</button>
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table display nowrap table-bordered table-hover" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Supplier</th>
            <th>No. Telp</th>
            <th>E-Mail</th>
            <th>No. Whatsapp</th>
            <th>Alamat</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
              foreach($supplier as $tampil_sp):
              ?>
                <tr style="text-align: center;">
                  <td><?= $no++ ?></td>
                  <td><?= $tampil_sp->namasp ?></td>
                  <td><?= $tampil_sp->telp ?></td>
                  <td><a href="mailto:<?= $tampil_sp->email ?>" target="_blank"><?= $tampil_sp->email ?></a></td>
                  <td>
                    <?php
                      if(!empty($tampil_sp->nowa))
                      {
                        ?>
                        <a href="https://api.whatsapp.com/send?phone=<?= $tampil_sp->nowa ?>" target="_blank" style="color: green;">
                          <button type="button" class="btn btn-success"><i class="fa fa-whatsapp"></i> Kirim pesan</button>
                        </a>
                        <?php
                      }
                      else
                      {
                        ?>
                        <button type="button" class="btn btn-danger" disabled style="cursor: not-allowed;"><i class="fab fa-whatsapp"></i> <strike>Kirim pesan</strike></button>
                        <?php
                      }
                    ?>
                    
                  </td>
                  <td><?= $tampil_sp->alamat ?></td>
                  <td width="250" style="text-align: center;">
                    <?php
                      if ($this->session->userdata('level') == "Admin")
                      {
                        ?>
                        <a href="<?php echo site_url('admin/supplier/edit/'.$tampil_sp->idsupplier) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="left" title="Ubah Data"><i class="material-icons">edit</i></a>
                    
                        <?php
                          $cok = 0;
                          $qry = $this->db->query("SELECT * from barang where idsupplier = '$tampil_sp->idsupplier'")->result();
                          foreach ($qry as $key)
                          {
                            $cok = $key->idsupplier;
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
                          <a onclick="deleteConfirm('<?php echo site_url('admin/supplier/delete/'.$tampil_sp->idsupplier) ?>')" data-toggle="tooltip" data-placement="left" title="Hapus" href="#" class="btn btn-small btn-danger btn-circle">
                            <i class="material-icons">delete_outline</i>
                          </a>
                          <?php
                          }
                        ?>
                      </td>
                        <?php
                      }
                      else
                      {
                        echo "-";
                      }
                    ?>
                    
                </tr>
              <?php
              endforeach;
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>