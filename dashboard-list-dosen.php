<?php
session_start();
require "dosen-fungsi.php";
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
// ambil data dari tabel dosen
$dosen = mysqli_query($conn, "SELECT * FROM dosen");


// tambah data
if (isset($_POST["submit"])) {

  // cek keberhasilan input data
  if (tambah($_POST) > 0) {
    echo "
<script>
  alert('DATA BERHASIL DITAMBAHKAN!');
  document.location.href = 'dashboard-list-dosen.php';
</script>
";
  } else {
    echo "
<script>
  alert('DATA GAGAL DITAMBAHKAN!');
  document.location.href = 'dashboard-list-dosen.php';
</script>";
  }
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {



  // cek keberhasilan ubah data
  if (ubah($_POST) > 0) {
    echo "
<script>
  alert('DATA BERHASIL DIUBAH!');
  document.location.href = 'dashboard-list-dosen.php';
</script>
";
  } else {
    echo "
<script>
  alert('DATA GAGAL DIUBAH!');
  document.location.href = 'dashboard-list-dosen.php';
</script>";
  }
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
      <h1 class="fs-6">Halaman Daftar Dosen</h1>

      <!-- card table -->
      <div class="card">
        <div class="card-body">
          <!-- Button Add modal -->
          <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#addData">
            Tambah Data
          </button>

          <!-- Add Modal -->
          <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="nip" class="form-label">NIP</label>
                      <input type="text" class="form-control" id="nip" name="nip_dosen" autocomplete="off">
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Dosen</label>
                      <input type="text" class="form-control" id="nama" name="nama_dosen" autocomplete="off">
                    </div>
                    <div class="mb-3">
                      <label for="telpon_dosen" class="form-label">Nomor Telpon</label>
                      <input type="text" class="form-control" id="telpon_dosen" name="telpon_dosen" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="col-12 btn btn-info text-white" name="submit">Tambah Data</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Add Modal End -->

          <hr>
          <table class="table table-bordered table-hover align-middle table-sm table-responsive">
            <thead class="table-secondary">
              <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">NIP</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Nomor Telpon</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($dosen as $row) : ?>
                <tr class="text-center">
                  <td><?= $i ?></td>
                  <td><?= $row["nip_dosen"] ?></td>
                  <td><?= $row["nama_dosen"] ?></td>
                  <td><?= $row["telpon_dosen"] ?></td>
                  <td class="py-3">
                    <!-- Button Edit modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row["id_dosen"] ?>">
                      Ubah
                    </button>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="edit<?= $row["id_dosen"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-start">
                            <form method="post">
                              <input type="hidden" class="form-control" id="id_dosen" name="id_dosen" value="<?= $row["id_dosen"] ?>" autocomplete="off">
                              <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip_dosen" value="<?= $row["nip_dosen"] ?>" autocomplete="off">
                              </div>

                              <div class="mb-3">
                                <label for="nama" class="form-label">Nama Dosen</label>
                                <input type="text" class="form-control" id="nama" name="nama_dosen" value="<?= $row["nama_dosen"] ?>">
                              </div>
                              <div class="mb-3">
                                <label for="telpon_dosen" class="form-label">Nomor Telpon</label>
                                <input type="text" class="form-control" id="telpon_dosen" name="telpon_dosen" autocomplete="off" value="<?= $row["telpon_dosen"] ?>">
                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="col-12 btn btn-warning text-white" name="ubah">Ubah Data</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Edit Modal End -->
                    <button class="btn btn-danger"><a class="text-decoration-none text-white" href="dosen-fungsi-hapus.php?id=<?= $row["id_dosen"] ?>" onclick="
                    return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a></button>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- card table end -->
    </main>
    <!-- main container end -->
    <!-- content end -->
  </div>



  <script src="assets/js/sidebar.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>