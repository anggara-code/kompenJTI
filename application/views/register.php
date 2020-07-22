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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets_login/css/main1.css">
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

<form action="<?=site_url('login/register')?>" method='post' id="form" enctype="multipart/form-data">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

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

    <?php
    $info =$this->session->flashdata('error_notif');
    if (isset($info)) {?>
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">&times;</button>
    <strong><?php echo $info; ?></strong>
    </div><?php
    }
    ?>

				<h2>REGISTRASI MAHASISWA</h2><Br>
	                <div class="form-group">
		                <label>NIM&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="nim" placeholder="NIM" required="required"
		                 value="<?=$this->session->flashdata('nim')?>">
	                </div>

	                <div class="form-group">
		                <label>Nama Lengkap&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required="required" value="<?=$this->session->flashdata('nama_lengkap')?>">
	                </div>

	                <div class="form-group">
		                <label>Tahun Masuk&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk" required="required" value="<?=$this->session->flashdata('tahun_masuk')?>">
	                </div>

	                <div class="form-group">
		                <label>Program Studi&nbsp;<span style="color: red;">*</span></label>
		                <select class="form-control" name="prodi">
		                	<option value="D3 MI" <?=$this->session->flashdata('prodi')=='D3 MI'? 'selected':'';?>>
		                		D3 Manajemen Informatika
		                	</option>
		                	<option value="D4 TI" <?=$this->session->flashdata('prodi')=='D4 TI'? 'selected':'';?>>D4 Teknik Informatika</option>
		                </select>
	                </div>

	                <div class="form-group">
		                <label>Email&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="email" placeholder="Email" required="required"
		                 value="<?=$this->session->flashdata('email')?>">
	                </div>

	                <div class="form-group">
		                <label>Nomor Telepon&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="nomor_telepon" placeholder="Nomor Telepon" required="required" value="<?=$this->session->flashdata('nomor_telepon')?>">
	                </div>

	                <div class="form-group">
		                <label>Username&nbsp;<span style="color: red;">*</span></label>
		                <input type="text" class="form-control" name="username" placeholder="Username" required="required"
		                 value="<?=$this->session->flashdata('username')?>">
	                </div>

	                <div class="form-group">
		                <label>Password&nbsp;<span style="color: red;">*</span></label>
		                <input type="password" class="form-control" name="password" placeholder="Password" required="required"
		                 value="<?=$this->session->flashdata('password')?>">
	                </div>

	                <div class="form-group">
		                <label>Foto Profil</label>
		                <input type="file" class="form-control" name="userfile" required="required">
	                </div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Registrasi
							</button>
						</div>
					</div>
					<br>

	                <a href="<?=site_url('login')?>"><< Login</a>
	                <br>
	                <br>
			</div>
		</div>
	</div>
</form>

	
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