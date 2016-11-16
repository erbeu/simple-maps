<?php
$qkategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$kategori'");
$dkategori = mysqli_fetch_array($qkategori);
?>

<h3>Edit <?= $dkategori["nama"] ?></h3>
<hr>
<?php
if (isset($_POST["submit"])) {
    if (!empty($_FILES["foto"]["name"])) {
        $uploadOk = 1;
        $target_dir = "../assets/img/lokasi/";
        $imageFileType = pathinfo(basename($_FILES["foto"]["name"]), PATHINFO_EXTENSION);
        $filename = $d["id"]." - ".$_POST["nama"].rand(0,999).".".$imageFileType;
        $target_file = $target_dir . $filename;
        $check = getimagesize($_FILES["foto"]["tmp_name"]);

        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Invalid Image";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<div class=\"alert alert-success\">$error</div>";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $qupdate = mysqli_query($conn, "UPDATE lokasi SET
                    nama = '$_POST[nama]',
                    alamat = '$_POST[alamat]',
                    foto = '$filename',
                    lat = '$_POST[lat]',
                    lng = '$_POST[lng]',
                    id_kotakab = '$_POST[id_kotakab]'
                    WHERE id = '$id'
                ");
                echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
            } else {
                echo "<div class=\"alert alert-success\">Gagal Upload</div>";
            }
        }
    } else {
        $qupdate = mysqli_query($conn, "UPDATE lokasi SET
            nama = '$_POST[nama]',
            alamat = '$_POST[alamat]',
            lat = '$_POST[lat]',
            lng = '$_POST[lng]',
            id_kotakab = '$_POST[id_kotakab]'
            WHERE id = '$id'
        ");
        echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
    }
}

$qlokasi = mysqli_query($conn, "SELECT * FROM lokasi WHERE id = '$id'");
$dlokasi = mysqli_fetch_array($qlokasi);
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Kota/Kab</label>
                <select name="id_kotakab" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $qkotakab = mysqli_query($conn, "SELECT * FROM kotakab");
                    while($dkotakab = mysqli_fetch_array($qkotakab)) {
                        $select = $dkotakab["id"] == $dlokasi["id_kotakab"] ? "selected" : "";
                        echo "<option value=\"$dkotakab[id]\" $select>$dkotakab[nama]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="<?= $dlokasi["nama"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" cols="30" rows="10" class="form-control" required><?= $dlokasi["alamat"] ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Foto</label>
                <img src="../assets/img/lokasi/<?= $dlokasi["foto"] ?>" class="img-thumbnail" width="100%"><br><br>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Latitude</label>
                <input type="text" name="lat" value="<?= $dlokasi["lat"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Logitude</label>
                <input type="text" name="lng" value="<?= $dlokasi["lng"] ?>" class="form-control" required>
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=lokasi/list&kategori=<?= $kategori ?>" class="btn btn-default">Kembali</a>
        </form>
    </div>
    <div class="col-md-9">
        <div id="map" style="width:100%; height:500px"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        
        function updateMarkerPosition(latLng) {
            $("input[name=lat]").val(latLng.lat());
            $("input[name=lng]").val(latLng.lng());
        }

        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: new google.maps.LatLng(<?= $dlokasi["lat"] ?>, <?= $dlokasi["lng"] ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var latLng = new google.maps.LatLng(<?= $dlokasi["lat"] ?>, <?= $dlokasi["lng"] ?>);

        var marker = new google.maps.Marker({
            position : latLng,
            title : "lokasi",
            map : map,
            draggable : true
        });
        
        updateMarkerPosition(latLng);
        google.maps.event.addListener(marker, "drag", function() {
            updateMarkerPosition(marker.getPosition());
        });
    });
</script>