<?php
require "qr-fungsi.php";
$id_barang = $_GET['id_barang'];
$barang = mysqli_query($conn, "SELECT * FROM barang   INNER JOIN Kategori ON Barang.id_kategori = Kategori.id_kategori
INNER JOIN MataKuliah ON Barang.id_matakuliah = MataKuliah.id_matakuliah WHERE id_barang= '$id_barang' ");
$b = mysqli_fetch_array($barang);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/img/page-logo/if-logo.png" type="image/x-icon" />
    <title>Lab Komputer dan Pemrograman Universitas Tanjungpura</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/navbar-logo/if-logo-and-text.png" alt="Bootstrap" width="300" />
            </a>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- qr result -->
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-header main-color-bg">
                            <h1 class="text-white fs-5 text-center p-2 align-items-center">
                                Data Barang
                            </h1>
                        </div>
                        <div class="card-body">
                            <p class="text-center">
                                <span class="text-center fw-bold">Kepemilikan Lab Informatika</span>
                                <br>
                                <span>Nama Barang</span> : <?= $b["nama_barang"] ?>
                                <br>
                                Jenis : <?= $b["nama_kategori"] ?>
                                <br>
                                Jumlah Barang : <?= $b["jumlah_barang"] ?>
                                <br>
                                Matakuliah : <?= $b["nama_matakuliah"] ?>
                                <br>
                                <span>Gedung : Informatika</span>
                                <br>
                                <span>Ruang : - </span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- qr result end -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>