<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tugas_model extends CI_Model {


	public function getById($id) 
	{
		$this->db->where('id_tugas', $id);
		$this->db->where('ditutup', 0);

		return $this->db->get('tugas')->result_array()[0];
	}

	public function getAll()
	{
		$this->db->select('t.*, p.nama_lengkap');
		$this->db->from('tugas t');
		$this->db->join('pemberi_tugas p', 't.nip=p.nip');
		$this->db->order_by('id_tugas DESC');

		if($this->session->userdata('logged_in')['level'] == 'dosen')
			$this->db->where('t.nip', $this->session->userdata('logged_in')['nip']);

		$this->db->where('ditutup', 0);

		return $this->db->get()->result_array();
	}

	public function getMyHistory()
	{
		$this->db->select('t.*, p.nama_lengkap');
		$this->db->from('tugas t');
		$this->db->join('pemberi_tugas p', 't.nip=p.nip');
		$this->db->order_by('id_tugas DESC');

		$this->db->where('t.nip', $this->session->userdata('logged_in')['nip']);
		$this->db->where('ditutup', 1);

		return $this->db->get()->result_array();
	}

	public function getAllHistory()
	{
		$this->db->select('t.*, p.nama_lengkap');
		$this->db->from('tugas t');
		$this->db->join('pemberi_tugas p', 't.nip=p.nip');
		$this->db->order_by('id_tugas DESC');

		$this->db->where('ditutup', 1);

		return $this->db->get()->result_array();
	}

	public function data_server()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('p.nama_lengkap, t.judul_tugas, t.tipe_tugas, t.date, t.kuota, t.jumlah_kompen, t.deskripsi, t.id_tugas')
			->from('tugas t')
			->join('pemberi_tugas p', 't.nip=p.nip')
			->where('t.ditutup', 0)
			->where('t.nip', $this->session->userdata('logged_in')['nip']);

		echo $this->datatables->generate();
	}

	public function data_server_mhs_tugasready()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('p.nama_lengkap, 
						p.foto_profil, 
						t.judul_tugas, 
						t.tipe_tugas, 
						t.date, 
						CONCAT(t.kuota, " mhs") as kuota, 
						CONCAT(t.jumlah_kompen, " jam") as jumlah_kompen, 
						t.deskripsi, 
						t.id_tugas, 
						CONCAT((SELECT count(tt.id) FROM transaksi_tugas tt WHERE tt.id_tugas=t.id_tugas), " mhs") as kuota_terisi')
			->from('tugas t')
			->join('pemberi_tugas p', 't.nip=p.nip')
			->where('t.ditutup', 0);

		echo $this->datatables->generate();
	}

	public function data_server_myhistory()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('p.nama_lengkap, t.judul_tugas, t.tipe_tugas, t.date, t.kuota, t.jumlah_kompen, t.deskripsi, t.id_tugas')
			->from('tugas t')
			->join('pemberi_tugas p', 't.nip=p.nip')
			->where('t.ditutup', 1)
			->where('t.nip', $this->session->userdata('logged_in')['nip']);

		echo $this->datatables->generate();
	}

	public function data_server_allhistory()
	{
		$this->load->library('Datatables');
		$this->datatables
			->select('p.nama_lengkap, t.judul_tugas, t.tipe_tugas, t.date, t.kuota, t.jumlah_kompen, t.deskripsi, t.id_tugas')
			->from('tugas t')
			->join('pemberi_tugas p', 't.nip=p.nip')
			->where('t.ditutup', 1);

		echo $this->datatables->generate();
	}

	public function insert()
	{
		$object = array(
				'nip'			=> $this->session->userdata('logged_in')['nip'], 
				'judul_tugas' 	=> $this->input->post('judul_tugas'), 
				'tipe_tugas' 	=> $this->input->post('tipe_tugas'), 
				'kuota'			=> $this->input->post('kuota'),
				'jumlah_kompen'	=> $this->input->post('jumlah_kompen'),
				'date'			=> date('d-m-Y H:i:s'),
				'deskripsi'		=> $this->input->post('deskripsi')
			);

		return $this->db->insert('tugas', $object);
	}

	public function edit($id)
	{
		$object = array(
				'nip'			=> $this->session->userdata('logged_in')['nip'], 
				'judul_tugas' 	=> $this->input->post('judul_tugas'), 
				'tipe_tugas' 	=> $this->input->post('tipe_tugas'), 
				'kuota' 		=> $this->input->post('kuota'),
				'jumlah_kompen' => $this->input->post('jumlah_kompen'),
				'deskripsi'		=> $this->input->post('deskripsi'),
			);

		$this->db->where('id_tugas', $id);

		return $this->db->update('tugas', $object);
	}

	public function delete($id)
	{
		return $this->db->delete('tugas', array('id_tugas' => $id));
	}

	public function close($id)
	{
		$object = array('ditutup' 	=> 1);

		$this->db->where('id_tugas', $id);

		return $this->db->update('tugas', $object);
	}



	// public function getDataTugas($params)
	// {
	// 	$nama_lengkap = array('nama_lengkap'=>$params);
	// 	$this->db->select('*');
	// 	$this->db->from('tugas');
	// 	$this->db->join('pemberi_tugas','tugas.nip = pemberi_tugas.nip');
	// 	$this->db->where($nama_lengkap);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function getDataTugasAdmin()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('tugas');
	// 	$this->db->join('pemberi_tugas','tugas.nip = pemberi_tugas.nip');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }


	// public function getDataHistory($params)
	// {
	// 	$session_data = $this->session->userdata('logged_in');
	// 	$level = $session_data['level'];

	// 	if ($level == 'dosen' or $level == 'admin') 
	// 	{
	// 		$nim = array('pemberi_tugas.nama_lengkap'=>$params);
	// 		$this->db->select('*');
	// 		$this->db->from('history_tugas');
	// 		$this->db->join('tugas','history_tugas.id_tugas=tugas.id_tugas');
	// 		$this->db->join('pemberi_tugas','tugas.nip=pemberi_tugas.nip');
	// 		$this->db->join('mahasiswa','history_tugas.nim=mahasiswa.nim');
	// 		$this->db->where($nim);
	// 		$this->db->where('history_tugas.status = "belum"');
	// 		$query = $this->db->get();
	// 		return $query->result();
	// 	}
	// 	else
	// 	{
	// 		$nim = array('nim'=>$params);
	// 		$this->db->select('*');
	// 		$this->db->from('history_tugas');
	// 		$this->db->join('tugas','tugas.id_tugas=history_tugas.id_tugas');
	// 		$this->db->join('pemberi_tugas','tugas.nip=pemberi_tugas.nip');
	// 		$this->db->where($nim);
	// 		$query = $this->db->get();
	// 		return $query->result();
	// 	}
	// }

	// public function getDataTugasAll()
	// {
	// 	//$key = array('history.nim'=>$nim2);
	// 	$this->db->select('*');
	// 	$this->db->from('tugas');
	// 	$this->db->join('pemberi_tugas','tugas.nip = pemberi_tugas.nip');
	// 	//$this->db->join('mahasiswa','history_tugas.nim = mahasiswa.nim');
	// 	//$this->db->join('history_tugas','tugas.id_tugas = history_tugas.id_tugas');
	// 	$this->db->where('tugas.kuota > 0');
	// 	//$this->db->where('history_tugas.nim !=',$nim2);
	// 	//$this->db->where($key);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function getLast()
	// {
	// 	$last=$this->db->query('SELECT * FROM tugas ORDER BY id_tugas DESC LIMIT 1');
	// 	return $last->row();
	// }

	// public function insert($raw)
	// {
	// 	$sql="INSERT IGNORE INTO tugas (id_tugas,nip,judul_tugas,tipe_tugas,kuota,jumlah_kompen,date,deskripsi) VALUES(?,?,?,?,?,?,?,?);";
	// 	$this->db->query($sql, array($raw['id_tugas'],$raw['nip'],$raw['judul_tugas'],$raw['tipe_tugas'],$raw['kuota'],$raw['jumlah_kompen'],$raw['date'],$raw['deskripsi']));
	// 	return $this->db->affected_rows();
	// }

	// public function insertHistory($raw)
	// {
	// 	$sql="INSERT IGNORE INTO history_tugas (id_tugas,nim,date) VALUES(?,?,?);";
	// 	$this->db->query($sql, array($raw['id_tugas'],$raw['nim'],$raw['date']));
	// 	return $this->db->affected_rows();
	// }

	// public function delete($id_tugas)
	// {
	// 	$key = array('history_tugas.id_tugas'=>$id_tugas);
	// 	$this->db->select('*');
	// 	$this->db->from('history_tugas');
	// 	$this->db->join('tugas','tugas.id_tugas=history_tugas.id_tugas');
	// 	$this->db->join('mahasiswa','history_tugas.nim=mahasiswa.nim');
	// 	$this->db->join('pemberi_tugas','tugas.nip=pemberi_tugas.nip');
	// 	$this->db->where($key);
	// 	$query = $this->db->get();
	// 	if($query->num_rows()==1)
	// 	{
	// 		return $query->result();
	// 	}
	// 	else
	// 	{
	// 		$this->db->delete('tugas', array('id_tugas' => $id_tugas));
	// 	}
	// }

	// public function getSeleksiTugas($id_tugas)
	// {
	// 	$query = 
	// 	$this->db->query('
	// 		SELECT tugas.*,pemberi_tugas.nama_lengkap
	// 		FROM tugas 
	// 		JOIN pemberi_tugas 
	// 		ON tugas.nip = pemberi_tugas.nip
	// 		WHERE id_tugas = ' . $id_tugas);
	// 	return $query->result();

	// }

	// public function getSeleksiHistoryTugas($id_history)
	// {
	// 		$id_history = array('id_history'=>$id_history);
	// 		$this->db->select('
	// 			mahasiswa.nama_lengkap AS nama_mahasiswa, 
	// 			mahasiswa.nim AS nim,
	// 			mahasiswa.email AS email_mhs,
	// 			mahasiswa.jumlah_kompen AS mhs_kompen,
	// 			pemberi_tugas.nama_lengkap AS nama_dosen,
	// 			pemberi_tugas.nip AS nip,
	// 			tugas.id_tugas AS id_tugas,
	// 			tugas.judul_tugas AS judul_tugas,
	// 			tugas.tipe_tugas AS tipe_tugas,
	// 			tugas.deskripsi AS deskripsi,
	// 			tugas.jumlah_kompen AS jumlah_kompen,
	// 			history_tugas.date AS date');
	// 		$this->db->from('history_tugas');
	// 		$this->db->join('tugas','tugas.id_tugas=history_tugas.id_tugas');
	// 		$this->db->join('mahasiswa','history_tugas.nim=mahasiswa.nim');
	// 		$this->db->join('pemberi_tugas','tugas.nip=pemberi_tugas.nip');
	// 		$this->db->where($id_history);
	// 		$query = $this->db->get();
	// 		return $query->result();
	// }

	// public function getSeleksiHistoryTugasByIdNim($id_tugas,$nim)
	// {
	// 	$key = array('history_tugas.id_tugas'=>$id_tugas,'history_tugas.nim'=>$nim);
	// 	$this->db->select('*');
	// 	$this->db->from('history_tugas');
	// 	$this->db->join('tugas','tugas.id_tugas=history_tugas.id_tugas');
	// 	$this->db->join('mahasiswa','history_tugas.nim=mahasiswa.nim');
	// 	$this->db->join('pemberi_tugas','tugas.nip=pemberi_tugas.nip');
	// 	$this->db->where('tugas.kuota > 0');
	// 	$this->db->where($key);
	// 	$query = $this->db->get();
	// 	if($query->num_rows()==1)
	// 	{
	// 		return $query->result();
	// 	}
	// 	else
	// 	{
	// 		return false;
	// 	}
	// }

	// public function getHistoryTugas()
	// {	
	// 	$this->db->select('history_tugas.id_history AS id_history,
	// 		tugas.id_tugas AS id_tugas,pemberi_tugas.nama_lengkap AS namaDosen,mahasiswa.nama_lengkap AS namaMahasiswa, history_tugas.date AS tanggal,mahasiswa.nim AS nim,history_tugas.kondisi AS kondisi');
	// 	$this->db->from('history_tugas');
	// 	$this->db->join('tugas','tugas.id_tugas = history_tugas.id_tugas');
	// 	$this->db->join('mahasiswa','history_tugas.nim = mahasiswa.nim');
	// 	$this->db->join('pemberi_tugas','tugas.nip = pemberi_tugas.nip');
	// 	$query = $this->db->get();
	// 	return $query->result();

	// }

	// public function getHistoryByNim($nim)
	// {	
	// 	$nim = array('nim'=>$nim);
	// 	$this->db->select('*');
	// 	$this->db->from('history_tugas');
	// 	$this->db->join('tugas','tugas.id_tugas = history_tugas.id_tugas');
	// 	$this->db->join('pemberi_tugas','tugas.nip = pemberi_tugas.nip');
	// 	$this->db->where($nim);
	// 	$query = $this->db->get();
	// 	return $query->result();

	// }

	// public function updateKuota($id_tugas,$kuotabaru)
	// {
	// 	$data = array('kuota' => $kuotabaru);
	// 	$this->db->where('id_tugas', $id_tugas);
	// 	$this->db->update('tugas', $data);
	// }

	// public function updatePemberiTugas($nip,$nama_lengkap,$email,$nomor_telepon)
	// {
	// 	$data = array('nama_lengkap' => $nama_lengkap,'email' => $email,'nomor_telepon' => $nomor_telepon);
	// 	$this->db->where('nip', $nip);
	// 	$this->db->update('pemberi_tugas', $data);
	// }

	// public function updateMahasiswa($nim,$nama_lengkap,$email,$nomor_telepon)
	// {
	// 	$data = array('nama_lengkap' => $nama_lengkap,'email' => $email,'nomor_telepon' => $nomor_telepon);
	// 	$this->db->where('nim', $nim);
	// 	$this->db->update('mahasiswa', $data);
	// }

	// public function updateVerifikasiSelesai($id_history)
	// {
	// 	$data = array('status' => 'selesai');
	// 	$this->db->where('id_history', $id_history);
	// 	$this->db->update('history_tugas', $data);
	// }

	// public function updateJumlahKompen($nim,$total)
	// {
	// 	$data = array('jumlah_kompen' => $total);
	// 	$this->db->where('nim', $nim);
	// 	$this->db->update('mahasiswa', $data);
	// }

	// public function updateRekapitulasi($nip,$rekapakhir)
	// {
	// 	$data = array('total' => $rekapakhir);
	// 	$this->db->where('nip', $nip);
	// 	$this->db->update('rekapitulasi', $data);
	// }

	// public function getRekapitulasi($nip)
	// {
	// 	$nama_lengkap = array('nip'=>$nip);
	// 	$this->db->select('total');
	// 	$this->db->from('rekapitulasi');
	// 	$this->db->where($nama_lengkap);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function updateKondisi($id_history)
	// {
	// 	$data = array('kondisi' => 'sudah');
	// 	$this->db->where('id_history', $id_history);
	// 	$this->db->update('history_tugas', $data);
	// }

	// public function updateVerifikasiGagal($id_history)
	// {
	// 	$data = array('status' => 'gagal');
	// 	$this->db->where('id_history', $id_history);
	// 	$this->db->update('history_tugas', $data);
	// }
	// public function getHistoryByNamaLengkap($id_tugas)
	// {
	// 	$data = array('history_tugas.id_tugas' => $id_tugas,'history_tugas.kondisi' => 'sudah');
	// 	$this->db->select('*');
	// 	$this->db->from('history_tugas');
	// 	$this->db->join('tugas','history_tugas.id_tugas = tugas.id_tugas');
	// 	$this->db->join('mahasiswa','history_tugas.nim = mahasiswa.nim');
	// 	$this->db->where($data);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	// public function getRekapitulasiAll()
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('rekapitulasi');
	// 	$this->db->join('pemberi_tugas','pemberi_tugas.nip = rekapitulasi.nip');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	
}