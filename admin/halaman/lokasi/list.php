<?php
$q = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$kategori'");
$d = mysqli_fetch_array($q);
?>

<h3><?= $d["nama"] ?> <a href="index.php?halaman=lokasi/tambah&kategori=<?= $d["id"] ?>" class="btn btn-success btn-sm">Tambah</a></h3>
<hr>
<?= isset($msg) ? "<div class=\"alert alert-success\">$msg</div>" : "" ?>
<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota/Kab</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $q1 = mysqli_query($conn, "SELECT lokasi.id, lokasi.nama, lokasi.alamat, kotakab.nama nama_kotakab
            FROM lokasi
            JOIN kotakab ON kotakab.id = lokasi.id_kotakab
            WHERE lokasi.id_kategori = '$kategori'
            ORDER BY id DESC
        ");
        while($d1 = mysqli_fetch_array($q1)) {
            echo "
                <tr>
                    <td>$no</td>
                    <td>$d1[nama]</td>
                    <td>$d1[alamat]</td>
                    <td>$d1[nama_kotakab]</td>
                    <td>
                        <a href=\"index.php?halaman=lokasi/edit&kategori=$kategori&id=$d1[id]\">Edit</a> |
                        <a href=\"index.php?halaman=lokasi/hapus&kategori=$kategori&id=$d1[id]\">Hapus</a>
                    </td>
                </tr>
            ";
            $no++;
        }
        ?>
    </tbody>
</table>
