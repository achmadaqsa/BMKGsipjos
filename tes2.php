<!DOCTYPE html>
<html>
<head>
	<title>Input Perbaikan Peralatan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css href=css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/autocomplete.css">
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="js/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.css">
	

</head>
<body>

	<div class="container">
	<?php include 'header1.php';?>

	<h3>Input Perbaikan Peralatan</h3>
	<a href="data-perbaikan.php" class="btn btn-info" role="button">Laporan Perbaikan Peralatan</a>
	<br><br>
	
	<script>
    $(function() {
        $("#buah").autocomplete({
            source: 'auto.php'
         });
    });
	</script>
	
	<form action="simpan-input-perbaikan.php" method="post">		
		<div class="form-group">
			<label for="tr">Tanggal Kerusakan :</label>
			<input type="text" class="form-control input-tanggal" id="tr" placeholder="Masukkan tanggal kerusakan" name="tr" required>
		</div>
		<div class="form-group">
			<label for="alat">Nama Alat :</label>
			<input type="text" class="form-control" id="buah" name="alat" placeholder="Nama Peralatan">
		</div>
		<div class="form-group">
			<label for="lapor">Nama Pelapor :</label>
			<input type="text" class="form-control" id="lapor" placeholder="Masukkan nama pelapor" name="lapor" required>
		</div>
		<div class="form-group">
			<label for="tp">Tanggal Perbaikan :</label>
			<input type="text" class="form-control input-tanggal" id="tp" placeholder="Masukkan tanggal perbaikan" name="tp" required>
		</div>
		<div class="form-group">
			<label for="t1">Teknisi 1 :</label>
			<input type="text" class="form-control" id="t1" placeholder="Masukkan nama teknisi 1" name="t1" required>
		</div>
		<div class="form-group">
			<label for="t2">Teknisi 2 :</label>
			<input type="text" class="form-control" id="t2" placeholder="Masukkan nama teknisi 2" name="t2" required>
		</div>
		<div class="form-group">
			<label for="t3">Teknisi 3 :</label>
			<input type="text" class="form-control" id="t3" placeholder="Masukkan nama teknisi 3" name="t3">
		</div>
		<div class="form-group">
			<label for="t4">Teknisi 4 :</label>
			<input type="text" class="form-control" id="t4" placeholder="Masukkan nama teknisi 4" name="t4">
		</div>
		<div class="form-group">
			<label for="t5">Teknisi 5 :</label>
			<input type="text" class="form-control" id="t5" placeholder="Masukkan nama teknisi 5" name="t5">
		</div>
		<div class="form-group">
			<label for="awal">Kondisi Awal :</label>
			<textarea class="form-control" rows="3" id="awal" placeholder="Masukkan kondisi awal peralatan" name="awal"></textarea>
		</div>
		<div class="form-group">
			<label for="tindakan">Tindakan Perbaikan :</label>
			<textarea class="form-control" rows="5" id="tindakan" placeholder="Masukkan tindakan perbaikan peralatan" name="tindakan"></textarea>
		</div>
		<div class="form-group">
			<label for="akhir">Kondisi Akhir :</label>
			<textarea class="form-control" rows="3" id="akhir" placeholder="Masukkan kondisi akhir peralatan" name="akhir"></textarea>
		</div>
		
		<button type="submit" value="Simpan" class="btn btn-primary">Simpan</button>
		
		
	</form>
	</div>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('.input-tanggal').datepicker({
        dateFormat: "yy-mm-dd"
     });		
	});
</script>
</body>

</html>