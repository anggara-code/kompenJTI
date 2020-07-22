  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tugas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Tugas</li>
              <li class="breadcrumb-item"><a href="<?=site_url('tugas')?>">Daftar Tugas</a></li>
              <li class="breadcrumb-item active"><?=$tugas['judul_tugas']?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Tugas</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Judul Tugas
                      <span class="float-right">
                        <?=$tugas['judul_tugas']?>
                      </span>
                    </a>
                  </li>  
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tipe Tugas
                      <span class="float-right">
                        <?=$tugas['tipe_tugas']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Kuota
                      <span class="float-right">
                        <?=$tugas['kuota']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Jumlah Kompen
                      <span class="float-right">
                        <?=$tugas['jumlah_kompen']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tanggal
                      <span class="float-right">
                        <?=$tugas['date']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Deskripsi
                      <span class="float-right">
                        <?=$tugas['deskripsi']?>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Mahasiswa Kompen</h3>
                <div class="card-tools">
                  <a href="<?=site_url('tugas/handleby_add/'.$id_tugas)?>">
                    <i class="fa fa-plus"></i> Tambah
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-footer bg-white p-0">
                <table class="table table-bordered">
                  <thead>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>Kompen</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>

                    <?php foreach ($mahasiswa as $key => $val): ?>                      
                    <tr>
                      <td><?=($key+1)?></td>
                      <td><?=$val['nama_lengkap']?></td>
                      <td><?=$val['jam_kompen']?></td>
                      <td><?=$val['tanggal_input']?></td>
                      <td>
                        <?php 
                          if($val['status']==1)
                            echo 'Selesai';
                          else
                            echo 'Proses';
                        ?>
                      </td>
                      <td>
                        <a href="<?=site_url('tugas/handleby_delete/'.$id_tugas.'/'.$val['id'])?>" class="btn btn-danger" title="hapus" onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php if($val['status']==0) { ?>
                        <a href="<?=site_url('tugas/handleby_valid/'.$id_tugas.'/'.$val['id'].'/1'.'?nim='.$val['nim'])?>" class="btn btn-success" title="validasi kompen" onclick="return confirm('apakah anda yakin ingin memvalidasi kompen ini?')">
                          <i class="fa fa-check"></i>
                        </a>
                        <?php } else { ?>
                        <a href="<?=site_url('tugas/handleby_valid/'.$id_tugas.'/'.$val['id'].'/0'.'?nim='.$val['nim'])?>" class="btn btn-warning" title="tidak jadi verifikasi kompen" onclick="return confirm('apakah anda tidak jadi memverifikasi kompen ini?')">
                          <i class="fa fa-times"></i>
                        </a>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php endforeach ?>

                  </tbody>
                </table>
              </div>
              <!-- /.footer -->
              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
 <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
