<?php

include('class.php');
$digi = new digilib;
$koneksi = $digi->koneksi();
// include ('koneksi.php');

session_start();
if (empty($_SESSION['user']) && empty($_SESSION['pass'])) {
    echo "<script>window.location.replace('./authentication-login.php')</script>";
}

error_reporting(0);



//ambil value & variabel dari payload
if ($_POST['tombol'] == "simpan") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $tipe = $_POST['tipe'];
    $pembimbing1 = $_POST['pembimbing1'];
    $pembimbing2 = $_POST['pembimbing2'];
    $ketua_penguji = $_POST['ketua_penguji'];
    $penguji1 = $_POST['penguji1'];
    $penguji2 = $_POST['penguji2'];
    $penguji3 = $_POST['penguji3'];
    $sekretaris = $_POST['sekretaris'];
    $nama_file = $_POST['nama_file'];

    $tombol_val = "simpan";
    // echo "nim : $nim <BR> nama: $nama <BR> kelas : $kelas <BR> alamat : $pembimbing1 <BR> jurusan : $jurusan <BR> prodi : $prodi <BR> kota : $pembimbing2 <BR> tlp : $penguji1 <BR> ";

    //masukan ke tabel pustaka1
    mysqli_query($koneksi, "INSERT INTO pustaka1 VALUES ('$id','$judul','$tahun','$tipe','$pembimbing1','$pembimbing2','$ketua_penguji','$penguji1','$penguji2','$penguji3','$sekretaris',\"$nama_file\")");

    //cek data apakah masuk
    if (mysqli_affected_rows($koneksi) > 0) echo "data berhasil masuk..";
    else echo "data gagal masuk..";
}

//Fungsi Delete

elseif ($_POST['tombol'] == 'hapus') {
    $judul = $_POST['judul'];
    mysqli_query($koneksi, "DELETE FROM pustaka1 WHERE judul = '$judul'");

    // Kode setelah penghapusan
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


// Fungsi Edit
elseif ($_POST['tombol'] == "edit") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $tipe = $_POST['tipe'];
    $pembimbing1 = $_POST['pembimbing1'];
    $pembimbing2 = $_POST['pembimbing2'];
    $ketua_penguji = $_POST['ketua_penguji'];
    $penguji1 = $_POST['penguji1'];
    $penguji2 = $_POST['penguji2'];
    $penguji3 = $_POST['penguji3'];
    $sekretaris = $_POST['sekretaris'];
    $nama_file = $_POST['nama_file'];
    $tombol_val = "edit";

    mysqli_query($koneksi, "UPDATE pustaka1 SET judul='$judul',tahun='$tahun',tipe='$tipe',pembimbing1='$pembimbing1',pembimbing2='$pembimbing2',ketua_penguji='$ketua_penguji',penguji1='$penguji1',penguji2='$penguji2',penguji3='$penguji3',sekretaris='$sekretaris' WHERE id='$id'");

    // if (mysqli_affected_rows($koneksi) > 0) {
    //     echo "data berhasil diubah . . . .";

} else {
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>DAFTAR PUSATAKA 1</title>

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
                        <a class="collapse-item" href="table-index.php">Mahasiswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Daftar Pustaka</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Daftar Pustaka:</h6>
                        <a class="collapse-item active" href="table-pustaka.php">Pustaka 1</a>
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
                <div id="collapseFormulir" class="collapse" aria-labelledby="headingFormulir" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Form:</h6>
                        <a class="collapse-item" href="dosen.php">Form Data Dosen</a>
                        <a class="collapse-item" href="index.php">Form Data Mahasiswa</a>
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

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>

                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Account</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow aidated--grow-in" aria-labelledby="userDropdown">
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
                    <h1 class="h3 mb-4 text-gray-800">Daftar Pustaka 1</h1>

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

                        <script>
                            $(document).ready(function() {
                                $("a[data-bs-toggle='modal']").click(function() {
                                    var judul = $(this).attr("href");
                                    $(".modal-title").text("Konfirmasi hapus");
                                    $(".modal-body").text("Apakah Anda yakin ingin menghapus Judul " + judul + "?");
                                    var form = '<form method="post">' +
                                        '<input type="hidden" name="judul" value="' + judul + '">' +
                                        '<button type="submit" class="btn btn-success m-2" name="tombol" value="hapus">Ya</button>' +
                                        '<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>' +
                                        '</form>';
                                    $(".modal-footer").empty().append(form);
                                });
                            });
                        </script>


                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Pustaka 1</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <a href="pustaka.php" type="button" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Judul</th>
                                                <th scope="col">Tahun</th>
                                                <th scope="col">Tipe</th>
                                                <th scope="col">Mahasiswa</th>
                                                <th scope="col">Pembimbing</th>
                                                <th scope="col">Ketua Penguji</th>
                                                <th scope="col">Penguji</th>
                                                <th scope="col">Sekretaris</th>
                                                <th scope="col">File Laporan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $q = mysqli_query($koneksi, "SELECT * FROM pustaka1 ORDER BY tahun ASC, tipe ASC");
                                            while ($d = mysqli_fetch_row($q)) {

                                                $id = $d[0];
                                                $judul = $d[1];
                                                $tahun = $d[2];
                                                $tipe = $d[3];
                                                $pembimbing1 = $digi->nip_to_nama($d[4]);
                                                $pembimbing2 = $digi->nip_to_nama($d[5]);
                                                $ketua_penguji = $digi->nip_to_nama($d[6]);
                                                $penguji1 = $digi->nip_to_nama($d[7]);
                                                $penguji2 = $digi->nip_to_nama($d[8]);
                                                $penguji3 = $digi->nip_to_nama($d[9]);
                                                $sekretaris = $digi->nip_to_nama($d[10]);
                                                $nama_file = $d[11];
                                                $tombol_val = "edit";

                                                echo "
                            <tr>
                            <td>$judul</td>                            
                            <td>$tahun</td>
                            <td>$tipe</td>
                            <td>";

                                                //data mahasiswa
                                                $n = 0;
                                                $q2 = mysqli_query($koneksi, "SELECT nim FROM pustaka2 WHERE id_judul='$id'");
                                                while ($d2 = mysqli_fetch_row($q2)) {
                                                    $n++;
                                                    echo "$n." . $digi->nim_to_nama($d2[0]);
                                                }


                                                echo "</td>
                        <td>1. $pembimbing1<BR>2. $pembimbing2</td>
                        <td>$ketua_penguji</td>
                        <td>1. $penguji1<BR>2. $penguji2<BR>3. $penguji3</td>
                        <td>$sekretaris</td>
                        <td><button type=button class='btn btn-outline-primary'>
                            <a href=\"laporan/$nama_file\" target=_blank><i class=\"bi bi-file-pdf\"></i></a>
                            </button>
                        </td>
                        <td>
                        <a href = 'pustaka.php?t=edit&judul=$judul'><span class=\"badge bg-primary me-2\">Edit</span></a>
                        <a href = '$judul' data-bs-toggle=modal data-bs-target=#myModal><span class=\"badge bg-danger\">Hapus</span></a>
                        </td>
                        </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="formp1.php" type="button" class="btn btn-primary"><i
                                            class="fas fa-plus"></i>Tambah</a>
                                </div>
                            </div>
                            <h5 class="card-title">Data <span>| Pustaka</span></h5>
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Tipe</th>
                                        <th scope="col">Mahasiswa</th>
                                        <th scope="col">Pembimbing</th>
                                        <th scope="col">Ketua Penguji</th>
                                        <th scope="col">Penguji</th>
                                        <th scope="col">Sekretaris</th>
                                        <th scope="col">File Laporan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ?php
                                    $q = mysqli_query($koneksi, "SELECT * FROM pustaka1 ORDER BY tahun ASC,tipe ASC");
                                    while ($d = mysqli_fetch_row($q)) {
                                        $id = $d[0];
                                        $judul = $d[1];
                                        $tahun = $d[2];
                                        $tipe = $d[3];
                                        $pembimbing1 = $digi->nip_to_nama($d[4]);
                                        $pembimbing2 = $digi->nip_to_nama($d[5]);
                                        $ketuapenguji = $digi->nip_to_nama($d[6]);
                                        $penguji1 = $digi->nip_to_nama($d[7]);
                                        $penguji2 = $digi->nip_to_nama($d[8]);
                                        $penguji3 = $digi->nip_to_nama($d[9]);
                                        $sekretaris = $digi->nip_to_nama($d[10]);
                                        $file = $d[11];

                                        echo "<tr>
                                        <td>$judul</td>
                                        <td>$tahun</td>
                                        <td>$tipe</td>
                                        <td>";

                                        // data mahasiswa
                                        $n = 0;
                                        $q2 = mysqli_query($koneksi, "SELECT nim FROM pustaka2 WHERE id_judul='$id'");
                                        while ($d2 = mysqli_fetch_row($q2)) {
                                            $n++;
                                            echo "$n." . $digi->nim_to_nama($d2[0]);
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> -->
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; ghiNABRina</span>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
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

</body>

</html>