<?php
include '../koneksi/koneksi.php';

$email        = $_POST['email'];
$namaDepan    = $_POST['namaDepan'];
$namaBelakang = $_POST['namaBelakang'];
$tgl_lahir    = $_POST['tgllahir'];
$password     = password_hash($_POST['password'], PASSWORD_DEFAULT);
$tgl_daftar   = date('Y-m-d');

// Cek apakah email sudah terdaftar
$cek_email = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
if (mysqli_num_rows($cek_email) > 0) {
    header("Location: ../LoginRegister/register.php?error=email_terdaftar");
    exit();
}

// Jika email belum terdaftar, simpan data
$query = "INSERT INTO pengguna (nama_dpn, nama_blkg, email, tgl_lahir, tgl_pendaftaran, password)
          VALUES ('$namaDepan', '$namaBelakang', '$email', '$tgl_lahir', '$tgl_daftar', '$password')";

if (mysqli_query($conn, $query)) {
    header("Location: ../LoginRegister/loginpage.php");
    exit();
} else {
    echo "Gagal mendaftar: " . mysqli_error($conn);
}
?>
