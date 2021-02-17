<?php
include 'koneksi.php';
if(isset($_GET['tanggal'])){
    $tanggal = $_GET['tanggal'];
    $query=mysqli_query($connect, "SELECT * FROM `alattu` WHERE Tanggal='$tanggal'");
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
//if($_POST['tp']=="") header("Location: pemeliharaan-alattu.php");
if (isset($_POST['simpan']) && ($_POST['tp'] != "") && ($_POST['np'] != "")) {
    $tanggal = $_POST['tp'];
    $nama = $_POST['np'];
    $catatan=$_POST['ck'];
    $max=$_POST['max'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        $kondisi[$i] = $_POST["kondisi$i"];
        $merk[$i] = $_POST["merk$i"];
        mysqli_query($connect, "INSERT INTO alattu VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$kondisi[$i]','$nama','$catatan')");
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
$pdf->Cell(10,3, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180,5, 'FORM PEMELIHARAAN ALAT', 0, 1, 'C');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20,5, 'Tanggal',0,0, 'L');
$pdf->Cell(40,5, ':'.$tanggal,0,0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20,5, 'Unit Kerja',0,0, 'L');
$pdf->Cell(40,5, ': TATA USAHA',0,0, 'L');

$pdf->MultiCell(0,5,'', 0, 2);
$pdf->SetFont('Arial','', 10);
$pdf->Cell(20,5, 'Teknisi',0,0, 'L');
$pdf->Cell(40,5, ':'.$nama,0,0, 'L');

//----------------------------------------------------------------------------------
//
$pdf->Cell(0,10,'',0,1);// Memberikan space kebawah agar tidak terlalu rapat

$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(0,0,'');
$pdf->Cell(7,10,'NO',1,0,'C');
$pdf->Cell(30,5,'NAMA','T',0,'C');
$pdf->Cell(40,10,'JENIS PERALATAN',1,0,'C');
$pdf->Cell(10,10,'VOL',1,0,'C');
$pdf->Cell(20,10,'KONDISI',1,0,'C');
$pdf->Cell(25,5,'LOKASI','T',0,'C');
$pdf->Cell(0,10,'KETERANGAN',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(30,5,'PERALATAN','B',0,'C');
$pdf->Cell(70,5,'',0,0,'C');
$pdf->Cell(25,5,'PERALATAN','B',0,'C');

// Komputer operasional

$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(70,5,'KOMPUTER OPERASIONAL',1,0,'L');
$pdf->Cell(10,5,'',1,0,'C');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(25,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->SetFont('Arial','',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(30,5,'PC KEPALA STASIUN',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[0]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[0]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. KASMET',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(30,5,'PC KASUBAG TU',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[1]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[1]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. KASUBAG TU',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(30,5,'PC BENDAHARA',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[2]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[2]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. BENDAHARA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,10,'4',1,0,'C');
$pdf->Cell(30,5,'PC BENDAHARA','LRT',0,'L');
$pdf->Cell(40,10,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,10,'1 UNIT',1,0,'C');
if($kondisi[3]==0){
    $pdf->Cell(20,10,'X',1,0,'C');
}
if($kondisi[3]==1){
    $pdf->Cell(20,10,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. BENDAHARA',0,0,'C');
$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(30,5,'MATERIAL','LRB',0,'L');
$pdf->Cell(70,5,'',0,0,'C');
$pdf->Cell(25,5,'MATERIAL',0,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'5',1,0,'C');
$pdf->Cell(30,5,'PC STAF TU',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[4]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[4]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(30,5,'PC STAF TU',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[5]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[5]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->SetFont('Arial','',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(30,5,'PC STAF TU',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[6]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[6]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(30,5,'PC STAF TU',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[7]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[7]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'9',1,0,'C');
$pdf->Cell(30,5,'PC PPK',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[8]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[8]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. PPK',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,10,'10',1,0,'C');
$pdf->Cell(30,10,'PC STAF PPK',1,0,'L');
$pdf->Cell(40,10,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,10,'1 UNIT',1,0,'C');
if($kondisi[9]==0){
    $pdf->Cell(20,10,'X',1,0,'C');
}
if($kondisi[9]==1){
    $pdf->Cell(20,10,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. BENDAHARA',0,0,'C');
$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(30,5,'','LRB',0,'L');
$pdf->Cell(70,5,'',0,0,'C');
$pdf->Cell(25,5,'MATERIAL',0,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'11',1,0,'C');
$pdf->Cell(30,5,'PC RESEPSIONIS',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[10]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[10]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'LOBBY TU',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'12',1,0,'C');
$pdf->Cell(30,5,'PC DISPLAY LOBBY',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[11]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[11]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'LOBBY TU',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

// Peralatan Elektronik Penunjang

$pdf->SetFont('Arial','B',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',1,0,'C');
$pdf->Cell(70,5,'PERALATAN ELEKTRONIK PENUNJANG OPERASIONAL',1,0,'L');
$pdf->Cell(10,5,'',1,0,'C');
$pdf->Cell(20,5,'',1,0,'C');
$pdf->Cell(25,5,'',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->SetFont('Arial','',7);
$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'1',1,0,'C');
$pdf->Cell(30,5,'UPS 3 KVA',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[12]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[12]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'GD. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'2',1,0,'C');
$pdf->Cell(30,5,'UPS 1 KVA',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'6 UNIT',1,0,'C');
if($kondisi[13]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[13]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'GD. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'3',1,0,'C');
$pdf->Cell(30,5,'PRINTER',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'6 UNIT',1,0,'C');
if($kondisi[14]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[14]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'GD. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'4',1,0,'C');
$pdf->Cell(30,5,'FOTOCOPY',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[15]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[15]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,10,'5',1,0,'C');
$pdf->Cell(30,10,'HUB 16 PORT','LRT',0,'L');
$pdf->Cell(40,10,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,10,'1 UNIT',1,0,'C');
if($kondisi[16]==0){
    $pdf->Cell(20,10,'X',1,0,'C');
}
if($kondisi[16]==1){
    $pdf->Cell(20,10,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. BENDAHARA',0,0,'C');
$pdf->Cell(0,10,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'',0,0,'C');
$pdf->Cell(30,5,'','LRB',0,'L');
$pdf->Cell(70,5,'',0,0,'C');
$pdf->Cell(25,5,'MATERIAL',0,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'6',1,0,'C');
$pdf->Cell(30,5,'HUB 8 PORT',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'3 UNIT',1,0,'C');
if($kondisi[17]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[17]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'GD. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'7',1,0,'C');
$pdf->Cell(30,5,'FAXIMILE',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[18]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[18]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. TATA USAHA',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(30,5,'MESIN FINGERPRINT',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[19]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[19]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'LOBBY TU',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

$pdf->MultiCell(0,5,'');
$pdf->Cell(7,5,'8',1,0,'C');
$pdf->Cell(30,5,'PABX',1,0,'L');
$pdf->Cell(40,5,'SEDERHANA ELEKTRONIK',1,0,'C');
$pdf->Cell(10,5,'1 UNIT',1,0,'C');
if($kondisi[20]==0){
    $pdf->Cell(20,5,'X',1,0,'C');
}
if($kondisi[20]==1){
    $pdf->Cell(20,5,'V',1,0,'C');
}
$pdf->Cell(25,5,'R. PPK',1,0,'C');
$pdf->Cell(0,5,'',1,0,'C');

//----------------------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0,5,$catatan,1,1);


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
$pdf->Cell(40,3, 'Kepala Seksi Observasi', 0, 0, 'C');
$pdf->Cell(53,3, '', 0, 0);
$pdf->Cell(50,3, 'Kepala Kelompok Peralatan Teknis', 0, 0, 'C');

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

    $pdf->Output();
?>