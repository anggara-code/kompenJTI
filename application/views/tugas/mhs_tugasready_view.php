
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tugas Ready</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Tugas Ready</li>
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
              <h3 class="card-title">Tugas Ready</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" >

              <table id="table" class="table table-bordered table-striped" width="1075px">
                <thead>
                    <tr>
                      <td>NO</td>
                      <td>FOTO</td>
                      <td>PEMBERI TUGAS</td>
                      <td>JUDUL TUGAS</td>
                      <td>KATEGORI</td>
                      <td>JUMLAH KOMPEN</td>
                      <td>KUOTA</td>
                      <td>KUOTA TERISI</td>
                      <td>TANGGAL DIPOST</td>
                    </tr>
                    </thead>
                    <tbody>
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

<script type="text/JavaScript">
    $(document).ready(function() {
        $('#table').DataTable( {
          "dom": "<'col-sm-12'<'row'<'col-sm-4'<'pull-left'l>><'col-sm-8'<'pull-right'f>>>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'col-sm-12'<'row'<'col-sm-4'<'pull-left'i>><'col-sm-8'<'pull-right'p>>>>",
        "processing": false,
        "serverSide": true,
        "ajax": {
          url: "<?=site_url('tugas/data_server_mhs_tugasready') ?>",
          type: "POST"
        },
        "columnDefs": [
          {
            "targets": 0,
            "data": null,
            "searchable": false,
            "sortable": false,
            "render": function(data, type, full, meta) {
              return meta.row+1;
            }
          },
          {
              "targets": 1,
              "data": null,
              "searchable": false,
              "sortable": false,
              "render": function (data, type, full, meta) {
                return '<img class="img-circle elevation-2" alt="User Image" width="70px" height="70px" '+
                      'src="<?=base_url('images/pemberi_tugas/')?>'+data['foto_profil']+'">';
              }
          },
          {
            "targets": 2,
            "data": "nama_lengkap"
          },
          {
            "targets": 3,
            "data": "judul_tugas"
          },
          {
            "targets": 4,
            "data": "tipe_tugas"
          },
          {
            "targets": 5,
            "data": "jumlah_kompen"
          },
          {
            "targets": 6,
            "data": "kuota"
          },
          {
            "targets": 7,
            "data": "kuota_terisi"
          },
          {
            "targets": 8,
            "data": "date"
          }
        ]
      } );
    } );
  </script>