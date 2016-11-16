<?php
$q = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$kategori'");
$d = mysqli_fetch_array($q);
?>

<h3>Tambah <?= $d["nama"] ?></h3>
<hr>
<?php
if (isset($_POST["submit"])) {
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
            $q1 = mysqli_query($conn, "INSERT INTO lokasi VALUES(
                null,
                '$kategori',
                '$_POST[nama]',
                '$_POST[alamat]',
                '$filename',
                '$_POST[lat]',
                '$_POST[lng]',
                '$_POST[id_kotakab]'
            )");
            echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
        } else {
            echo "<div class=\"alert alert-success\">Gagal Upload</div>";
        }
    }
}
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Kota/Kab</label>
                <select name="id_kotakab" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $q1 = mysqli_query($conn, "SELECT * FROM kotakab");
                    while($d1 = mysqli_fetch_array($q1)) {
                        echo "<option value=\"$d1[id]\">$d1[nama]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="">Foto</label>
                <input type="file" name="foto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Latitude</label>
                <input type="text" name="lat" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Logitude</label>
                <input type="text" name="lng" value="" class="form-control" required>
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=lokasi/list&kategori=<?= $d["id"] ?>" class="btn btn-default">Kembali</a>
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
            zoom: 5,
            center: new google.maps.LatLng(-0.789275, 113.921327),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var latLng = new google.maps.LatLng(-0.789275, 113.921327);

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
        
        $("select[name=id_kotakab]").on("change", function() {
            if (this.value != "") {
                $.ajax({
                    url: "../ajax.php",
                    method : "get",
                    data: "id_kotakab="+this.value,
                    success: function (data) {
                        data = jQuery.parseJSON(data);
                        latLng = new google.maps.LatLng(data.lat, data.lng);
                        marker.setPosition(latLng);
                        map.setCenter(latLng);
                        updateMarkerPosition(marker.getPosition());
                        map.setZoom(13);
                    }
                });
            }
        });
    });
</script>