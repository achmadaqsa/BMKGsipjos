<!DOCTYPE html>
<html>
<head>
	<title>Input Instalasi Peralatan</title>
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

	<h3>Input Instalasi Peralatan</h3>
	<a href="data-instalasi.php" class="btn btn-info" role="button">Laporan Instalasi Peralatan</a>
	<br><br>
	
	<script>
    $(function() {
        $("#buah").autocomplete({
            source: 'auto.php'
         });
    });
	</script>
	
	<form action="simpan-input-instalasi.php" method="post">

		<div class="form-group">
			<label for="alat">Nama Peralatan :</label>
			<input type="text" class="form-control" id="alat" placeholder="Masukkan nama peralatan" name="alat" required>
		</div>
		<div class="form-group">
			<label for="mt">Merk/Tipe :</label>
			<input type="text" class="form-control" id="mt" placeholder="Masukkan merk / tipe" name="mt" required>
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

		<div class="form-group">
			<label for="ti">Tanggal Instalasi :</label>
			<input type="text" class="form-control input-tanggal" id="ti" name="ti" placeholder="Tanggal Instlasi">
		</div>
		<div class="form-group">
			<label for="wi">Waktu instalasi :</label>
			<input type="time" class="form-control" id="wi" placeholder="Masukkan nama pelapor" name="wi" required>
		</div>
		<div class="form-group">
			<label for="pj">Penanggung jawab Peralatan :</label>
			<input type="text" class="form-control" id="pj" placeholder="Masukkan penanggung alat/ - jika tidak ada" name="pj" required>
		</div>
		<div class="form-group">
			<label for="t1_ins">Teknisi 1 :</label>
			<select class="form-control" id="t1_ins" name="t1_ins" required>
				<option value="">-</option>
				<option value="ANWAR">M. ANWAR SYAEFUDIN</option>
				<option value="MIRA">MIRA GRAMEDIA</option>
				<option value="ROKHYADIN">ROKHYADIN</option>
				<option value="DENI">DENI PRASETYO</option>
				<option value="BANGKIT">SHOWAN BANGKIT S.</option>
				<option value="YUDHA">ARSY YUDHA P.</option>
				<option value="RIZZAL">MUH. RIZZAL F.</option>			
			</select>
		</div>
		<div class="form-group">
			<label for="t2_ins">Teknisi 2 :</label>
			<select class="form-control" id="t2_ins" name="t2_ins">
				<option value="">-</option>
				<option value="ANWAR">M. ANWAR SYAEFUDIN</option>
				<option value="MIRA">MIRA GRAMEDIA</option>
				<option value="ROKHYADIN">ROKHYADIN</option>
				<option value="DENI">DENI PRASETYO</option>
				<option value="BANGKIT">SHOWAN BANGKIT S.</option>
				<option value="YUDHA">ARSY YUDHA P.</option>
				<option value="RIZZAL">MUH. RIZZAL F.</option>			
			</select>
		</div>
		<div class="form-group">
			<label for="t3_ins">Teknisi 3 :</label>
			<select class="form-control" id="t3_ins" name="t3_ins">
				<option value="">-</option>
				<option value="ANWAR">M. ANWAR SYAEFUDIN</option>
				<option value="MIRA">MIRA GRAMEDIA</option>
				<option value="ROKHYADIN">ROKHYADIN</option>
				<option value="DENI">DENI PRASETYO</option>
				<option value="BANGKIT">SHOWAN BANGKIT S.</option>
				<option value="YUDHA">ARSY YUDHA P.</option>
				<option value="RIZZAL">MUH. RIZZAL F.</option>			
			</select>
		</div>
		<div class="form-group">
			<label for="t4_ins">Teknisi 4 :</label>
			<select class="form-control" id="t4_ins" name="t4_ins">
				<option value="">-</option>
				<option value="ANWAR">M. ANWAR SYAEFUDIN</option>
				<option value="MIRA">MIRA GRAMEDIA</option>
				<option value="ROKHYADIN">ROKHYADIN</option>
				<option value="DENI">DENI PRASETYO</option>
				<option value="BANGKIT">SHOWAN BANGKIT S.</option>
				<option value="YUDHA">ARSY YUDHA P.</option>
				<option value="RIZZAL">MUH. RIZZAL F.</option>			
			</select>
		</div>
		<div class="form-group">
			<label for="t5_ins">Teknisi 5 :</label>
			<select class="form-control" id="t5_ins" name="t5_ins">
				<option value="">-</option>
				<option value="ANWAR">M. ANWAR SYAEFUDIN</option>
				<option value="MIRA">MIRA GRAMEDIA</option>
				<option value="ROKHYADIN">ROKHYADIN</option>
				<option value="DENI">DENI PRASETYO</option>
				<option value="BANGKIT">SHOWAN BANGKIT S.</option>
				<option value="YUDHA">ARSY YUDHA P.</option>
				<option value="RIZZAL">MUH. RIZZAL F.</option>			
			</select>
		</div>
		<div class="form-group">
			<label for="keg">Kegiatan yang dilakukan :</label>
			<textarea class="form-control" rows="5" id="keg" placeholder="Masukkan kegiatan instalasi yang dilakukan" name="keg"></textarea>
		</div>
		<div class="form-group">
			<label for="cat">Catatan :</label>
			<textarea class="form-control" rows="5" id="cat" placeholder="Masukkan catatan" name="cat"></textarea>
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