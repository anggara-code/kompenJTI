<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberi_tugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->login_model->ifNotLogged();

		$this->load->model('pemberi_tugas_model');

        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
	}

	public function index()
	{
		$data["profile"]		= $this->session->userdata('logged_in');
		// $data["pemberi_tugas"]	= $this->pemberi_tugas_model->getAll();
		$data['content']		= 'pemberi_tugas/pemberi_tugas_view';
        $data['active']			= 'pemberi_tugas';

		$this->load->view('index',$data);
	}

	public function data_server()
	{
		$this->pemberi_tugas_model->data_server();
	}

	public function edit($nip, $foto_profil)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip', 'nip', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
        
        $data['active']			= 'pemberi_tugas';

		if($this->form_validation->run()==FALSE)
		{
			$data['nip']		= $nip;
			$data['foto']		= $foto_profil;
			$data['profile']	= $this->session->userdata('logged_in');
			$data['data']		= $this->pemberi_tugas_model->getById($nip);
			$data['content']	= 'pemberi_tugas/edit_view';
			$data['error']		= '';

			$this->load->view('index',$data);
		}
		else
		{
			if($this->isUnameExist($nip)) {
				$this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
				redirect('pemberi_tugas/edit/'.$nip.'/'.$foto_profil);
			}

			$config['upload_path']          = './images/pemberi_tugas/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 1000000000;
	        $config['max_width']            = 10240;
	        $config['max_height']           = 7680;

	        $this->load->library('upload', $config);
	        $uploaded = false;

	        if($this->upload->do_upload('userfile'))
	        	$uploaded = true;
            
        	if($this->pemberi_tugas_model->edit($nip)) {
        		if($uploaded) {
					$urlFoto = './images/pemberi_tugas/'.$foto_profil;
					unlink($urlFoto);
        		}

            	$this->session->set_flashdata('notifikasi', 'Sukses mengedit data');
        		redirect('pemberi_tugas');
        	}
        	else {
        		$this->session->set_flashdata('error_notif', 'edit data gagal');
        		redirect('pemberi_tugas/edit/'.$nip.'/'.$foto_profil);
        	}
        
		}
	}

	public function editProfile($nip, $foto_profil)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
        
        $data['active']			= 'home';

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

			$config['upload_path']          = './images/pemberi_tugas/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 1000000000;
	        $config['max_width']            = 10240;
	        $config['max_height']           = 7680;

	        $this->load->library('upload', $config);
	        $uploaded = false;

	        if($this->upload->do_upload('foto_profil'))
	        	$uploaded = true;
            
        	if($this->pemberi_tugas_model->editProfile($nip)) {

        		$sess = $this->session->userdata('logged_in');
        		$sess['email']			= $this->input->post('email');
        		$sess['nomor_telepon']	= $this->input->post('nomor_telepon');
        		$sess['username']		= $this->input->post('username');

        		if($uploaded) {
        			$sess['foto_profil']	= $this->upload->data('file_name');
					$urlFoto = './images/pemberi_tugas/'.$foto_profil;
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

	public function isUnameExistWhenEditProfile()
	{
		$username = $this->input->post('username');

		if($this->session->userdata('logged_in')['username'] != $username) {
			$dnsUname = $this->pemberi_tugas_model->getByUsername($username);
			if(count($dnsUname) > 0) {
				if($this->session->userdata('logged_in')['username'] != $dnsUname[0]['username']) {
					return true;
				}
			}
		}

		return false;
	}

	public function isUnameExist($nip)
	{
		$username = $this->input->post('username');

		$dnsUname = $this->pemberi_tugas_model->getByUsername($username);
		if(count($dnsUname) > 0) {
			if($nip != $dnsUname[0]['nip']) {
				return true;
			}
		}

		return false;
	}


	public function add()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip', 'nip', 'trim|required');
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('nomor_telepon', 'nomor_telepon', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
        
        $data['active']			= 'pemberi_tugas';

		if (empty($_FILES['userfile']['name']))
		{
			$this->form_validation->set_rules('userfile', 'foto', 'trim|required');
		}
		if($this->form_validation->run()==FALSE)
		{
			$data['profile']	= $this->session->userdata('logged_in');
			$data['content']	= 'pemberi_tugas/add_view';
			$data['error']		= '';

			$this->load->view('index',$data);
		}
		else
		{
			if($this->isUnameExist($nip)) {
				$this->session->set_flashdata('error_notif', 'Username sudah digunakan, silahkan cari username lain');
				redirect('pemberi_tugas/add');
			}

			$config['upload_path']          = './images/pemberi_tugas/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 1000000000;
	        $config['max_width']            = 10240;
	        $config['max_height']           = 7680;
	        $this->load->library('upload', $config);
	        
	        if ( ! $this->upload->do_upload('userfile'))
            {
            	$data['profile']	= $this->session->userdata('logged_in');
				$data['content']	= 'pemberi_tugas/add_view';
            	$data['error'] 		= $this->upload->display_errors();
            	$this->session->set_flashdata('notifikasi' , 'Ukuran Foto Terlalu Besar');

				$this->load->view('index',$data);
            }
            else
            {
            	if($this->pemberi_tugas_model->insert()) {
            		$this->session->set_flashdata('notifikasi', 'Sukses menambah data');
            		redirect('pemberi_tugas');
            	}
            	else {
            		$this->session->set_flashdata('error_notif', 'menambah data gagal');
            		redirect('pemberi_tugas/add');
            	}
            }
		}
	}

	public function delete($nip, $foto_profil)
	{
		if($this->pemberi_tugas_model->delete($nip)) {
			$urlFoto = './images/pemberi_tugas/'.$foto_profil;
			unlink($urlFoto);
			$this->session->set_flashdata('notifikasi' , 'Dosen berhasil di hapus');
		}
		else
			$this->session->set_flashdata('error_notif' , 'Dosen berhasil di hapus');

		redirect('pemberi_tugas');
	}

}