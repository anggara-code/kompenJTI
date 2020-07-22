<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('login_model');
    $this->login_model->ifNotLogged();

    $this->load->model('mahasiswa_model');

    $this->load->library('session');
    $this->load->library('curl');
    $this->load->helper('form');
    $this->load->helper('url');
  }

  public function data_server()
  {
    $this->mahasiswa_model->data_server();
  }

  public function index() 
  {
    $data['profile']     = $this->session->userdata('logged_in');
    // $data['mahasiswa']  = $this->mahasiswa_model->getAll();
    $data['active']     = 'mahasiswa';
    $data['content']    = 'mahasiswa/mahasiswa_view';

    $this->load->view('index', $data);
  }

  public function add()
  {
    $this->load->helper('url','form');  
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
    $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
        
    $data['active']     = 'mahasiswa';

    if (empty($_FILES['userfile']['name']))
    {
      $this->form_validation->set_rules('userfile', 'foto', 'trim|required');
    }
    if($this->form_validation->run()==FALSE)
    {
      $data['profile']  = $this->session->userdata('logged_in');
      $data['content']  = 'mahasiswa/add_view';
      $data['error']    = '';

      $this->load->view('index',$data);
    }
    else
    {
      if($this->isNimExistWhenAdd()) {
        $this->session->set_flashdata('error_notif', 'NIM sudah terdaftar');
        redirect('mahasiswa/add');
      }
      if($this->isUnameExistWhenAdd()) {
        $this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
        redirect('mahasiswa/add');
      }
      $config['upload_path']          = './images/mahasiswa/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 1000000000;
      $config['max_width']            = 10240;
      $config['max_height']           = 7680;
      $this->load->library('upload', $config);
      
      if ( ! $this->upload->do_upload('userfile'))
      {
        $data['profile']  = $this->session->userdata('logged_in');
        $data['content']  = 'pemberi_tugas/add_view';
        $data['error']    = $this->upload->display_errors();
        $this->session->set_flashdata('notifikasi' , 'Ukuran Foto Terlalu Besar');

        $this->load->view('index',$data);
      }
      else
      {
        if($this->mahasiswa_model->insert()) {
          $this->session->set_flashdata('notifikasi', 'Sukses mengedit data');
          redirect('mahasiswa');
        }
        else {
          $this->session->set_flashdata('error_notif', 'menambah data gagal');
          redirect('mahasiswa/add');
        }
      }
    }
  }
  
  public function edit($nim, $foto_profil)
  {
    $this->load->helper('url','form');  
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
    $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
        
    $data['active']     = 'mahasiswa';

    if($this->form_validation->run()==FALSE)
    {
      $data['nim']      = $nim;
      $data['foto']     = $foto_profil;
      $data['profile']  = $this->session->userdata('logged_in');
      $data['data']     = $this->mahasiswa_model->getById($nim);
      $data['content']  = 'mahasiswa/edit_view';
      $data['error']    = '';

      $this->load->view('index',$data);
    }
    else
    {
      if($this->isNimExistWhenEdit($nim)) {
        $this->session->set_flashdata('error_notif', 'NIM '.$this->input->post('nim').' sudah digunakan');
        redirect('mahasiswa/edit/'.$nim.'/'.$foto_profil);
      }
      if($this->isUnameExistWhenEdit($nim)) {
        $this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
        redirect('mahasiswa/edit/'.$nim.'/'.$foto_profil);
      }

      $config['upload_path']          = './images/mahasiswa/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 1000000000;
      $config['max_width']            = 10240;
      $config['max_height']           = 7680;

      $this->load->library('upload', $config);
      $uploaded = false;

      if($this->upload->do_upload('userfile'))
        $uploaded = true;
        
      if($this->mahasiswa_model->edit($nim)) {
        if($uploaded) {
          $urlFoto = './images/mahasiswa/'.$foto_profil;
          unlink($urlFoto);
        }
        $this->session->set_flashdata('notifikasi', 'Sukses mengedit data');
        redirect('mahasiswa');
      }
      else {
        $this->session->set_flashdata('error_notif', 'edit data gagal');
        redirect('mahasiswa/edit/'.$nim.'/'.$foto_profil);
      }
        
    }
  }


  public function editProfile($nim, $foto_profil)
  {
    $this->load->helper('url','form');  
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
        
        $data['active']     = 'home';

    if($this->form_validation->run()==FALSE)
    {
        $this->session->set_flashdata('error_notif', 'Isi semua form');
        redirect('home');
    }
    else
    {
      if($this->isUnameExistWhenEditProfile()) {
        $this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
        redirect('home');
      }

      $config['upload_path']          = './images/mahasiswa/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 1000000000;
      $config['max_width']            = 10240;
      $config['max_height']           = 7680;

      $this->load->library('upload', $config);
      $uploaded = false;

      if($this->upload->do_upload('foto_profil'))
        $uploaded = true;
        
      if($this->mahasiswa_model->editProfile($nim)) {

        $sess = $this->session->userdata('logged_in');
        $sess['email']          = $this->input->post('email');
        $sess['nomor_telepon']  = $this->input->post('nomor_telepon');
        $sess['username']       = $this->input->post('username');

        if($uploaded) {
          $sess['foto_profil']  = $this->upload->data('file_name');
          $urlFoto = './images/mahasiswa/'.$foto_profil;
          unlink($urlFoto);
        }

        $this->session->set_userdata('logged_in', $sess);

        $this->session->set_flashdata('notifikasi', 'Edit profil berhasil');
        redirect('home');
      }
      else {
        $this->session->set_flashdata('error_notif', 'edit data gagal');
        redirect('home');
      }
        
    }
  }

  public function delete($nim, $foto_profil)
  {
    if($this->mahasiswa_model->delete($nim)) {
      $urlFoto = './images/mahasiswa/'.$foto_profil;
      unlink($urlFoto);
      $this->session->set_flashdata('notifikasi' , 'Dosen berhasil di hapus');
    }
    else
      $this->session->set_flashdata('error_notif' , 'Dosen berhasil di hapus');

    redirect('mahasiswa');
  }


  public function getApiProfile($nim)
  {
      $URL='http://polin3m4:openws@api.polinema.ac.id/siakad/mahasiswa/semester?nim='.$nim;

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$URL);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      $result=curl_exec ($ch);
      $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
      curl_close ($ch);
      $obj = json_decode($result, true);
      $result = $obj['data'];
      return $result; 
  }

  public function getApiAlpha($nim, $smstr)
  {
    $username='tugasakhir';
    $password='p0l1nema';

    $URL='http://api.polinema.ac.id/siakad/presensi/absensi/nim/'.$nim.'/thnsem/'.$smstr.'/format/json';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$URL);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $result=curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close ($ch);
    $obj = json_decode($result, true);
    return $obj;
  }

  public function getJamTerkompen($transaksi, $semester)
  {
    $jamKompen = 0;
    foreach ($transaksi as $key => $val) {
      if($val['semester'] == $semester)
        $jamKompen = $jamKompen + $val['jam_kompen'];
    }

    return $jamKompen;
  }

  public function cekKompen()
  {
    $this->load->model('transaksi_tugas_model');

    $nim = $this->input->post('nim') ? $this->input->post('nim') : $this->input->get('nim');

    $username     = 'tugasakhir';
    $password     = 'p0l1nema';
    $allSemester  = array();
    $isValid      = $this->getApiAlpha($nim, 1)['status'];
    $transaksi    = $this->transaksi_tugas_model->getByNimTugasDone($nim);

    $tran = array();

    if($isValid == 'data valid') {
      $profile      = $this->getApiProfile($nim);
      $count        = count($profile);
      $totalKompen  = 0;
      $terkompen    = 0;

      for ($i=0; $i < 8; $i++) { 

        if($i < count($profile)) {

          $JamKali = 2;

          for ($p=1; $p < $count; $p++)
            $JamKali = $JamKali * 2;

          $semester                         = $profile[$i]['semester'];
          $jamTerkompen                     = $this->getJamTerkompen($transaksi, $semester);
          $tran[] = $jamTerkompen;
          $allSemester[]                    = $this->getApiAlpha($nim, $semester)['data'];
          $total                            = $JamKali * $allSemester[$i]['JamAlpa'];
          $telahKompen                      = $JamKali * $jamTerkompen / 2;
          $belumKompen                      = $total - $telahKompen;
          $allSemester[$i]['semester']      = $semester;
          $allSemester[$i]['JamKali']       = $JamKali;
          $allSemester[$i]['JamTerkompen']  = $jamTerkompen;
          $allSemester[$i]['Total']         = $total;
          $allSemester[$i]['SudahKompen']   = $telahKompen;
          $allSemester[$i]['BelumKompen']   = $belumKompen;
          $allSemester[$i]['LabelSemester'] = 'Semester '.($i+1);
          $totalKompen                      = $totalKompen + $total;
          $terkompen                        = $terkompen + $telahKompen;
          $count--; 

        } else {
          $allSemester[] = array(
              'JamAlpa'     => '-',
              'MenitAlpa'   => '-',
              'JamSakit'    => '-',
              'MenitSakit'  => '-',
              'JamIjin'     => '-',
              'MenitIjin'   => '-',
              'JamKali'     => '-',
              'JamTerkompen'=> '-',
              'SudahKompen' => '-',
              'BelumKompen' => '-',
              'Total'       => '-',
              'LabelSemester' => 'Semester '.($i+1)
            );
        }
      }

        $telah      = $terkompen;
        $kompen     = array();

        for ($i=(count($allSemester)-1); $i >=0; $i--) { 
          $kom = $allSemester[$i]['Total'];

          if($kom != '-') {

            if($kom != 0) {
              $x = $kom - $telah;
              if($x >= 0) {
                $kom = $x;
                $allSemester[$i]['BelumKompen'] = $x;
              } else {
                $telah = -1 * $x;
                $allSemester[$i]['BelumKompen'] = 0;
              }
            }

          }
        }

      $mahasiswa = $profile[0];
      $mahasiswa['totalKompen']  = $totalKompen;
      $mahasiswa['telahKompen']  = $terkompen;
      $mahasiswa['sisaKompen']   = $totalKompen-$terkompen;

      $data['allSemester']  = $allSemester;
      $data['mahasiswa']    = $mahasiswa;
      $data['profile']      = $this->session->userdata('logged_in');
      $data['active']       = 'home';
      $data['content']      = 'mahasiswa/kompen_view';
      $data['nim']          = $nim;
      if($this->input->get('nim'))
        $data['active']     = 'alpaku';

      $this->load->view('index', $data);
    } else {
      $this->session->set_flashdata('error_notif', 'Mahasiswa tidak ditemukan');
      redirect('home');
    }
  
  }

  public function search($key)
  {
    $array  = $this->mahasiswa_model->getSearchById($key);
    $data   = array();

    foreach ($array as $val) {
      $a = array(
          'label' => $val['nim'].' ('.$val['nama_lengkap'].')',
          'value' => $val['nim']
        );
      $data[] = $a;
    }

    echo json_encode($data);
  }




  public function isUnameExistWhenEditProfile()
  {
    $username = $this->input->post('username');
    
    if($this->session->userdata('logged_in')['username'] != $username) {
      $mhsUname = $this->mahasiswa_model->getByUsername($username);
      if(count($mhsUname) > 0) {
        if($this->session->userdata('logged_in')['username'] != $mhsUname[0]['username']) {
          return true;
        }
      }
    }

    return false;
  }

  public function isUnameExistWhenEdit($nim)
  {
    $username = $this->input->post('username');

    $mhsUname = $this->mahasiswa_model->getByUsername($username);
    if(count($mhsUname) > 0) {
      if($nim != $mhsUname[0]['nim']) {
        return true;
      }
    }

    return false;
  }

  public function isUnameExistWhenAdd()
  {
    $username = $this->input->post('username');

    $mhsUname = $this->mahasiswa_model->getByUsername($username);
    if(count($mhsUname) > 0)
      return true;
    
    return false;
  }

  public function isNimExistWhenAdd()
  {
    $nim = $this->input->post('nim');

    $mhsNim = $this->mahasiswa_model->getById($nim);
    if(count($mhsNim) > 0)
      return true;
    
    return false;
  }

  public function isNimExistWhenEdit($nim)
  {
    $nim2 = $this->input->post('nim');

    if($nim == $nim2)
      return false;

    $mhsNim = $this->mahasiswa_model->getById($nim2);
    if(count($mhsNim) > 0)
      return true;

    return false;
  }
}