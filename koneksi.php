<?php 

//bikin variable koneksi
$host = "localhost";
$user= "root";
$pass = "";
$db = "digilib_tk";

//koneksi
$koneksi = mysqli_connect($host, $user, $pass, $db);
//cek koneksi
if (!$koneksi) echo "koneksi gagal...";

?>