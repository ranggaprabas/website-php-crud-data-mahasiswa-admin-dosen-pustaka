<?php
class digilib
{
    public function koneksi()
    {
        $host = "localhost";
        $user= "root";
        $pass = "";
        $db = "digilib_tk";

    $koneksi=mysqli_connect($host,$user,$pass,$db);
    if (!$koneksi) return mysqli_connect_error();
    else return $koneksi;
    }
    public function homebase ($no)
    {
        $q = mysqli_query($this->koneksi(), "SELECT nama FROM homebase WHERE no='$no'");
        $d = mysqli_fetch_row($q);
        if (!empty($d[0])) return $d[0];
    }

    public function nim_to_nama($nim)
    {
    $q = mysqli_query($this->koneksi(), "SELECT nama FROM mhs WHERE nim='$nim'");
    $d = mysqli_fetch_row($q);
    return $d[0];
    }
    public function nip_to_nama($nip)
    {
        $q = mysqli_query($this->koneksi(), "SELECT gelar_depan,nama,gelar_belakang FROM dosen WHERE nip = '$nip'");
        $d = mysqli_fetch_row($q);
        if (!empty($d[1])) {
            $nama = strtolower($d[1]);
            $nama_lengkap = $d[0] . ' ' . ucwords($nama) . ', ' . $d[2];
            return $nama_lengkap;
        }
    }
}
?>