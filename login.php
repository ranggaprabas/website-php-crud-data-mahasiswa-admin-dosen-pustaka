<?php

// include ('koneksi.php');
include('class.php');
$digi = new digilib;
$koneksi = $digi->koneksi(); //

// //VARIABEL KONEKSI
// $host="localhost";
// $user="telkom";
// $pass="*t3lk0m#2023";
// $db="digilib_tk";

// $koneksi=mysqli_connect($host,$user,$pass,$db);
// //cek koneksi
// if (!$koneksi) echo "koneksi gagal............";

// masukan data login
// $user = "admin";
// $pass = "admin";
// $pass_hash = password_hash($pass, PASSWORD_DEFAULT); // hashing password

// mysqli_query($koneksi,"INSERT INTO login VALUES('$user','$pass_hash',NOW(),NOW())");
// codingan diatas hanya untuk input data saja jika sudah bisa dihapus


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-gradient-primary">

    <!-- FORM LOGIN -->
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <?php

                // buat kode untuk eksekusi tombol
                if (isset($_POST['tombol'])) {
                    $user = $_POST['username'];
                    $pass = $_POST['pswd'];

                    // query data di tabel login username tsb
                    $q = mysqli_query($koneksi, "SELECT username, password FROM login WHERE username = '$user'");
                    // ambil data password
                    $d = mysqli_fetch_row($q);
                    $pass_db = $d[1];
                    // cek data username tsb ada atau tidak di tabel login
                    $j = mysqli_num_rows($q);

                    // verifikasi password
                    $pass_hass = password_verify($pass, $pass_db);
                    if (!empty($j) && !empty($pass_hass)) {
                        // jika login berhasil maka akan membuat session baru username dan password
                        session_start();
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $pass_db;

                        //redirect ke halaman /login/index.php
                        echo "<script>window.location.replace('./index.php')</script>";
                    } else {
                        // jika gagal login diberi alert
                        echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                            <button type=button class=btn-close data-bs-dismiss=alert></button>
                            <strong>Failed!</strong> Gagal login...
                        </div>";
                    }
                }

                ?>
            </div>
            <div class="container">
                <div class="col-sm-3"></div>
                <div class="row justify-content-center">

                    <div class="col-xl-10 col-lg-12 col-md-9">

                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-6 d-none d-lg-block">
                                        <img src="./img/logopolines.png" alt="polines" width="100%" class="mt-5">
                                    </div>
                                    <div class=" col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                            </div>
                                            <form method="post">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                                                </div>
                                                <div class="mb-4">
                                                    <label for="pswd" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword1" name="pswd">
                                                </div>
                                                <!-- <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.php">Forgot Password ?</a>
                                    </div> -->
                                                <button href="" type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" name="tombol" value="login">Login</button>

                                                <!-- <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                                        <a class="text-primary fw-bold ms-2" href="./authentication-register.php">Create
                                            an account</a>
                                    </div> -->
                                            </form>
                                            <hr>
                                            <div class="text-center">
                                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                            <div class="text-center">
                                                <a class="small" href="register.php">Create an Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- FORM LOGIN -->




    <!-- Outer Row -->




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>