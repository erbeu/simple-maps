<h3>Provinsi <a href="index.php?halaman=provinsi/tambah" class="btn btn-success btn-sm">Tambah</a></h3>
<hr>
<?= isset($msg) ? "<div class=\"alert alert-success\">$msg</div>" : "" ?>
<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $q = mysqli_query($conn, "SELECT * FROM provinsi ORDER BY id DESC");
        while($d = mysqli_fetch_array($q)) {
            echo "
                <tr>
                    <td>$no</td>
                    <td>$d[nama]</td>
                    <td>
                        <a href=\"index.php?halaman=provinsi/edit&id=$d[id]\">Edit</a> |
                        <a href=\"index.php?halaman=provinsi/hapus&id=$d[id]\">Hapus</a>
                    </td>
                </tr>
                ";
            $no++;
        }
        ?>
    </tbody>
</table>