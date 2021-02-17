<?php 
include 'koneksi.php';

$tr = $_POST['tr'];

$datamentah = $_POST['alat'];
$pecah = explode(";",$datamentah);
$alat = $pecah[0];
$mt = $pecah[1];
$sn = $pecah[2];
$jp = $pecah[3];
$lok = $pecah[4];


$lapor = strtoupper($_POST['lapor']);
$tp = $_POST['tp'];
$tx1 = strtolower($_POST['t1']);
$t1 = ucfirst($tx1);
$tx2 = strtolower($_POST['t2']);
$t2 = ucfirst($tx2);
$tx3 = strtolower($_POST['t3']);
$t3 = ucfirst($tx3);
$tx4 = strtolower($_POST['t4']);
$t4 = ucfirst($tx4);
$tx5 = strtolower($_POST['t5']);
$t5 = ucfirst($tx5);

$awal = $_POST['awal'];
$tindakan = $_POST['tindakan'];
$akhir = $_POST['akhir'];
$timestamp = date("Y-m-d H:i:s");
mysqli_query($connect, "insert into perbaikan values('','$tr','$alat','$mt','$sn','$jp','$lok','$lapor','$tp','$t1','$t2','$t3','$t4','$t5','$awal','$tindakan','$akhir','$timestamp')");

header("location:input-perbaikan.php");
?>