<?php

session_start();
if(empty($_SESSION['user']) && empty($_SESSION['pass'])){
    echo"<script>window.location.replace('login.php')</script>";
}

error_reporting(0);

include ('class.php');
$digi = new digilib;
$koneksi = $digi->koneksi();
// include ('koneksi.php');

// //bikin variable koneksi
// $host = "localhost";
// $user= "telkom";
// $pass = "*t3lk0m#2023";
// $db = "digilib_tk";

// //koneksi
// $koneksi = mysqli_connect($host, $user, $pass, $db);
// //cek koneksi
// if (!$koneksi) echo "koneksi gagal...";



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
    // echo "data gagal diubah . . . .";
    }
    

    if ($_GET['t'] == "edit") {
        $judul = $_GET['judul'];
        $q = mysqli_query($koneksi, "SELECT id,tahun,tipe,pembimbing1,pembimbing2,ketua_penguji,penguji1,penguji2,penguji3,sekretaris,nama_file FROM pustaka1 WHERE judul='$judul'");
        $d = mysqli_fetch_row($q);
        $id = $d[0];
        $tahun = $d[1];
        $tipe = $d[2];
        $pembimbing1 = $d[3];
        $pembimbing2 = $d[4];
        $ketua_penguji = $d[5];
        $penguji1 = $d[6];
        $penguji2 = $d[7];
        $penguji3 = $d[8];
        $sekretaris = $d[9];
        $nama_file = $d[10];
        
        $tombol_val = "edit";
    }
    
    // Menuju form edit
    else {
        $id = "";
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
        $nama_file = "";
        $tombol_val = "simpan";
    }



?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <title>Admin - FORM PUSTAKA 1</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Output
            </div>


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Aktor</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Aktor:</h6>
                        <a class="collapse-item " href="table-dosen.php">Dosen</a>
                        <a class="collapse-item" href="table-mahasiswa.php">Mahasiswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Daftar Pustaka</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Daftar Pustaka:</h6>
                        <a class="collapse-item" href="table-pustaka.php">Pustaka 1</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Input
            </div>


            <!-- Nav Item - Formulir Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormulirOne"
                    aria-expanded="true" aria-controls="collapseFormulirOne">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Formulir Data</span>
                </a>
                <div id="collapseFormulirOne" class="collapse" aria-labelledby="headingFormulirOne"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Form:</h6>
                        <a class="collapse-item" href="dosen.php">Form Data Dosen</a>
                        <a class="collapse-item" href="index.php">Form Data Mahasiswa</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Formulir Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormulirTwo"
                    aria-expanded="true" aria-controls="collapseFormulirTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Formulir Daftar Pustaka</span>
                </a>
                <div id="collapseFormulirTwo" class="collapse show" aria-labelledby="headingFormulirTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pustaka:</h6>
                        <a class="collapse-item active" href="pustaka.php">Form Daftar Pustaka 1</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow aidated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow aidated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow aidated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Account</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow aidated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Formulir Pustaka 1</h1>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="container-fluid">
                            <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

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
                        <!-- HEAD FORM -->

                         <!-- FORM TABEL MAHASISWA-->
                <div class="main">
                    <div class="mt-4 p-5 bg-primary text-white rounded">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="POST" id="form_pustaka" enctype="multipart/form-data">
                                        <input type="hidden" name="p" value="pustaka">

                                        <div class="mb-3">
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
                            
                                                    $th = array('2023', '2022', '2021', '2020');
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
                                                    <?php 
                            
                                                    $t = array('TA', 'Magang',);
                                                    foreach ($t as $tip) {

                                                        if ($tip == $tipe) $sel = "SELECTED";
                                                        else $sel = "";
                                                        echo "<option value='$tip' $sel>$tip</option>";
                                                    }

                                                ?>
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $pembimbing1) $sel= "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                            $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                            while($d=mysqli_fetch_row($q)){
                                                                if ($d[0] == $pembimbing2) $sel= "SELECTED";
                                                                else $sel = "";
                                                                echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji1) $sel= "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji2) $sel= "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji3) $sel= "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $ketua_penguji) $sel= "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
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
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            echo "<option value='$d[0]'>$d[1] $d[2] $d[3]</option>";
                                                        }


                                                        ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Upload File</label>
                                            <input class="form-control" type="file" name="laporan" id="formFile">
                                        </div>

                                        <div class=" mt-3">
                                            <label for="mhs[]" class="form-label">Nama Mahasiswa:</label>
                                        </div>

                                        <div class="row field_wrapper" id="box">
                                            <div class="col-sm-6 mb-3">

                                                <input type="text" class="form-control" value="<?php echo $nama ?>"
                                                    placeholder="Enter Nama" name="mhs[]">

                                            </div>

                                            <div class="col-sm-2" id="hide_7">
                                                <button type="button" class="btn add_button"><i
                                                        class="bi bi-plus-square-fill text-success"></i></button>
                                            </div>
                                        </div>



                                        <button type="submit" name="tombol" class="btn btn-primary mt-5"
                                            value="<?php echo $tombol_val ?>">Simpan</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; ghiNABRina</span>
                                    </div>
                                </div>
                            </footer>
                        <!-- /.container-fluid -->

                    </div>

                </div>
                <!-- End of Page Wrapper -->

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Logout" below if you are ready to end your current
                                    session.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bootstrap core JavaScript-->
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="js/sb-admin-2.min.js"></script>

                    <!-- Page level plugins -->
                    <script src="vendor/chart.js/Chart.min.js"></script>

                    <!-- Page level custom scripts -->
                    <script src="js/demo/chart-area-demo.js"></script>
                    <script src="js/demo/chart-pie-demo.js"></script>
                    <script src="js/demo/chart-bar-demo.js"></script>
            </div>
        </div>
    </div>
</div>

    <!-- Menambahkan nama mahasiswa -->
    <script type="text/javascript">
    $(document).ready(function() {

        // menyembunyikan table jika memilih magang
        $("select[name='tipe']").on("change", function() {

            tipe = $(this).find(":selected").val();
            console.log("ke select " + tipe);
            if (tipe == "Magang") {
                $("#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button").fadeOut(500);
            } else {
                $("#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button").fadeIn(500);
            }
        })


        // syntax menambahkan table nama, dan fungsi autocomplete
        $(".add_button").click(function() {
            mhs1 = '<div class="row" id="mhs_del">';
            mhs2 = '<div class="col-sm-6 mb-3">';
            mhs3 =
                '<input type="text" class="form-control" value="<?php echo $nama ?>"placeholder="Enter Nama" name="mhs[]">';
            mhs4 = '</div>';
            mhs5 = '<div class="col-sm-2 remove_button">';
            mhs6 =
                '<button type="button" name="tambahkan" id="tambahkan"class="btn"><i class="bi bi-x-square-fill text-danger"></i></button>';
            mhs7 = '</div>';
            mhs8 = '</div>';
            mhs_add = mhs1 + mhs2 + mhs3 + mhs4 + mhs5 + mhs6 + mhs7 + mhs8;

            $("button[name='tombol']").before(mhs_add);

            $(".remove_button").click(function() {
                console.log("remove button");
                $("#mhs_del").remove();
            })
            $("input[name='mhs[]']").keyup(function() {
                mhs_nama = $(this).val();
                console.log("nama:" + mhs_nama);

                $.ajax({
                        method: "POST",
                        url: "data-ajax.php",
                        data: {
                            p: "mhs",
                            nama: mhs_nama
                        },
                        dataType: "json",
                    })

                    .done(function(data) {
                        panjang = data.length;
                        $("input[name='mhs[]']").autocomplete({
                            source: data
                        });
                        console.log("data" + panjang);
                    })
                    .fail(function(msg) {
                        console.log("error" + msg);
                    })
            })
        })


        // menyamakan pembimbing1 dan ketua_penguji
        $("select[name='pembimbing1']").on("change", function() {
            pembimbing1 = $(this).find(":selected").val(); //
            $("select[name='ketua_penguji']").val(pembimbing1); //
        })

        $("select[name='ketua_penguji']").on("change", function() {
            ketua_penguji = $(this).find(":selected").val(); //
            $("select[name='pembimbing1']").val(ketua_penguji); //
        })

        // syntax mencari nama dengan ajax
        $("input[name='mhs[]']").keyup(function() {
            mhs_nama = $(this).val();
            console.log("nama:" + mhs_nama);

            $.ajax({
                    method: "POST",
                    url: "data-ajax.php",
                    data: {
                        p: "mhs",
                        nama: mhs_nama,
                    },
                    dataType: "json",
                })

                .done(function(data) {
                    panjang = data.length;
                    $("input[name='mhs[]']").autocomplete({
                        source: data
                    });
                    console.log("data" + panjang);
                })
                .fail(function(msg) {
                    console.log("error" + msg);
                })
        })

        $('#form_pustaka').submit(function(e) {
            e.preventDefault(); // prefent default form submission

            // Get the form data
            var formData = new FormData(this);

            // make an ajax request
            $.ajax({
                    url: 'data-ajax.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                })
                .done(function() {
                    console.log("oke");
                })
                .fail(function(msg) {
                    console.log("error " + msg)
                })
        })
    });
    </script>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <script src="./jquery-ui/jquery-ui.js"></script>
    <script src="./jquery-ui/jquery-ui.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>