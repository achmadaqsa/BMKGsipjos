<!DOCTYPE html>
<html>
<head>
	<title>Laporan Perbaikan Peralatan</title>
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
	
	<h3>Laporan Perbaikan Peralatan Stasiun Meteorologi Kelas I Juanda Sidoarjo</h3>
	<a href="input-perbaikan.php" class="btn btn-info" role="button">Input Perbaikan Peralatan</a>
	<br/>
	<br/>
	
	<table class="table table-striped">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Alat</th>
			<th>Merk / Tipe / SN</th>
			<th>TOD</th>
			<th>Tanggal Mulai Rusak</th>
			<th>Tanggal Perbaikan</th>
			<th>Data Kerusakan</th>
			<th>Tindakan Perbaikan</th>
			<th>Opsi</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($connect,"select * from perbaikan order by id desc limit 100");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['alat']; ?></td>
				<td><?php echo $d['mt'];
				echo "\n";
				echo $d['sn']; ?>
				</td>
				<td><?php echo $d['t1'];
				echo "\n";
				echo $d['t2'];
				echo "\n";
				echo $d['t3'];
				echo "\n";
				echo $d['t4'];
				echo "\n";
				echo $d['t5'];?>
				</td>
				<td><?php echo $d['tr']; ?></td>
				<td><?php echo $d['tp']; ?></td>
				<td><?php echo $d['awal']; ?></td>
				<td><?php echo $d['tindakan']; ?></td>
				<td>
					
					<a href="edit-perbaikan.php?id=<?php echo $d['id']; ?>" >EDIT</a>
				</td>
				<td>
					<a href="cetak.php?id=<?php echo $d['id']; ?>" target="_blank">CETAK</a>
					
					
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