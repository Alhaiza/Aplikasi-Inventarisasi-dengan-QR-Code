<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }
$conn = mysqli_connect("localhost", "root", "root", "project_college_inventory");

// Function Query Database ke web
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}



function tambah($data)
{
    // ambil data dari tiap data dalam form
    global $conn;
    $nama = htmlspecialchars($data["nama_barang"]);
    $id_kategori = htmlspecialchars($data["id_kategori"]);
    $jumlah = htmlspecialchars($data["jumlah_barang"]);
    $id_matakuliah = htmlspecialchars($data["id_matakuliah"]);



    // query insert data
    $query = "INSERT INTO barang (nama_barang, id_kategori, jumlah_barang, id_matakuliah)
                VALUES
                ('$nama','$id_kategori','$jumlah','$id_matakuliah')
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");

    return mysqli_affected_rows($conn);
}


function ubah()
{
    global $conn;

    if (isset($_POST['ubah'])) {


        $query = mysqli_query($conn, "UPDATE barang SET
        nama_barang = '$_POST[nama_barang]',
        id_kategori = '$_POST[id_kategori]',
        jumlah_barang = '$_POST[jumlah_barang]',
        id_matakuliah = '$_POST[id_matakuliah]'
    WHERE id_barang = '$_POST[id_barang]'
");



        if ($query) {

            echo "
        <script>
            alert('DATA BERHASIL DIUBAH!');
            document.location.href = 'dashboard-list-inventaris.php';
        </script>";
        } else {
            echo "
        <script>
            alert('DATA GAGAL DIUBAH!');
            document.location.href = 'dashboard-list-inventaris.php';
        </script>";
        }
    }
}
