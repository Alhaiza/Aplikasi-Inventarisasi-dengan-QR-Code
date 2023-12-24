<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" href="assets/img/page-logo/if-logo.png" type="image/x-icon" />
    <title>Admin Dashboard</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar main-color-bg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/dashboard-logo/if-logo-and-text-edit-text.png" alt="Bootstrap" width="300" /></a>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- main container -->
    <div class="main-container">
        <!-- sidebar -->
        <aside class="sidebar" id="sidebar">
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="dashboard-list-dosen.php">Daftar Dosen</a></li>
                <li>
                    <a href="dashboard-list-matakuliah.php">Daftar Mata Kuliah</a>
                </li>
                <li><a href="dashboard-list-kategori.php">Daftar Kategori</a></li>
                <li>
                    <a href="dashboard-list-inventaris.php">Daftar Inventaris</a>
                </li>
                <li><a href="dashboard-qr.php">QR Code</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <!-- sidebar end -->

        <!-- content -->
        <main class="content vh-100 bg-body-tertiary p-5 mt-5">
            <h1 class="fs-6">Halaman Beranda</h1>
            <!-- card title -->
            <div class="card">
                <div class="card-body">
                    <h1>Selamat Datang, Admin!</h1>
                    <hr />
                    <h6>
                        Selamat datang di Halaman Aplikasi Inventarisasi Lab Komputer dan
                        Pemgrograman Informatika Universitas Tanjungpura
                    </h6>
                </div>
            </div>
            <!-- card title end -->
        </main>
        <!-- content end -->
    </div>
    <!-- main container end -->

    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>