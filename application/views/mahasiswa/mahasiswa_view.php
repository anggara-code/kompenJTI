  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mahasiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">Mahasiswa</li>
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
              <h3 class="card-title">Daftar Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <div class="card-footer">
                <a href="<?=site_url('mahasiswa/add')?>" type="button" class="btn btn-primary btn-sm">
                  <i class="fa fa-user"></i>  TAMBAH MAHASISWA
                </a>
              </div>

              <table id="table" class="table table-bordered table-striped" width="1075px">
                <thead>
                    <tr>
                      <td>NO</td>
                      <td>FOTO PROFIL</td>
                      <td>NAMA LENGKAP</td>
                      <td>NIM</td>
                      <td>USERNAME</td>
                      <td>EMAIL</td>
                      <td>AKSI</td>
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
          url: "<?=site_url('mahasiswa/data_server') ?>",
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
                      'src="<?=base_url('images/mahasiswa/')?>'+data['foto_profil']+'">';
              }
          },
          {
            "targets": 2,
            "data": "nama_lengkap"
          },
          {
            "targets": 3,
            "data": "nim"
          },
          {
            "targets": 4,
            "data": "username"
          },
          {
            "targets": 5,
            "data": "email"
          },
          {
              "targets": 6,
              "data": null,
              "searchable": false,
              "sortable": false,
              "render": function (data, type, full, meta) {
                return "<a href='<?=site_url('mahasiswa/edit/')?>"+data["nim"]+"/"+data["foto_profil"]+"' title='edit' class='btn btn-success'>"+
                      "<span class='glyphicon glyphicon-edit'></span>"+
                    "</a>"+"&nbsp;"+
                    "<a href='<?=site_url('mahasiswa/delete/')?>"+data["nim"]+"/"+data["foto_profil"]+"' title='hapus' class='btn btn-danger' onclick=\"return confirm('Apakah anda yakin akan menghapus data ini?')\">"+
                      "<span class='glyphicon glyphicon-trash'></span>"+
                    "</a>";
              }
          }
        ]
      } );
    } );
  </script>