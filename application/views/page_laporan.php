<?php
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = base_url('images/logopolinema.png');
		$this->Image($image_file, 10, 10, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


		$image_file = base_url('images/isopolinema.jpg');
		$this->Image($image_file, 170, 12, 28, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sapta Ahmad Afrizal');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->AddPage();

$style = array('width' => 0.7, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$style2 = array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));

$pdf->Line(10, 45, 200, 45, $style2);
$pdf->Line(10, 46, 200, 46, $style);

    $txt = <<<EOF
    <style>
    span {
    	font-family: times;
    }
	.center {
		font-family: times;
		text-align: center;
	}
	.header1 {
		font-size:14px;
	}
	.header2 {
		font-size:18px;
	}
	.header3 {
		font-size:14px;
	}
	.header4 {
		font-size:13px;
	}
	</style>
    <span class="center">
    <span class="header1"><b>KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</b></span><br>
    <span class="header2"><b>POLITEKNIK NEGERI MALANG</b></span><br>
    <span class="header3"><b>JURUSAN TEKNOLOGI INFORMASI</b></span><br>
    <span class="header4">JL. Soekarno Hatta No.9 Malang 65141</span><br>
    <span class="header4">Telp. (0341) 404424 - 404425 Fax (0341) 404420</span><br>
    <span class="header4">http://www.polinema.ac.id</span><br><br>
    <b>BERITA ACARA PELAKSANAAN KOMPENSASI</b>
    </span><br>

EOF;

$pdf->writeHTMLCell(0, 0, '', '', $txt, 0, 1, 0, true, '', true);

$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));

$pdf->SetFont('times', '', 12);

// Nama Pengajar
$pdf->Cell(45, 5, 'Nama Pengajar');
$pdf->Cell(45, 5, ': '.$profile['nama_lengkap']);
$pdf->Ln(6);

// NIP
$pdf->Cell(45, 5, 'NIP');
$pdf->Cell(45, 5, ': '.$profile['nip']);
$pdf->Ln(10);

$pdf->Cell(200, 5, 'Memberikan rekomendasi kompensasi kepada');
$pdf->Ln(8);

// Nama Mahasiswa
$pdf->Cell(45, 5, 'Nama Mahasiswa');
$pdf->Cell(45, 5, ': '.$detail['nama_lengkap']);
$pdf->Ln(6);

// NIM
$pdf->Cell(45, 5, 'NIM');
$pdf->Cell(45, 5, ': '.$detail['nim']);
$pdf->Ln(6);

// Kelas
$pdf->Cell(45, 5, 'Kelas');
$pdf->Cell(45, 5, ': '.$detail['prodi'].'-'.$kelas);
$pdf->Ln(6);

// Alasan
$pdf->Cell(45, 5, 'Alasan');
$pdf->Cell(45, 5, ': ');
$pdf->Ln(6);

// Semester
$pdf->Cell(45, 5, 'Semester');
$pdf->Cell(45, 5, ': '.$textSmt1);
$pdf->Ln(6);

if($textSmt2 != "") {
// lanjutan semester
$pdf->Cell(45, 5, '');
$pdf->Cell(45, 5, '  '.$textSmt2);
$pdf->Ln(6);

}

// Pekerjaan
$pdf->Cell(45, 5, 'Pekerjaan');
$pdf->Cell(45, 5, ': '.$detail['judul_tugas']);
$pdf->Ln(6);

// Jumlah jam
$pdf->Cell(45, 5, 'Jumlah Jam');
$pdf->Cell(45, 5, ': '.$jam_kompen.' jam');
$pdf->Ln(6);

// Sisa Kompen
$pdf->Cell(45, 5, 'Belum Kompen');
$pdf->Cell(45, 5, ': '.$sisaKompen.' jam');
$pdf->Ln(16);



// TTD
$pdf->Cell(110, 5, '');
$pdf->Cell(100, 5, 'Malang, '.$tanggal);
$pdf->Ln(6);

$pdf->Cell(110, 5, 'Mengetahui');
$pdf->Cell(100, 5, 'Yang memberikan rekomendasi');
$pdf->Ln(6);

$pdf->Cell(110, 5, 'Ka. Program Studi');
$pdf->Ln(20);

$pdf->Cell(110, 5, '('.$kaprodi.')');
$pdf->Cell(100, 5, '('.$profile['nama_lengkap'].')');
$pdf->Ln(6);

$pdf->Cell(110, 5, 'NIP. '.$nip_kaprodi);
$pdf->Cell(100, 5, 'NIP. '.$profile['nip']);
$pdf->Ln(16);

$pdf->Cell(110, 5, 'FRM.RIF.01.07.02');
$pdf->Ln(6);

$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255)));
$pdf->SetFillColor(255,255,0);
// $pdf->SetTextColor(0,0,255);
$pdf->Cell(110	, 5, '*BUKTI KOMPEN WAJIB DISIMPAN SEBAGAI SYARAT BEBAS TANGGUNGAN');
$pdf->Ln(6);


ob_clean();
// $pdf->Output('example_003.pdf', 'D');
// $tmp = ini_get('upload_tmp_dir');
// $pdf->Output("$tmp/file.pdf", "F");
// $pdf->Output('sapta.pdf', 'F');
$pdf->Output($filename, 'F');

//============================================================+
// END OF FILE
//============================================================+



//     $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
//     $pdf->SetTitle('Contoh');
//     $pdf->SetAuthor('Author');
// 	$pdf->setPrintHeader(false);
// 	$pdf->setPrintFooter(false);
//     $pdf->AddPage();
//     $html = <<<EOF
//     <style>
// 	.center {
// 		font-family: times;
// 		text-align: center;
// 	}
// 	.header1 {
// 		font-size:12px;
// 	}
// 	.header2 {
// 		font-size:18px;
// 	}
// 	.header3 {
// 		font-size:14px;
// 	}
// 	.header3 {
// 		font-size:12px;
// 	}
// 	</style>
//     <span class="center">
//     <span class="header1"><b>KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</b></span><br>
//     <span class="header2"><b>POLITEKNIK NEGERI MALANG</b></span><br>
//     <span class="header3"><b>JURUSAN TEKNOLOGI INFORMASI</b></span><br>
//     <span class="header4">JL. Soekarno Hatta No.9 Malang 65141</span><br>
//     <span class="header4">Telp. (0341) 404424 - 404425 Fax (0341) 404420</span><br>
//     <span class="header4">http://www.polinema.ac.id</span><br>
//     </span>



// EOF;

// 	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//     // $pdf->Write(5, "<p style='color:red;'>SAPTA");
//     $pdf->Output('contoh1.pdf', 'I');
