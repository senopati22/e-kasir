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

$t1 = $this->uri->segment(4); $t2 = $this->uri->segment(5); 
if($t2%4 == 0)
{
  $jh = 28;
}
else
{
  $jh = 29;
}

$bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
$jh  = array(0, 31, $jh, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$wh = "";

if(!empty($t1) && empty($t2))
{
    $wh = " where month(tanggal) ='$t1'";
}
elseif(empty($t1) && !empty($t2))
{
    $wh = " where year(tanggal) ='$t2'";
}
elseif(!empty($t1) && !empty($t2))
{
    $wh = " where tanggal between '$t2-$t1-1' AND '$t2-$t1-$jh[$t1]'";
}

if($t1 == "" || $t1 == 0)
{
    $query = $this->db->query("SELECT * from barang_laku $wh order by tanggal desc")->result();
}
else
{
    for ($i=1; $i <= $jh[$t1]; $i++)
    {  
        $query = $this->db->query("SELECT * from barang_laku $wh order by tanggal desc")->result();
    }
}


if($t1 == 0 && $t2 == 0)
{
    $query = $this->db->query("SELECT * from barang_laku $wh order by tanggal desc")->result();
}

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
if(!empty($t1) && !empty($t2))
{
	$pdf->ln(1);
	$pdf->Cell(10.5, 0.7, "Laporan Penjualan pada bulan ".$bln[$t1]." tahun ".$t2, 0, 0, 'C');
}
else if(!empty($t1) && empty($t2))
{
	$pdf->ln(1);
	$pdf->Cell(10.5, 0.7, "Laporan Penjualan pada bulan ".$bln[$t1]." dan semua tahun", 0, 0, 'C');
}
else if(empty($t1) && !empty($t2))
{
	$pdf->ln(1);
	$pdf->Cell(11, 0.7, "Laporan Penjualan pada semua bulan dan tahun ".$t2, 0, 0, 'C');
}
else
{
	$pdf->ln(1);
	$pdf->Cell(11.5, 0.7, "Laporan Penjualan pada semua bulan dan semua tahun", 0, 0, 'C');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".tanggal_indo($date, true),0,0,'C');
$pdf->ln(1);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Total harga', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'laba', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
foreach($query as $tmp)
{
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, tanggal_indo($tmp->tanggal),1, 0, 'C');
	$pdf->Cell(6, 0.8, $tmp->nama,1, 0, 'C');
	$pdf->Cell(3, 0.8, $tmp->jumlah, 1, 0,'C');
	$pdf->Cell(4, 0.8, formatAngka($tmp->harga)." ,-", 1, 0,'C');
	$pdf->Cell(4.5, 0.8, formatAngka($tmp->total_harga)." ,-",1, 0, 'C');
	$pdf->Cell(4, 0.8, formatAngka($tmp->laba)." ,-", 1, 1,'C');

	$no++;
}

$q = $this->db->query("SELECT sum(total_harga) as total from barang_laku $wh")->result();
foreach($q as $total)
{
	$pdf->Cell(18, 0.8, "Total Pendapatan", 1, 0,'C');		
	$pdf->Cell(4.5, 0.8, "Rp. ".formatAngka($total->total)." ,-", 1, 0,'C');	
}

$qu = $this->db->query("SELECT sum(laba) as total_laba from barang_laku $wh")->result();
foreach($qu as $tl)
{
	$pdf->Cell(4, 0.8, "Rp. ".formatAngka($tl->total_laba)." ,-", 1, 1,'C');	
}

$pdf->Cell(45, 4, "Bangkalan, ".tanggal_indo($date), 0, 0, 'C');
$pdf->ln(1);
$pdf->Cell(45.1, 7, "Direktur ".SITE_NAME, 0, 0, 'C');

$pdf->Output("Laporan Barang Laku.pdf","I");
?>