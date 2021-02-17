<?php
include 'koneksi.php';
if (isset($_GET['tanggal'])) {
    $sqlEdit = mysqli_query($connect, "select * from alatfc where Tanggal='$_GET[tanggal]'");
    $i = 0;
    while ($e = mysqli_fetch_array($sqlEdit)) {
        $kondisi[$i] = $e['Kondisi'];
        $i++;
        $nama = $e['Nama'];
        $tanggal = $e['Tanggal'];
        $catatan = $e['Catatan'];
        $array_no[] = $e['No'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Form Pemeliharaan Peralatan FC</title>
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
    <form action="data-pemeliharaan.php" method="post">
    <!-- ini $nama $tanggal -->
    <div class="form-group"><label for="ti">Nama :</label><input type="text" class="form-control" id="np"
            name="np" value="<?=$nama?>" placeholder="Nama Petugas/Teknisi"></div>
    <div class="form-group"><label for="ti">Tanggal Pemeliharaan : <?=$tanggal?></label><input type="hidden"
            class="form-control input-tanggal" id="tp" name="tp" placeholder="Tanggal Perawatan"
            value="<?=$tanggal?>"></div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peralatan</th>
            <th scope="col">Kondisi</th>
            <th scope="col">Merk / SN</th>
          </tr>
        </thead>
        <tbody>
        <?php
$namaperalatan = array('PC KAPOK FORECASTER','PC STAF FORECASTER','PC STAF FORECASTER','HUB 16 PORT','ROUTER MIKROTIK','UPS 3 KVA','UPS 2 KVA','PRINTER-SCANNER');
$merksn = array('SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK','SEDERHANA ELEKTRONIK');
for ($i = 0; $i < count($namaperalatan); $i++) {
    ?>
                    <tr>
                        <th scope="row"><?=$i + 1?></th>
                        <td><?=$namaperalatan[$i]?></td>
                        <td><input <?=($kondisi[$i] == '0') ? "checked" : ""?> type="radio" class="mr-1"
                                name="kondisi<?=$i?>" value="0"><label>Buruk</label><br><input name="kondisi<?=$i?>"
                                <?=($kondisi[$i] == '1') ? "checked" : ""?> class="mr-1" type="radio"
                                value="1"><label>Baik</label><br></td>
                    </tr>
                    <?php
}
?>
                </tbody>
                </table>
            <!-- ini $catatan -->
            <div class="form-group"><label for="ti">Catatan Khusus : </label><textarea class="form-control" id="ck"
                    name="ck" placeholder="Catatan Khusus"><?=$catatan?></textarea></div>
            <input type="hidden" name="max" value="<?=count($namaperalatan)?>">
            <input type="hidden" name="start" value="<?=$array_no[0]?>">
            <input type="hidden" name="namaalat" value="alatfc">
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