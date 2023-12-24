<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }
require "inventaris-fungsi.php";

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
            <script>
                alert('DATA BERHASIL DIHAPUS!');
                document.location.href = 'dashboard-list-inventaris.php';
            </script>
        ";
} else {
    echo "
            <script>
                alert('DATA GAGAL DIHAPUS!');
                document.location.href = 'dashboard-list-inventaris.php';
            </script>
        ";
}
