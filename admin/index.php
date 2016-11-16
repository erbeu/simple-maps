<?php
session_start();
require_once("../config.php");
require_once("../fungsi.php");

if(!isset($_SESSION["id_admin"])) {
    require_once("halaman/login.php");
} else {
    $halaman = isset($_GET["halaman"]) ? $_GET["halaman"] : "beranda";
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    $kategori = isset($_GET["kategori"]) ? $_GET["kategori"] : null;
    $msg = isset($_GET["msg"]) ? $_GET["msg"] : null;
    $layout = isset($_GET["layout"]) ? $_GET["layout"] : "default";

    if($halaman == "logout") {
        session_destroy();
        header("location:index.php");
    }

    $file_halaman = file_exists("halaman/".$halaman.".php") ? $halaman : '404';
    $file_layout = file_exists("layout/".$layout.".php") ? $layout : 'default';
    require("layout/".$file_layout.".php");
}