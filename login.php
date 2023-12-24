<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
}

// session_start();
require "login-registrasi-fungsi.php";
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  // check username
  if (mysqli_num_rows($result) === 1) {

    //check password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      $_SESSION["login"] = true;
      header("Location: index.php");
      exit;
    }
  }
  $error = true;
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
  <title>Lab Komputer dan Pemrograman Universitas Tanjungpura</title>
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

  <!-- login form -->
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
                <input type="text" name="username" id="username" class="form-control my-3 py-2" placeholder="Username" required autocomplete="off" />
                <input type="password" name="password" id="password" class="form-control my-3 py-2" placeholder="Password" required autocomplete="off" />
                <div class="text-center mt-3">
                  <button type="submit" name="login" class="rounded py-1 px-3 text-white main-color-bg">
                    Login
                  </button>
                </div>
                <?php if (isset($error)) : ?>
                  <p class="text-center text-danger fw-bold mt-2">Username/Password Salah!</p>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- login form end -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>