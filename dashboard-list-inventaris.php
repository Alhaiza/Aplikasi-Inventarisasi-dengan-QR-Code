<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "inventaris-fungsi.php";
// ambil data dari tabel dosen
$barang = mysqli_query($conn, "SELECT * FROM barang INNER JOIN Kategori ON Barang.id_kategori = Kategori.id_kategori
INNER JOIN MataKuliah ON Barang.id_matakuliah = MataKuliah.id_matakuliah");

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$matakuliah = mysqli_query($conn, "SELECT * FROM matakuliah");

// tambah data
if (isset($_POST["submit"])) {
  // cek keberhasilan input data
  if (tambah($_POST) > 0) {
    echo "
<script>
  alert('DATA BERHASIL DITAMBAHKAN!');
  document.location.href = 'dashboard-list-inventaris.php';
</script>
";
  } else {
    echo "
<script>
  alert('DATA GAGAL DITAMBAHKAN!');
  document.location.href = 'dashboard-list-inventaris.php';
</script>";
  }
}

// cek apakah tombol ubah sudah ditekan atau belum
if (isset($_POST["ubah"])) {
  // cek keberhasilan ubah data
  if (ubah($_POST) > 0) {
    echo "
<script>
  alert('DATA BERHASIL DIUBAH!');
  document.location.href = 'dashboard-list-inventaris.php';
</script>
";
  } else {
    echo "
<script>
  alert('DATA GAGAL DIUBAH!');
  document.location.href = 'dashboard-list-inventaris.php';
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
  <title>List Inventaris</title>
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
      <h1 class="fs-6">Halaman Daftar Inventarisasi</h1>

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
                      <label for="nama_barang" class="form-label">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" name="nama_barang" autocomplete="off">
                    </div>
                    <div class="mb-3">
                      <label for="id_kategori" class="form-label">Kategori Barang</label>
                      <select name="id_kategori" class=" form-select" aria-label="Default select example" id="kategori_barang">
                        <?php foreach ($kategori as $k) : ?>
                          <option value=" <?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                      <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" autocomplete="off">
                    </div>
                    <div class="mb-3">
                      <label for="id_matakuliah" class="form-label">Matakuliah</label>
                      <select name="id_matakuliah" class=" form-select" aria-label="Default select example" id="kategori_barang">
                        <?php foreach ($matakuliah as $m) : ?>
                          <option value=" <?= $m['id_matakuliah'] ?>"><?= $m['nama_matakuliah'] ?></option>
                        <?php endforeach ?>
                      </select>
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
                <th scope="col">Nama Barang</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($barang as $row) : ?>
                <tr class="text-center">
                  <td><?= $i ?></td>
                  <td><?= $row["nama_barang"] ?></td>
                  <td><?= $row["nama_kategori"] ?></td>
                  <td><?= $row["jumlah_barang"] ?></td>
                  <td><?= $row["nama_matakuliah"] ?></td>
                  <td class="py-3">
                    <!-- Button Edit modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row["id_barang"] ?>">
                      Ubah
                    </button>
                    <!-- edit Modal -->
                    <div class="modal fade" id="edit<?= $row["id_barang"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-start">
                            <form method="post">
                              <input type="hidden" id="id_barang" name="id_barang" value="<?= $row["id_barang"] ?>" autocomplete="off">
                              <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $row["nama_barang"] ?>" autocomplete="off">
                              </div>

                              <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori</label>
                                <select name="id_kategori" class=" form-select" aria-label="Default select example" id="kategori_barang">
                                  <?php foreach ($kategori as $k) : ?>
                                    <!-- <option selected disabled value="<?= $row["id_kategori"] ?>"><?= $row["nama_kategori"] ?></option> -->
                                    <option value=" <?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>
                              <!-- <div class="mb-3">
                                <label for="id_kategori" class="form-label">Kategori</label>
                                <input type="number" class="form-control" id="id_kategori" name="id_kategori" value="<?= $row["id_kategori"] ?>">
                              </div> -->
                              <div class="mb-3">
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?= $row["jumlah_barang"] ?>" autocomplete="off">
                              </div>


                              <div class="mb-3">
                                <label for="id_matakuliah" class="form-label">Matakuliah</label>
                                <select name="id_matakuliah" class=" form-select" aria-label="Default select example" id="kategori_barang">
                                  <?php foreach ($matakuliah as $m) : ?>
                                    <option value=" <?= $m['id_matakuliah'] ?>"><?= $m['nama_matakuliah'] ?></option>
                                  <?php endforeach ?>
                                </select>
                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="col-12 btn btn-warning text-white" name="ubah">Ubah Data</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
        </div>
        <!-- Add Modal End -->
        <button class="btn btn-danger"><a class="text-decoration-none text-white" href="inventaris-fungsi-hapus.php?id=<?= $row["id_barang"] ?>" onclick="
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