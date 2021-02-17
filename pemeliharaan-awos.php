<?php
include 'koneksi.php';
$nama="";
$tanggal="";
$catatan="";
if (isset($_POST['simpan'])) {
    $nama = $_POST['np'];
    $tanggal = $_POST['tp'];
    $site = $_POST['SelectionSite'];
    $catatan = $_POST['ck'];
    $max = $_POST['max'];
    $note = $_POST['note'];
    for ($i = 0; $i < $max; $i++) {
        $alat[$i] = $_POST["alat$i"];
        if (!isset($_POST["kondisi$i"])) {
            $kondisi[$i] = 3;
        } else {
            $kondisi[$i] = $_POST["kondisi$i"];
        } 
        $merk[$i] = $_POST["merk$i"];
        $query = "INSERT INTO `awos` VALUES ('','$tanggal','$alat[$i]','$merk[$i]','$site','$kondisi[$i]','$nama','$catatan')";
        mysqli_query($connect, $query);
    }
    if ($note == "GAP1 Berhasil Diisi") {
        header("Location: awos.php?tgl=" . $tanggal);
    }
    echo $note;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Form Pemeliharaan AWOS</title>
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
    <form action="" method="post">
      <div class="form-group"><label for="ti">Nama :</label><input type="text" class="form-control" id="np" name="np"
          placeholder="Nama Petugas/Teknisi" value="<?php if($nama != ""){echo $nama;} ?>"></div>
      <div class="form-group"><label for="ti">Tanggal Pemeliharaan :</label><input type="text"
          class="form-control input-tanggal" id="tp" name="tp" placeholder="Tanggal Perawatan" value="<?php if($tanggal != ""){echo $tanggal;} ?>"></div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peralatan</th>
            <th scope="col">
              <select id="SelectionSite" name="SelectionSite" onchange="check(this)">
                <option selected="selected" value="">SITE</option>
                <option value="RWY10">SITE RWY10</option>
                <option value="RWY28">SITE RWY28</option>
                <option value="MIDDLE">SITE MIDDLE</option>
                <option value="GAP1">Gedung Angkasa Pura 1</option>
              </select>
            </th>
            <th scope="col">Kondisi</th>
            <th scope="col">Merk / SN</th>
          </tr>
        </thead>
        <tbody id="baris">

        </tbody>
      </table>
      <div class="form-group"><label for="ti">Catatan Khusus : </label><textarea class="form-control" id="ck" name="ck"
          placeholder="Catatan Khusus"><?php if($catatan != ""){echo $catatan;} ?></textarea></div>
      <input type="hidden" id="max" name="max" value="">
      <input type="hidden" id="note" name="note" value="">
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

    function check(el) {
      document.getElementById("baris").innerHTML = "";
      var namaperalatan = ["Data Logger", "Sensor Temperatur dan RH", "Sensor Tekanan Udara", "Sensor Angin",
        "Sensor Visibility", "Ceilometer", "Radio Komunikasi"
      ];
      if ($("#SelectionSite").val() == "RWY10") {
        var merk = ["COASTAL ENV. / ZENO 6800 / 1096", "ROTRONIC / HYGROCLIP2 / 20261107",
          "VAISALA / PTB330 / P2610316", "GILL INSTRUMENTS / WO-65 / 1826001", "BIRAL / VPF-730 / M11514-01",
          "CAMPBELL SCIENTIFIC / CS135 / E1150", "FLUIDMESH / VOLO / 1200232429"
        ];
        for (var i = 0; i < merk.length; i++) {
          $('#baris').append('<tr><th scope="row">' + (i + 1).valueOf() + '</th><td>' + namaperalatan[i] +
            '</td><input type="hidden" value="' + namaperalatan[i] + '" name="alat' + i +
            '"><td id="site[]"></td><td><input type="radio" class="mr-1" name="kondisi' + i +
            '" value="0"><label>Rusak Berat</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="1"><label>Rusak Ringan</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="2"><label>Baik</label></td><td id="merk[' + i +
            ']" class="merk" name="merk[]"></td><input type="hidden" id="merk' + i + '" name="merk' + i + '"></tr>')
        }
        for (var i = 0; i < merk.length; i++) {
          document.getElementById("merk" + i).value = merk[i];
          document.getElementById("merk[" + i + "]").innerHTML = merk[i];
        }
        document.getElementById("note").value = "RWY10 Berhasil Diisi";
      }
      if ($("#SelectionSite").val() == "RWY28") {
        var merk = ["COASTAL ENV. / ZENO 6800 / 1095", "ROTRONIC / HYGROCLIP2 / 20245972",
          "VAISALA / PTB330 / P2610314", "GILL INSTRUMENTS / WO-65 / 1826006", "BIRAL / VPF-710 / M11512-01",
          "CAMPBELL SCIENTIFIC / CS135 / E1155", "FLUIDMESH / VOLO / 1200231479"
        ];
        for (var i = 0; i < merk.length; i++) {
          $('#baris').append('<tr><th scope="row">' + (i + 1).valueOf() + '</th><td>' + namaperalatan[i] +
            '</td><input type="hidden" value="' + namaperalatan[i] + '" name="alat' + i +
            '"><td id="site[]"></td><td><input type="radio" class="mr-1" name="kondisi' + i +
            '" value="0"><label>Rusak Berat</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="1"><label>Rusak Ringan</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="2"><label>Baik</label></td><td id="merk[' + i +
            ']" class="merk" name="merk[]"></td><input type="hidden" id="merk' + i + '" name="merk' + i + '"></tr>')
        }
        for (var i = 0; i < merk.length; i++) {
          document.getElementById("merk" + i).value = merk[i];
          document.getElementById("merk[" + i + "]").innerHTML = merk[i];

        }
        document.getElementById("note").value = "RWY28 Berhasil Diisi";
      }
      if ($("#SelectionSite").val() == "MIDDLE") {
        var namaperalatan = [
          "Data Logger", "Sensor Temperatur dan RH", "Sensor Tekanan Udara", "Sensor Angin", "Sensor Curah Hujan",
          "Sensor Solar Radiation", "Lightning Detector", "Radio Komunikasi"
        ];
        var merk = ["COASTAL ENV. / ZENO 6800 / 1097", "ROTRONIC / HYGROCLIP2 / 20261119",
          "VAISALA / PTB330 / K2650008", "GILL INSTRUMENTS / WO-65 / 1826009",
          "TEXAS ELEC. / TR-522-M-01 / 76110-518", "KIPP&ZONEN / CMP11 / 185125", "COASTAL ENV. / 1220-153-161 / 151",
          "FLUIDMESH / VOLO / 1200231503"
        ];
        for (var i = 0; i < merk.length; i++) {
          $('#baris').append('<tr><th scope="row">' + (i + 1).valueOf() + '</th><td>' + namaperalatan[i] +
            '</td><input type="hidden" value="' + namaperalatan[i] + '" name="alat' + i +
            '"><td id="site[]"></td><td><input type="radio" class="mr-1" name="kondisi' + i +
            '" value="0"><label>Rusak Berat</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="1"><label>Rusak Ringan</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="2"><label>Baik</label></td><td id="merk[' + i +
            ']" class="merk" name="merk[]"></td><input type="hidden" id="merk' + i + '" name="merk' + i + '"></tr>')
        }
        for (var i = 0; i < merk.length; i++) {
          document.getElementById("merk" + i).value = merk[i];
          document.getElementById("merk[" + i + "]").innerHTML = merk[i];

        }
        document.getElementById("note").value = "MIDDLE Berhasil Diisi";
      }
      if ($("#SelectionSite").val() == "GAP1") {
        document.getElementById("ck").value = "";
        var namaperalatan = [
          "Server 1", "Server 2", "PC Client Observer", "PC Client Forecaster", "PC Client APP", "PC Client ATC"
        ];
        var merk = ["Dell / Poweredge R230", "Dell / Poweredge R230", "HP / Slimline PC 270", "HP / Slimline PC 270",
          "HP / Slimline PC 270", "HP / Slimline PC 270"
        ];
        for (var i = 0; i < merk.length; i++) {
          $('#baris').append('<tr><th scope="row">' + (i + 1).valueOf() + '</th><td>' + namaperalatan[i] +
            '</td><input type="hidden" value="' + namaperalatan[i] + '" name="alat' + i +
            '"><td id="site[]"></td><td><input type="radio" class="mr-1" name="kondisi' + i +
            '" value="0"><label>Rusak Berat</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="1"><label>Rusak Ringan</label><br><input name="kondisi' + i +
            '" class="mr-1" type="radio" value="2"><label>Baik</label></td><td id="merk[' + i +
            ']" class="merk" name="merk[]"></td><input type="hidden" id="merk' + i + '" name="merk' + i + '"></tr>')
        }
        for (var i = 0; i < merk.length; i++) {
          document.getElementById("merk" + i).value = merk[i];
          document.getElementById("merk[" + i + "]").innerHTML = merk[i];

        }
        document.getElementById("note").value = "GAP1 Berhasil Diisi";
      }
      document.getElementById("max").value = merk.length;
    }
  </script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.js"></script>
</body>

</html>