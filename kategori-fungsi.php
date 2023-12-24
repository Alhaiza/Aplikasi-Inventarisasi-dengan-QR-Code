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

    $nama = htmlspecialchars($data["nama_kategori"]);


    // query insert data
    $query = "INSERT INTO kategori
                VALUES
                ('', '$nama')
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");

    return mysqli_affected_rows($conn);
}


function ubah()
{
    global $conn;

    if (isset($_POST['ubah'])) {
        $query = mysqli_query($conn, "UPDATE kategori SET
                        
                        nama_kategori = '$_POST[nama_kategori]'
                    WHERE id_kategori = '$_POST[id_kategori]'
        ");

        if ($query) {
            echo "<script>
            alert('DATA BERHASIL DIUBAH!');
            document.location.href = 'dashboard-list-kategori.php';
        </script>";
        } else {
            echo "<script>
            alert('DATA GAGAL DIUBAH!');
            document.location.href = 'dashboard-list-kategori.php';
        </script>";
        }
    }
}
