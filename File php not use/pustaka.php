<?php

session_start();
if(empty($_SESSION['user']) && empty($_SESSION['pass'])){
    echo"<script>window.location.replace('./authentication-login.php')</script>";
}

// error_reporting(0);

//bikin variable koneksi
$host = "localhost";
$user= "telkom";
$pass = "*t3lk0m#2023";
$db = "digilib_tk";

//koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);
//cek koneksi
if (!$koneksi) echo "koneksi gagal...";



    //ambil value & variabel dari payload
if ($_POST ['tombol'] == "simpan"){
    $id = $_POST ['id'];
    $judul = $_POST ['judul'];
    $tahun = $_POST ['tahun'];  
    $tipe = $_POST ['tipe'];    
    $pembimbing1 = $_POST ['pembimbing1'];
    $pembimbing2 = $_POST ['pembimbing2'];
    $ketua_penguji = $_POST ['ketua_penguji'];
    $penguji1 = $_POST ['penguji1'];
    $penguji2 = $_POST ['penguji2'];
    $penguji3 = $_POST ['penguji3'];
    $sekretaris = $_POST ['sekretaris'];
    
    $tombol_val = "simpan";
    // echo "nim : $nim <BR> nama: $nama <BR> kelas : $kelas <BR> alamat : $pembimbing1 <BR> jurusan : $jurusan <BR> prodi : $prodi <BR> kota : $pembimbing2 <BR> tlp : $penguji1 <BR> ";

    //masukan ke tabel pustaka1
    mysqli_query($koneksi, "INSERT INTO pustaka1 VALUES ('$id','$judul','$tahun','$tipe','$pembimbing1','$pembimbing2','$ketua_penguji','$penguji1','$penguji2','$penguji3','$sekretaris')");

    //cek data apakah masuk
    if(mysqli_affected_rows($koneksi) > 0) 
        echo "data berhasil masuk..";
    else echo "data gagal masuk..";

    }

//Fungsi Delete

elseif ($_POST['tombol'] == 'hapus'){
    $nim = $_POST['nim'];
    mysqli_query($koneksi, "DELETE FROM pustaka1 WHERE nim = '$nim'");

    $judul = "";    
    $tahun = "";
    $tipe = "";
    $pembimbing1 = "";
    $pembimbing2 = "";
    $ketua_penguji = "";
    $penguji1 = "";
    $penguji2 = "";
    $penguji3 = "";
    $sekretaris = "";
    
    $tombol_val = "simpan";
    
}


// Fungsi Edit
elseif ($_POST ['tombol'] == "edit"){
    $id = $_POST ['id'];
    $judul = $_POST ['judul'];
    $tahun = $_POST ['tahun'];  
    $tipe = $_POST ['tipe'];    
    $pembimbing1 = $_POST ['pembimbing1'];
    $pembimbing2 = $_POST ['pembimbing2'];
    $ketua_penguji = $_POST ['ketua_penguji'];
    $penguji1 = $_POST ['penguji1'];
    $penguji2 = $_POST ['penguji2'];
    $penguji3 = $_POST ['penguji3'];
    $sekretaris = $_POST ['sekretaris'];
    $tombol_val = "edit";
    
    mysqli_query($koneksi, "UPDATE pustaka1 SET judul='$judul',tahun='$tahun',tipe='$tipe',pembimbing1='$pembimbing1',pembimbing2='$pembimbing2',ketua_penguji='$ketua_penguji',penguji1='$penguji1',penguji2='$penguji2',penguji3='$penguji3',sekretaris='$sekretaris' WHERE id='$id'");
    
    // if (mysqli_affected_rows($koneksi) > 0) {
    //     echo "data berhasil diubah . . . .";
    
    }
else{
    $judul = "";    
    $tahun = "";
    $tipe = "";
    $pembimbing1 = "";
    $pembimbing2 = "";
    $ketua_penguji = "";
    $penguji1 = "";
    $penguji2 = "";
    $penguji3 = "";
    $sekretaris = "";
    $tombol_val = "simpan";
    echo "data gagal diubah . . . .";
    }
    

    if ($_GET['t'] == "edit") {

        $id = $_GET['id'];
        $q = mysqli_query($koneksi, "SELECT judul,tahun,tipe,pembimbing1,pembimbing2,ketua_penguji,penguji1,penguji2,penguji3,sekretaris FROM pustaka1 WHERE id='$id'");
        $d = mysqli_fetch_row($q);
        $judul = $d[0];    
        $tahun = $d[1];
        $tipe = $d[2];
        $pembimbing1 = $d[3];
        $pembimbing2 = $d[4];
        $ketua_penguji = $d[5];
        $penguji1 = $d[6];
        $penguji2 = $d[7];
        $penguji3 = $d[8];
        $sekretaris = $d[9];
        
        $tombol_val = "edit";
        
        }

 // Menuju form edit

else{
    $judul = "";    
    $tahun = "";
    $tipe = "";
    $pembimbing1 = "";
    $pembimbing2 = "";
    $ketua_penguji = "";
    $penguji1 = "";
    $penguji2 = "";
    $penguji3 = "";
    $sekretaris = "";
    $tombol_val = "simpan";
    }



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->

    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>DIGILIB TK</title>
</head>

<body>


    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.php" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/polines_brand.png" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <!-- <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li> -->
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">FORM</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link mt-2" href="./index.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Mahasiswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./dosen.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Dosen</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./pustaka.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Pustaka</span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">TABLE</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link mt-2" href="./table-mahasiswa.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Table Mahasiswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./table-dosen.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Table Dosen</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./table-pustaka.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Table Pustaka</span>
                            </a>
                        </li>

                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-alerts.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Alerts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-card.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Card</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-forms.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Forms</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-typography.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-typography"></i>
                                </span>
                                <span class="hide-menu">Typography</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-login.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./icon-tabler.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-mood-happy"></i>
                                </span>
                                <span class="hide-menu">Icons</span>
                            </a>
                        </li> -->
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li> -->
                    </ul>
                    <!-- <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Upgrade to pro</h6>
                                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/"
                                    target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="../assets/images/backgrounds/rocket.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div> -->
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li> -->
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <a href="index.php" target="" class="btn btn-primary">Admin</a>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                                        class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="logout.php"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Start Coding dari matkul web -->
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <script>
                        $(document).ready(function() {

                            $("a:nth-child(2)").click(function() {

                                console.log("diklik lho");

                                nim = $(this).attr("href");

                                $(".modal-title").text("Konfirmasi hapus");

                                $(".modal-body").text("Apakah anda yakin hapus data NIM " + nim + " ?");

                                form1 = "<form method=post>";
                                form2 = "<input type=hidden name=nim value=" + nim + ">";
                                form3 =
                                    "<button type=\"submit\" class=\"btn btn-success m-2\" name=\"tombol\" value=\"hapus\">Ya</button>";
                                form4 =
                                    "<button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Tidak</button>"
                                form = form1 + form2 + form3 + form4

                                $(".modal-footer").empty().append(form);



                            })

                        })
                        </script>



                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-sm-12">
                                    <form action="" method="POST">

                                        <div class="mb-3 mt-3">
                                            <label for="judul" class="form-label">Judul:</label>
                                            <input type="text" class="form-control" value="<?php echo $judul ?>"
                                                placeholder="Enter Judul" name="judul">
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="tahun" class="form-label">Tahun:</label>
                                                    <select type="text" class="form-select" placeholder="Masukan Tahun"
                                                        name="tahun">
                                                        <option>Tahun</option>
                                                        <?php 
                            
                                                    $th = array('2018', '2019',);
                                                    foreach ($th as $tah) {

                                                        if ($tah == $tahun) $sel = "SELECTED";
                                                        else $sel = "";
                                                        echo "<option value='$tah' $sel>$tah</option>";
                                                    }

                                                ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb-3">

                                                <label for="tipe" class="form-label">Tipe:</label>
                                                <select type="text" class="form-select" placeholder="Masukan Tipe"
                                                    name="tipe" id="select">
                                                    <option value="">Tipe</option>
                                                    <option value="TA">TA</option>
                                                    <option value="Magang">Magang</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-sm-6 mb-3">

                                                <label for="pembimbing1" class="form-label">Pembimbing 1:</label>
                                                <select type="text" class="form-select"
                                                    placeholder="Masukan Pembimbing 1" name="pembimbing1">
                                                    <option>Pembimbing 1</option>
                                                    <?php 
                            
                                                    $p1 = array('Sarono', 'Sutarmo',);
                                                    foreach ($p1 as $pem1) {

                                                        if ($pem1 == $pembimbing1) $sel = "SELECTED";
                                                        else $sel = "";
                                                        echo "<option value='$pem1' $sel>$pem1</option>";
                                                    }

                                                ?>
                                                </select>

                                            </div>

                                            <div class="col-sm-6 mb-3" id="hide_1">

                                                <label for="pembimbing2" class="form-label">Pembimbing 2:</label>
                                                <select type="text" class="form-select"
                                                    placeholder="Masukan Pembimbing 2" name="pembimbing2">
                                                    <option>Pembimbing 2</option>
                                                    <?php 
                            
                                                        $p2 = array('Sarono', 'Sutarmo',);
                                                        foreach ($p2 as $pem2) {

                                                            if ($pem2 == $pembimbing2) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$pem2' $sel>$pem2</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4 mb-3" id="hide_2">

                                                <label for="penguji1" class="form-label">Penguji 1:</label>
                                                <select type="text" class="form-select" placeholder="Masukan Penguji 1"
                                                    name="penguji1">
                                                    <option>Penguji 1</option>
                                                    <?php 
                            
                                                        $pe1 = array('Sarono', 'Sutarmo',);
                                                        foreach ($pe1 as $peng1) {

                                                            if ($peng1 == $penguji1) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$peng1' $sel>$peng1</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-4 mb-3" id="hide_3">

                                                <label for="penguji2" class="form-label">Penguji 2:</label>
                                                <select type="text" class="form-select" placeholder="Masukan Penguji 2"
                                                    name="penguji2">
                                                    <option>Penguji 2</option>
                                                    <?php 
                            
                                                        $pe2 = array('Sarono', 'Sutarmo',);
                                                        foreach ($pe2 as $peng2) {

                                                            if ($peng2 == $penguji2) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$peng2' $sel>$peng2</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-4 mb-3" id="hide_4">

                                                <label for="penguji3" class="form-label">Penguji 3:</label>
                                                <select type="text" class="form-select" placeholder="Masukan Penguji 3"
                                                    name="penguji3">
                                                    <option>Penguji 3</option>
                                                    <?php 
                            
                                                        $pe3 = array('Sarono', 'Sutarmo',);
                                                        foreach ($pe3 as $peng3) {

                                                            if ($peng3 == $penguji3) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$peng3' $sel>$peng3</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 mb-3" id="hide_5">

                                                <label for="ketua_penguji" class="form-label">Ketua Penguji:</label>
                                                <select type="text" class="form-select"
                                                    placeholder="Masukan Ketua Penguji" name="ketua_penguji">
                                                    <option>Ketua Penguji</option>
                                                    <?php 
                            
                                                        $ket = array('Sarono', 'Sutarmo',);
                                                        foreach ($ket as $ketu) {

                                                            if ($ketu == $ketua_penguji) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$ketu' $sel>$ketu</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-6 mb-3" id="hide_6">

                                                <label for="sekretaris" class="form-label">Sekretaris:</label>
                                                <select type="text" class="form-select" placeholder="Masukan Sekretaris"
                                                    name="sekretaris">
                                                    <option>Sekretaris</option>
                                                    <?php 
                            
                                                        $sek = array('Sarono', 'Sutarmo',);
                                                        foreach ($sek as $sekre) {

                                                            if ($sekre == $sekretaris) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$sekre' $sel>$sekre</option>";
                                                        }

                                                        ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Choose File</label>
                                            <input class="form-control" type="file" id="formFile">
                                        </div>

                                        <div class=" mt-3">
                                            <label for="nama" class="form-label">Nama Mahasiswa:</label>
                                        </div>

                                        <div class="row field_wrapper" id="box">
                                            <div class="col-sm-6 mb-3">

                                                <input type="text" class="form-control" value="<?php echo $nama ?>"
                                                    placeholder="Enter Nama" name="nama">

                                            </div>

                                            <div class="col-sm-2" id="hide_7">
                                                <button type="button" class="btn btn-primary add_button">+</button>
                                            </div>
                                        </div>



                                        <button type="submit" name="tombol" class="btn btn-primary mt-5"
                                            value="<?php echo $tombol_val ?>">Simpan</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="container mt-5">

                            <div class="row">

                                <div class="col-sm-12">
                                    <h2>Table Mahasiswa</h2>
                                    <p>Mahasiswa Teknik Elektro Program Studi Teknik Telekomunikasi</p>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th>Alamat</th>
                                                <th>Jurusan</th>
                                                <th>Prodi</th>
                                                <th>Kota</th>
                                                <th>Telepon</th>
                                            </tr>
                                        </thead>
                                        <tbody> -->
                        <?php
                        // $q = mysqli_query($koneksi,"SELECT nim,nama,kelas,alamat,jurusan,prodi,kota,tlp FROM pustaka1 ORDER BY nim ASC");
                        // while ($d = mysqli_fetch_row($q)){

                            // $nim = $d[0];
                            // $nama = $d[1];
                            // $kelas = $d[2];
                            // $pembimbing1 = $d[3];
                            // $jurusan = $d[4];
                            // $prodi = $d[5];
                            // $pembimbing2 = $d[6];
                            // $penguji1 = $d[7];
                            // $tombol_val = "edit";


                            // echo "
                            // <tr>
                            // <td>$nim</td>
                            // <td>$nama</td>
                            // <td>$kelas</td>
                            // <td>$pembimbing1</td>
                            // <td>$jurusan</td>
                            // <td>$prodi</td>
                            // <td>$pembimbing2</td>
                            // <td>$penguji1</td>
                            // <td>
                            // <a href = 'index.php?t=edit&nim=$nim'><i class=\"bi bi-file-earmark-text text-primary me-2\"></i></a>
                            // <a href = '$nim' data-bs-toggle=modal data-bs-target=#myModal><i class=\"bi bi-trash text-danger\"></i></a>
                            // </td>
                            // </tr>
                            // ";
                        
                        // }
                        ?>

                        </tbody>
                        </table>
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

    <!-- Menambahkan nama mahasiswa -->
    <script type="text/javascript">
    $(document).ready(function() {

        const el = document.getElementById('select');
        const box1 = document.getElementById('hide_1');
        const box2 = document.getElementById('hide_2');
        const box3 = document.getElementById('hide_3');
        const box4 = document.getElementById('hide_4');
        const box5 = document.getElementById('hide_5');
        const box6 = document.getElementById('hide_6');
        const box7 = document.getElementById('hide_7');

        el.addEventListener('change', function handleChange(event) {
            if (event.target.value === 'Magang') {
                box1.style.display = 'none';
                box2.style.display = 'none';
                box3.style.display = 'none';
                box4.style.display = 'none';
                box5.style.display = 'none';
                box6.style.display = 'none';
                box7.style.display = 'none';
            } else {
                box1.style.display = 'block';
                box2.style.display = 'block';
                box3.style.display = 'block';
                box4.style.display = 'block';
                box5.style.display = 'block';
                box6.style.display = 'block';
                box7.style.display = 'block';
            }
        });

        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div class="row">' +
            '<div class="col-sm-6 mb-3">' +
            '<input type="text" class="form-control" value="<?php echo $nama ?>"placeholder="Enter Nama" name="nama">' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<button type="button" name="tambahkan" id="tambahkan"class="btn btn-primary remove_button">+</button>' +
            '</div>' +
            '</div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function() { //Once add button is clicked
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(
            e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>

    <script src="jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function() { //Once add button is clicked
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
    </script>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>