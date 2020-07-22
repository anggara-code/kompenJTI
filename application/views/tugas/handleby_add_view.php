
  <style type="text/css">
    
    .autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}


  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Mahasiswa ditugaskan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Tugas</li>
              <li class="breadcrumb-item"><a href="<?=site_url('tugas')?>">Daftar Tugas</a></li>
              <li class="breadcrumb-item"><a href="<?=site_url('tugas/handleby/'.$id_tugas)?>">Dikerjakan Oleh</a></li>
              <li class="breadcrumb-item active">Tambah Mahasiswa ditugaskan</li>
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
            <?php echo form_open('tugas/handleby_add/'.$id_tugas)?>
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                </div>
                <?php echo validation_errors(); ?>
                <?php echo $error;
                ?>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>NIM</label>
                  </div>
                  <div class="col-md-9">
                    <input id="nim" name="nim" type="text" class="form-control" onkeyup="searchMhs()" placeholder="NIM">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Kompen</label>
                  </div>
                  <div class="col-md-9">
                    <input id="jam_kompen" name="jam_kompen" type="number" class="form-control" placeholder="Ingin Kompen Berapa jam?" min="1" value="1">
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
<script type="text/javascript">

  function searchMhs() {
    var key = $("#nim").val();

    if(key.length > 2) {
      $( "#nim" ).autocomplete({
        source: '<?=site_url('mahasiswa/search/')?>'+key,
        select: function (e, ui) {
          $("#nim").val(ui.item.value);
          return false;
        },
      }); 
    }
  }


</script>
  <script src="<?=base_url('assets_admin/includes/js/jquery-ui.js')?>"></script>
