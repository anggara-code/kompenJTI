<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_tugas_model extends CI_Model {

	public function getByTugas($id_tugas)
	{
		$this->db->select('*');
		$this->db->from('transaksi_tugas t');
		$this->db->join('mahasiswa m', 't.nim=m.nim');
		$this->db->where('id_tugas', $id_tugas);
		
		return $this->db->get()->result_array();
	}

	public function getByNimTugasDone($nim)
	{
		$this->db->select('id, jam_kompen, semester');
		$this->db->from('transaksi_tugas');
		$this->db->where('nim', $nim);
		$this->db->where('status', 1);
		
		return $this->db->get()->result_array();
	}

	public function getDetailTugas($id_tugas, $nim)
	{
		$this->db->select('a.id, 
			a.jam_kompen, 
			a.semester, 
			a.tanggal_input, 
			a.status,
			b.*,
			c.*');
		$this->db->from('transaksi_tugas a');
		$this->db->join('tugas b', 'a.id_tugas=b.id_tugas');
		$this->db->join('mahasiswa c', 'a.nim=c.nim');
		$this->db->where('a.id_tugas', $id_tugas);
		$this->db->where('a.nim', $nim);

		return $this->db->get()->result_array()[0];
	}


	public function insert($id_tugas)
	{
		$URL='http://polin3m4:openws@api.polinema.ac.id/siakad/mahasiswa/semester?nim='.$this->input->post('nim');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result=curl_exec ($ch);
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
		curl_close ($ch);
		$obj = json_decode($result, true);
		$result = $obj['data'];

		$semester = end($result)['semester'];

		$object = array(
				'id_tugas'		=> $id_tugas,
				'nim'			=> $this->input->post('nim'),
				'jam_kompen'	=> $this->input->post('jam_kompen'),
				'semester'		=> $semester,
				'tanggal_input'	=> date('d-m-Y H:i:s'),
				'keterangan'	=> '',
				'status'		=> 0
			);

		return $this->db->insert('transaksi_tugas', $object);
	}

	public function delete($id)
	{
		return $this->db->delete('transaksi_tugas', array('id' => $id));
	}

	public function getMyTransaksiMhs()
	{
		$this->db->select('a.id, 
			a.jam_kompen, 
			a.semester, 
			a.tanggal_input, 
			a.status,
			b.*,
			c.nama_lengkap');
		$this->db->from('transaksi_tugas a');
		$this->db->join('tugas b', 'a.id_tugas=b.id_tugas');
		$this->db->join('pemberi_tugas c', 'b.nip=c.nip');
		$this->db->where('a.nim', $this->session->userdata('logged_in')['nim']);
		$this->db->order_by("a.id","desc");

		return $this->db->get()->result_array();
	}


	public function valid($id, $isValid)
	{
		$object = array('status' => $isValid);

		$this->db->where('id', $id);

		return $this->db->update('transaksi_tugas', $object);
	}

}