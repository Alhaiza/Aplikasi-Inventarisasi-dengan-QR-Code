<?php

require "login-registrasi-fungsi.php";
if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo
        "
        <script>
            alert('Registrasi Berhasil!');
        </script>
        ";
    } else {
        echo mysqli_error($conn);
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
    <title>Registrasi</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar bg-body-tertiary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/img/navbar-logo/if-logo-and-text.png" alt="Bootstrap" width="300" />
            </a>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- Regis form -->
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-header main-color-bg">
                            <img class="rounded my-3 m-auto d-block" src="assets/img/page-logo/if-logo.png" alt="" width="100" />
                            <h1 class="text-white fs-5 text-center">
                                Aplikasi Inventarisasi Lab Komputer dan Pemrograman
                            </h1>
                        </div>
                        <div class="card-body">

                            <form method="post" action="">
                                <input type="text" name="username" id="username" class="form-control my-3 py-2" placeholder="Username" required />
                                <input type="text" name="full_name" id="full_name" class="form-control my-3 py-2" placeholder="Nama Lengkap" required />
                                <input type="password" name="password" id="password" class="form-control my-3 py-2" placeholder="Password" required />
                                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control my-3 py-2" placeholder="Konfirmasi Password" required />
                                <div class="text-center mt-3">
                                    <button type="submit" name="register" class="rounded py-1 px-3 text-white main-color-bg">
                                        Registrasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Regis form end -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>