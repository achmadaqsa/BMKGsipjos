<!DOCTYPE html>
<html>
<head>
	<title>Laporan Instalasi Peralatan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css href=css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	
	<div class="container">
	<?php include 'header1.php';?>
	
	<h3>Laporan Instalasi Peralatan Stasiun Meteorologi Kelas I Juanda Sidoarjo</h3>
	<a href="input-instalasi.php" class="btn btn-info" role="button">Input Instalasi Peralatan</a>
	<br/>
	<br/>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Alat</th>
			<th>Merk / Tipe / SN</th>
			<th>TOD</th>
			<th>Tanggal Instalasi</th>
			<th>Waktu Instalasi</th>
			<th>Kegiatan Instalasi</th>
			<th>Catatan</th>
			<th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($connect,"select * from instalasi order by id_ins desc limit 100");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['alat']; ?></td>
				<td><?php echo $d['mt'];
				echo "\n";
				echo $d['sn'];?>
				</td>
				<td><?php echo $d['t1_ins'];
				echo "\n";
				echo $d['t2_ins'];
				echo "\n";
				echo $d['t3_ins'];
				echo "\n";
				echo $d['t4_ins'];
				echo "\n";
				echo $d['t5_ins'];?>
				</td>
				<td><?php echo $d['ti']; ?></td>
				<td><?php echo $d['wi']; ?></td>
				<td><?php echo $d['keg']; ?></td>
				<td><?php echo $d['cat']; ?></td>
				<td>
					
					<a href="edit-instalasi.php?id_ins=<?php echo $d['id_ins']; ?>" >EDIT</a>
				</td>
				<td>
					<a href="cetak-instalasi.php?id_ins=<?php echo $d['id_ins']; ?>" target="_blank">CETAK</a>
					
					
				</td>
			</tr>
			<?php 
		}
		?>
		</tbody>
	</table>
	</div>
</body>
</html>