<h3>Tambah Provinsi</h3>
<hr>
<?php
if(isset($_POST["submit"])) {
    $q = mysqli_query($conn, "INSERT INTO provinsi VALUES(
        null,
        '$_POST[nama]',
        '$_POST[lat]',
        '$_POST[lng]'
        )");
    echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
}
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="" class="form-control" required>
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
            <a href="index.php?halaman=provinsi/list" class="btn btn-default">Kembali</a>
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
    });
</script>