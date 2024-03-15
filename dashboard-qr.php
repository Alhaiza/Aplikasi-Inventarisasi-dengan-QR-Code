<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
include "phpqrcode/qrlib.php";
require "qr-fungsi.php";
// ambil data dari tabel dosen
$conn = mysqli_connect("localhost", "root", "root", "project_college_inventory");
$barang = mysqli_query($conn, "SELECT * FROM barang INNER JOIN Kategori ON Barang.id_kategori = Kategori.id_kategori
INNER JOIN MataKuliah ON Barang.id_matakuliah = MataKuliah.id_matakuliah");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="shortcut icon" href="assets/img/page-logo/if-logo.png" type="image/x-icon" />
  <title>QR Code</title>
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
      <a href="qr-cetak.php" class="btn btn-success" target="_blank">Cetak</a>
      <?php $i = 1; ?>

      <?php foreach ($barang as $row) : ?>
        <div class="card shadow-sm my-2">
          <div class="card-body">
            <div class="row align-items-center text-center">
              <div class="col"><?= $i ?></div>
              <div class="col"><?= $row['nama_barang'] ?></div>
              <div class="col">
                <?php
                $id = $row["id_barang"];
                $viewUrl = "qr-hasil.php?id_barang=$id";
                $qrCodeImagePath = 'assets/img/qr/qrcode_' . $id . '.png';
                QRcode::png($viewUrl, $qrCodeImagePath);
                echo '<img src="' . $qrCodeImagePath . '" alt="QR Code">';
                ?>
                <!-- <a href="qr-hasil.php?id_barang=<?= $id ?>" target="_blank">
                  <?= $id; ?>
                </a> -->
              </div>
            </div>
          </div>
        </div>
        <?php $i++; ?>
      <?php endforeach; ?>
    </main>
  </div>

  <script src="assets/js/sidebar.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>