<?php

include('koneksi.php');
// Koneksi ke database

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    // Query untuk mengambil data mahasiswa berdasarkan NIM
    $query = mysqli_query($koneksi, "SELECT nim, nama, kelas, alamat, kota, tlp FROM mahasiswa WHERE nim = '$nim'");
    $data = mysqli_fetch_assoc($query);

    echo json_encode($data); // Mengirim data dalam format JSON
}
?>