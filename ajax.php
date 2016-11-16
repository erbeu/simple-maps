<?php
require_once("config.php");

if(!empty($_GET["provinsi"])) {
    $q = mysqli_query($conn, "SELECT * FROM kotakab WHERE id_provinsi = '$_GET[provinsi]'");
    while($d = mysqli_fetch_array($q)) {
        $list[] = [
            $d["id"],
            $d["nama"],
            $d["lat"],
            $d["lng"]
        ];
    }
    echo json_encode($list);
}

if(!empty($_GET["id_kotakab"])) {
    $q = mysqli_query($conn, "SELECT * FROM kotakab WHERE id = '$_GET[id_kotakab]'");
    $d = mysqli_fetch_assoc($q);
    echo json_encode($d);
}

if(!empty($_GET["lokasi"])) {
    $q = mysqli_query($conn, "SELECT *, lokasi.id as id_lokasi, lokasi.nama as nama_lokasi, kategori.nama as nama_kategori FROM lokasi
        JOIN kategori ON kategori.id = lokasi.id_kategori
        WHERE
        lokasi.id = '$_GET[lokasi]'
    ");
    $d = mysqli_fetch_array($q);

    echo "
        <div id=\"content\" class=\"text-center\" style=\"max-width: 200px; word-wrap:break-word;\">
            <img src=\"assets/img/lokasi/$d[foto]\" width=\"100%\">
            <h4 id=\"firstHeading\" class=\"firstHeading\">$d[nama_lokasi]</h4>
            <div id=\"bodyContent\" class=\"text-left\">
                <p>Kategori : $d[nama_kategori]</p>
                <p>$d[alamat]</p>
            </div>
        </div>
    ";
}