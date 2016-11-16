<h3 class="text-center">Selamat Datang</h3>
<hr>
<div class="row">
    <?php
    $q = mysqli_query($conn, "SELECT * FROM kategori");
    while($d = mysqli_fetch_array($q)) {
        echo "
        <div class=\"col-md-3 text-center\">
            <div class=\"panel panel-default\">
                <div class=\"panel-heading\">
                    <h3 class=\"panel-title\">$d[nama]</h3>
                </div>
                <div class=\"panel-body\">
                    <img src=\"../assets/img/kategori/$d[icon]\">
                    <hr>
                    <a href=\"index.php?halaman=lokasi/list&kategori=$d[id]\" class=\"btn btn-primary btn-block\">Lihat $d[nama]</a>
                </div>
            </div>
        </div>
        ";
    }
    ?>
</div>