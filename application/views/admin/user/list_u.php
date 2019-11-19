<!DOCTYPE html>
<html lang="en">
<head>

  <?php $this->load->view("admin/_partials/head.php") ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view("admin/_partials/sidebar.php") ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <?php $this->load->view("admin/_partials/header.php") ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php $this->load->view("admin/_partials/user/user.php") ?>
        </div>
      </div>

      <!-- Footer -->
      <?php $this->load->view("admin/_partials/footer.php") ?>

    </div>

  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php $this->load->view("admin/_partials/modal.php") ?>
<?php $this->load->view("admin/_partials/js.php") ?>

</body>
</html>
