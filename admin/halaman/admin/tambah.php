<h3>Tambah Admin</h3>
<hr>
<?php
if(isset($_POST["submit"])) {
    $q = mysqli_query($conn, "INSERT INTO admin VALUES(
        null,
        '$_POST[nama]',
        '$_POST[username]',
        MD5('$_POST[password]')
        )");
    echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
}
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" value="" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" value="" class="form-control" required>
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=admin/list" class="btn btn-default">Kembali</a>
        </form>
    </div>
    <div class="col-md-9">
    </div>
</div>