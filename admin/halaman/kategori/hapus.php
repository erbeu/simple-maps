<?php
$q = mysqli_query($conn, "DELETE FROM kategori WHERE id = '$id'");
header("location:index.php?halaman=kategori/list&msg=Data Berhasil Dihapus");