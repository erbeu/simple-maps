<h3>Edit Kategori</h3>
<hr>
<?php
if(isset($_POST["submit"])) {
    if($_FILES["icon"]["tmp_name"] != '') {
        $uploadOk = 1;
        $target_dir = "../assets/img/kategori/";
        $imageFileType = pathinfo(basename($_FILES["icon"]["name"]), PATHINFO_EXTENSION);
        $filename = $_POST["nama"] . rand(0,999) . "." . $imageFileType;
        $target_file = $target_dir . $filename;
        $check = getimagesize($_FILES["icon"]["tmp_name"]);

        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error = "Invalid Image";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "<div class=\"alert alert-success\">$error</div>";
        } else {
            if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
                $q = mysqli_query($conn, "UPDATE kategori SET
                    nama = '$_POST[nama]',
                    icon = '$filename'
                    WHERE id = '$id'
                ");
                echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
            } else {
                echo "<div class=\"alert alert-success\">Gagal Upload</div>";
            }
        }
    } else {
        $q = mysqli_query($conn, "UPDATE kategori SET nama = '$_POST[nama]' WHERE id = '$id'");
        echo "<div class=\"alert alert-success\">Data Berhasil Disimpan</div>";
    }
}

$q = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$id'");
$d = mysqli_fetch_array($q);
?>
<div class="row">
    <div class="col-md-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" value="<?= $d["nama"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Icon</label>
                <input type="file" name="icon" class="form-control">
                <p class="help-block">
                    Kosongkan jika tidak ingin mengganti icon.<br>
                    Icon lama : <img src="../assets/img/kategori/<?= $d["icon"] ?>" class="img-thumbnail">
                </p>
            </div>
            <button type="submit" name="submit" value="1" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=kategori/list" class="btn btn-default">Kembali</a>
        </form>
    </div>
    <div class="col-md-9">
    </div>
</div>