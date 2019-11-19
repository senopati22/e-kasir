<div class="content-wrapper" style="font-weight: normal;">
  <!-- Content Header (Page header) -->
 <?php $this->load->view("admin/_partials/section_breadcrumb.php") ?>

  <!-- Main content -->
  <section class="content">

    <?php if (validation_errors()) : ?>
      <div class="callout callout-danger">
        <h4><i class="fa fa-exclamation-triangle"></i> PERINGATAN!</h4>
        <?= validation_errors(); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('successpass')): ?>
    <div class="modal fade" id="editPass" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-weight: normal;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check-square-o" style="color: #00A65A;"></i> PASSWORD ANDA BERHASIL DI-<i>UPDATE</i>!</h5>
          </div>
          <div class="modal-body">Silahkan login kembali untuk meng-<i>akses</i> halaman admin.</div>
          <div class="modal-footer" style="text-align: center;">
            Anda akan <span class="btn-xs btn-danger" style="padding: 3px 5px 3px 5px;"><i class="fa fa-sign-out"></i> Logout</span> otomatis dalam <span id="waktu">10</span> detik
            <script type="text/javascript">
              var waktu = 11;
              setInterval(function() {
                waktu--;
                if (waktu < 0) 
                {
                  window.location = 'http://localhost:8080/kejaksaan/login';
                }
                else
                {
                  document.getElementById('waktu').innerHTML = waktu;
                }
              }, 1000);
            </script>
          </div>
        </div>
      </div>
    </div>
    <!--<div class="callout callout-success">
      <h4><i class="fa fa-check-square-o"></i> PASSWORD BERHASIL DIUPDATE</h4>
      Silahkan login kembali untuk meng-<i>akses</i> halaman admin. Anda akan logout otomatis dalam <span id="waktu">10</span> detik.
      <script type="text/javascript">
        var waktu = 11;
        setInterval(function() {
          waktu--;
          if (waktu < 0) 
          {
            window.location = 'http://localhost:8080/kejaksaan/login';
          }
          else
          {
            document.getElementById('waktu').innerHTML = waktu;
          }
        }, 1000);
      </script>
    </div>-->
    <?php endif; ?>

    <?php if ($this->session->flashdata('gagalpass')) : ?>
      <div class="alert alert-danger alet-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="fa fa-exclamation-triangle"></i> PERINGATAN!</h4>
        Password lama Anda salah. Silahkan masukkan password lama Anda dengan benar.
      </div>
    <?php endif; ?>

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">UBAH PASSWORD</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>

    <form action="<?php base_url('admin/user/editpassword') ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">

              <input type="hidden" name="user_id" value="<?= $userpas->user_id ?>">
              <!-- NAMA ASLI -->
              <div class="form-group">
                <label for="exrealname">Nama Asli</label>
                <input type="text" disabled class="form-control" value="<?= $userpas->user_realname ?>">
              </div>

              <!-- PASSWORD LAMA -->
              <div class="form-group">
                <label>Password Lama</label>
                <input type="password" class="form-control" required name="passwordlama" placeholder="Masukkan password lama anda">
              </div>

            </div>
            <div class="col-md-6">

              <!-- PASSWORD BARU -->
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" class="form-control" required minlength="5" name="user_password" placeholder="Masukkan password baru anda">
              </div>

              <!-- PASSWORD BARU -->
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" class="form-control" required minlength="5" name="confirm_password" placeholder="Masukkan ulang password baru anda">
              </div>

            </div>

          </div>
        </div>
        <div class="box-footer">
          <a href="javascript:history.back()">
            <button class="btn btn-warning" type="button" name="btn"><i class="fa fa-reply"></i> Cancel</button>
          </a>
          <button class="btn btn-success pull-right" type="submit" name="btn"><i class="fa fa-save"></i> Save Data</button>
        </div>
    </form>
    </div>

  </section>
</div>