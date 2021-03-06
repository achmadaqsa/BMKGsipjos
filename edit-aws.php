<?php
include 'koneksi.php';
if (isset($_GET['tanggal'])) {
    $sqlEdit = mysqli_query($connect, "select * from aws where Tanggal='$_GET[tanggal]'");
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
  <title>Form Pemeliharaan AWS</title>
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
$namaperalatan = array('Data Logger','Sensor Temperatur dan RH','Sensor Tekanan Udara','Sensor Kecepatan Angin dan Arah Angin','Sensor Curah Hujan','Sensor Intensitas Radiasi Matahari','Sensor Suhu Air','Sensor Tinggi Air','Cup Counter Anemometer','Solar Cell','Solar Controller','Battery','Inverter','PC Server','Monitor Server','PC Client','Monitor Client','PC Display','Monitor Display','UPS');
$merksn = array('VAISALA / QML201C / -','VAISALA / HMP155 / L2450026','VAISALA / PTB330 / L2450061','VAISALA / WMT703 / L2150423','VAISALA / RG13N2NN / L2520163','VAISALA / QMS101 / 140050','THIES CLIMA / 2.1235.01.010 / -','THIES / 6.1423.10.073 / 7150130','VAISALA / WMS302','GH SOLAR / GH100P-18','PHOCOS','UL RANGE / 12V-26AH','SOUER / 12V-10A','ASUS / TS110-E8-PI4 / F3S0AG0001NV','ASUS / VX238','ASUS / VIVOBOOK','ASUS','PCDUINO','SAMSUNG','APC / SMART-UPS 3000XL / -');
for ($i = 0; $i < count($namaperalatan); $i++) {
    ?>
<tr>
          <th scope="row"><?=$i + 1?></th>
          <td><?=$namaperalatan[$i]?></td>
          <input type="hidden" value="<?=$namaperalatan[$i]?>" name="alat<?=$i?>">
<!-- ini checked -->
          <td><input <?= ($kondisi[$i] == '0') ? "checked": "" ?> type="radio" class="mr-1" name="kondisi<?=$i?>" value="0"><label>Rusak Berat</label><br><input
              name="kondisi<?=$i?>" <?= ($kondisi[$i] == '1') ? "checked": "" ?> class="mr-1" type="radio" value="1"><label>Rusak Ringan</label><br><input
              name="kondisi<?=$i?>" <?= ($kondisi[$i] == '2') ? "checked": "" ?> class="mr-1" type="radio" value="2"><label>Baik</label></td>
          <td><?=$merksn[$i]?></td>
          <input type="hidden" name="merk<?=$i?>" value="<?=$merksn[$i]?>">
        </tr>
          <?php
}
?>
        </tbody>
      </table>
      <!-- ini $catatan -->
      <div class="form-group"><label for="ti">Catatan Khusus : </label><textarea
          class="form-control" id="ck" name="ck" placeholder="Catatan Khusus"><?=$catatan?></textarea></div>
          <input type="hidden" name="max" value="<?=count($namaperalatan)?>">
          <input type="hidden" name="start" value="<?=$array_no[0]?>">
          <input type="hidden" name="namaalat" value="aws">
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