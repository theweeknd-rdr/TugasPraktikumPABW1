<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah login, arahkan ke homepage
    header("Location: user_app/pageTampilan/homepage.php"); 
    exit();
} else {
    // Jika belum login, arahkan ke halaman login
    header("Location: pilihlogin.php");
    exit();
}
?>
