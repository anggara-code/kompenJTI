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

    <?php
    $info =$this->session->flashdata('notifikasi');
    if (isset($info)) {?>
    <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">&times;</button>
    <strong><?php echo $info; ?></strong>
    </div><?php
    }
    ?>

    <?php
    $info =$this->session->flashdata('success_notif');
    if (isset($info)) {?>
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert"
    aria-hidden="true">&times;</button>
    <strong><?php echo $info; ?></strong>
    </div><?php
    }
    ?>

<form action="<?=site_url('login/login_pemberi_tugas?level=dosen')?>" method='post' id="form">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
					<?php echo validation_errors(); ?>

	                <div class="form-group">
		                <label>Login Sebagai <?php echo CI_VERSION; ?> </label><Br>
		                <!-- <div class="row"> -->
	                		<input type="button" class="btn btn-info" id="btn_admin" onclick="changeLogin('admin')" value="Admin">&nbsp;&nbsp;&nbsp;
                			<input type="button" class="btn btn-warning" id="btn_dosen" onclick="changeLogin('dosen')" value="Dosen/Admin/Teknisi">&nbsp;&nbsp;&nbsp;
	                		<input type="button" class="btn btn-info" id="btn_mahasiswa" onclick="changeLogin('mahasiswa')" value="Mahasiswa">
	                	<!-- </div> -->
<!-- 		                <select class="form-control" name="tipe">
							<option value="admin">Admin</option>
							<option value="dosen">Dosen/Teknisi (Pemberi Tugas)</option>
							<option value="mahasiswa">Mahasiswa</option>
		                </select> -->
	                </div>

	                <div class="form-group">
		                <label>Username <?php echo site_url();?></label>
		                <input type="text" class="form-control" name="username" placeholder="Username" required="required"
		                 value="<?=$this->session->flashdata('username')?>">
	                </div>

	                <div class="form-group">
		                <label>Password <?php echo base_url();?></label>
		                <input type="password" class="form-control" name="password" placeholder="Password" required="required"
		                 value="<?=$this->session->flashdata('password')?>">
	                </div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>
					</div>
					<br>

	                <a href="<?=site_url('login/lupa_password')?>">Lupa Password ?</a>
	                <span class="pull-right"><a href="<?=site_url('login/register')?>">Registrasi Mahasiswa ?</a></span>
	                <br><br>
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


<script type="text/javascript">

	$(document).ready(function() {
<?php if($this->session->flashdata('level') == 'admin') { ?>
		$('#btn_admin').attr('class','btn btn-warning');
		$('#btn_dosen').attr('class','btn btn-info');
		$('#btn_mahasiswa').attr('class','btn btn-info');
		$('#form').attr('action', "<?=site_url('login/login_pemberi_tugas?level=admin')?>");
<?php } else if($this->session->flashdata('level') == 'dosen') { ?>
		$('#btn_admin').attr('class','btn btn-info');
		$('#btn_dosen').attr('class','btn btn-warning');
		$('#btn_mahasiswa').attr('class','btn btn-info');
		$('#form').attr('action', "<?=site_url('login/login_pemberi_tugas?level=dosen')?>");
<?php } else if($this->session->flashdata('level') == 'mahasiswa') { ?>
		$('#btn_admin').attr('class','btn btn-info');
		$('#btn_dosen').attr('class','btn btn-info');
		$('#btn_mahasiswa').attr('class','btn btn-warning');
		$('#form').attr('action', "<?=site_url('login/login_mahasiswa')?>");
<?php } ?>

	});


	function changeLogin(btn) {
		if(btn == 'admin') {
			$('#btn_admin').attr('class','btn btn-warning');
			$('#btn_dosen').attr('class','btn btn-info');
			$('#btn_mahasiswa').attr('class','btn btn-info');
			$('#form').attr('action', "<?=site_url('login/login_pemberi_tugas?level=admin')?>");
		} else if(btn == 'dosen') {
			$('#btn_admin').attr('class','btn btn-info');
			$('#btn_dosen').attr('class','btn btn-warning');
			$('#btn_mahasiswa').attr('class','btn btn-info');
			$('#form').attr('action', "<?=site_url('login/login_pemberi_tugas?level=dosen')?>");
		} else if(btn == 'mahasiswa') {
			$('#btn_admin').attr('class','btn btn-info');
			$('#btn_dosen').attr('class','btn btn-info');
			$('#btn_mahasiswa').attr('class','btn btn-warning');
			$('#form').attr('action', "<?=site_url('login/login_mahasiswa')?>");
		}
	}
</script>


</body>
</html>