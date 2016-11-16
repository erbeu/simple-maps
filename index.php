<?php
session_start();
require_once("config.php");
require_once("fungsi.php");

$halaman = isset($_GET["halaman"]) ? $_GET["halaman"] : "beranda";
$id = isset($_GET["id"]) ? $_GET["id"] : null;
$msg = isset($_GET["msg"]) ? $_GET["msg"] : null;
$layout = isset($_GET["layout"]) ? $_GET["layout"] : "default";

if($halaman == "logout") {
    session_destroy();
    header("location:index.php");
}

$file_halaman = file_exists("halaman/".$halaman.".php") ? $halaman : '404';
$file_layout = file_exists("layout/".$layout.".php") ? $layout : 'default';
require("layout/".$file_layout.".php");
