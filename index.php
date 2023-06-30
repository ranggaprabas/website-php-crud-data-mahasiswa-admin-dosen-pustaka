<?php

include('class.php');
$digi = new digilib;
$koneksi = $digi->koneksi();
// include ('koneksi.php');

session_start();
if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    echo "<script>window.location.replace('login.php')</script>";
}

error_reporting(0);

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
if ($_POST['tombol'] == "simpan") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];
    $kota = $_POST['kota'];
    $tlp = $_POST['tlp'];
    $tombol_val = "simpan";
    // echo "nim : $nim <BR> nama: $nama <BR> kelas : $kelas <BR> alamat : $alamat <BR> jurusan : $jurusan <BR> prodi : $prodi <BR> kota : $kota <BR> tlp : $tlp <BR> ";

    //masukan ke tabel mhs
    mysqli_query($koneksi, "INSERT INTO mhs VALUES ('$nim','$nama','$kelas','$alamat','$jurusan','$prodi','$kota','$tlp')");

    //cek data apakah masuk
    if (mysqli_affected_rows($koneksi) > 0)
        echo "data berhasil masuk..";

    else echo "data gagal masuk..";
}

//Fungsi Delete

elseif ($_POST['tombol'] == 'hapus') {
    $nim = $_POST['nim'];
    mysqli_query($koneksi, "DELETE FROM mhs WHERE nim = '$nim'");

    $nim = "";
    $nama = "";
    $kelas = "";
    $jurusan = "";
    $prodi = "";
    $alamat = "";
    $kota = "";
    $tlp = "";
    $tombol_val = "simpan";
}


// Fungsi Edit
elseif ($_POST['tombol'] == "edit") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];
    $kota = $_POST['kota'];
    $tlp = $_POST['tlp'];
    $tombol_val = "edit";

    mysqli_query($koneksi, "UPDATE mhs SET nama='$nama',kelas='$kelas',alamat='$alamat',jurusan='$jurusan',prodi='$prodi',kota='$kota',tlp='$tlp' WHERE nim='$nim'");

    // if (mysqli_affected_rows($koneksi) > 0) {
    //     echo "data berhasil diubah . . . .";

} else {
    $nim = "";
    $nama = "";
    $kelas = "";
    $jurusan = "";
    $prodi = "";
    $alamat = "";
    $kota = "";
    $tlp = "";
    $tombol_val = "simpan";
    // echo "data gagal diubah . . . .";
}







if ($_GET['t'] == "edit") {

    $nim = $_GET['nim'];
    $q = mysqli_query($koneksi, "SELECT nama,kelas,alamat,jurusan,prodi,kota,tlp FROM mhs WHERE nim='$nim'");
    $d = mysqli_fetch_row($q);
    $nama = $d[0];
    $kelas = $d[1];
    $alamat = $d[2];
    $jurusan = $d[3];
    $prodi = $d[4];
    $kota = $d[5];
    $tlp = $d[6];
    $tombol_val = "edit";
}

// Menuju form edit

else {
    $nim = "";
    $nama = "";
    $kelas = "";
    $alamat = "";
    $jurusan = "";
    $prodi = "";
    $kota = "";
    $tlp = "";
    $tombol_val = "simpan";
}



?>

<!DOCTYPE html>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Admin - FORM MAHASISWA</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Aktor</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Aktor:</h6>
                        <a class="collapse-item" href="table-dosen.php">Dosen</a>
                        <a class="collapse-item" href="table-mahasiswa.php">Mahasiswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFormulir" aria-expanded="true" aria-controls="collapseFormulir">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Formulir Data</span>
                </a>
                <div id="collapseFormulir" class="collapse show" aria-labelledby="headingFormulir" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Form:</h6>
                        <a class="collapse-item" href="dosen.php">Form Data Dosen</a>
                        <a class="collapse-item active" href="index.php">Form Data Mahasiswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Formulir Daftar Pustaka Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDaftarpustaka" aria-expanded="true" aria-controls="collapseDaftarpustaka">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Formulir Daftar Pustaka</span>
                </a>
                <div id="collapseDaftarpustaka" class="collapse" aria-labelledby="headingDaftarpustaka" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pustaka:</h6>
                        <a class="collapse-item" href="pustaka.php">Form Daftar Pustaka 1</a>

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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
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
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
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
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Account</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                    <h1 class="h3 mb-2 text-gray-800">Formulir Mahasiswa</h1>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="container-fluid">

                            <!-- Area Chart -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the area chart can be found in the
                                    <code>/js/demo/chart-area-demo.js</code> file.
                                </div>
                            </div> -->

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

                            <div class="main">
                                <div class="mt-4 p-5 bg-primary text-white rounded">
                                    <script>
                                        $(document).ready(function() {
                                            $("a:nth-child(2)").click(function() {
                                                console.log("diklik lo...");
                                                nim = $(this).attr('href');
                                                $(".modal-title").text("Konfirmasi Hapus");
                                                $(".modal-body").text("Apakah Anda yakin hapus data NIM " +
                                                    nim + "?");

                                                form1 = "<form method=post>";
                                                form2 = "<input type=hidden name=nim value=" + nim + ">";
                                                form3 =
                                                    "<button type=submit class=\"btn btn-success me-2\" name=tombol value=hapus>Ya</button>";
                                                form4 =
                                                    "<button type=button class=\"btn btn-danger\" data-bs-dismiss=modal>Tidak</button>";
                                                form5 = "</form>";
                                                form = form1 + form2 + form3 + form4 + form5;

                                                $(".modal-footer").empty().append(form);

                                            })
                                        })

                                        $(document).ready(function() {
                                            // Mendapatkan parameter t dan nim dari URL
                                            const urlParams = new URLSearchParams(window.location.search);
                                            const editMode = urlParams.get('t') === 'edit';
                                            const nimParam = urlParams.get('nim');

                                            if (editMode && nimParam) {
                                                // Mengisi form sesuai data yang ada berdasarkan NIM
                                                $.ajax({
                                                    url: 'get_data.php', // Ubah 'get_data.php' dengan URL atau file yang digunakan untuk mengambil data dari database berdasarkan NIM
                                                    method: 'GET',
                                                    data: {
                                                        nim: nimParam
                                                    },
                                                    success: function(response) {
                                                        const data = JSON.parse(response);
                                                        if (data) {
                                                            $('#nim').val(data.nim);
                                                            $('#nama').val(data.nama);
                                                            $('#kelas').val(data.kelas);
                                                            $('#alamat').val(data.alamat);
                                                            $('#jurusan').val(data.jurusan);
                                                            $('#prodi').val(data.prodi);
                                                        }
                                                    },
                                                    error: function() {
                                                        console.log(
                                                            'Terjadi kesalahan saat mengambil data dari server.'
                                                        );
                                                    }
                                                });
                                            }
                                        });
                                    </script>


                                    <!-- FORM TABEL MAHASISWA-->
                                    <div class="container">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="col-sm-12">
                                                    <form action="" method="POST">
                                                        <div class="mb-3 mt-3">
                                                            <label for="nim" class="form-label">NIM:</label>
                                                            <input type="text" class="form-control" value="<?php echo $nim ?>" placeholder="Enter nim" name="nim">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama:</label>
                                                            <input type="text" class="form-control" value="<?php echo $nama ?>" placeholder="Masukan Nama" name="nama">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kelas" class="form-label">Kelas:</label>
                                                            <select type="text" class="form-select" placeholder="Masukan Kelas" name="kelas">
                                                                <option>Kelas</option>
                                                                <?php

                                                                $k = array('TK-3A', 'TK-3B', 'TE-4A', 'TE-4B');
                                                                foreach ($k as $kls) {

                                                                    if ($kls == $kelas) $sel = "SELECTED";
                                                                    else $sel = "";
                                                                    echo "<option value='$kls' $sel>$kls</option>";
                                                                }

                                                                ?>

                                                            </select>
                                                        </div>

                                                        <label for="alamat" class="form-label">Alamat:</label>
                                                        <textarea class="form-control" rows="5" id="id_alamat" name="alamat"><?php echo $alamat ?></textarea>

                                                        <div class="mb-3">
                                                            <label for="jurusan" class="form-label">Jurusan:</label>
                                                            <input type="text" class="form-control" name="jurusan" placeholder="Teknik Elektro" value="Teknik Elektro" readonly>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="prodi" class="form-label">Prodi:</label>
                                                            <select type="text" class="form-select" placeholder="Masukan Prodi" name="prodi">
                                                                <option>Prodi</option>
                                                                <?php

                                                                $pro = array('D3 - Telekomunikasi', 'D4 - Telekomunikasi');
                                                                foreach ($pro as $prod) {

                                                                    if ($prod == $prodi) $sel = "SELECTED";
                                                                    else $sel = "";
                                                                    echo "<option value='$prod' $sel>$prod</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="kota" class="form-label">Kota:</label>
                                                            <input type="text" class="form-control" value="<?php echo $kota ?>" placeholder="Masukan Kota" name="kota">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="tlp" class="form-label">Telepon:</label>
                                                            <input type="text" class="form-control" value="<?php echo $tlp ?>" placeholder="Masukan Telepon" name="tlp">
                                                        </div>

                                                        <button type="submit" name="tombol" class="btn btn-primary mt-5" value="<?php echo $tombol_val ?>">Simpan</button>

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
                                        // $q = mysqli_query($koneksi,"SELECT nim,nama,kelas,alamat,jurusan,prodi,kota,tlp FROM mhs ORDER BY nim ASC");
                                        // while ($d = mysqli_fetch_row($q)){

                                        // $nim = $d[0];
                                        // $nama = $d[1];
                                        // $kelas = $d[2];
                                        // $alamat = $d[3];
                                        // $jurusan = $d[4];
                                        // $prodi = $d[5];
                                        // $kota = $d[6];
                                        // $tlp = $d[7];
                                        // $tombol_val = "edit";


                                        // echo "
                                        // <tr>
                                        // <td>$nim</td>
                                        // <td>$nama</td>
                                        // <td>$kelas</td>
                                        // <td>$alamat</td>
                                        // <td>$jurusan</td>
                                        // <td>$prodi</td>
                                        // <td>$kota</td>
                                        // <td>$tlp</td>
                                        // <td>
                                        // <a href = 'index.php?t=edit&nim=$nim'><i class=\"bi bi-file-earmark-text text-primary me-2\"></i></a>
                                        // <a href = '$nim' data-bs-toggle=modal data-bs-target=#myModal><i class=\"bi bi-trash text-danger\"></i></a>
                                        // </td>
                                        // </tr>
                                        // ";

                                        // }
                                        ?>
                                        </div>
                                        </div>
                            <!-- End of Main Content -->

                            <!-- Footer -->
                            <footer class="sticky-footer bg-white">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; ghiNABRina</span>
                                    </div>
                                </div>
                            </footer>
                            <!-- End of Footer -->

                        
                        <!-- End of Content Wrapper -->

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
                    </div>
                </div>
            </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>