<?php
include "koneksi.php"; //Include file koneksi
$searchTerm = $_GET['term']; // Menerima kiriman data dari inputan pengguna

$sql="SELECT * FROM peralatan WHERE alat LIKE '%$searchTerm%' ORDER BY alat DESC"; // query sql untuk menampilkan data mahasiswa dengan operator LIKE

$hasil=mysqli_query($connect,$sql); //Query dieksekusi

//Disajikan dengan menggunakan perulangan
while ($row = mysqli_fetch_array($hasil)) {
    $data[0] = $row['alat'];
	$data[1] = $row['mt'];
	$data[2] = $row['sn'];
	$data[3] = $row['jp'];
	$data[4] = $row['lok'];
	$out []= implode (";",$data);
	
}
//Nilainya disimpan dalam bentuk json
echo json_encode($out);
?>