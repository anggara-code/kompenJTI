<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_Model extends CI_Model {

	public function getLoginPemberiTugas() {
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));

		if($this->input->get('level') == 'admin') {
			$this->db->where('level', 'admin');
			return $this->db->get('pemberi_tugas')->result_array();
		} else if($this->input->get('level') == 'dosen') {
			$this->db->where('level', 'dosen');
			return $this->db->get('pemberi_tugas')->result_array();
		}
	}

	public function getLoginMahasiswa() {
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));

		return $this->db->get('mahasiswa')->result_array();
	}

	public function cariMHS($nim)
	{
			$this->db->where('nim', $nim);
			$query = $this->db->get('mahasiswa');
			if($query->num_rows()==1)
			{
				return true;
			}
			else
			{
				return false;
			}
	}

	public function insertMhs($nim,$nama)
	{
		$object = array(
				'nim' => $nim,
				'nama_lengkap' => $nama,
				'foto_profil' => 'mahasiswa.png'
				);
		$this->db->insert('mahasiswa', $object);
	}

	public function ifLogged() {
		if($this->session->userdata('logged_in')) {
			redirect('home');
		}
	}

	public function ifNotLogged() {
		if(!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}


	// public function loginMahasiswa($username, $password)
	// {
	// 		$this->db->where('nim', $username);
	// 		$this->db->where('nim', $password);
	// 		$query = $this->db->get('mahasiswa');
	// 		if($query->num_rows()==1)
	// 		{
	// 			return $query->result();
	// 		}
	// 		else
	// 		{
	// 			return false;
	// 		}
	// }

	// public function loginPemberiTugas($username, $password)
	// {

	// 		$this->db->where('nip', $username);
	// 		$this->db->where('nip', $password);
	// 		$query = $this->db->get('pemberi_tugas');
	// 		if($query->num_rows()==1)
	// 		{
	// 			return $query->result();
	// 		}
	// 		else
	// 		{
	// 			return false;
	// 		}
	// }
}