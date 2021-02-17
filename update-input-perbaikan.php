<?php 
include 'koneksi.php';
$id = $_POST['id'];
$tr = $_POST['tr'];

$datamentah = $_POST['alat'];
$pecah = explode("-",$datamentah);
$alat = $pecah[0];
$mt = $pecah[1];
$jp = $pecah[2];
$lok = $pecah[3];

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
mysqli_query($connect, "update perbaikan
set
tr='$tr',
alat='$alat',
mt='$mt',
jp='$jp',
lok='$lok',
lapor='$lapor',
tp='$tp',
t1='$t1',
t2='$t2',
t3='$t3',
t4='$t4',
t5='$t5',
awal='$awal',
tindakan='$tindakan',
akhir='$akhir',
timestamp='$timestamp'
where id=$id");

//header("location:data-perbaikan.php");
?>