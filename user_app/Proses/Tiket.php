<?php
session_start();
require_once '../../config.php';

if (!isset($_GET['kode'])) {
    header("Location: ../pageTampilan/destinasipage.php");
    exit();
}

$kode_pemesanan = $_GET['kode'];

// Get booking details with wisata information
$sql = "SELECT p.*, w.nama_wisata, w.kota, w.provinsi 
        FROM pemesanan p 
        LEFT JOIN tujuan_wisata w ON p.id_wisata = w.id_wisata 
        WHERE p.kode_pemesanan = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kode_pemesanan);
$stmt->execute();
$tiket = $stmt->get_result()->fetch_assoc();

if (!$tiket) {
    header("Location: ../pageTampilan/destinasipage.php");
    exit();
}

// Format date
$tanggal_format = date('d/m/Y', strtotime($tiket['tgl_berangkat']));
?>
<!-- Tampilan Tiket -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tiket - TripTix</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600">TripTix</h1>
            <p class="text-gray-500">E-Ticket</p>
        </div>

        <div class="border-t border-b border-gray-200 py-4 mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Kode Booking:</span>
                <span class="font-bold"><?= htmlspecialchars($kode_pemesanan) ?></span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Status:</span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Confirmed</span>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">Nama Pemesan:</span>
                <span class="font-semibold"><?= htmlspecialchars($tiket['nama_pemesan']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Tanggal:</span>
                <span><?= $tanggal_format ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Jumlah:</span>
                <span><?= $tiket['jumlah_pesan'] ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Kode Booking:</span>
                <span class="font-mono"><?= htmlspecialchars($tiket['kode_pemesanan']) ?></span>
            </div>
        </div>

        <div class="mt-8 flex flex-col space-y-4">
            <button onclick="window.print()" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                Cetak Tiket
            </button>
            <a href="../pageTampilan/destinasipage.php" class="text-center text-blue-600 hover:underline">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
