
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Brand Logo -->


      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <a href="<?=site_url()?>">&nbsp;
          <img src="<?=base_url();?>images/logopolinema.png" alt="AdminLTE Logo" class=" img-circle elevation-4"
               style="opacity: .8; width: 35px">&nbsp;&nbsp;Kompen JTI
        </a>
      </div>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          <?php if($profile['level'] == 'mahasiswa') { ?>
            <img src="<?=base_url();?>images/mahasiswa/<?=$profile['foto_profil']?>" class="img-circle elevation-2" alt="User Image">
          <?php } else { ?>
            <img src="<?=base_url();?>images/pemberi_tugas/<?=$profile['foto_profil']?>" class="img-circle elevation-2" alt="User Image">
          <?php } ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$profile['nama_lengkap']?></a>
          <a><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-login" ><i class="fa fa-users"></i> Profile</button>
        </div>
        </div>
      <!-- Sidebar Menu -->
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview" id="list_dashboard">
            <a href="<?=site_url('home') ?>" class="nav-link <?php if($active == 'home') { echo 'active';}?>">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if($profile['level'] == 'admin') { ?>
          <li class="nav-item has-treeview <?php if($active == 'pemberi_tugas' || $active == 'mahasiswa') { echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active == 'pemberi_tugas' || $active == 'mahasiswa') { echo 'active';}?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url() ?>pemberi_tugas" class="nav-link <?php if($active == 'pemberi_tugas') { echo 'active';}?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Admin/Dosen/Teknisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url() ?>mahasiswa" class="nav-link <?php if($active == 'mahasiswa') { echo 'active';}?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Mahasiswa</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($profile['level'] == 'admin' || $profile['level'] == 'dosen') { ?>
          <li class="nav-item has-treeview <?php if($active == 'tugas' || $active == 'historytugas' || $active=='allhistorytugas') { echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active == 'tugas' || $active == 'historytugas' || $active=='allhistorytugas') { echo 'active';}?>">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Tugas
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url()?>tugas" class="nav-link <?php if($active == 'tugas') { echo 'active';}?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Daftar Tugas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url()?>tugas/history" class="nav-link <?php if($active == 'historytugas') { echo 'active';}?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Historyku</p>
                </a>
              </li>
              <?php if($profile['level'] == 'admin') { ?>
              <li class="nav-item">
                <a href="<?=site_url()?>tugas/allhistory" class="nav-link <?php if($active == 'allhistorytugas') { echo 'active';}?>">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Semua History</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>

          <?php if($profile['level'] == 'mahasiswa') { ?>
          <li class="nav-item has-treeview">
            <a href="<?=site_url('mahasiswa/cekKompen?nim='.$profile['nim']) ?>" class="nav-link <?php if($active=='alpaku') { echo 'active'; }?>">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Alpaku
                <i></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url() ?>tugas/mhs_tugasready" class="nav-link <?php if($active=='mhs_tugasready') { echo 'active'; }?>">
              <i class="nav-icon fa fa-check"></i>
              <p>
                Tugas Ready
                <i></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?=site_url() ?>tugas/mhs_mytugas" class="nav-link <?php if($active=='mhs_mytugas') { echo 'active'; }?>">
              <i class="nav-icon fa fa-book"></i>
              <p>
                History Tugasku
                <i></i>
              </p>
            </a>
          </li>
          
          <?php } ?>
          
          <a href="<?=site_url() ?>Login/logout">
            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-share"></i>Logout</button>
          </a>

        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<script type="text/javascript">
  $("#list_dashboard a").first().remove();
</script>