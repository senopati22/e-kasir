<?php
$no = 1;
function formatAngka($angka)
{
  $hasil = 'Rp. '.number_format($angka, 0, '.', '.');
  return $hasil;
}

function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}

$date = date("Y-m-d");

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image(base_url('upload/logotoko/'.$this->session->userdata('foto')), 1, 1, 2, 2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5, 0.5, $this->session->userdata('site_name'), 0, 'L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, $this->session->userdata('alamat'), 0, 'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, $this->session->userdata('kota').' - '.$this->session->userdata('prov') ,0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5, 0.5, 'Telp. '.$this->session->userdata('telp'), 0, 'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"LAPORAN DATA BARANG",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".tanggal_indo($date, true),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Suplier', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'modal', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
foreach($barang as $tmp)
{
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $tmp->nama,1, 0, 'C');
	$pdf->Cell(3, 0.8, $tmp->namajns, 1, 0,'C');
	$pdf->Cell(4, 0.8, $tmp->namasp,1, 0, 'C');
	$pdf->Cell(4.5, 0.8, formatAngka($tmp->modal), 1, 0,'C');
	$pdf->Cell(4.5, 0.8, formatAngka($tmp->harga),1, 0, 'C');
	$pdf->Cell(2, 0.8, $tmp->jumlah, 1, 1,'C');

	$no++;
}

$pdf->Cell(45, 4, "Bangkalan, ".tanggal_indo($date), 0, 0, 'C');
$pdf->ln(1);
$pdf->Cell(45, 7, "Direktur ".SITE_NAME, 0, 0, 'C');

$pdf->Output("Laporan Barang.pdf","I");
?>