<h3>Edit Kota/Kab</h3>
<hr>
<?php
if(isset($_POST["submit"])) {
    $q = mysqli_query($conn, "UPDATE kotakab SET
        nama = '$_POST[nama]',
        lat = '$_POST[lat]',
        lng = '$_POST[lng]',
        id_provinsi = '$_POST[id_provinsi]'
        WHERE id = '$id'");
    echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
}

$q = mysqli_query($conn, "SELECT * FROM kotakab WHERE id = $id");
$d = mysqli_fetch_array($q);
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Provinsi</label>
                <select name="id_provinsi" class="form-control" required>
                    <option value=""></option>
                    <?php
                    $q1 = mysqli_query($conn, "SELECT * FROM provinsi");
                    while($d1 = mysqli_fetch_array($q1)) {
                        $select = $d1["id"] == $d["id_provinsi"] ? "selected" : "";
                        echo "<option value=\"$d1[id]\" $select>$d1[nama]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="<?php echo $d["nama"]; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Latitude</label>
                <input type="text" name="lat" value="<?php echo $d["lat"]; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Logitude</label>
                <input type="text" name="lng" value="<?php echo $d["lng"]; ?>" class="form-control" required>
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=kotakab/list" class="btn btn-default">Kembali</a>
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
            zoom: 10,
            <?php echo "center: new google.maps.LatLng($d[lat], $d[lng]),"; ?>
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        <?php echo "var latLng = new google.maps.LatLng($d[lat], $d[lng]);"; ?>

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