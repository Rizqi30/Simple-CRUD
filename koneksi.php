<?php
$host       = "localhost";
$user       = "root";
$password   = "";
$db         = "db_user";

$koneksi    = mysqli_connect($host, $user, $password, $db);
if (!$koneksi) { //cek koneksi
    die("Not Connected to Database");
}
$nama       = "";
$email      = "";
$no_telp    = "";
$alamat     = "";
$error      = "";
$sukses     = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id     = $_GET['id'];
    $sql1   = "delete from user where id = '$id'";
    $q1     = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Data Berhasil di Hapus";
    } else {
        $error  = "Data Gagal di Hapus";
    }
}

if ($op == 'edit') {
    $id                 = $_GET['id'];
    $sql1               = "select * from user where id = '$id'";
    $q1                 = mysqli_query($koneksi, $sql1);
    $r1                 = mysqli_fetch_array($q1);
    $nama               = isset($r1['nama']) ? $r1['nama'] : '';
    $email              = isset($r1['email']) ? $r1['email'] : '';
    $no_telp            = isset($r1['no_telp']) ? $r1['no_telp'] : '';
    $alamat             = isset($r1['alamat']) ? $r1['alamat'] : '';
    //$nama       = $r1['nama'];
    //$email      = $r1['email'];
    //$no_telp    = $r1['no_telp'];
    //$alamat     = $r1['alamat'];

    if ($nama == '') {
        $error = "Data Tidak Ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $nama           = $_POST['nama'];
    $email          = $_POST['email'];
    $no_telp        = $_POST['no_telp'];
    $alamat         = $_POST['alamat'];

    if ($nama && $email && $no_telp && $alamat) {
        if ($op == 'edit') { // untuk Update
            $sql1   = "update user set nama = '$nama', email = '$email', no_telp = '$no_telp', alamat = '$alamat' where id = '$id'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil di Update";
            } else {
                $error = "Data Gagal di Update";
            }
        } else { //untuk Insert
            $sql1   = "insert into user(nama,email,no_telp,alamat) values ('$nama','$email','$no_telp','$alamat')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil Input Data Baru";
            } else {
                $error      = "Gagal Input Data";
            }
        }
    } else {
        $error = "Data Harus di Input Semua";
    }
}
