<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('session'); // Load library season
        $this->load->helper('form'); // Load library form
        $this->load->helper('url'); // Load library url
	}

	public function index()
	{
        $this->login_model->ifLogged();
		
		$this->load->view('login');
	}

	public function login_pemberi_tugas()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run()) {
			$row = $this->login_model->getLoginPemberiTugas();

			if(count($row) > 0) {
				$row = $row[0];

				$this->session->set_flashdata('notifikasi', 'Selamat datang '.$row['level'].' '.$row['nama_lengkap']);
				$this->session->set_userdata('logged_in', $row);

				redirect('home');
			} else {
				$this->session->set_flashdata('notifikasi' , 'Username atau password salah');
				$this->session->set_flashdata('username', $this->input->post('username'));
				$this->session->set_flashdata('password', $this->input->post('password'));
				$this->session->set_flashdata('level', $this->input->get('level'));

				redirect('login?level=dosen');
			}
		}
		else {
			$this->session->set_flashdata('notifikasi' , 'Username dan password tidak boleh kosong');

			redirect('Login');
		}
	}

	public function login_mahasiswa()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run()) {
			$row = $this->login_model->getLoginMahasiswa();

			if(count($row) > 0) {
				$row = $row[0];
				$row['level']	= 'mahasiswa';

				$this->session->set_flashdata('notifikasi', 'Selamat datang '.$row['level'].' '.$row['nama_lengkap']);
				$this->session->set_userdata('logged_in', $row);

				redirect('home');
			} else {
				$this->session->set_flashdata('notifikasi' , 'Username atau password salah');
				$this->session->set_flashdata('username', $this->input->post('username'));
				$this->session->set_flashdata('password', $this->input->post('password'));
				$this->session->set_flashdata('level', 'mahasiswa');

				redirect('Login');
			}
		}
		else {
			$this->session->set_flashdata('notifikasi' , 'Username dan password tidak boleh kosong');

			redirect('Login');
		}
	}

	public function lupa_password()
	{
        $this->login_model->ifLogged();

		$this->load->view('lupa_password');
	}

	public function register()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'nama', 'trim|required');
		$this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'trim|required');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if($this->form_validation->run()) {
			$this->load->model('mahasiswa_model');

			$mhsNim = $this->mahasiswa_model->getById($this->input->post('nim'));

			if(count($mhsNim) <= 0) {
				$mhsUname = $this->mahasiswa_model->getByUsername($this->input->post('username'));

				if(count($mhsUname) <= 0) {
					$config['upload_path']          = './images/mahasiswa/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 1000000000;
					$config['max_width']            = 10240;
					$config['max_height']           = 7680;

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('userfile')) {
						$this->session->set_flashdata('error_notif', $this->upload->display_errors());
						$this->setNotifRegister();
						redirect('login/register');
					} else {
						if($this->mahasiswa_model->insert()) {
							$this->session->set_flashdata('success_notif', 'Registrasi berhasil, silahkan login');
							redirect('login');
						} else {
							$this->session->set_flashdata('error_notif', 'menambah data gagal');
							$this->setNotifRegister();
							redirect('login/register');
						}
					}

				} else {
					$this->setNotifRegister();
					$this->session->set_flashdata('error_notif', 'Username sudah digunakan mahasiswa lain. silahkan ganti username anda');
					redirect('login/register');
				}
			} else {
				$this->setNotifRegister();
				$this->session->set_flashdata('error_notif', 'Anda sudah terdaftar, jika password lupa silahkan menghubungi Pak Kadek Suarjuna');
				redirect('login/register');
			}
		}
		else {
			$this->load->view('register');
		}

	}

	private function setNotifRegister() {
		$this->session->set_flashdata('nim', $this->input->post('nim'));
		$this->session->set_flashdata('nama_lengkap', $this->input->post('nama_lengkap'));
		$this->session->set_flashdata('tahun_masuk', $this->input->post('tahun_masuk'));
		$this->session->set_flashdata('prodi', $this->input->post('prodi'));
		$this->session->set_flashdata('username', $this->input->post('username'));
		$this->session->set_flashdata('password', $this->input->post('password'));
		$this->session->set_flashdata('nomor_telepon', $this->input->post('nomor_telepon'));
		$this->session->set_flashdata('email', $this->input->post('email'));
	}

	public function logout() 
    {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('api');
		session_destroy();
		redirect('Login');
	}
}



	// public function cekLevel()
	// {
	// 	$session_data = $this->session->userdata('logged_in');
	// 	$level["level"] = $session_data['level'];

	// 	if($level["level"] == "dosen" or $level["level"] == "admin")
	// 	{
 //            redirect('Pemberi_tugas');
	// 	}
	// 	else
	// 	{
 //            redirect('Mahasiswa'); 
 //      	}
	// }

      ///////////////////////////////////////////////////////////////// END FUNGSI LOGIN



	// public function add()
 //  {
 //    $this->load->helper('url','form');  
 //    $this->load->library('form_validation');

 //    $this->form_validation->set_rules('nim', 'NIM', 'trim|required');
 //    $this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'trim|required');
 //    $this->form_validation->set_rules('username', 'username', 'trim|required');
 //    $this->form_validation->set_rules('password', 'password', 'trim|required');
 //    $this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
 //    $this->form_validation->set_rules('email', 'email', 'trim|required');
        
 //    $data['active']     = 'mahasiswa';

 //    if (empty($_FILES['userfile']['name']))
 //    {
 //      $this->form_validation->set_rules('userfile', 'foto', 'trim|required');
 //    }
 //    if($this->form_validation->run()==FALSE)
 //    {
 //      $data['profile']  = $this->session->userdata('logged_in');
 //      $data['content']  = 'mahasiswa/add_view';
 //      $data['error']    = '';

 //      $this->load->view('index',$data);
 //    }
 //    else
 //    {
 //      if($this->isUnameExistWhenAdd()) {
 //        $this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
 //        redirect('mahasiswa/add');
 //      }
 //      $config['upload_path']          = './images/mahasiswa/';
 //      $config['allowed_types']        = 'gif|jpg|png';
 //      $config['max_size']             = 1000000000;
 //      $config['max_width']            = 10240;
 //      $config['max_height']           = 7680;
 //      $this->load->library('upload', $config);
      
 //      if ( ! $this->upload->do_upload('userfile'))
 //      {
 //        $data['profile']  = $this->session->userdata('logged_in');
 //        $data['content']  = 'pemberi_tugas/add_view';
 //        $data['error']    = $this->upload->display_errors();
 //        $this->session->set_flashdata('notifikasi' , 'Ukuran Foto Terlalu Besar');

 //        $this->load->view('index',$data);
 //      }
 //      else
 //      {
 //        if($this->mahasiswa_model->insert()) {
 //          $this->session->set_flashdata('notifikasi', 'Sukses mengedit data');
 //          redirect('mahasiswa');
 //        }
 //        else {
 //          $this->session->set_flashdata('error_notif', 'menambah data gagal');
 //          redirect('mahasiswa/add');
 //        }
 //      }
 //    }
 //  }

	// public function cekDB()
	// {
	// 	$username = $this->input->post('username');
	// 	$password = $this->input->post('password');

	// 	$this->load->model('login_model');
	// 	$result = $this->login_model->loginPemberiTugas($username, $password);
 //        if($result)
 //        {
 //           	$sess_array = array();
 //            foreach ($result as $row) 
 //            {
 //                $sess_array = 
 //                array(
 //                        'nama_lengkap'=>$row->nama_lengkap,
 //                        'nip'=>$row->nip,
 //                        'nomor_telepon' => $row->nomor_telepon,
 //                        'level' => $row->level
 //                );
 //                $this->session->set_userdata('logged_in',$sess_array);

 //                if ($row->level == 'admin') 
 //                {
 //                	$this->session->set_flashdata('notifikasi' , 'Selamat Datang Admin '.$row->nama_lengkap);
 //                }
 //                else
 //                {
 //                	$this->session->set_flashdata('notifikasi' , 'Selamat Datang Dosen '.$row->nama_lengkap);
 //                }
 //            }
 //            return true;
 //        }
 //        else
 //        {
	//      	$URL1='http://polin3m4:openws@api.polinema.ac.id/siakad/mahasiswa/semester?nim=';
	// 		$URL2=$username;
	// 		$URL=$URL1.$URL2;
	// 		$ch = curl_init();
	// 		curl_setopt($ch, CURLOPT_URL,$URL);
	// 		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
	// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	// 		$result=curl_exec ($ch);
	// 		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
	// 		curl_close ($ch);
	// 		$obj = json_decode($result);
	// 		$status = $obj->{'status'};  
	// 		if ($status == 'error') 
	// 		{
	// 			$this->session->set_flashdata('notifikasi' , 'Nim tidak terdaftar atau salah');
	// 		  	return false;
	// 		}
	// 		else
	// 		{
	// 		   	$data = $obj->{'data'};
	// 	    	$nama = $data[0]->nama;
	// 	    	$nim = $data[0]->nim;

	// 	    	$this->load->model('login_model');
	// 			$result = $this->login_model->loginMahasiswa($username, $nim);

	// 			if($result)
	// 			{
	// 				$sess_array = array(); // Memasukkan array pada session
	// 				foreach ($result as $row) 
	// 				{
	// 					$sess_array = array(
	// 						'nama_lengkap'=>$row->nama_lengkap,
	// 						'nim'=>$row->nim,
	// 						'nomor_telepon' => $row->nomor_telepon,
	// 						'level' => 'mahasiswa'
	// 					);
	// 					$this->session->set_userdata('logged_in',$sess_array);
	// 				}
	// 				$this->session->set_flashdata('notifikasi' , 'Selamat datang, mahasiswa '.$row->nama_lengkap);
	// 				return true;
	// 			}
	// 			else
	// 			{
	// 				$sess_array = array(
	// 		    		'nama_lengkap'=>$nama,
	// 					'nim'=>$nim,
	// 					'nomor_telepon' => 0,
	// 					'level' => 'mahasiswa'
	// 				);

	// 				$this->session->set_userdata('logged_in',$sess_array);
	// 				$this->login_model->insertMhs($nim,$nama);
	// 				$this->session->set_flashdata('notifikasi' , 'Selamat datang, ini pertama kali anda login '.$nama.' , Silahkan melengkapi profil anda');
	// 				return true;
					
	// 			}

	// 		}
                
	// 	}
            
	// }