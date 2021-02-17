<?php
include 'koneksi.php';
if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $query=mysqli_query($connect, "(SELECT * FROM llwasm WHERE Tanggal='$tanggal') ORDER by Tanggal ASC");
    $i=0;
    while ($row=mysqli_fetch_array($query)) {
        $nama = $row['Nama'];
        $catatan=$row['Catatan'];
        $alat[$i] = $row["Alat"];
        $kondisi[$i] = $row["Kondisi"];
        $merk[$i] = $row["Merk"];
        $i++;
    }
}

//if($_POST['tp']=="") header("Location: pemeliharaan-llwasm.php");
if (isset($_POST['simpan']) && ($_POST['tp'] != "") && ($_POST['np'] != "")) {
    $tanggal = $_POST['tp'];
    $nama = $_POST['np'];
    $catatan=$_POST['ck'];
    $max=$_POST['max'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        $kondisi[$i] = $_POST["kondisi$i"];
        $merk[$i] = $_POST["merk$i"];
        mysqli_query($connect, "INSERT INTO llwasm VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$kondisi[$i]','$nama','$catatan')");
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
$pdf->SetFont('Arial', 'UB', 12);
$pdf->Cell(180, 5, 'LAPORAN PEMELIHARAAN PERALATAN', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(180, 5, 'LLWAS', 0, 1, 'C');
//----------------------------------------------------------------------------------
//identitas
$pdf->Cell(0, 2, '', 0, 1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'I. Identitas', 0, 1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(7, 5, 'No', 1, 0, 'C');
$pdf->Cell(0, 5, 'Uraian', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '1', 'LR', 0, 'C');
$pdf->Cell(40, 5, 'Lokasi / Stasiun', 'LRT', 0, 'L');
$pdf->Cell(133, 5, ':Kecamatan Sedati, Sidoarjo', 'LR', 1, 'L');
$pdf->Cell(7, 5, '2', 'LR', 0, 'C');
$pdf->Cell(40, 5, 'Petugas / Teknisi ', 'LR', 0, 'L');
$pdf->Cell(133, 5, ':'.$nama, 'LR', 1, 'L');
$pdf->Cell(7, 5, '3', 'LR', 0, 'C');
$pdf->Cell(40, 5, 'Waktu Pelaksanaan ', 'LR', 0, 'L');
$pdf->Cell(133, 5, ':'.$tanggal, 'LR', 1, 'L');
$pdf->Cell(7, 5, '4', 'LRB', 0, 'C');
$pdf->Cell(40, 5, 'Jenis Peralatan', 'LRB', 0, 'L');
$pdf->Cell(133, 5, ':Teknologi canggih/modern', 'LRB', 1, 'L');
//-------------------------------------------------------------------------------
//Kondisi Komponen
$pdf->Cell(0, 5, '', 0, 1);// Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'II. Kondisi Komponen LLWAS', 0, 1);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(7, 10, 'No', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Peralatan', 1, 0, 'C');
$pdf->Cell(55, 10, 'Merk / SN', 1, 0, 'C');
$pdf->Cell(27, 5, 'Kondisi', 1, 0, 'C');
$pdf->Cell(0, 10, 'KETERANGAN', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->Cell(102, 5, '', 0, 0, 'C');
$pdf->Cell(9, 5, 'RB', 1, 0, 'C');
$pdf->Cell(9, 5, 'RR', 1, 0, 'C');
$pdf->Cell(9, 5, 'Baik', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '1', 1, 0, 'C');
$pdf->Cell(40, 5, 'Server ims0', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '2', 1, 0, 'C');
$pdf->Cell(40, 5, 'Server ims1', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '3', 1, 0, 'C');
$pdf->Cell(40, 5, 'PC Client Observer', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '4', 1, 0, 'C');
$pdf->Cell(40, 5, 'PC Client Forecaster', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '5', 1, 0, 'C');
$pdf->Cell(40, 5, 'PC Client Teknisi', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '6', 1, 0, 'C');
$pdf->Cell(40, 5, 'PC Client ATC', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');

$pdf->MultiCell(0, 5, '');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(7, 5, '7', 1, 0, 'C');
$pdf->Cell(40, 5, 'PC Client APP', 1, 0, 'L');
$pdf->Cell(55, 5, 'Fujitsu', 1, 0, 'C');
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
$pdf->Cell(0, 5, '', 1, 0, 'C');
//----------------------------------------------------------------------
//catatan khusus
$pdf->Cell(0, 10, '', 0, 1); // Memberikan space kebawah agar tidak terlalu rapat
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, 'III. Catatan Khusus', 0, 1);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 5, $catatan, 1, 1);
//----------------------------------------------
//KEPALA SEKSI
$pdf->SetFont('Arial', '', 10);

$pdf->MultiCell(0, 5, '', 0, 2);
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
$pdf->Cell(47, 5, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 38), 0, 0, '', false);
$pdf->Cell(53, 5, '', 0, 0);
$pdf->Cell(80, 14, $pdf->Image($image2, $pdf->GetX(), $pdf->GetY(), 42), 0, 1, '', false);

$pdf->MultiCell(0, 0, '', 0, 2);
$pdf->Cell(7, 5, '', 0, 0);
$pdf->Cell(55, 5, 'ZEM IRIANTO PADAMA, SE, S.Si', 0, 0, 'C');
$pdf->Cell(38, 5, '', 0, 0);
$pdf->Cell(0, 5, 'M. ANWAR SYAEFUDIN, ST', 0, 0);
$pdf->Output();
