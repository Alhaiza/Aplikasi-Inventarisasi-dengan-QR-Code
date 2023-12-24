
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

    $nip = htmlspecialchars($data["nip_dosen"]);
    $nama = htmlspecialchars($data["nama_dosen"]);
    $telpon = htmlspecialchars($data["telpon_dosen"]);



    // query insert data
    $query = "INSERT INTO dosen (nip_dosen, nama_dosen, telpon_dosen)
                VALUES
                ('$nip', '$nama', '$telpon')
    
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM dosen WHERE id_dosen = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data)
{
    global $conn;

    if (isset($_POST['ubah'])) {
        $query = mysqli_query($conn, "UPDATE dosen SET
                        nip_dosen = '$_POST[nip_dosen]',
                        nama_dosen = '$_POST[nama_dosen]',
                        telpon_dosen = '$_POST[telpon_dosen]'
                    WHERE id_dosen = '$_POST[id_dosen]'
        ");

        if ($query) {
            echo "<script>
            alert('DATA BERHASIL DIUBAH!');
            document.location.href = 'dashboard-list-dosen.php';
        </script>";
        } else {
            echo "<script>
            alert('DATA GAGAL DIUBAH!');
            document.location.href = 'dashboard-list-dosen.php';
        </script>";
        }
    }
}
