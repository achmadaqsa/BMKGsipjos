<!DOCTYPE html>
<html>
<head>
	<title>Input Daftar Peralatan</title>
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
	
	<h3>Input Daftar Peralatan</h3>
	<a href="data-peralatan.php" class="btn btn-info" role="button">Daftar Peralatan</a>
	<br><br>
	
	<form action="simpan-input-peralatan.php" method="post">	
		<div class="form-group">
			<label for="alat">Nama Peralatan :</label>
			<input type="text" class="form-control" id="alat" placeholder="Masukkan nama peralatan" name="alat" required>
		</div>
		<div class="form-group">
			<label for="mt">Merk/Tipe/SN :</label>
			<input type="text" class="form-control" id="mt" placeholder="Masukkan merk / tipe " name="mt" required>
		</div>
		<div class="form-group">
			<label for="sn">Serial Number :</label>
			<input type="text" class="form-control" id="sn" placeholder="Masukkan serial number peralatan" name="sn" required>
		</div>
		<div class="form-group">
			<label for="tahun">Tahun Mulai Pakai :</label>
			<input type="text" class="form-control" id="tahun" placeholder="Masukkan tahun mulai pakai peralatan" name="tahun" required>
		</div>
		<div class="form-group">			
			<label for="jp">Jenis Peralatan :</label>
			<select class="form-control" id="jp" name="jp">
				<option>SEDERHANA MEKANIK</option>
				<option>SEDERHANA ELEKTRONIK</option>
				<option>TEK. CANGGIH/MODERN</option>
			</select>
		</div>
		<div class="form-group">
			<label for="lok">Lokasi Peralatan :</label>
			<input type="text" class="form-control" id="lok" placeholder="Masukkan lokasi peralatan" name="lok" required>
		</div>
		<div class="form-check">
			<label class="form-check-label" for="radio1">
				<input type="radio" class="form-check-input" id="radio1" name="status" value="A" checked>AKTIF
			</label>
		</div>
		<div class="form-check">
			<label class="form-check-label" for="radio2">
				<input type="radio" class="form-check-input" id="radio2" name="status" value="NA">NON-AKTIF
			</label>
		</div>
		
		<div class="form-group">			
			<label for="unit">Unit :</label>
			<select class="form-control" id="unit" name="unit">
				<option value="OBS">OBSERVASI UDARA PERMUKAAN</option>
				<option value="AEROLOGI">OBSERVASI UDARA ATAS</option>
				<option value="PERTEK">PERALATAN TEKNIS</option>
				<option value="DATIN">DATA INFORMASI</option>
				<option value="FCT">FORECASTER</option>
				<option value="TU">TATA USAHA</option>
				<option value="RADAR">RADAR CUACA</option>
				<option value="AWOS">AWOS</option>
				<option value="LLWAS">LLWAS</option>
				<option value="AWS">AWS DIGITALISASI</option>
				<option value="DC">DISPLAY CUACA</option>
				<option value="SERVER">SERVER KANTOR</option>				
			</select>
		</div>
		
		<button type="submit" value="Simpan" class="btn btn-primary">Simpan</button>
		
	</form>
	</div>
</body>

</html>