<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="" method="get">
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi" id="provinsi" class="form-control" required>
                            <option value="">Pilih Provinsi</option>
                            <?php
                            $q = mysqli_query($conn, "SELECT * FROM provinsi");
                            while($d = mysqli_fetch_array($q)) {
                                $select = isset($_GET['provinsi']) && $_GET['provinsi'] == $d['id'] ? 'selected' : '';
                                echo "<option value=\"$d[id]\" $select>$d[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kotakab">Kota/Kab</label>
                        <select name="kotakab" id="kotakab" class="form-control" required>
                            <?php
                            if(isset($_GET['kotakab'])) {
                                $q = mysqli_query($conn, "SELECT * FROM kotakab WHERE id_provinsi = '$_GET[provinsi]'");
                                while($d = mysqli_fetch_array($q)) {
                                    $select = $_GET['kotakab'] == $d['id'] ? 'selected' : '';
                                    echo "<option value=\"$d[id]\" $select>$d[nama]</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    $i = 0;
                    $q = mysqli_query($conn, "SELECT * FROM kategori");
                    while($d = mysqli_fetch_array($q)) {
                        $check = isset($_GET['kategori'][$i]) && $_GET['kategori'][$i] == $d["id"] ? 'checked' : '';
                        echo "
                            <div class=\"checkbox\">
                                <label>
                                    <input type=\"checkbox\" name=\"kategori[$i]\" value=\"$d[id]\" $check> $d[nama]
                                </label>
                            </div>
                        ";
                        $i++;
                    }
                    ?>
                    <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                    <a href="index.php" class="btn btn-default">Reset</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Peta</h3>
            </div>
            <div class="panel-body">
                <div id="map" style="width:100%; height:500px"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function ambil_kotakab(provinsi) {
            $.ajax({
                url : "ajax.php",
                method : "get",
                data : "provinsi=" + provinsi,
                success : function(data) {
                    var kotakab = jQuery.parseJSON(data);
                    var element = "<option value=\"\">Pilih Kota/Kab</option>";

                    for(var i = 0; i < kotakab.length; i++) {
                        element = element+"<option value=\""+kotakab[i][0]+"\">"+kotakab[i][1]+"</option>";
                    }
                    $("#kotakab").append(element).attr("disabled", false);
                }
            });
        }
        
        if($("#provinsi").val() != "") {
            $("#kotakab").attr("disabled", false);
        } else {
            $("#kotakab").attr("disabled", true);
        }
        
        $("#provinsi").on("change", function() {
            var provinsi = $("#provinsi").val();
            $("#kotakab").find("option").remove().end()
            
            if(provinsi != "") {
                ambil_kotakab(provinsi);
            } else {
                $("#kotakab").attr("disabled", true);
            }
        });
        
        <?php if(isset($_GET["submit"])) { ?>
        
            var map;
            var options = {
                zoom: 12,
                <?php
                $q = mysqli_query($conn, "SELECT * FROM kotakab WHERE id = $_GET[kotakab]");
                $d = mysqli_fetch_array($q);
                echo "center: new google.maps.LatLng($d[lat], $d[lng]),";
                ?>
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("map"), options);
        
            var locations = [
                <?php
                foreach($_GET["kategori"] as $key => $data) {
                    $q = mysqli_query($conn, "SELECT *, lokasi.id as id_lokasi, lokasi.nama as nama_lokasi, kategori.nama as nama_kategori FROM lokasi
                        JOIN kategori ON kategori.id = lokasi.id_kategori
                        WHERE
                        id_kategori = '".$_GET["kategori"][$key]."' AND
                        id_kotakab = '$_GET[kotakab]'
                    ");
                    if(mysqli_num_rows($q) != "") {
                        while($d = mysqli_fetch_array($q)) {
                            echo "[$d[id_lokasi], $d[id_kategori], '$d[nama_lokasi]', '$d[icon]', $d[lat], $d[lng]],";
                        }
                    }
                }
                ?>
            ];

            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            var tabel;
            var id;
            var iw;
            for (i = 0; i < locations.length; i++) {
                var myicon = "assets/img/kategori/"+locations[i][3];
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][4], locations[i][5]),
                    map: map,
                    icon: myicon
                });

                google.maps.event.addListener(marker, "click", (function (marker, i) {
                    return function () {
                        lokasi = locations[i][0];
                        $.ajax({
                            url: "ajax.php",
                            method : "get",
                            data: "lokasi="+lokasi,
                            success: function (data) {
                                iw = data;

                                infowindow.setContent(iw);
                                infowindow.setOptions({maxWidth: 200});
                                infowindow.open(map, marker);
                            }
                        });
                        lokasi = null;
                    }
                })(marker, i));
            }
        <?php } ?>
    });
</script>