<?php
session_start();
require_once '../../config.php';

$kode_pemesanan = $_GET['kode'] ?? null;

if (!$kode_pemesanan) {
    header("Location: destinasipage.php");
    exit();
}

// Get complete booking details
$sql = "SELECT p.*, w.nama_wisata, w.lokasi, w.kota, w.provinsi,
               t.nama_mitra, t.jenis_transportasi, t.keberangkatan, t.tujuan,
               h.nama_penginapan, h.tipe
        FROM pemesanan p 
        LEFT JOIN tujuan_wisata w ON p.id_wisata = w.id_wisata
        LEFT JOIN transportasi t ON p.id_transportasi = t.id_transportasi
        LEFT JOIN penginapan h ON p.id_penginapan = h.id_penginapan
        WHERE p.kode_pemesanan = ? AND p.status_pembayaran = 'paid'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kode_pemesanan);
$stmt->execute();
$tiket = $stmt->get_result()->fetch_assoc();

if (!$tiket) {
    header("Location: destinasipage.php");
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
            <!-- Common ticket details -->
            <div class="flex justify-between">
                <span class="text-gray-600">Nama Pemesan:</span>
                <span class="font-semibold"><?= htmlspecialchars($tiket['nama_pemesan']) ?></span>
            </div>
            
            <!-- Show relevant details based on booking type -->
            <?php if ($tiket['nama_mitra']): ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Transportasi:</span>
                    <span><?= htmlspecialchars($tiket['nama_mitra']) ?> (<?= htmlspecialchars($tiket['jenis_transportasi']) ?>)</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Rute:</span>
                    <span><?= htmlspecialchars($tiket['keberangkatan']) ?> → <?= htmlspecialchars($tiket['tujuan']) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($tiket['nama_wisata']): ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Wisata:</span>
                    <span><?= htmlspecialchars($tiket['nama_wisata']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Lokasi:</span>
                    <span><?= htmlspecialchars($tiket['lokasi']) ?></span>
                </div>
            <?php endif; ?>

            <?php if ($tiket['nama_penginapan']): ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Penginapan:</span>
                    <span><?= htmlspecialchars($tiket['nama_penginapan']) ?> (<?= htmlspecialchars($tiket['tipe']) ?>)</span>
                </div>
            <?php endif; ?>
            
            <!-- Common ticket footer -->
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
