<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class mahasiswa_model extends CI_Model {

	public function getDataMahasiswa($params)
	{
		if ($params == '') 
		{	
			$query = $this->db->get('mahasiswa');
			return $query->result();
		}
		else
		{
			$this->db->where('nama_lengkap', $params);	
			$query = $this->db->get('mahasiswa',1);
			return $query->result();
		}
	}

	public function getDataMahasiswaAll()
	{
		$query = $this->db->get('mahasiswa');
		return $query->result();
	}

	public function getAll()
	{
		return $this->db->get('mahasiswa')->result_array();
	}


	public function getById($nim) 
	{
		$this->db->where('nim', $nim);

		return $this->db->get('mahasiswa')->result_array()[0];
	}

	public function getSearchById($key)
	{
		$this->db->select('nim, nama_lengkap');
		$this->db->like('nim', $key, 'after');
		return $this->db->get('mahasiswa')->result_array();
	}

	public function getByUsername($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('mahasiswa')->result_array();
	}

	public function data_server()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('nim, nama_lengkap, foto_profil, email, username')
			->from('mahasiswa');

		echo $this->datatables->generate();
	}

	public function deleteMahasiswa($nim)
	{
		$this->db->delete('mahasiswa', array('nim' => $nim));

	}

	public function insertdata()
	{
		$object = array(
				'nim' => $this->input->post('nim'),
				'nama_lengkap' => $this->input->post('nama_lengkap'), 
				'username' => $this->input->post('username'), 
				'password' => $this->input->post('password'), 
				'nomor_telepon' => $this->input->post('nomor_telepon'),
				'email' => $this->input->post('email'),
				'foto_profil' => $this->upload->data('file_name')
				);
		$this->db->insert('mahasiswa', $object);
	}
	public function getDataMahasiswaByNim($nim)
	{
		$this->db->where('nim', $nim);	
		$query = $this->db->get('mahasiswa',1);
		if($query->num_rows()==1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}	
	public function editMahasiswa($nim)
	{
		$object = array(
				'nama_lengkap' => $this->input->post('nama_lengkap'), 
				'username' => $this->input->post('username'), 
				'password' => $this->input->post('password'), 
				'nomor_telepon' => $this->input->post('nomor_telepon'),
				'jumlah_kompen' => $this->input->post('jumlah_kompen'),
				'email' => $this->input->post('email'),
				'foto_profil' => $this->input->post('foto_profil')
				);
		$this->db->where('nim', $nim);
		$this->db->update('mahasiswa', $object);
	}

	public function upload_form()
	{
		date_default_timezone_set('Asia/Jakarta');
        $date = date('d-m-Y H:i:s');
		$object = array(
				'nim' => $this->input->post('nim'), 
				'foto' => $this->upload->data('file_name'), 
				'tanggal' => $date
				);
		$this->db->insert('form_kompen', $object);
	}
	public function getDataForm_Kompen($params)
	{
		$this->db->where('nim', $params);	
		$query = $this->db->get('form_kompen');
		return $query->result();
	}



	public function insert()
	{
		$object = array( 'nim' 	=> $this->input->post('nim'),
				'nama_lengkap'	=> $this->input->post('nama_lengkap'), 
				'tahun_masuk' 	=> $this->input->post('tahun_masuk'), 
				'prodi' 		=> $this->input->post('prodi'), 
				'username' 		=> $this->input->post('username'), 
				'password' 		=> md5($this->input->post('password')), 
				'nomor_telepon'	=> $this->input->post('nomor_telepon'),
				'email'			=> $this->input->post('email'), 
				'foto_profil'	=> $this->upload->data('file_name'));

		return $this->db->insert('mahasiswa', $object);
	}

	public function edit($nim)
	{
		$object = array(
				'nim' 			=> $this->input->post('nim'),
				'nama_lengkap' 	=> $this->input->post('nama_lengkap'), 
				'tahun_masuk' 	=> $this->input->post('tahun_masuk'), 
				'prodi' 		=> $this->input->post('prodi'), 
				'username' 		=> $this->input->post('username'), 
				'nomor_telepon' => $this->input->post('nomor_telepon'),
				'email' 		=> $this->input->post('email'),
			);

		if($this->input->post('password'))
			$object['password'] = md5($this->input->post('password'));

		if($this->upload->data('file_name') != '')
			$object['foto_profil'] = $this->upload->data('file_name');

		$this->db->where('nim', $nim);

		return $this->db->update('mahasiswa', $object);
	}

	public function editProfile($nim)
	{
		$object = array(
				'username' 		=> $this->input->post('username'), 
				'nomor_telepon' => $this->input->post('nomor_telepon'),
				'email' 		=> $this->input->post('email'),
			);

		if($this->input->post('password'))
			$object['password'] = md5($this->input->post('password'));

		if($this->upload->data('file_name') != '')
			$object['foto_profil'] = $this->upload->data('file_name');

		$this->db->where('nim', $nim);

		return $this->db->update('mahasiswa', $object);
	}

	public function delete($nim)
	{
		$this->db->where('nim', $nim);
		return $this->db->delete('mahasiswa');
	}


}