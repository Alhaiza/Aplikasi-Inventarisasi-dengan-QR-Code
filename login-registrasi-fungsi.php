<?php
// session_start();
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
//     exit;
// }
$conn = mysqli_connect("localhost", "root", "root", "project_college_inventory");
function register($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $full_name = mysqli_real_escape_string($conn, $data["full_name"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $passwordConfirm = mysqli_real_escape_string($conn, $data["confirmPassword"]);

    // cek username
    $checkUsername = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($checkUsername)) {
        echo
        "<script>
    alert('Username sudah ada!');
</script>
";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $passwordConfirm) {
        echo
        "<script>
    alert('Masukan Password dan Konfirmasi Password yang serupa!');
</script>
";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users (username, full_name, password)
VALUES
('$username', '$full_name', '$password')
");
    return mysqli_affected_rows($conn);
    header("Location: login.php");
}
