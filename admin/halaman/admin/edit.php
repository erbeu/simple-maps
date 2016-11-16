<h3>Edit Admin</h3>
<hr>
<?php
if(isset($_POST["submit"])) {
    if($_POST["password"] != "") {
        $q = mysqli_query($conn, "UPDATE admin SET
            nama = '$_POST[nama]',
            username = '$_POST[username]',
            password = '$_POST[password]'
            WHERE id = '$id'
        ");
    } else {
        $q = mysqli_query($conn, "UPDATE admin SET
            nama = '$_POST[nama]',
            username = '$_POST[username]'
            WHERE id = '$id'
        ");
    }
    echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
}

$q = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
$d = mysqli_fetch_array($q);
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="<?= $d["nama"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" value="<?= $d["username"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" value="" class="form-control">
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=admin/list" class="btn btn-default">Kembali</a>
        </form>
    </div>
    <div class="col-md-9">
    </div>
</div>