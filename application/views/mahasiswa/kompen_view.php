  <!-- Content Wrapper. Contains page content -->
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
              <li class="breadcrumb-item"><a href="<?=site_url('home')?>">Home</a></li>
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Informasi Detail Kompen</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>

      function detail(JamAlpa, MenitAlpa, JamSakit, MenitSakit, JamIjin, MenitIjin) {
        var html =  'Jam Alpa       = '+ JamAlpa + '<br>'+
            'Menit Alpa     = '+ MenitAlpa + '<br>'+
            'Jam Sakit      = '+ JamSakit + '<br>'+
            'Menit Sakit    = '+ MenitSakit + '<br>'+
            'Jam Ijin       = '+ JamIjin + '<br>' +
            'Menit Ijin     = '+ MenitIjin + '<br>';

        $('.modal-body').html(html);

        $("#myModal").modal('show');
      }

    </script>

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Kompen Siakad</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">

                  <li class="nav-item" height="50">
                    <a href="#" class="nav-link">
                      Semester
                      <span class="float-right">
                        Lihat Detail
                      </span>
                    </a>
                  </li>
                  <?php foreach ($allSemester as $key => $val): ?>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <?=$val['LabelSemester']?> = <?=$val['JamAlpa']?> 
                      <span class="float-right">
                      <button type="button" class="edit-record" onclick="detail(<?=$val['JamAlpa']?>, 
                                                                                <?=$val['MenitAlpa']?>,
                                                                                <?=$val['JamSakit']?>,
                                                                                <?=$val['MenitSakit']?>,
                                                                                <?=$val['JamIjin']?>,
                                                                                <?=$val['MenitIjin']?>)">
                        <i class="fa fa-users"></i> Detail
                      </button>
                      </span>
                    </a>
                  </li>  
                  <?php endforeach ?>
                   <li class="nav-item">
                    <a href="#" class="nav-link">
                      Nama
                      <span class="float-right">
                      <?=$mahasiswa['nama']?>
                      </span>
                    </a>
                  </li> 
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Jalur Masuk
                      <span class="float-right">
                      <?=$mahasiswa['jalurmasuk']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Angkatan
                      <span class="float-right">
                      <?=$mahasiswa['angkatan']?>
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
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Data Kompen Sistem</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">

                  <li class="nav-item" height="50">
                    <a href="#" class="nav-link">
                      Total Kompen
                      <span class="float-right">
                        Belum terkompen
                      </span>
                    </a>
                  </li>
                  <?php foreach ($allSemester as $val2): ?>
                  <li class="nav-item" height="50">
                    <a href="#" class="nav-link">
                      <?=$val2['JamAlpa']?> x <?=$val2['JamKali']?> = <?=$val2['Total']?>
                      <span class="float-right">
                        <?=$val2['BelumKompen']?>
                      </span>
                    </a>
                  </li>
                  <?php endforeach ?>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <b>Total</b>
                      <span class="float-right">
                        <?=$mahasiswa['totalKompen']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <b>Telah kompen</b>
                      <span class="float-right">
                        <?=$mahasiswa['telahKompen']?>
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <b>Yang harus dikerjakan</b>
                      <span class="float-right">
                        <?=$mahasiswa['sisaKompen']?>
                      </span>
                    </a>
                  </li>
                </ul>
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
