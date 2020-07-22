<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pemberi_tugas_model extends CI_Model {

	public function getDataPemberiTugas($nama_lengkap)
	{
		$this->db->where('nama_lengkap', $nama_lengkap);	
		$query = $this->db->get('pemberi_tugas',1);
		return $query->result();
	}

	public function getDataPemberiTugasByNip($nip)
	{
		$this->db->where('nip', $nip);	
		$query = $this->db->get('pemberi_tugas',1);
		return $query->result();
	}

	public function getById($nip) 
	{
		$this->db->where('nip', $nip);

		return $this->db->get('pemberi_tugas')->result_array()[0];
	}

	public function getAll()
	{
		$this->db->order_by('level', 'DESC');

		return $this->db->get('pemberi_tugas')->result_array();
	}

	public function getByUsername($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('pemberi_tugas')->result_array();
	}

	public function getAllAdmin()
	{
		$this->db->where('level', 'admin');
		return $this->db->get('pemberi_tugas')->result_array();
	}

	public function data_server()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('nip, nama_lengkap, foto_profil, email, username, level, super_admin')
			->from('pemberi_tugas');

		echo $this->datatables->generate();
	}

	public function insert()
	{
		$object = array( 'nip' 	=> $this->input->post('nip'),
				'nama_lengkap'	=> $this->input->post('nama_lengkap'), 
				'username' 		=> $this->input->post('username'), 
				'password' 		=> md5($this->input->post('password')), 
				'nomor_telepon'	=> $this->input->post('nomor_telepon'),
				'email'			=> $this->input->post('email'), 
				'foto_profil'	=> $this->upload->data('file_name'));

		return $this->db->insert('pemberi_tugas', $object);
	}

	public function edit($nip)
	{
		$object = array(
				'nip' 			=> $this->input->post('nip'),
				'nama_lengkap' 	=> $this->input->post('nama_lengkap'), 
				'username' 		=> $this->input->post('username'), 
				'nomor_telepon' => $this->input->post('nomor_telepon'),
				'email' 		=> $this->input->post('email'),
				'level' 		=> $this->input->post('level'),
			);

		if($this->input->post('password'))
			$object['password'] = md5($this->input->post('password'));

		if($this->upload->data('file_name') != '')
			$object['foto_profil'] = $this->upload->data('file_name');

		$this->db->where('nip', $nip);

		return $this->db->update('pemberi_tugas', $object);
	}


	public function editProfile($nip)
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

		$this->db->where('nip', $nip);

		return $this->db->update('pemberi_tugas', $object);
	}

	public function delete($nip)
	{
		return $this->db->delete('pemberi_tugas', array('nip' => $nip));
	}
}