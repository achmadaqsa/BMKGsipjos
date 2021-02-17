<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $tanggal=$_POST['tp'];
echo $tanggal;
}
?>
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
    <script type="text/javascript">
    </script>
	<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.css">
</head>
<body>
<div class="dropdown show">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown link
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
</body>

</html>