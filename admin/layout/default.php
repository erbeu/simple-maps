<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aplikasi GIS</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/DataTables/datatables.min.css">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/DataTables/datatables.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=INSERT_KEY"></script>
    <script>
        $(document).ready(function() {
            $(".datatable").DataTable();
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Aplikasi GIS</h1>
        </div>
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Wilayah <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?halaman=provinsi/list">Provinsi</a></li>
                            <li><a href="index.php?halaman=kotakab/list">Kota/Kab</a></li>
                        </ul>
                    </li>
                    <li><a href="index.php?halaman=kategori/list">Kategori</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Lokasi <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            $q = mysqli_query($conn, "SELECT * FROM kategori");
                            while($d = mysqli_fetch_array($q)) {
                                echo "<li><a href=\"index.php?halaman=lokasi/list&kategori=$d[id]\">$d[nama]</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <li><a href="index.php?halaman=admin/list">Admin</a></li>
                    <li><a href="index.php?halaman=logout">Logout</a></li>
                </ul>
            </div>
        </nav>
        
        <div class="panel panel-default">
            <div class="panel-body">
                <?php require_once("halaman/".$file_halaman.".php"); ?>
            </div>
        </div>
    </div>
</body>

</html>