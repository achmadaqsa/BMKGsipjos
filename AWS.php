<?php
include 'koneksi.php';
if(isset($_GET['tanggal'])){
    $tanggal = $_GET['tanggal'];
    $query=mysqli_query($connect, "(SELECT * FROM aws WHERE Tanggal='$tanggal') ORDER by Tanggal ASC");
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

//if($_POST['tp']=="") header("Location: pemeliharaan-aws.php");
if (isset($_POST['simpan']) && ($_POST['tp'] != "") && ($_POST['np'] != "")) {
    $tanggal = $_POST['tp'];
    $nama = $_POST['np'];
    $catatan=$_POST['ck'];
    $max=$_POST['max'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        $kondisi[$i] = $_POST["kondisi$i"];
        $merk[$i] = $_POST["merk$i"];
        mysqli_query($connect, "INSERT INTO aws VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$kondisi[$i]','$nama','$catatan')");
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
$pdf->Cell(180,5,'LAPORAN PEMELIHARAAN PERALATAN',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,5,'AWS Digitalisasi',0,1,'C');
//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0,2,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'I. Identitas',0,1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(7,5,'No',1,0,'C');
$pdf->Cell(0,5,'Uraian',1,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'1','LR',0,'C');
$pdf->Cell(40,5,'Lokasi / Stasiun','LRT',0,'L');
$pdf->Cell(133,5,':Taman Alat / Stasiun Meteorologi Kelas I Juanda Sidoarjo','LR',1,'L');
$pdf->Cell(7,5,'2','LR',0,'C');
$pdf->Cell(40, 5, 'Petugas / Teknisi ', 'LR', 0, 'L');
$pdf->Cell(133, 5, ':'.$nama, 'LR', 1, 'L');
$pdf->Cell(7, 5, '3', 'LR', 0, 'C');
$pdf->Cell(40, 5, 'Waktu Pelaksanaan ', 'LR', 0, 'L');
$pdf->Cell(133, 5, ':'.$tanggal, 'LR', 1, 'L');
$pdf->Cell(7, 5, '4', 'LRB', 0, 'C');
$pdf->Cell(40,5,'Jenis Peralatan','LRB',0,'L');
$pdf->Cell(133,5,':Teknologi canggih/modern','LRB',1,'L');
//-------------------------------------------------------------------------------
//Kondisi Komponen
$pdf->Cell(0,4,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'II. Kondisi Komponen AWS Digitalisasi',0,1);
$pdf->SetFont('Arial','B',8);
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

$pdf->MultiCell(0,5,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(40,5,'Data Logger',1,0,'C');
$pdf->Cell(55,5,'VAISALA/QML201C/-',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(40,5,'Sensor Temperatur dan RH',1,0,'L');
$pdf->Cell(55,5,'VAISALA/HMP155/L2450026',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(40,5,'Sensor Tekanan Udara',1,0,'L');
$pdf->Cell(55,5,'VAISALA/PTB330/L2450061',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,10,'4',1,0,'C');
$pdf->Cell(40,5,'Sensor Kecepatan Angin ','LRT',0,'L');
$pdf->Cell(55,10,'VAISALA/WMT703/L2150423',1,0,'C');
if ($kondisi[3] == 0) {
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[3] == 1) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[3] == 2) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
}

$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(40,5,'dan Arah Angin','LRB',0,'C');

$pdf->MultiCell(0,5,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(40,5,'Sensor Curah Hujan',1,0,'L');
$pdf->Cell(55,5,'VAISALA/RG13N2NN/L2420163',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,10,'6',1,0,'C');
$pdf->Cell(40,5,'Sensor Intensitas Radiasi ','LRT',0,'L');
$pdf->Cell(55,10,'VAISALA/QMS101/140050',1,0,'C');
if ($kondisi[5] == 0) {
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[5] == 1) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[5] == 2) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
}
$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(40,5,'Matahari','LRB',0,'L');

$pdf->MultiCell(0,5,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(40,5,'Sensor Suhu Air',1,0,'L');
$pdf->Cell(55,5,'THIES CLIMA/2.1235.01.010/-',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(40,5,'Sensor Tinggi Air',1,0,'L');
$pdf->Cell(55,5,'THIES /6.1432.10.073/7150130',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'9',1,0,'C');
$pdf->Cell(40,5,'Cup Counter Anemometer',1,0,'L');
$pdf->Cell(55,5,'VAISALA/WMS302',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'10',1,0,'C');
$pdf->Cell(40,5,'Solar Cell',1,0,'L');
$pdf->Cell(55,5,'GH SOLAR/GH100P-18',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'11',1,0,'C');
$pdf->Cell(40,5,'Solar Controller',1,0,'L');
$pdf->Cell(55,5,'PHOCOS',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'12',1,0,'C');
$pdf->Cell(40,5,'Battery',1,0,'L');
$pdf->Cell(55,5,'UL RANGE/12V-26AH))P-18',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'13',1,0,'C');
$pdf->Cell(40,5,'Inverter',1,0,'L');
$pdf->Cell(55,5,'SOUER/12V-10A',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,10,'14',1,0,'C');
$pdf->Cell(40,10,'PC Server',1,0,'L');
$pdf->Cell(55,5,'ASUS/TS110-E8-PI4/','LR',0,'C');
if ($kondisi[13] == 0) {
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[13] == 1) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
}
if ($kondisi[13] == 2) {
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, '', 1, 0, 'C');
    $pdf->Cell(9, 10, 'V', 1, 0, 'C');
}
$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(47,5,'',0,0,'C');
$pdf->Cell(55,5,'F3S0AG001NV','LRB',0,'C');

$pdf->MultiCell(0,5,'');
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'15',1,0,'C');
$pdf->Cell(40,5,'Monitor Server',1,0,'L');
$pdf->Cell(55,5,'ASUS/VX238',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'16',1,0,'C');
$pdf->Cell(40,5,'PC Client',1,0,'L');
$pdf->Cell(55,5,'ASUS/VIVOBOOK',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'17',1,0,'C');
$pdf->Cell(40,5,'Monitor Client',1,0,'L');
$pdf->Cell(55,5,'ASUS',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'18',1,0,'C');
$pdf->Cell(40,5,'PC Display',1,0,'L');
$pdf->Cell(55,5,'PCDUINO',1,0,'C');
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'19',1,0,'C');
$pdf->Cell(40,5,'Monitor Display',1,0,'L');
$pdf->Cell(55,5,'SAMSUNG',1,0,'C');
if ($kondisi[18] == 0) {
    $pdf->Cell(9, 5, 'V', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
    $pdf->Cell(9, 5, '', 1, 0, 'C');
}
if ($kondisi[19] == 1) {
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
$pdf->SetFont('Arial','',8);
$pdf->Cell(7,5,'20',1,0,'C');
$pdf->Cell(40,5,'UPS',1,0,'L');
$pdf->Cell(55,5,'APC/SMART-UPS 3000XL/-',1,0,'C');
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
//----------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0,5,$catatan,1,1);
//----------------------------------------------
//KEPALA SEKSI
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0, 5, '', 0, 2);
$pdf->Cell(0, 4, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Mengetahui,', 0, 2, 'C');
$pdf->Cell(0, 5, '', 0, 0);

$pdf->MultiCell(0, 0, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(40, 5, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

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