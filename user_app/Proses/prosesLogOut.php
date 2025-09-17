<?php
session_start();
// Hapus semua data session
session_unset();
session_destroy();

// Setelah logout, arahkan ke halaman login atau homepage
header("Location: ../LoginRegister/loginpage.php");
exit();
?>
