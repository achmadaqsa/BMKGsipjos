<!DOCTYPE html>
<html>
<head>
	<title>Edit Perbaikan Peralatan</title>
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

<?php

	include 'koneksi.php';
	
	if(isset($_GET['id'])){
	$sqlEdit = mysqli_query($connect,"select * from perbaikan where id='$_GET[id]'");
	$e=mysqli_fetch_array($sqlEdit);
	}
	?>


	<div class="container">
	<?php
	include 'header1.php';

	?>
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
	<form action="update-input-perbaikan.php" method="POST">	
		<input  name="id" value="<?php echo $_GET["id"]; ?>">
		<div class="form-group">
			<label for="tr">Tanggal Kerusakan :</label>
			<input type="text" class="form-control input-tanggal" id="tr" value="<?php echo $e['tr']; ?>" name="tr" required>
		</div>
		<div class="form-group">
			<label for="alat">Nama Alat :</label>
			<input type="text" class="form-control" id="buah" value="<?php echo $e['alat']; ?>" name="alat" placeholder="Nama Peralatan">
		</div>
		<div class="form-group">
			<label for="lapor">Nama Pelapor :</label>
			<input type="text" class="form-control" id="lapor" value="<?php echo $e['lapor']; ?>" placeholder="Masukkan nama pelapor" name="lapor" required>
		</div>
		<div class="form-group">
			<label for="tp">Tanggal Perbaikan :</label>
			<input type="text" class="form-control input-tanggal" id="tp" value="<?php echo $e['tp']; ?>" placeholder="Masukkan tanggal perbaikan" name="tp" required>
		</div>
		<div class="form-group">
			<?php $tek1= $e['t1']; ?>
			<label for="t1">Teknisi 1 :</label>
			<select class="form-control" id="t1"  name="t1" required>
				<option <?php echo ($tek1 == '-') ? "selected": "" ?>></option>
				<option <?php echo ($tek1 == 'Rizzal') ? "selected": "" ?>>M. RIZZAL F</option>
				<option <?php echo ($tek1 == 'Anwar') ? "selected": "" ?>>M. ANWAR SYAEFUDIN</option>
				<option <?php echo ($tek1 == 'Mira') ? "selected": "" ?>>MIRA GRAMEDIA</option>
				<option <?php echo ($tek1 == 'Rokhyadin') ? "selected": "" ?>>ROKHYADIN</option>
				<option <?php echo ($tek1 == 'Deni') ? "selected": "" ?>>DENI PRASETYO</option>
				<option <?php echo ($tek1 == 'Bangkit') ? "selected": "" ?>>SHOWAN BANGKIT S.</option>
				<option <?php echo ($tek1 == 'Yudha') ? "selected": "" ?>>ARSY YUDHA P.</option>
				<option value="">-</option>
							
			</select>
		</div>
		<div class="form-group">
			<label for="t2">Teknisi 2 :</label>
			<select class="form-control" id="t2" name="t2">
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
			<label for="t3">Teknisi 3 :</label>
			<select class="form-control" id="t3" name="t3">
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
			<label for="t4">Teknisi 4 :</label>
			<select class="form-control" id="t4" name="t4">
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
			<label for="t5">Teknisi 5 :</label>
			<select class="form-control" id="t5" name="t5">
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
			<label for="awal">Kondisi Awal :</label>
			<textarea  class="form-control" rows="3" id="awal" placeholder="" name="awal"><?php echo $e['awal']; ?></textarea>
		</div>
		<div class="form-group">
			<label for="tindakan">Tindakan Perbaikan :</label>
			<textarea class="form-control" rows="5" id="tindakan" placeholder="Masukkan tindakan perbaikan peralatan" name="tindakan"><?php echo $e['tindakan']; ?></textarea>
		</div>
		<div class="form-group">
			<label for="akhir">Kondisi Akhir :</label>
			<textarea class="form-control" rows="3" id="akhir" placeholder="Masukkan kondisi akhir peralatan" name="akhir"><?php echo $e['akhir']; ?></textarea>
		</div>
		
		<button type="submit" name="update" value="update" class="btn btn-primary">update</button>
		
		
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