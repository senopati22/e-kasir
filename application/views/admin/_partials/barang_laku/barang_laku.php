<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><i class="fas fa-cash-register"></i> Data Barang Terjual</h1>
<?php
$t1 = 0; $t2 = 0; $t3 = 0;
if(!empty($_POST['t1']) || !empty($_POST['t2']))
{
  $t1 = $_POST['t1'];
  $t2 = $_POST['t2'];
}

$bln = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September', 'Oktober','Nopember','Desember');
if($t2%4==0){
  $j = 29;
}else{
  $j = 28;
}
//echo $t1.$t2;
$jh   = array(0,31,$j,31,30,31,30,31,31,30,31,30,31);
?>

<form action="" method="post" enctype="multipart/form-data" style="margin-bottom: 10px;">

  <div class="row">
    <div class="col-3">
      <select class="custom-select form-control selectpicker show-menu-arrow show-tick" data-size="6" data-style="btn-info" data-header="Silahkan pilih bulan" name="t1" onchange="submit()">
        <?php
          echo"<option value='0'>--- SEMUA BULAN ---</option>";
          for($a=1;$a<=12;$a++){
            echo"<option value='$a'"; if($a==$t1)echo"selected";else echo""; echo">".$bln[$a]."</option>";
          }
        ?>
      </select>
    </div>
    <div class="col-3">
      <select class="custom-select form-control selectpicker show-menu-arrow show-tick" data-size="6" data-style="btn-info" data-header="Silahkan pilih tahun" name="t2" onchange="submit()">
        <?php 
          echo"<option value='0'>--- SEMUA TAHUN ---</option>";
          if(!empty($t1))
          {
            $whr = " where month(tanggal) = '$t1'";
          }
          else
          {
            $whr = "";
          }
          $sq = $this->db->query("SELECT tanggal from barang_laku $whr group by year(tanggal)")->result();
          foreach($sq as $sw)
          {
            $data = explode('-', $sw->tanggal);
            $thn = $data[0];
            echo "<option value='$thn'"; if($thn == $t2) echo "selected"; else echo""; echo ">$thn</option>";
          }
          // $mulai = date('Y') - 7;
          // for($i=$mulai; $i<=date('Y') + 7; $i++)
          // {
          //     echo"<option value='$i'"; if($i==$t2) echo"selected"; else echo""; echo">$i</option>";
          // }
        ?>
      </select>
    </div>
    
  </div>

</form>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="<?php echo site_url('admin/barang_laku/add') ?>">
      <button class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Entry Data</button>
    </a>
    <a target="_blank" href="<?= base_url('admin/barang_laku/printbarang_laku/'.$t1.'/'.$t2.'/') ?>">
      <button type="button" class="btn btn-info"><i class="fa fa-print"></i> Cetak data barang</button>
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table display nowrap table-bordered table-hover" id="example" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Harga Terjual /pcs</th>
            <th>Total Harga</th>
            <th>Jumlah</th>
            <th>Laba</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1; $wh = "";
            if(!empty($t1) && empty($t2))
            {
              $wh = " where month(tanggal) ='$t1'";
            }
            elseif(empty($t1) && !empty($t2))
            {
              $wh = " where year(tanggal) ='$t2'";
            }
            elseif(!empty($t1) && !empty($t2))
            {
              $wh = " where tanggal between '$t2-$t1-1' AND '$t2-$t1-$jh[$t1]'";
            }
            $q = $this->db->query("SELECT * from barang_laku $wh order by tanggal desc")->result();
            foreach($q as $brg_laku):
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= indonesian_date($brg_laku->tanggal, 'l, d F Y') ?></td>
              <td><?= $brg_laku->nama ?></td>
              <td><?= number_format_short($brg_laku->harga) ?></td>
              <td><?= number_format_short($brg_laku->total_harga) ?></td>
              <td><?= $brg_laku->jumlah ?></td>
              <td><?= number_format_short($brg_laku->laba) ?></td>
              
              <td width="250" style="text-align: center;">
                <?php
                  if ($this->session->userdata('level') == "Admin")
                  {
                    ?>
                    <a onclick="deleteConfirm('<?php echo site_url('admin/barang_laku/delete/'.$brg_laku->id) ?>')" data-toggle="tooltip" data-placement="left" title="Hapus Data" href="#" class="btn btn-small btn-danger btn-circle"><i class="material-icons">delete_outline</i></a>
                    <?php
                  }
                  else
                  {
                    echo "-";
                  }
                ?>
                
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4">Total Pemasukan</td>
            <td style="text-align: center;">
              <?php
                function formatAngka($angka)
                {
                  $hasil = number_format($angka, 0, '.', '.');
                  return $hasil;
                }
                if(!empty($t1) && empty($t2)) //bulan
                {
                  for($i = 0; $i < 12; $i++)
                  {
                    $qq = $this->db->query("SELECT SUM(total_harga) as jumlah from barang_laku where month(tanggal) = '$t1'")->result();
                  }
                    foreach($qq as $qw)
                    {
                        echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                    }
                }
                else if(empty($t1) && !empty($t2)) //tahun
                {
                  $qq = $this->db->query("SELECT SUM(total_harga) as jumlah from barang_laku where year(tanggal) = '$t2'")->result();
                  foreach($qq as $qw)
                  {
                      echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                  }
                }
                else if(!empty($_POST['t1']) && !empty($_POST['t2']))
                {
                  $qq = $this->db->query("SELECT SUM(total_harga) as jumlah from barang_laku where month(tanggal) = '$t1' and year(tanggal) = '$t2'")->result();
                  foreach($qq as $qw)
                  {
                      echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                  }
                }
                else
                {
                    $qq = $this->db->query("SELECT SUM(total_harga) as jumlah from barang_laku")->result();
                    foreach($qq as $qw)
                    {
                        echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                    }
                }
              ?>
            </td>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="6">Total Laba</td>
            <td style="text-align: center;">
              <?php
                if(!empty($t1) && empty($t2)) //bulan
                {
                  for($i = 0; $i < 12; $i++)
                  {
                    $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where month(tanggal) = '$t1'")->result();
                  }
                    foreach($qq as $qw)
                    {
                        echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                    }
                }
                else if(empty($t1) && !empty($t2)) //tahun
                {
                  $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where year(tanggal) = '$t2'")->result();
                  foreach($qq as $qw)
                  {
                      echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                  }
                }
                else if(!empty($_POST['t1']) && !empty($_POST['t2']))
                {
                  $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where month(tanggal) = '$t1' and year(tanggal) = '$t2'")->result();
                  foreach($qq as $qw)
                  {
                      echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                  }
                }
                else
                {
                    $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku")->result();
                    foreach($qq as $qw)
                    {
                        echo "<b>Rp. ".formatAngka($qw->jumlah)."</b>";
                    }
                }
              ?>
            </td>
            <td>&nbsp;</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>