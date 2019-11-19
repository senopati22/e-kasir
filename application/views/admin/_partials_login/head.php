<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
	$toko = $this->db->query('SELECT * from toko')->row();
?>
<title><?= strtoupper($toko->site_name) .": ". ucfirst($this->uri->segment(1)) ?></title>
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/vendor/bootstrap/css/bootstrap.min.css') ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/vendor/animate/animate.css') ?>">
<!--===============================================================================================-->	
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/vendor/css-hamburgers/hamburgers.min.css') ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/vendor/select2/select2.min.css') ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/css/util.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/css/main.css') ?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets_login/sweetalert/dist/sweetalert.css') ?>">
<link rel="shortcut icon" href="<?php echo base_url('image/logo.png'); ?>" type="image/x-icon">