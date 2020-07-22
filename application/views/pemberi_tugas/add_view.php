
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Admin/Dosen/Teknisi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item"><a href="<?=site_url('pemberi_tugas')?>">Admin/Dosen/Teknisi</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <!-- Profile Image -->
            <?php echo form_open_multipart('Pemberi_tugas/add/')?>
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                </div>
                <?php echo validation_errors(); ?>
                <?php echo $error;
                ?>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>NIP</label>
                  </div>
                  <div class="col-md-9">
                    <input id="nip" name="nip" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nama Lengkap</label>
                  </div>
                  <div class="col-md-9">
                    <input id="navbar" name="nama_lengkap" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Username</label>
                  </div>
                  <div class="col-md-9">
                    <input id="username" name="username" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Password</label>
                  </div>
                  <div class="col-md-9">
                    <input id="password" name="password" type="password" class="form-control"  >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nomor Telepon</label>
                  </div>
                  <div class="col-md-9">
                    <input id="nomor_telepon" name="nomor_telepon" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Email</label>
                  </div>
                  <div class="col-md-9">
                    <input id="email" name="email" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="">Foto Profil</label>
                  </div>
                  <div class="col-md-9">
                    <input type="file" name="userfile" size="20"/>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Level</label>
                  </div>
                  <div class="col-md-9">
                    <select name="level" class="form-control" style="height: 35px">
                      <option value="dosen">Dosen/Teknisi/Admin</option>
                      <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary" style="float:right;"><i class="glyphicon glyphicon-save"></i>  Save</button>
                <?php echo form_close(); ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
