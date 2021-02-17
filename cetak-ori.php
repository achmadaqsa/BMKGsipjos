<?php
// memanggil library FPDF
$image1 = 'ttd-zem.png';
$image2 = 'ttd-anwar.png';
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p','mm','A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->SetMargins(20,10,10);

// header
$pdf->SetFont('Arial','',8);
$pdf->Cell(190,7,'FM.PT.01.02.01',0,1,'R');
$pdf->Image('logo-bmkg.png',25,16,19);
$pdf->Image('logo-nqa.png',169,17,30);
$pdf->SetFont('Arial','',10);
$pdf->Cell(173,1,'BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(173,7,'STASIUN METEOROLOGI KELAS I JUANDA SIDOARJO',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(173,1,'Bandar Udara Internasional Juanda Surabaya',0,1,'C');
$pdf->Cell(173,7,'Telepon: (031) 8667540, Fax: (031) 8675342',0,1,'C');
$pdf->Cell(173,1,'Email: stamet.juanda@bmkg.go.id',0,1,'C');
$pdf->Cell(173,7,'Website: juanda.jatim.bmkg.go.id',0,1,'C');
$pdf->Cell(180,1,'','B',1,'C');
$pdf->Cell(180,1,'','B',1,'C');
//-------------------------------------------------------------------------

// judul
$pdf->Cell(10,3,'',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(180,7,'FORM PERBAIKAN ALAT',0,1,'C');
$pdf->Cell(10,3,'',0,1);

include 'koneksi.php';
$id = $_GET['id'];
$perbaikan = mysqli_query($connect, "select * from perbaikan where id='$id'");
while ($row = mysqli_fetch_array($perbaikan)){ 

// data teknis
$pdf->SetFont('Arial','',10);
$pdf->Cell(32,6,'Tanggal Kerusakan',0,0);
$pdf->Cell(2,6,':',0,0);
$pdf->Cell(75,6,$row['tr'],0,0);
$pdf->Cell(31,6,'Tanggal Perbaikan',0,0);
$pdf->Cell(2,6,':',0,0);
$pdf->Cell(55,6,$row['tp'],0,1);
//----------------------------------------
$pdf->Cell(32,3,'Nama Alat',0,0);
$pdf->Cell(2,3,':',0,0);
$pdf->Cell(75,3,$row['alat'],0,0);
$pdf->Cell(31,3,'Teknisi',0,0);
$pdf->Cell(4,3,'1.',0,0);
$pdf->Cell(55,3,$row['t1'],0,1);
//----------------------------------------
$pdf->Cell(32,6,'Merk/Tipe',0,0);
$pdf->Cell(2,6,':',0,0);
$pdf->Cell(75,6,$row['mt'],0,0);
$pdf->Cell(31,6,'',0,0);
$pdf->Cell(4,6,'2.',0,0);
$pdf->Cell(55,6,$row['t2'],0,1);
//----------------------------------------
$pdf->Cell(32,3,'Jenis Peralatan',0,0);
$pdf->Cell(2,3,':',0,0);
$pdf->Cell(75,3,$row['jp'],0,0);
$pdf->Cell(31,3,'',0,0);
$pdf->Cell(5,3,'3.',0,0);
$pdf->Cell(55,3,$row['t3'],0,1);
//----------------------------------------
$pdf->Cell(32,6,'Lokasi Alat',0,0);
$pdf->Cell(2,6,':',0,0);
$pdf->Cell(75,6,$row['lok'],0,0);
$pdf->Cell(31,6,'',0,0);
$pdf->Cell(5,6,'4.',0,0);
$pdf->Cell(55,6,$row['t4'],0,1);
//----------------------------------------
$pdf->Cell(32,3,'Nama Pelapor',0,0);
$pdf->Cell(2,3,':',0,0);
$pdf->Cell(75,3,$row['lapor'],0,0);
$pdf->Cell(31,3,'',0,0);
$pdf->Cell(5,3,'5.',0,0);
$pdf->Cell(55,3,$row['t5'],0,1);
//----------------------------------------
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(90,8,'Pelapor',0,0);
$pdf->Cell(10,8,'',0,0);
$pdf->Cell(0,8,'Kepala Kelompok Peralatan Teknis',0,1);
$pdf->Cell(10,10,'',0,1);//spasi kebawah tidak terlalu rapat
$pdf->Cell(10,8,'',0,0); 
$pdf->Cell(90,8,$row['lapor'],0,0);
$pdf->Cell(10,8,'',0,0);
$pdf->Image('ttd-anwar.png',133,83,42);
$pdf->Cell(0,8,'M. ANWAR SYAEFUDIN, ST',0,1);
//-------------------------------------------

//KONDISI AWAL
$pdf->Cell(0,0,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'KONDISI AWAL',0,1);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,$row['awal'],1,1);

//TINDAKAN PERBAIKAN
$pdf->Cell(0,5,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'TINDAKAN PERBAIKAN',0,1);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,$row['tindakan'],1,1);

//KONDISI AKHIR
$pdf->Cell(0,5,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'KONDISI AKHIR',0,1);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,5,$row['akhir'],1,1);

//KEPALA SEKSI
$pdf->SetFont('Arial','B',10);
//$pdf->Cell(113,10,'',0,0);
$pdf->Cell(213,10,'Mengetahui,',0,1);
//$pdf->Cell(80,0,'',0,0);
$pdf->Cell(105,0,'KEPALA SEKSI OBSERVASI',0,1);
//$pdf->Cell(105,0,'',0,0);
$pdf->Cell(1,1,$pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38),0,0,'',false);
//$pdf->Cell(10,15,'',0,1);//spasi kebawah tidak terlalu rapat
//$pdf->Cell(97,10,'',0,0);

$pdf->Cell(100,45,'ZEM IRIANTO PADAMA, SE, S.Si',0,1);


}
$pdf->Output();
?>