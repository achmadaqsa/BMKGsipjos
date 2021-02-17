<?php
include 'koneksi.php';
if(isset($_GET['tanggal'])){
    $tanggal = $_GET['tanggal'];
    $query=mysqli_query($connect, "(SELECT * FROM upm WHERE Tanggal='$tanggal') ORDER by Tanggal ASC");
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

//if($_POST['tp']=="") header("Location: pemeliharaan-upm.php");
if (isset($_POST['simpan']) && ($_POST['tp'] != "") && ($_POST['np'] != "")) {
    $tanggal = $_POST['tp'];
    $nama = $_POST['np'];
    $catatan=$_POST['ck'];
    $max=$_POST['max'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        $kondisi[$i] = $_POST["kondisi$i"];
        $merk[$i] = $_POST["merk$i"];
        mysqli_query($connect, "INSERT INTO upm VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$kondisi[$i]','$nama','$catatan')");
    }
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
$pdf->SetFont('Arial','UB',12);
$pdf->Cell(0,5,'LAPORAN PEMELIHARAAN PERALATAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Observasi Udara Permukaan',0,1,'C');

//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0,2,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'I. Identitas',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,5,'No',1,0,'C',0);
$pdf->Cell(0,5,'Uraian',1,0,'C',0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'1','LR',0,'C',0);
$pdf->Cell(40,5,'Lokasi / Stasiun','LR',0,'L',0);
$pdf->Cell(0,5,': Taman Alat / Stasiun Meteorologi Kelas I Juanda Sidoarjo','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'2','LR',0,'C',0);
$pdf->Cell(40,5,'Petugas / Teknisi','LR',0,'L',0);
$pdf->Cell(133, 5, ':'.$nama, 'LR', 1, 'L');

$pdf->Cell(7,5,'3','LR',0,'C',0);
$pdf->Cell(40,5,'Waktu Pelaksanaan','LR',0,'L',0);
$pdf->Cell(133, 5, ':'.$tanggal, 'LR', 1, 'L');

$pdf->Cell(7,5,'4','LRB',0,'C',0);
$pdf->Cell(40,5,'Jenis Peralatan','LRB',0,'L',0);
$pdf->Cell(0,5,': Sederhana Mekanik (Konvensional)','LRB',0,'L',0);

//----------------------------------------------------------------------------------
//kondisi kompoonen AWOS
$pdf->Cell(0,8,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,'II. Kondisi Peralatan Observasi Udara Permukaan',0,1);
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

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Termometer BB-BK',1,0,'L');
$pdf->Cell(55,5,'SCHNEIDER / 80906',1,0,'C');
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
$pdf->Cell(40,5,'Termometer BB-BK',1,0,'L');
$pdf->Cell(55,5,'SCHNEIDER /795345',1,0,'C');
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
$pdf->Cell(40,5,'Termometer Maksimum',1,0,'L');
$pdf->Cell(55,5,'SCHNEIDER / 189811',1,0,'C');
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
$pdf->Cell(40,5,'Termometer Minimum',1,0,'L');
$pdf->Cell(55,5,'SCHNEIDER / 389611',1,0,'C');
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
$pdf->Cell(40,5,'Thermohygrograph',1,0,'L');
$pdf->Cell(55,5,'KETTERER / 09091232',1,0,'C');
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
$pdf->Cell(40,5,'Penakar Hujan Obs',1,0,'L');
$pdf->Cell(55,5,'-',1,0,'C');
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
$pdf->Cell(40,5,'Panci Penguapan',1,0,'L');
$pdf->Cell(55,5,'-',1,0,'C');
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

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(40,5,'Termometer Apung',1,0,'L');
$pdf->Cell(55,5,'THIES CLIMA / 1121',1,0,'C');
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
$pdf->Cell(7,5,'9',1,0,'C');
$pdf->Cell(40,5,'Still Well - Hook Gauge',1,0,'L');
$pdf->Cell(55,5,'-',1,0,'C');
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
$pdf->Cell(7,5,'10',1,0,'C');
$pdf->Cell(40,5,'ARWS / KAH',1,0,'L');
$pdf->Cell(55,5,'GRASSEBY / 6043',1,0,'C');
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

//----------------------------------------------------------------------------------
//Catatan Khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, $catatan, "LT LB", 0, 'L');
$pdf->Cell(0, 5, '', "RT RB", 0, 'L');
//----------------------------------------------------------------------------------
//Mengetahui
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0,20, '', 0, 2);
$pdf->Cell(0,4, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0,5, '', 0, 0);

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53,5, '', 0, 0);
$pdf->Cell(50,5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

$pdf->MultiCell(0,5, '', 0, 2);
$pdf->Cell(47, 5, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(80, 5, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0,10, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);

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
$pdf->SetFont('Arial','UB',12);
$pdf->Cell(0,3,'LAPORAN PEMELIHARAAN PERALATAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Observasi Udara Permukaan',0,1,'C');

//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0,2,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'I. Identitas',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(7,5,'No',1,0,'C',0);
$pdf->Cell(0,5,'Uraian',1,0,'C',0);

$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'1','LR',0,'C',0);
$pdf->Cell(40,5,'Lokasi / Stasiun','LR',0,'L',0);
$pdf->Cell(0,5,': Taman Alat / Stasiun Meteorologi Kelas I Juanda Sidoarjo','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'2','LR',0,'C',0);
$pdf->Cell(40,5,'Petugas / Teknisi','LR',0,'L',0);
$pdf->Cell(133, 5, ':'.$nama, 'LR', 1, 'L');
$pdf->Cell(0,5,':','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'3','LR',0,'C',0);
$pdf->Cell(40,5,'Waktu Pelaksanaan','LR',0,'L',0);
$pdf->Cell(133, 5, ':'.$tanggal, 'LR', 1, 'L');
$pdf->Cell(0,5,':','LR',0,'L',0);

$pdf->Cell(7,5,'','',1,'L',0);
$pdf->Cell(7,5,'4','LRB',0,'C',0);
$pdf->Cell(40,5,'Jenis Peralatan','LRB',0,'L',0);
$pdf->Cell(0,5,': Sederhana Mekanik (Konvensional)','LRB',0,'L',0);

//----------------------------------------------------------------------------------
//kondisi kompoonen AWOS
$pdf->Cell(0,8,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,6,'II. Kondisi Peralatan Observasi Udara Permukaan',0,1);
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

$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'BAROMETER DIGITAL',1,0,'L');
$pdf->Cell(55,5,'VAISALA / PTB330 / L1410641',1,0,'C');
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
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'PYRANOMETER',1,0,'L');
$pdf->Cell(55,5,'KIPP&ZONEN / 114060',1,0,'C');
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

//----------------------------------------------------------------------------------
//Catatan Khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, $catatan, "LT LB", 0, 'L');
$pdf->Cell(0, 5, '', "RT RB", 0, 'L');
//----------------------------------------------------------------------------------
//Mengetahui
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0,20, '', 0, 2);
$pdf->Cell(0,4, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0,5, '', 0, 0);

$pdf->MultiCell(0,0, '', 0, 2);
$pdf->Cell(7,5, '', 0, 0);
$pdf->Cell(40,5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53,5, '', 0, 0);
$pdf->Cell(50,5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

$pdf->MultiCell(0,5, '', 0, 2);
$pdf->Cell(47, 5, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(80, 5, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0,10, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);

    $pdf->Output();
?>