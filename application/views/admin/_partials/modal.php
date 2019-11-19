<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-weight: normal;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" role="document">
      <div class="modal-header">
        <h5 class="modal-title">APAKAH ANDA YAKIN INGIN LOGOUT?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Jika Anda yakin maka tekan tombol warna merah dipojok kanan bawah yang bertuliskan <i>Logout</i>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
        <a href="<?php echo base_url('login/logout') ?>"><button class="btn btn-danger" type="button"><i class="fas fa-sign-out-alt"></i> Logout</button></a>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-weight: normal;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 15px;">APAKAH ANDA YAKIN INGIN MENGHAPUS DATA INI?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary pull-left" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#"><i class="fa fa-trash"></i> Delete</a>
      </div>
    </div>
  </div>
</div>

<!-- Reset Confirmation-->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="font-weight: normal;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">APAKAH ANDA YAKIN INGIN MERESET KODE INI?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">Kode yang direset tidak akan bisa dikembalikan. <i style="font-weight: bold;">Kecuali</i>, jika memasukkan kode kembali.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary pull-left" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Batal aja deh</button>
        <a id="btn-reset" class="btn btn-danger" href="#"><i class="fa fa-trash-o"></i> Iya, Saya yakin</a>
      </div>
    </div>
  </div>
</div>