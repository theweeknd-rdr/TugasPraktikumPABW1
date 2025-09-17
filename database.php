<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_triptix2";


$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Login gagal! Username atau password salah'); window.location='login.php';</script>";
}

mysqli_close($conn);
?>
