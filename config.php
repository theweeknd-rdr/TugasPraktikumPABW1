<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_triptix2";

// Set timeout yang lebih lama
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

// Coba koneksi dengan mysqli
$conn = mysqli_init();
if (!$conn) {
    die("mysqli_init failed");
}

// Set opsi koneksi
mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 300);

// Buat koneksi
if (!mysqli_real_connect($conn, $host, $user, $pass, $db)) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set wait_timeout dan interactive_timeout
mysqli_query($conn, "SET SESSION wait_timeout=300");
mysqli_query($conn, "SET SESSION interactive_timeout=300");

// Fungsi untuk mengecek dan memulihkan koneksi
function check_connection($conn) {
    if (!mysqli_ping($conn)) {
        // Coba reconnect jika koneksi terputus
        mysqli_close($conn);
        $conn = mysqli_init();
        mysqli_real_connect($conn, $GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
    }
    return $conn;
}
?>
