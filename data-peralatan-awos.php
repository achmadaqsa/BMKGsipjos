<!DOCTYPE html>
<html>
<head>
	<title>Daftar Peralatan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css href=css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
	
	<div class="container">
	<?php include 'header1.php';?>
	
	<h3>Daftar Inventaris Peralatan AWOS</h3>
	<h3>Stasiun Meteorologi Kelas I Juanda Sidoarjo</h3>
	<a href="input-peralatan.php" class="btn btn-info" role="button">Tambah Data Peralatan</a>
	<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Detail</button>
	<div class="dropdown-menu">
		<a class="dropdown-item" href="data-peralatan-obs.php">Observasi Udara Permukaan</a>
		<a class="dropdown-item" href="data-peralatan-aero.php">Observasi Udara Atas</a>
		<a class="dropdown-item" href="data-peralatan-tek.php">Peralatan Teknis</a>
		<a class="dropdown-item" href="data-peralatan-dtn.php">Data Informasi</a>
		<a class="dropdown-item" href="data-peralatan-fct.php">Forecaster</a>
		<a class="dropdown-item" href="data-peralatan-tu.php">Tata Usaha</a>
		<a class="dropdown-item" href="data-peralatan-rad.php">Radar Cuaca</a>
		<a class="dropdown-item" href="data-peralatan-awos.php">AWOS</a>
		<a class="dropdown-item" href="data-peralatan-llwas.php">LLWAS</a>
		<a class="dropdown-item" href="data-peralatan-aws.php">AWS Digitalisasi</a>
		<a class="dropdown-item" href="data-peralatan-server.php">Server Kantor</a>
	</div>
	<br/>
	<br/>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama Alat</th>
			<th>Merk / Tipe / SN</th>
			<th>Tahun Mulai Pakai</th>
			<th>Jenis Peralatan</th>
			<th>Lokasi Peralatan</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($connect,"select * from peralatan where unit = 'AWOS'");
		while($d = mysqli_fetch_array($data)){
			?>
			
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['alat']; ?></td>
				<td><?php echo $d['mt']; ?></td>
				<td><?php echo $d['tahun']; ?></td>
				<td><?php echo $d['jp']; ?></td>
				<td><?php echo $d['lok']; ?></td>
			</tr>
			
			<?php 
		}
		?>
		</tbody>
	</table>
	</div>
</body>
</html>