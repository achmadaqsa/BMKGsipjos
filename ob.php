<?php
include 'koneksi.php';
if(isset($_GET['tanggal'])){
    $tanggal = $_GET['tanggal'];
    $query=mysqli_query($connect, "(SELECT * FROM alatob WHERE Tanggal='$tanggal') ORDER by Tanggal ASC");
    $i=0;
    while($row=mysqli_fetch_array($query)){
        $nama = $row['Nama'];
        $catatan=$row['Catatan'];
        $alat[$i] = $row["Alat"];
        $kondisi[$i] = $row["Kondisi"];
	$merk[$i] = $row["Merk"];
        $i++;
    }
}

if (isset($_POST['simpan']) && ($_POST['tp'] != "") && ($_POST['np'] != "")) {
    $tanggal = $_POST['tp'];
    $nama = $_POST['np'];
    $catatan=$_POST['ck'];
    $max=$_POST['max'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        $kondisi[$i] = $_POST["kondisi$i"];
        $merk[$i] = $_POST["merk$i"];
        mysqli_query($connect, "INSERT INTO alatob VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$kondisi[$i]','$nama','$catatan')");
    }
}

// memanggil library FPDF
$image1 = 'ttd-zem.png';
$image2 = 'ttd-anwar.png';
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
$pdf->SetMargins(20, 10, 10);

// header
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 7, 'FM.PT.01.02.01', 0, 1, 'R');
$pdf->Image('logo-bmkg.png', 25, 16, 19);
$pdf->Image('logo-nqa.png', 169, 17, 30);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(173, 1, 'BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(173, 7, 'STASIUN METEOROLOGI KELAS I JUANDA SIDOARJO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(173, 1, 'Bandar Udara Internasional Juanda Surabaya', 0, 1, 'C');
$pdf->Cell(173, 7, 'Telepon: (031) 8667540, Fax: (031) 8675342', 0, 1, 'C');
$pdf->Cell(173, 1, 'Email: stamet.juanda@bmkg.go.id dan kstujud@gmail.com', 0, 1, 'C');
$pdf->Cell(173, 7, 'Website: juanda.jatim.bmkg.go.id', 0, 1, 'C');
$pdf->Cell(180, 1, '', 'B', 1, 'C');
$pdf->Cell(180, 1, '', 'B', 1, 'C');
//----------------------------------------------------------------------------------
// judul
$pdf->Cell(10, 3, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'LAPORAN PEMELIHARAAN ALAT', 0, 1, 'C');

$pdf->MultiCell(0, 0, '', 0, 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'Tanggal', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'C');
$pdf->Cell(0, 5, ''.$tanggal, 0, 1, 'L');

$pdf->MultiCell(0, 0, '', 0, 2);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, 'Unit Kerja', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'C');
$pdf->Cell(40, 5, 'OBSERVASI UDARA PERMUKAAN', 0, 1, 'L');
$pdf->Cell(20, 5, 'Teknisi', 0, 0, 'L');
$pdf->Cell(5, 5, ':', 0, 0, 'C');
$pdf->Cell(0, 5, ''.$nama, 0, 1, 'L');

//-------------------------------------------------------------------------
//TABEL
$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(7, 10,'NO',1,0, 'C');
$pdf->Cell(31, 5,'NAMA','LRT',0, 'C');
$pdf->Cell(40, 10,'JENIS PERALATAN',1,0, 'C');
$pdf->Cell(9, 10,'VOL',1,0, 'C');
$pdf->Cell(15, 10,'KONDISI',1,0, 'C');
$pdf->Cell(25, 5,'LOKASI','LRT',0, 'C');
$pdf->Cell(0, 10,'KETERANGAN',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','B', 8);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'PERALATAN','LRB',0, 'C');
$pdf->Cell(64, 5,'',0,0, 'C');
$pdf->Cell(25, 5,'PERALATAN','LRB',0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',1,0, 'C');
$pdf->Cell(71, 5,'KOMPUTER OPERASIONAL',1,0, 'L');
$pdf->Cell(9, 5,'',1,0, 'C');
$pdf->Cell(15, 5,'',1,0, 'C');
$pdf->Cell(25, 5,'',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'1',1,0, 'C');
$pdf->Cell(31, 5,'PC KAPOKSI','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[0]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[0]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R. OBSERVASI',1,0, 'C');;
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'OBSERVASI','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'2',1,0, 'C');
$pdf->Cell(31, 5,'PC OPERASIONAL','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[1]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[1]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R. OBSERVASI',1,0, 'C');
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'OBSERVASI','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'3',1,0, 'C');
$pdf->Cell(31, 5,'PC OPERASIONAL','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTROIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[2]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[2]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R. OBSERVASI',1,0, 'C');
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'KOMUNIKASI','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'4',1,0, 'C');
$pdf->Cell(31, 5,'PC STAF','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[3]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[3]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'OBSERVASI','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'5',1,0, 'C');
$pdf->Cell(31, 5,'PC STAF','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[4]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[4]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'KOMUNIKASI','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'6',1,0, 'C');
$pdf->Cell(31, 5,'PC BMKGSOFT','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[5]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[5]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',1,0, 'C');
$pdf->Cell(71, 5,'PERALATAN ELEKTRONIK PENUNJANG OPERASIONAL',1,0, 'L');
$pdf->Cell(9, 5,'',1,0, 'C');
$pdf->Cell(15, 5,'',1,0, 'C');
$pdf->Cell(25, 5,'',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'1',1,0, 'C');
$pdf->Cell(31, 5,'UPS5 KVA','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[6]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[6]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'2',1,0, 'C');
$pdf->Cell(31, 5,'UPS 3 KVA','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[7]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[7]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'3',1,0, 'C');
$pdf->Cell(31, 5,'PRINTER','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'2 UNIT',1,0, 'C');
if($kondisi[8]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[8]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'4',1,0, 'C');
$pdf->Cell(31, 5,'ROUTER','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[9]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[9]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'5',1,0, 'C');
$pdf->Cell(31, 5,'HUB 16 PORT','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[10]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[10]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'6',1,0, 'C');
$pdf->Cell(31, 5,'HUB 8 PORT','LRT',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[11]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[11]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 10,'7',1,0, 'C');
$pdf->Cell(31, 5,'RADIOLINK OBS-','LRT',0, 'L');
$pdf->Cell(40, 10,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 10,'1 UNIT',1,0, 'C');
if($kondisi[12]==0){
    $pdf->Cell(15,10,'X',1,0,'C');
}
if($kondisi[12]==1){
    $pdf->Cell(15,10,'V',1,0,'C');
}
$pdf->Cell(25, 10,'R. OBSERVASI',1,0, 'C');;
$pdf->Cell(0, 10,'',1,0, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'',0,0, 'C');
$pdf->Cell(31, 5,'SERVER','LRB',0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 7);
$pdf->Cell(7, 5,'8',1,0, 'C');
$pdf->Cell(31, 5,'MESIN FINGERPRINT','LRB',0, 'L');
$pdf->Cell(40, 5,'SEDERHANA ELEKTRONIK',1,0, 'C');
$pdf->Cell(9, 5,'1 UNIT',1,0, 'C');
if($kondisi[13]==0){
    $pdf->Cell(15,5,'X',1,0,'C');
}
if($kondisi[13]==1){
    $pdf->Cell(15,5,'V',1,0,'C');
}
$pdf->Cell(25, 5,'R.OBSERVASI',1,0, 'C');
$pdf->Cell(0, 5,'',1,0, 'C');
//-------------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0,5,$catatan,1,1);
$pdf->Cell(0, 30, '', 0, 1);
//----------------------------------------------
//KEPALA SEKSI
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0, 30, '', 0, 2);
$pdf->Cell(0, 5, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0, 5, '', 0, 0);

$pdf->MultiCell(0, 0, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

$pdf->MultiCell(0, 5, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(40, 5, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(80, 14, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0, 5, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);

$pdf->MultiCell(0, 5, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'NIP. 19721225 199603 1 001', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'NIP. 19611210 198303 1 002', 0, 0);
//-----------------------------------------------------------------------
$pdf->Output();