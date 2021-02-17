<?php
include 'koneksi.php';
$tanggal=$_GET['tgl'];
$query=mysqli_query($connect, "select * from awos where Tanggal='$tanggal' limit 28");
$i=0;
while($row=mysqli_fetch_array($query)){
    $kondisi[$i]= $row['Kondisi'];
    if($i==21){
        $catatan1=$row['Catatan'];
    }
    if($i==27){
        $catatan2=$row['Catatan'];
    }
    $i++;
    $nama=$row['Nama'];
    $tanggal=$row['Tanggal'];
}
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
$pdf->Cell(173,1,'Email: stamet.juanda@bmkg.go.id dan kstujud@gmail.com',0,1,'C');
$pdf->Cell(173,7,'Website: juanda.jatim.bmkg.go.id',0,1,'C');
$pdf->Cell(180,1,'','B',1,'C');
$pdf->Cell(180,1,'','B',1,'C');

//----------------------------------------------------------------------------------
// judul
$pdf->Cell(10,3,'',0,1);
$pdf->SetFont('Arial','UB',10);
$pdf->Cell(0,3,'LAPORAN PEMELIHARAAN PERALATAN',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'AWOS(Automated Weather Observing System',0,1,'C');

//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0,2,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'I. Identitas',0,1);

$pdf->SetFont('Arial','B',7);
$pdf->Cell(7,5,'No',1,0,'C',0);
$pdf->Cell(0,5,'Uraian',1,0,'C',0);

$pdf->SetFont('Arial','',7);
$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'1','LR',0,'C',0);
$pdf->Cell(40,5,'Lokasi / Stasiun','LR',0,'L',0);
$pdf->Cell(0,5,': RWY10 - RWY28 / Stasiun Meteorologi Kelas I Juanda Sidoarjo','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'2','LR',0,'C',0);
$pdf->Cell(40,5,'Petugas / Teknisi','LR',0,'L',0);
$pdf->Cell(0,5,':'.$nama,'LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'3','LR',0,'C',0);
$pdf->Cell(40,5,'Waktu Pelaksanaan','LR',0,'L',0);
$pdf->Cell(0,5,':'.$tanggal,'LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'4','LRB',0,'C',0);
$pdf->Cell(40,5,'Jenis Peralatan','LRB',0,'L',0);
$pdf->Cell(0,5,': Teknologi canggih/modern','LRB',0,'L',0);

//----------------------------------------------------------------------------------
//kondisi kompoonen AWOS
$pdf->Cell(0,5,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,'II. Kondisi Komponen AWOS',0,1);
$pdf->SetFont('Arial','B',10);

$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(0,0,'');
$pdf->Cell(7,10,'No',1,0,'C');
$pdf->Cell(40,10,'Nama Peralatan',1,0,'C');
$pdf->Cell(55,10,'Merk / SN',1,0,'C');
$pdf->Cell(27,5,'Kondisi',1,0,'C');
$pdf->Cell(0,10,'KETERANGAN',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(102,5,'',0,0,'C');
$pdf->Cell(9,5,'RB',1,0,'C');
$pdf->Cell(9,5,'RR',1,0,'C');
$pdf->Cell(9,5,'Baik',1,0,'C');

// SITE RWY10

$pdf->SetFont('Arial','',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(40,5,'SITE RWY10',1,0,'L');
$pdf->Cell(55,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Data Logger',1,0,'L');
$pdf->Cell(55,5,'COASTAL ENV. / ZENO 6800 / 1096',1,0,'C');
if ($kondisi[0] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[0] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[0] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'Sensor Temperatur dan RH',1,0,'L');
$pdf->Cell(55,5,'ROTRONIC / HYGROCLIP2 / 20261107',1,0,'C');
if ($kondisi[1] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[1] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[1] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(40,5,'Sensor Tekanan Udara',1,0,'L');
$pdf->Cell(55,5,'VAISALA / PTB330 / P2610316',1,0,'C');
if ($kondisi[2] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[2] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[2] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'4',1,0,'C');
$pdf->Cell(40,5,'Sensor Angin',1,0,'L');
$pdf->Cell(55,5,'GILL INSTRUMENTS / WO-65 / 1826001',1,0,'C');
if ($kondisi[3] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[3] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[3] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(40,5,'Sensor Visibility',1,0,'L');
$pdf->Cell(55,5,'BIRAL / VPF-730 / M11514-01',1,0,'C');
if ($kondisi[4] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[4] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[4] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(40,5,'Ceilometer',1,0,'L');
$pdf->Cell(55,5,'CAMPBELL SCIENTIFIC / CS135 / E1155',1,0,'C');
if ($kondisi[5] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[5] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[5] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(40,5,'Radio Komunikasi',1,0,'L');
$pdf->Cell(55,5,'FLUIDMESH / VOLO / 1200232429',1,0,'C');
if ($kondisi[6] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[6] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[6] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

// SITE RWY28

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(40,5,'SITE RWY28',1,0,'L');
$pdf->Cell(55,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Data Logger',1,0,'L');
$pdf->Cell(55,5,'COASTAL ENV. / ZENO 6800 / 1095',1,0,'C');
if ($kondisi[7] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[7] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[7] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'Sensor Temperatur dan RH',1,0,'L');
$pdf->Cell(55,5,'ROTRONIC / HYGROCLIP2 / 20245972',1,0,'C');
if ($kondisi[8] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[8] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[8] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(40,5,'Sensor Tekanan Udara',1,0,'L');
$pdf->Cell(55,5,'VAISALA / PTB330 / P2610314',1,0,'C');
if ($kondisi[9] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[9] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[9] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'4',1,0,'C');
$pdf->Cell(40,5,'Sensor Angin',1,0,'L');
$pdf->Cell(55,5,'GILL INSTRUMENTS / WO-65 / 1826006',1,0,'C');
if ($kondisi[10] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[10] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[10] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(40,5,'Sensor Visibility',1,0,'L');
$pdf->Cell(55,5,'BIRAL / VPF-710 / M11512-01',1,0,'C');
if ($kondisi[11] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[11] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[11] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(40,5,'Ceilometer',1,0,'L');
$pdf->Cell(55,5,'CAMPBELL SCIENTIFIC / CS135 / E1155',1,0,'C');
if ($kondisi[12] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[12] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[12] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(40,5,'Radio Komunikasi',1,0,'L');
$pdf->Cell(55,5,'FLUIDMESH / VOLO / 1200231479',1,0,'C');
if ($kondisi[13] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[13] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[13] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

// SITE MIDDLE

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(40,5,'SITE MIDDLE',1,0,'L');
$pdf->Cell(55,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Data Logger',1,0,'L');
$pdf->Cell(55,5,'COASTAL ENV. / ZENO 6800 / 1097',1,0,'C');
if ($kondisi[14] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[14] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[14] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'Sensor Temperatur dan RH',1,0,'L');
$pdf->Cell(55,5,'ROTRONIC / HYGROCLIP2 / 20261119',1,0,'C');
if ($kondisi[15] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[15] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[15] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(40,5,'Sensor Tekanan Udara',1,0,'L');
$pdf->Cell(55,5,'VAISALA / PTB330 / K2650008',1,0,'C');
if ($kondisi[16] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[16] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[16] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'4',1,0,'C');
$pdf->Cell(40,5,'Sensor Angin',1,0,'L');
$pdf->Cell(55,5,'GILL INSTRUMENTS / WO-65 / 1826009',1,0,'C');
if ($kondisi[17] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[17] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[17] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(40,5,'Sensor Curah Hujan',1,0,'L');
$pdf->Cell(55,5,'TEXAS ELEC. / TR-522-M-01 / 76110-518',1,0,'C');
if ($kondisi[18] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[18] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[18] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(40,5,'Sensor Solar Radiation',1,0,'L');
$pdf->Cell(55,5,'KIPP&ZONEN / CMP11 / 185125',1,0,'C');
if ($kondisi[19] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[19] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[19] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(40,5,'Lightning Detector',1,0,'L');
$pdf->Cell(55,5,'COASTAL ENV. / 1220-153-161 /151',1,0,'C');
if ($kondisi[20] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[20] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[20] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(40,5,'Radio Komunikasi',1,0,'L');
$pdf->Cell(55,5,'FLUIDMESH / VOLO / 1200231503',1,0,'C');
if ($kondisi[21] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[21] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[21] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

//----------------------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0,5,$catatan1,1,1);
$pdf->Cell(0, 30, '', 0, 1);
//----------------------------------------------------------------------------------
//Mengetahui
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(0,5, '', 0, 2);
$pdf->Cell(0,4, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0,5, '', 0, 0);

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53,5, '', 0, 0);
$pdf->Cell(50,5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(47, 3, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 0, '', 0, 0);
$pdf->Cell(80, 3, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0,15, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);


// halaman baru (mingguan)

$pdf->AddPage();
$pdf->SetMargins(20,10,10);

// header
$pdf->SetFont('Arial','',8);
$pdf->Cell(180,7,'FM.PT.01.02.01',0,1,'R');
$pdf->Image('logo-bmkg.png',25,16,19);
$pdf->Image('logo-nqa.png',169,17,30);
$pdf->SetFont('Arial','',10);
$pdf->Cell(173,1,'BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(173,7,'STASIUN METEOROLOGI KELAS I JUANDA SIDOARJO',0,1,'C');
$pdf->SetFont('Arial','',10);
$pdf->Cell(173,1,'Bandar Udara Internasional Juanda Surabaya',0,1,'C');
$pdf->Cell(173,7,'Telepon: (031) 8667540, Fax: (031) 8675342',0,1,'C');
$pdf->Cell(173,1,'Email: stamet.juanda@bmkg.go.id dan kstujud@gmail.com',0,1,'C');
$pdf->Cell(173,7,'Website: juanda.jatim.bmkg.go.id',0,1,'C');
$pdf->Cell(180,1,'','B',1,'C');
$pdf->Cell(180,1,'','B',1,'C');

//----------------------------------------------------------------------------------
// judul
$pdf->Cell(10,3,'',0,1);
$pdf->SetFont('Arial','UB',12);
$pdf->Cell(0,3,'LAPORAN PEMELIHARAAN PERALATAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'AWOS(Automated Weather Observing System',0,1,'C');

//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0,8,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'I. Identitas',0,1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,'No',1,0,'C',0);
$pdf->Cell(0,5,'Uraian',1,0,'C',0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'1','LR',0,'C',0);
$pdf->Cell(40,5,'Lokasi / Stasiun','LR',0,'L',0);
$pdf->Cell(0,5,': Gedung Angkasa Pura 1 / Stasiun Meteorologi Kelas I Juanda Sidoarjo','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'2','LR',0,'C',0);
$pdf->Cell(40,5,'Petugas / Teknisi','LR',0,'L',0);
$pdf->Cell(0,5,':'.$nama,'LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'3','LR',0,'C',0);
$pdf->Cell(40,5,'Waktu Pelaksanaan','LR',0,'L',0);
$pdf->Cell(0,5,':'.$tanggal,'LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'4','LRB',0,'C',0);
$pdf->Cell(40,5,'Jenis Peralatan','LRB',0,'L',0);
$pdf->Cell(0,5,': Teknologi canggih/modern','LRB',0,'L',0);

//----------------------------------------------------------------------------------
//kondisi kompoonen AWOS
$pdf->Cell(0,8,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,'II. Kondisi Komponen AWOS',0,1);
$pdf->SetFont('Arial','B',10);

$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(0,0,'');
$pdf->Cell(7,10,'No',1,0,'C');
$pdf->Cell(40,10,'Nama Peralatan',1,0,'C');
$pdf->Cell(55,10,'Merk / SN',1,0,'C');
$pdf->Cell(27,5,'Kondisi',1,0,'C');
$pdf->Cell(0,10,'KETERANGAN',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(102,5,'',0,0,'C');
$pdf->Cell(9,5,'RB',1,0,'C');
$pdf->Cell(9,5,'RR',1,0,'C');
$pdf->Cell(9,5,'Baik',1,0,'C');

// SITE RWY10

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(40,5,'Server & Client AWOS',1,0,'L');
$pdf->Cell(55,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(9,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Server 1',1,0,'L');
$pdf->Cell(55,5,'Dell / Poweredge R230',1,0,'C');
if ($kondisi[22] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[22] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[22] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'Server 2',1,0,'L');
$pdf->Cell(55,5,'Dell / Poweredge R230',1,0,'C');
if ($kondisi[23] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[23] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[23] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(40,5,'PC Client Observer',1,0,'L');
$pdf->Cell(55,5,'HP / Slimline PC 270',1,0,'C');
if ($kondisi[24] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[24] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[24] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'4',1,0,'C');
$pdf->Cell(40,5,'PC Client Forecaster',1,0,'L');
$pdf->Cell(55,5,'HP / Slimline PC 270',1,0,'C');
if ($kondisi[25] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[25] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[25] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(40,5,'PC Client APP',1,0,'L');
$pdf->Cell(55,5,'HP / Slimline PC 270',1,0,'C');
if ($kondisi[26] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[26] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[26] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(40,5,'PC Client ATC',1,0,'L');
$pdf->Cell(55,5,'HP / Slimline PC 270',1,0,'C');
if ($kondisi[27] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[27] == 1) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[27] == 2) {
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
}
$pdf->Cell(0,5,'',1,0,'C');

//----------------------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0,5,$catatan2,1,1);

//----------------------------------------------------------------------------------
//Mengetahui
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0,10, '', 0, 2);
$pdf->Cell(0,4, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0,5, '', 0, 0);

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53,5, '', 0, 0);
$pdf->Cell(50,5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(47, 3, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 0, '', 0, 0);
$pdf->Cell(80, 3, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0,15, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);

    $pdf->Output();
?>