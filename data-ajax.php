<?php

include ('class.php');
$digi = new digilib;
$koneksi = $digi->koneksi();
// include ('koneksi.php');

if (isset($_POST['p'])) {
    $p = $_POST['p'];
    
    if ($p == "mhs") {
        $nama = $_POST['nama'];
        $q = mysqli_query($koneksi, "SELECT nim,nama,kelas FROM mhs WHERE nama LIKE '%$nama%'");
        while ($d = mysqli_fetch_row($q)) {
            // $data[] = array('nim' => $d[0], 'nama' => $d[1], 'kelas' => $d[2]);
            $label = '['. $d[2] . ']'. ' ' . $d[0] .' '. $d[1];
            $value = $d[0] . ' ' . $d[1];
            $data[] = array('label' => $label, 'value' => $value);
        }
        echo json_encode($data);
    }elseif($p == "pustaka"){
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
        $mhs = $_POST ['mhs'];

        if($tipe == 'Magang') $ketua_penguji = "";

        //upload file 
        $target_dir = "laporan/";
        $nama_file = basename($_FILES["laporan"]["name"]);
        $target_file = $target_dir . $nama_file;
        move_uploaded_file($_FILES["laporan"]["tmp_name"], $target_file);

        mysqli_query($koneksi, "INSERT INTO pustaka1 (judul,tahun,tipe,pembimbing1,pembimbing2,ketua_penguji,penguji1,penguji2,penguji3,sekretaris,nama_file) VALUES (\"$judul\",'$tahun','$tipe','$pembimbing1','$pembimbing2','$ketua_penguji','$penguji1','$penguji2','$penguji3','$sekretaris',\"$nama_file\")");
        $last_id = mysqli_insert_id($koneksi);

        for($i = 0; $i < count($mhs); $i++){
            
            $e = explode(' ',$mhs[$i]);
            mysqli_query($koneksi, "INSERT INTO pustaka2 (id_judul,nim) VALUES ('$last_id','$e[0]')");
        }

    }
}

?>