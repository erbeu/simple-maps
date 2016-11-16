<?php
$q = mysqli_query($conn, "DELETE FROM provinsi WHERE id = '$id'");
header("location:index.php?halaman=provinsi/list&msg=Data Berhasil Dihapus");