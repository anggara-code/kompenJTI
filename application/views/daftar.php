<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kompen JTI</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets_login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<style type="text/css">
      body
      {
          background-image: url("<?php echo base_url();?>images/background.png");
          background-size: 100%;
      }
    </style>

    <?php
    $info =$this->session->flashdata('notifikasi');
    if (isset($info)) {?>
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">&times;</button>
    <strong><?php echo $info; ?></strong>
    </div><?php
    }
    ?>

<?php echo form_open_multipart('Login/daftar') ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-48">
						<img src="<?php echo base_url();?>images/logopolinemakecil.png" class="img-circle" alt="User Image">
					</span>
					<span class="login100-form-title p-b-26">
						Daftar
					</span>
					<?php echo validation_errors(); ?>
					<div class="wrap-input100 validate-input" data-validate = "Enter user">
						<input class="input100" type="text" name="nim" id="nim">
						<span class="focus-input100" data-placeholder="NIM"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter user">
						<input class="input100" type="text" name="nama_lengkap" id="nama_lengkap">
						<span class="focus-input100" data-placeholder="Nama lengkap"></span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Daftar
							</button>
						</div>
					</div>
				</form>
<?php echo form_close(); ?>
<br>
<a href="<?php echo site_url() ?>/Login" class="btn btn-primary btn-block"><b>Back</b></a>
			</div>
		</div>
	</div>


	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>assets_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets_login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url();?>assets_login/js/main.js"></script>

</body>
</html>