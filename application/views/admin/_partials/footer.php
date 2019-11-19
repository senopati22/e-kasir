<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <?php
        $dt = date('d-m-Y');
      ?>
      <span><?= $this->session->userdata('site_name') ?> &copy; <strong><?= indonesian_date($dt, 'l, d F Y') ?></strong> - <a href="https://api.whatsapp.com/send?phone=6285231669714&text=Assalamualaikum.%20Saya%20ingin%20menyampaikan%20tentang%20web%20yang%20Anda%20buatkan.%20Terimakasih" target="_blank">Raihan Habib Dhiaulhaq</a>.</span>
    </div>
  </div>
</footer>