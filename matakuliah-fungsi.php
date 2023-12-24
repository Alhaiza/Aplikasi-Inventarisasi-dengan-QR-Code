<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }
$conn = mysqli_connect("localhost_name_here", "username_here", "password_here", "database_name_here");

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

    $kode = htmlspecialchars($data["kode_matakuliah"]);
    $nama = htmlspecialchars($data["nama_matakuliah"]);
    $sks = htmlspecialchars($data["sks_matakuliah"]);
    $id_dosen = htmlspecialchars($data["id_dosen"]);



    // query insert data
    $query = "INSERT INTO matakuliah
                VALUES
                ('', '$kode',  '$nama', '$sks', '$id_dosen')
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM matakuliah WHERE id_matakuliah = $id");

    return mysqli_affected_rows($conn);
}


function ubah()
{
    global $conn;

    if (isset($_POST['ubah'])) {
        $query = mysqli_query($conn, "UPDATE matakuliah SET
                        kode_matakuliah = '$_POST[kode_matakuliah]',
                        nama_matakuliah = '$_POST[nama_matakuliah]',
                        sks_matakuliah = '$_POST[sks_matakuliah]',
                        id_dosen = '$_POST[id_dosen]'
                    WHERE id_matakuliah = '$_POST[id_matakuliah]'
        ");

        if ($query) {
            echo "<script>
            alert('DATA BERHASIL DIUBAH!');
            document.location.href = 'dashboard-list-matakuliah.php';
        </script>";
        } else {
            echo "<script>
            alert('DATA GAGAL DIUBAH!');
            document.location.href = 'dashboard-list-matakuliah.php';
        </script>";
        }
    }
}
