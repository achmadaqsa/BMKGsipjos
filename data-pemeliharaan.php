<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    $nama = $_POST['np'];
    $catatan = $_POST['ck'];
    $max = $_POST['max'];
    $start = $_POST['start'];
    for ($i = 0; $i < $max; $i++) {
        $kondisi = $_POST["kondisi$i"];
        mysqli_query($connect, "update $_POST[namaalat] set Kondisi='$kondisi',Nama='$nama',Catatan='$catatan' where No='$start'");
        $start++;
    }
}
$filter="";
if (isset($_POST['filter'])) {
    if (($_POST['startbulan'] && $_POST['starttahun']) != "") {
        if (($_POST['endbulan'] && $_POST['endtahun']) != "") {
            $endtahun=$_POST['endtahun'];
            $endbulan=$_POST['endbulan'];
        } else {
            $endtahun=3000;
            $endbulan=12;
        }
        $filter="WHERE Tanggal BETWEEN '$_POST[starttahun]-$_POST[startbulan]-01' AND '$endtahun-$endbulan-31'";
    } else {
        $filter="";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Laporan Pemeliharaan Peralatan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css href=css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header.css">
	<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
</head>

<body>

	<div class="container">
		<?php include 'header1.php';?>
		<h3>Laporan Pemeliharaan Peralatan Stasiun Meteorologi Kelas I Juanda Sidoarjo</h3>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-12 my-1 mb-2">
					<label class="mr-sm-2" for="inlineFormCustomSelect">Filter</label>
					<div class="row">
						<div class="col-md-2">
							<select class="custom-select" id="inlineFormCustomSelect" name="startbulan">
								<option selected>Bulan</option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="col-md-2">
							<select class="custom-select" id="inlineFormCustomSelect" name="starttahun">
								<option selected>Tahun</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="3">Three</option>
							</select>
						</div>
						<div class="col-md-2">
							<select class="custom-select" id="inlineFormCustomSelect" name="endbulan">
								<option selected>Bulan</option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="col-md-2">
							<select class="custom-select" id="inlineFormCustomSelect" name="endtahun">
								<option selected>Tahun</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="3">Three</option>
							</select>
						</div>
						<div class="col-md-2">
							<button type="submit" name="filter" class="btn btn-primary">FILTER</button>
						</div>
					</div>

				</div>
			</div>
		</form>

		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
					aria-controls="profile" aria-selected="true">ADJuanda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
					aria-controls="contact" aria-selected="false">ADMalang</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="ae-tab" data-toggle="tab" href="#ae" role="tab" aria-controls="ae"
					aria-selected="false">AE</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="av-tab" data-toggle="tab" href="#av" role="tab" aria-controls="av"
					aria-selected="false">AV</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="da-tab" data-toggle="tab" href="#da" role="tab" aria-controls="da"
					aria-selected="false">DA</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="di-tab" data-toggle="tab" href="#di" role="tab" aria-controls="di"
					aria-selected="false">DI</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="fc-tab" data-toggle="tab" href="#fc" role="tab" aria-controls="fc"
					aria-selected="false">FC</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="ob-tab" data-toggle="tab" href="#ob" role="tab" aria-controls="ob"
					aria-selected="false">OB</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="pt-tab" data-toggle="tab" href="#pt" role="tab" aria-controls="pt"
					aria-selected="false">PT</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="sv-tab" data-toggle="tab" href="#sv" role="tab" aria-controls="sv"
					aria-selected="false">SV</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="tu-tab" data-toggle="tab" href="#tu" role="tab" aria-controls="tu"
					aria-selected="false">TU</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="awos-tab" data-toggle="tab" href="#awos" role="tab" aria-controls="awos"
					aria-selected="false">AWOS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="aws-tab" data-toggle="tab" href="#aws" role="tab" aria-controls="aws"
					aria-selected="false">AWS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="llwasb-tab" data-toggle="tab" href="#llwasb" role="tab" aria-controls="llwasb"
					aria-selected="false">LLWASB</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="llwasm-tab" data-toggle="tab" href="#llwasm" role="tab" aria-controls="llwasm"
					aria-selected="false">LLWASM</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
					aria-selected="false">RC</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="upm-tab" data-toggle="tab" href="#upm" role="tab" aria-controls="upm"
					aria-selected="false">UPM</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `radarcuaca` $filter $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-radarcuaca.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="RC.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `adjuanda` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-adjuanda.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="ADJUANDA.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `admalang` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-admalang.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="ADMALANG.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="ae" role="tabpanel" aria-labelledby="ae-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatae` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatae.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="ae.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="av" role="tabpanel" aria-labelledby="av-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatav` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatav.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="av.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="av" role="tabpanel" aria-labelledby="av-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatav` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatav.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="av.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="da" role="tabpanel" aria-labelledby="da-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatda` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatda.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="da.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="di" role="tabpanel" aria-labelledby="di-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatdi` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatdi.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="di.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="fc" role="tabpanel" aria-labelledby="fc-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatfc` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatfc.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="fc.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="ob" role="tabpanel" aria-labelledby="ob-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatob` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatob.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="ob.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="pt" role="tabpanel" aria-labelledby="pt-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatpt` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatpt.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="pt.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="sv" role="tabpanel" aria-labelledby="sv-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alatsv` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alatsv.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="alatsv.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="tu" role="tabpanel" aria-labelledby="tu-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `alattu` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-alattu.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="tu.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="awos" role="tabpanel" aria-labelledby="awos-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `awos` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<!--<td>
								<a href="edit-awos.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td> -->
							<td>
								<a href="awos.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="aws" role="tabpanel" aria-labelledby="aws-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `aws` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-aws.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="aws.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="llwasb" role="tabpanel" aria-labelledby="llwasb-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `llwasb` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-llwasb.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="llwasb.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="llwasm" role="tabpanel" aria-labelledby="llwasm-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `llwasm` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-llwasm.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="llwasm.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="upm" role="tabpanel" aria-labelledby="upm-tab">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal Pemeliharaan</th>
							<th>Teknisi</th>
							<th>Catatan</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
$no = 1;
$data = mysqli_query($connect, "SELECT * FROM `upm` $filter GROUP BY Tanggal ASC");
while ($d = mysqli_fetch_array($data)) {
    ?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$d['Tanggal']?></td>
							<td><?=$d['Nama']?></td>
							<td><?=$d['Catatan']?></td>
							<td>
								<a href="edit-upm.php?tanggal=<?php echo $d['Tanggal']; ?>">EDIT</a>
							</td>
							<td>
								<a href="upm.php?tanggal=<?=$d['Tanggal']?>" target="_blank">CETAK</a>
							</td>
						</tr>
						<?php
}
?>
					</tbody>
				</table>
			</div>



		</div>
	</div>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.js"></script>
</body>

</html>