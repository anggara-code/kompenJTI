
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Insert Tugas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Tugas</li>
              <li class="breadcrumb-item"><a href="<?=site_url('tugas')?>">Daftar Tugas</a></li>
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
            <?php echo form_open('tugas/add/')?>
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                </div>
                <?php echo validation_errors(); ?>
                <?php echo $error;
                ?>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Tipe Tugas</label>
                  </div>
                  <div class="col-md-9">
                    <select class="form-control" style="height: 35px" name="tipe_tugas">
                      <option value="1">Penugasan</option>
                      <option value="2">Pembelian</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Judul Tugas</label>
                  </div>
                  <div class="col-md-9">
                    <input id="judul_tugas" name="judul_tugas" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Kuota</label>
                  </div>
                  <div class="col-md-9">
                    <input id="kuota" name="kuota" type="text" class="form-control" >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Jumlah Kompen</label>
                  </div>
                  <div class="col-md-9">
                    <input id="jumlah_kompen" name="jumlah_kompen" type="text" class="form-control"  >
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Deskripsi</label>
                  </div>
                  <div class="col-md-9">
                    <textarea name="deskripsi" class="form-control"></textarea>
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
