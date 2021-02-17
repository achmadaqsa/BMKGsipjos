<?php 
include 'koneksi.php';

$ti = $_POST['ti'];
$wi = $_POST['wi'];


$pj = strtoupper($_POST['pj']);


$tx1 = strtolower($_POST['t1_ins']);
$t1 = ucfirst($tx1);
$tx2 = strtolower($_POST['t2_ins']);
$t2 = ucfirst($tx2);
$tx3 = strtolower($_POST['t3_ins']);
$t3 = ucfirst($tx3);
$tx4 = strtolower($_POST['t4_ins']);
$t4 = ucfirst($tx4);
$tx5 = strtolower($_POST['t5_ins']);
$t5 = ucfirst($tx5);

$keg = $_POST['keg'];
$cat = $_POST['cat'];

$timestamp = date("Y-m-d H:i:s");


$alat = strtoupper($_POST['alat']);
$mt = strtoupper($_POST['mt']);
$sn = $_POST['sn'];
$tahun = strtoupper($_POST['tahun']);
$jp = strtoupper($_POST['jp']);
$lok = strtoupper($_POST['lok']);
$sts = strtoupper($_POST['status']);
$unit = strtoupper($_POST['unit']);





mysqli_query($connect, "insert into instalasi (id_ins, ti, wi, alat, mt, sn, jp, lok, pj, t1_ins, t2_ins, t3_ins, t4_ins, t5_ins, keg, cat, dt) values('','$ti','$wi','$alat','$mt','$sn','$jp','$lok','$pj','$t1','$t2','$t3','$t4','$t5','$keg','$cat','$timestamp')");





mysqli_query($connect, "insert into peralatan values('','$alat','$mt','$sn','$tahun','$jp','$lok','$sts','$unit')");








header("location:input-instalasi.php");
?>