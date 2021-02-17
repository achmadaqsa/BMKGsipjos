<?php 
include 'koneksi.php';

$alat = strtoupper($_POST['alat']);
$mt = strtoupper($_POST['mt']);
$sn = $_POST['sn'];
$tahun = strtoupper($_POST['tahun']);
$jp = strtoupper($_POST['jp']);
$lok = strtoupper($_POST['lok']);
$sts = strtoupper($_POST['status']);
$unit = strtoupper($_POST['unit']);

mysqli_query($connect, "insert into peralatan values('','$alat','$mt','$sn','$tahun','$jp','$lok','$sts','$unit')");

header("location:input-peralatan.php");
?>