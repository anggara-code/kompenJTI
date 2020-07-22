<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Kompen JTI 2018</title>

  <link href="<?=base_url('assets_admin/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
  <link href="<?=base_url('assets_admin/includes/themes/css/adminlte.min.css');?>" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="<?=base_url('assets_admin/includes/datatables/datatables.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets_admin/includes/css/jquery-ui-smoothness.css')?>" rel="stylesheet">
  
  <script src="<?=base_url('assets_admin/includes/js/jquery-1.10.2.js')?>"></script>
  <script src="<?=base_url('assets_admin/includes/datatables/datatables.min.js')?>"></script>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <?php $this->load->view('sidebar')?>
  <?php $this->load->view('profile') ?>
  <?php $this->load->view($content)?>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <footer class="main-footer">
    <div class="float-right d-sm-none d-md-block">
      Politeknik Negeri Malang
    </div>
    <strong>Copyright1 &copy; 2018 <a href="https://adminlte.io">Sistem Informasi Kompen</a>
  </footer>
</div>

<script src="<?php echo base_url();?>assets_admin/includes/themes/js/adminlte.js"></script>
</body>
</html>
