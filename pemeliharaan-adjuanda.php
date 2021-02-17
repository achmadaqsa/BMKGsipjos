<!DOCTYPE html>
<html>

<head>
  <title>Form Pemeliharaan AD Juanda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css href=css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/autocomplete.css">
  <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="js/jquery-ui/jquery-ui.js"></script>
</head>

<body>
  <div class="container">
    <?php include 'header1.php';
?><script>
      $(function () {
          $("#buah").autocomplete({
              source: 'auto.php'
            }

          );
        }

      );
    </script>
    <form action="ADJUANDA.php" method="post">
    <div class="form-group"><label for="ti">Nama :</label><input type="text"
          class="form-control" id="np" name="np" placeholder="Nama Petugas/Teknisi"></div>
      <div class="form-group"><label for="ti">Tanggal Pemeliharaan :</label><input type="text"
          class="form-control input-tanggal" id="tp" name="tp" placeholder="Tanggal Perawatan"></div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peralatan</th>
            <th scope="col">Kondisi</th>
          </tr>
        </thead>
        <tbody>
        <?php
$namaperalatan = array('Cek kondisi fisik PC ','Cek kondisi fisik monitor ','Cek kondisi dan fungsi kamera CCTV ','Cek kondisi dan fungsi Modem ADSL dan GSM','Cek koneksi inetrnet','Cek kondisi UPS','Cek pengkabelan (power dan VGA)','Cek kuota paket data GSM ','Cek update konten informasi ','Pembersihan PC dan Modem dari debu dan kotoran ','Cek kondisi fisik PC ','Cek kondisi fisik monitor ','Cek kondisi dan fungsi kamera CCTV ','Cek kondisi dan fungsi Modem ADSL dan GSM','Cek koneksi inetrnet','Cek kondisi UPS','Cek pengkabelan (power dan VGA)','Cek kuota paket data GSM ','Cek update konten informasi ','Pembersihan PC dan Modem dari debu dan kotoran ');
$merksn = array('');
for ($i = 0; $i < count($namaperalatan); $i++) {
    ?>
<tr>
          <th scope="row"><?=$i+1?></th>
          <td><?=$namaperalatan[$i]?></td>
          <input type="hidden" value="<?=$namaperalatan[$i]?>" name="alat<?=$i?>">
          <td><input type="radio" class="mr-1" name="kondisi<?=$i?>" value="0"><label>Buruk</label><br><input name="kondisi<?=$i?>" class="mr-1" type="radio" value="1"><label>Baik</label><br></input></td>
        </tr>
          <?php
}
?>
        </tbody>
      </table>
      <div class="form-group"><label for="ti">Catatan Khusus : </label><textarea
          class="form-control" id="ck" name="ck" placeholder="Catatan Khusus"></textarea></div>
          <input type="hidden" name="max" value="<?=count($namaperalatan)?>">
      <button type="submit" name="simpan" value="Simpan" class="btn btn-primary">Simpan</button>
    </form>
  </div>
  <script type="text/javascript">
    $(document).ready(function () {
        $('.input-tanggal').datepicker({
            dateFormat: "yy-mm-dd"
          }

        );
      }

    );
  </script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.js"></script>
</body>

</html>