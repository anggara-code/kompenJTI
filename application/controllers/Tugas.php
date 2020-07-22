<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('login_model');
		$this->login_model->ifNotLogged();

		$this->load->model('tugas_model');
	}


	public function index()
	{
		$data["profile"]		= $this->session->userdata('logged_in');
		$data["tugas"]			= $this->tugas_model->getAll();
		$data['content']		= 'tugas/tugas_view';
	    $data['active']			= 'tugas';
		$this->load->view('index',$data);
	}

	public function data_server()
	{
		$this->tugas_model->data_server();
	}

	public function data_server_myhistory()
	{
		$this->tugas_model->data_server_myhistory();
	}

	public function data_server_allhistory()
	{
		$this->tugas_model->data_server_allhistory();
	}

	public function data_server_mhs_tugasready()
	{
		$this->tugas_model->data_server_mhs_tugasready();
	}

	public function history()
	{
		$data["profile"]		= $this->session->userdata('logged_in');
		// $data["tugas"]			= $this->tugas_model->getMyHistory();
		$data['content']		= 'tugas/history_view';
	    $data['active']			= 'historytugas';

		$this->load->view('index',$data);
	}

	public function allhistory()
	{
		$data["profile"]		= $this->session->userdata('logged_in');
		// $data["tugas"]			= $this->tugas_model->getAllHistory();
		$data['content']		= 'tugas/history_view';
	    $data['active']			= 'allhistorytugas';

		$this->load->view('index',$data);
	}

	public function mhs_mytugas()
	{
		$this->load->model('transaksi_tugas_model');

		$data["profile"]		= $this->session->userdata('logged_in');
		$data["tugas"]			= $this->transaksi_tugas_model->getMyTransaksiMhs();
		$data['content']		= 'tugas/mhs_mytugas_view';
	    $data['active']			= 'mhs_mytugas';


		$this->load->view('index',$data);
	}

	public function mhs_tugasready()
	{
		$this->load->model('transaksi_tugas_model');

		$data["profile"]		= $this->session->userdata('logged_in');
		$data["tugas"]			= $this->transaksi_tugas_model->getMyTransaksiMhs();
		$data['content']		= 'tugas/mhs_tugasready_view';
	    $data['active']			= 'mhs_tugasready';


		$this->load->view('index',$data);
	}

	public function edit($id_tugas)
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul_tugas', 'judul_tugas', 'trim|required');
		$this->form_validation->set_rules('tipe_tugas', 'tipe_tugas', 'trim|required');
		$this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
		$this->form_validation->set_rules('jumlah_kompen', 'jumlah_kompen', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        
        $data['active']			= 'tugas';

		if($this->form_validation->run()==FALSE)
		{
			$data['id_tugas']	= $id_tugas;
			$data['profile']	= $this->session->userdata('logged_in');
			$data['data']		= $this->tugas_model->getById($id_tugas);
			$data['content']	= 'tugas/edit_view';
			$data['error']		= '';

			$this->load->view('index',$data);
		}
		else
		{
        	if($this->tugas_model->edit($id_tugas)) {
        		$this->session->set_flashdata('notifikasi', 'edit tugas berhasil');
        		redirect('tugas');
        	} else {
        		$this->session->set_flashdata('error_notif', 'edit data gagal');
        		redirect('tugas/add');
        	}
        
		}
	}


	public function add()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('judul_tugas', 'judul_tugas', 'trim|required');
		$this->form_validation->set_rules('tipe_tugas', 'tipe_tugas', 'trim|required');
		$this->form_validation->set_rules('kuota', 'kuota', 'trim|required');
		$this->form_validation->set_rules('jumlah_kompen', 'jumlah_kompen', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        
        $data['active']			= 'tugas';

		if($this->form_validation->run()==FALSE)
		{
			$data['profile']	= $this->session->userdata('logged_in');
			$data['content']	= 'tugas/add_view';
			$data['error']		= '';

			$this->load->view('index',$data);
		}
		else
		{
        	if($this->tugas_model->insert()) {
        		$this->session->set_flashdata('notifikasi', 'menambah data berhasil');
        		redirect('tugas');
        	} else {
        		$this->session->set_flashdata('error_notif', 'menambah data gagal');
        		redirect('tugas/add');
        	}
		}
	}

	public function delete($id_tugas)
	{
		if($this->tugas_model->delete($id_tugas))
			$this->session->set_flashdata('notifikasi' , 'Tugas berhasil di hapus');
		else
			$this->session->set_flashdata('error_notif' , 'Gagal menghapus tugas');

		redirect('tugas');
	}

	public function close($id_tugas)
	{
		if($this->tugas_model->close($id_tugas))
			$this->session->set_flashdata('notifikasi' , 'Tugas berhasil di tutup');
		else
			$this->session->set_flashdata('error_notif' , 'Gagal menutup tugas');

		redirect('tugas');
	}

	public function handleby($id_tugas)
	{
		$this->load->model('transaksi_tugas_model');

		$data['tugas']			= $this->tugas_model->getById($id_tugas);
		$data['mahasiswa']		= $this->transaksi_tugas_model->getByTugas($id_tugas);
		$data['profile']		= $this->session->userdata('logged_in');
		$data['id_tugas']		= $id_tugas;
		$data['content']		= 'tugas/handleby_view';
        $data['active']			= 'tugas';

		$this->load->view('index',$data);
	}

	public function handleby_add($id_tugas)
	{
		$this->load->model('transaksi_tugas_model');
		$this->load->model('mahasiswa_model');

		$this->load->helper('url','form');	
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nim', 'NIM', 'trim|required');
		$this->form_validation->set_rules('jam_kompen', 'Jam Kompen', 'trim|required');

		if($this->form_validation->run()==FALSE)
		{
			$data['profile']		= $this->session->userdata('logged_in');
			$data['id_tugas']		= $id_tugas;
			$data['content']		= 'tugas/handleby_add_view';
	        $data['active']			= 'tugas';
	        $data['error']			= '';

			$this->load->view('index',$data);
		}
		else
		{
			$nim = $this->input->post('nim');
			if(count($this->mahasiswa_model->getById($nim)) > 0) {

	        	if($this->transaksi_tugas_model->insert($id_tugas)) {
	        		$detail = $this->transaksi_tugas_model->getDetailTugas($id_tugas, $nim);

	        		$this->print_pdf($detail);
	        		$this->session->set_flashdata('notifikasi', 'menambah data berhasil');
	        		redirect('tugas/handleby/'.$id_tugas);
	        	} else {
	        		$this->session->set_flashdata('error_notif', 'menambah data gagal');
	        		redirect('tugas/handleby_add/'.$id_tugas);
	        	}
			} else {
        		$this->session->set_flashdata('error_notif', 'Mahasiswa dengan NIM '.$nim.' tidak ditemukan/tidak terdaftar');
        		redirect('tugas/handleby_add/'.$id_tugas);
			}
		}

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
		// print_r($result);
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
		// print_r($obj);
		return $obj;
	}

	public function handleby_delete($id_tugas, $id)
	{
		$this->load->model('transaksi_tugas_model');
		
		if($this->transaksi_tugas_model->delete($id))
			$this->session->set_flashdata('notifikasi' , 'Mahasiswa kompen berhasil di hapus');
		else
			$this->session->set_flashdata('error_notif' , 'Gagal menghapus mahasiswa kompen di hapus');

		redirect('tugas/handleby/'.$id_tugas);
	}

	public function handleby_valid($id_tugas, $id, $isValid)
	{
		$this->load->model('transaksi_tugas_model');
		
		if($this->transaksi_tugas_model->valid($id, $isValid)) {
			if($isValid)
				$this->session->set_flashdata('notifikasi' , 'Kompen mahasiswa '.$this->input->get('nim').' Terverifikasi');
			else
				$this->session->set_flashdata('notifikasi' , 'Kompen mahasiswa '.$this->input->get('nim').' Tidak jadi diverifikasi');
		}
		else
			$this->session->set_flashdata('error_notif' , 'Proses gagal');

		redirect('tugas/handleby/'.$id_tugas);
	}

	public function getJamTerkompen($transaksi, $semester)
	{
		$jamKompen = 0;
		foreach ($transaksi as $key => $val)
			if($val['semester'] == $semester)
				$jamKompen = $jamKompen + $val['jam_kompen'];

		return $jamKompen;
	}

	public function print_pdf($detail)
	{
        $this->load->library('Pdf');

        $this->load->model('mahasiswa_model');
        $this->load->model('transaksi_tugas_model');

        $mhs 		= $this->getApiProfile($detail['nim']);
	    $transaksi  = $this->transaksi_tugas_model->getByNimTugasDone($detail['nim']);
    	$count		= count($mhs);
        $kompens 	= array();
        $alpas 		= array();
        $totalSemua	= 0;
        $telahSemua	= 0;

        $jam_kompen = $this->input->post('jam_kompen');
        $smt 		= $detail['tahun_masuk'].'1';

        // foreach ($mhs as $key => $val) {
        for($key = 0; $key < 8; $key++) {

        	if($key < count($mhs)) {
				$JamKali = 2;

				for ($p=1; $p < $count; $p++)
					$JamKali = $JamKali * 2;

	        	$kompens[] 					= $this->getApiAlpha($detail['nim'], $smt)['data'];
	        	$jamTerkompen 				= $this->getJamTerkompen($transaksi, $smt);
	        	$total 						= $kompens[$key]['JamAlpa'] * $JamKali;
	        	$telahKompen            	= $JamKali * $jamTerkompen / 2;
	        	$alpas[$key]['Total']		= $total;
	        	$telahSemua					= $telahSemua + $telahKompen;
	        	$totalSemua					= $totalSemua + $total;


	        	if($smt%2==0)
	        		$smt = $smt+9;
	        	else
	        		$smt = $smt+1;

		        $count--; 
        	} else {
        		$alpas[$key]['Total']		= 0;
        	}
	    }
        // }

        $telah 			= $telahSemua;
        $isBayar 		= false;
        $kompen 		= array();
        $bayar 			= $this->input->post('jam_kompen');
	    $sisaKompen 	= $totalSemua - ($telahSemua + $bayar);


        for ($i=(count($alpas)-1); $i >=0; $i--) { 
        	$kom = $alpas[$i]['Total'];

        	if($kom != 0 && !$isBayar) {
        		$x = $kom - $telah;
        		if($x >= 0) {
        			$isBayar = true;
        			$kom = $x;
        		} else {
        			$telah = -1 * $x;
        		}
        	}

        	if($isBayar) {
        		$x = $kom - $bayar;
        		if($x>=0) {
        			$kom = $x;
        			$kompen[] = $bayar;
        			$bayar = 0;
        		} else {
        			$bayar = -1 * $x;
        			$kompen[] = $kom;
        		}
        	} else {
        		$kompen[] = 0;
        	}

        }

        if($detail['prodi'] == 'D3 MI') {
	        $textSmt1 = "(I/ ".$kompen[7]." jam) (II/ ".$kompen[6]." jam) (III/ ".$kompen[5]." jam) ".
	        			"(IV/ ".$kompen[4]." jam) (V/ ".$kompen[3]." jam) (VI/ ".$kompen[2]." jam)";
	        $textSmt2 = "";
        } else if($detail['prodi'] == 'D4 TI') {
	        $textSmt1 = "(I/ ".$kompen[7]." jam) (II/ ".$kompen[6]." jam) (III/ ".$kompen[5]." jam) ".
	        			"(IV/ ".$kompen[4]." jam) (V/ ".$kompen[3]." jam) (VI/ ".$kompen[2]." jam)";
	        $textSmt2 = "(VII/ ".$kompen[1]." jam) (VIII/ ".$kompen[0]." jam)";
        }


		$data['detail']			= $detail;
        $data['textSmt1']		= $textSmt1;
        $data['textSmt2']		= $textSmt2;
        $data['sisaKompen']		= $sisaKompen;
        $data['profile']		= $this->session->userdata('logged_in');
        $data['jam_kompen']		= $this->input->post('jam_kompen');
        $data['tanggal']		= date('d-m-Y');
        $data['kelas']			= end($mhs)['tingkat'].end($mhs)['kelas'];
        $data['filename']		= dirname(__FILE__).'/../../pdf/kompen_'.$detail['id'].'.pdf';

        if($detail['prodi'] == 'D3 MI') {
        	$data['kaprodi']	= 'Dr.Eng. Rosa Andrie A., ST., MT.';
        	$data['nip_kaprodi']= '198010102005011001';
        } else {
        	$data['kaprodi']	= 'Ir. Deddy Kusbianto Purwoko Aji, M.MKom';
        	$data['nip_kaprodi']= '196211281988111001';
        }

        $this->load->view('page_laporan', $data);

        $this->setEmail($detail['email'], $data['filename']);
	}


	public function setEmail($email, $pdfname)
	{
		$subject="POLINEMA JTI KOMPEN";
		$message="Silahkan print dokumen dibawah, lalu minta tanda tangan jika kompenmu sudah selesai, dan simpan baik baik dokumen kompen itu";

		$this->sendEmail($email,$subject,$message,$pdfname);
	}

	public function sendEmail($email,$subject,$message,$pdfname)
    {
		$config = Array(
			'protocol'	=> 'smtp',
			'smtp_host'	=> 'ssl://smtp.googlemail.com',
			'smtp_port'	=> 465,
			'smtp_user'	=> 'dimazchandra31@gmail.com', 
			'smtp_pass'	=> 'ikipassword', 
			'mailtype'	=> 'html',
			'charset'	=> 'iso-8859-1',
			'wordwrap'	=> TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('dimazchandra31@gmail.com');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->attach($pdfname);

		if($this->email->send())
		{
			unlink($pdfname);
		}
		else
		{
			show_error($this->email->print_debugger());
		}

    }

}