
  <?php 
  if($this->session->userdata('logged_in')['level'] == 'mahasiswa') {
    $id = $profile['nim'];
    $action = 'mahasiswa/editProfile/'.$id.'/'.$this->session->userdata('logged_in')['foto_profil'];
  } else { 
    $id = $profile['nip'];
    $action = 'pemberi_tugas/editProfile/'.$id.'/'.$this->session->userdata('logged_in')['foto_profil'];
  }

  ?>

  <?php echo form_open_multipart($action); ?>
  <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="brand-text font-awesome">Edit Profil</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form>
          <?php if($this->session->userdata('logged_in')['level'] == 'mahasiswa') { ?>
          <center><img class="profile-user-img img-fluid img-circle"
                     src="<?=base_url();?>images/mahasiswa/<?=$profile['foto_profil']?>"
                     alt="User profile picture"></center>
          <?php } else { ?>
          <center><img class="profile-user-img img-fluid img-circle"
                     src="<?=base_url();?>images/pemberi_tugas/<?=$profile['foto_profil']?>"
                     alt="User profile picture"></center>
          <?php } ?>
          <h3 class="profile-username text-center"><?=$profile['nama_lengkap']?></h3>
          <div class="form-group row">
            <div class="col-sm-4">
              <label>Email&nbsp;<span style="color: red;">*</span></label>
            </div>
            <div class="col-sm-8">
              <input id="email" name="email" type="text" class="form-control" value="<?=$profile['email']?>" >
            </div>
          </div> 
          <div class="form-group row">
            <div class="col-sm-4">
              <label>Nomor Telepon&nbsp;<span style="color: red;">*</span></label>
            </div>
            <div class="col-sm-8">
              <input id="nomor_telepon" name="nomor_telepon" type="text" class="form-control" value="<?=$profile['nomor_telepon']?>" >
            </div>
          </div>   
          <div class="form-group row">
            <div class="col-sm-4">
              <label>Username&nbsp;<span style="color: red;">*</span></label>
            </div>
            <div class="col-sm-8">
              <input id="username" name="username" type="text" class="form-control" value="<?=$profile['username']?>" >
            </div>
          </div>   
          <div class="form-group row">
            <div class="col-sm-4">
              <label>Password</label>
            </div>
            <div class="col-sm-8">
              <input id="password" name="password" type="password" class="form-control">
            </div>
          </div>   
          <div class="form-group row">
            <div class="col-sm-4">
              <label>Foto Profil</label>
            </div>
            <div class="col-sm-8">
              <input id="foto_profil" name="foto_profil" type="file" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close();?>
