<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, arahkan ke homepage
    header("Location: pageTampilan/HomePage.php"); 
    exit();
} else {
    // Jika belum login, arahkan ke halaman login
    header("Location: LoginRegister/loginpage.php");
    exit();
}
?>
