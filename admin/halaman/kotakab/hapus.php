<?php
$q = mysqli_query($conn, "DELETE FROM kotakab WHERE id = '$id'");
header("location:index.php?halaman=kotakab/list&msg=Data Berhasil Dihapus");