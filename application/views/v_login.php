<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("admin/_partials_login/head.php") ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/sweetalert/dist/sweetalert.css') ?>">
	<script type="text/javascript" src="<?php echo base_url('assets_login/sweetalert/dist/sweetalert-dev.js') ?>"></script>
</head>
<body>

<script type="text/javascript">
	<?php if ($this->session->flashdata('gagal')): ?>
		swal("Data Invalid", "Username or password didn't match, please try again", "error");
	<?php endif; ?>

	<?php if ($this->session->flashdata('peringatan_login')): ?>
		swal("Akses ditolak!", "Silahkan login terlebih dahulu", "error");
	<?php endif; ?>

	<?php if ($this->session->flashdata('gantipass')): ?>
		swal("Password Anda Telah Berubah!", "Silahkan login menggunakan password baru Anda", "error");
	<?php endif; ?>
</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<?php
					$toko = $this->db->query('SELECT * from toko')->row();
				?>
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?php echo base_url('upload/logotoko/'.$toko->foto); ?>" alt="Foto">
				</div>

				<form class="login100-form validate-form" action="<?php echo base_url('login/aksi_login') ?>" method="post">
				
					<span class="login100-form-title">
						Selamat Datang di<br><?= strtoupper($toko->site_name) ?>
					</span>
					
					<?php if ($this->session->flashdata('gagal')): ?>
					<div class="alert alert-danger" role="alert" style="border-radius: 10px;">
						<?php echo $this->session->flashdata('gagal'); ?>
					</div>
					<?php endif; ?>

					<?php if ($this->session->flashdata('peringatan_login')): ?>
					<div class="alert alert-danger" role="alert" style="border-radius: 10px;">
						<?php echo "<i class='fa fa-exclamation-triangle'></i> Login terlebih dahulu untuk mengakses halaman admin." ?>
					</div>
					<?php endif; ?>

					<?php if ($this->session->flashdata('changepass')): ?>
					<div class="alert alert-danger" role="alert" style="border-radius: 10px;">
						<?php echo "Login terlebih dahulu untuk mengakses halaman admin, dengan password baru Anda." ?>
					</div>
					<?php endif; ?>
					
					<div class="wrap-input100 validate-input" data-validate="Username tidak boleh kosong">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password tidak boleh kosong">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							&nbsp;
						</span>
						<a class="txt2" href="#">
							<!-- Username / Password? --> &nbsp;
						</a>
					</div>

					<div class="text-center p-t-136" style="padding-top: -40%;">
						<a class="txt2" href="#">
							<!-- Create your Account -->
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php $this->load->view("admin/_partials_login/js.php") ?>
</body>
</html>