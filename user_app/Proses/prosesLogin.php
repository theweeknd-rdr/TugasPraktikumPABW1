<?php
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

   
    $stmt = mysqli_prepare($conn, "SELECT * FROM pengguna WHERE email = ?");
    mysqli_stmt_bind_param($stmt,   "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
       
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['nama_dpn'];
            $_SESSION['namaDepan'] = $user['nama_dpn'];

            
            header("Location: ../pageTampilan/Homepage.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
} else {
   
    header("Location: loginpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login Gagal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-600 flex items-center justify-center min-h-screen">
    <div class="bg-slate-800 text-white p-6 rounded-lg shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold mb-4">Login Gagal</h1>
        <p class="mb-4"><?= htmlspecialchars($error ?? 'Terjadi kesalahan') ?></p>
        <a href="../LoginRegister/loginpage.php"
            class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kembali ke
            Login</a>
    </div>
</body>
</html>
