  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

    <?php if($this->session->userdata('logged_in')['level'] != 'mahasiswa') { ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cek Kompen Mahasiswa</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <?php echo form_open('Mahasiswa/cekKompen'); ?>
                <div class="card-body box-profile">
                  <?php echo validation_errors(); ?>
                  <div class="text-center">
                  </div>
                  <div class="form-group">
                    <label>Masukkan NIM Mahasiswa</label>
                    <input id="nim" name="nim" type="text" class="form-control" value="" >
                  </div>
                </div>
                <center><button type="submit" class="btn btn-info">Cari</button></center>
                <br>
             <?php echo form_close();?>
              <!-- /.card-header -->

          
              <!-- /.footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

    <?php } ?>
    <!-- /.content -->
  </div>