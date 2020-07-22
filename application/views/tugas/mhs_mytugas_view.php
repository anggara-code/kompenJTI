  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">History Tugasku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">History Tugasku</li>
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">History Tugasku</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="example1" class="table table-bordered table-striped" width="1027px">
                <thead>
                    <tr>
                      <td>NO</td>
                      <td>PEMBERI TUGAS</td>
                      <td>JUDUL TUGAS</td>
                      <td>KATEGORI</td>
                      <td>JUMLAH KOMPEN</td>
                      <td>DILAKSANAKAN</td>
                      <td>TANGGAL</td>
                      <td>STATUS</td>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($tugas as $no => $key) { ?>
                      <tr>
                        <td><?=($no+1) ?></td>
                        <td><?=$key['nama_lengkap']?></td>
                        <td><?=$key['judul_tugas'] ?></td>
                        <td><?=$key['tipe_tugas'] ?></td>
                        <td><?=$key['jumlah_kompen'] ?></td>
                        <td><?=$key['tanggal_input'] ?></td>
                        <td><?=$key['tanggal_input'] ?></td>
                        <td><?=$key['status']==1?'SELESAI':'PROSES'; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

