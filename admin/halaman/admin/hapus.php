<?php
$q = mysqli_query($conn, "DELETE FROM admin WHERE id = '$id'");
header("location:index.php?halaman=admin/list&msg=Data Berhasil Dihapus");