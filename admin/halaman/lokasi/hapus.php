<?php
$q = mysqli_query($conn, "DELETE FROM lokasi WHERE id = '$id'");
header("location:index.php?halaman=lokasi/list&kategori=$kategori&msg=Data Berhasil Dihapus");