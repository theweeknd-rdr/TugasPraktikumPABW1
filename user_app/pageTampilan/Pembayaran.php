<?php
session_start();
require_once '../../config.php';

// Get payment parameters
$kode_pemesanan = $_GET['kode'] ?? '';
$nama = $_GET['nama'] ?? '';
$jumlah = $_GET['jumlah'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';
$total = $_GET['total'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update payment status in database
    $sql = "UPDATE pemesanan SET status_pembayaran = 'paid' WHERE kode_pemesanan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kode_pemesanan);
    
    if ($stmt->execute()) {
        // Redirect to ticket page
        header("Location: Tiket.php?kode=" . urlencode($kode_pemesanan));
        exit();
    }
}

// Validate booking exists
$sql = "SELECT * FROM pemesanan WHERE kode_pemesanan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kode_pemesanan);
$stmt->execute();
$result = $stmt->get_result();

if (!$result->fetch_assoc()) {
    header("Location: destinasipage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - TripTix</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Pembayaran Tiket</h2>
        
        <!-- Payment Details -->
        <div class="space-y-4 mb-8">
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Kode Booking:</span>
                <span class="font-semibold"><?= htmlspecialchars($kode_pemesanan) ?></span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Nama:</span>
                <span><?= htmlspecialchars($nama) ?></span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Tanggal:</span>
                <span><?= htmlspecialchars($tanggal) ?></span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span class="text-gray-600">Jumlah Tiket:</span>
                <span><?= htmlspecialchars($jumlah) ?></span>
            </div>
            <div class="flex justify-between py-2 border-b text-lg font-bold">
                <span class="text-gray-600">Total:</span>
                <span class="text-green-600">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- Payment Form -->
        <form method="POST" action="Tiket.php" class="space-y-6">
            <input type="hidden" name="kode_pemesanan" value="<?= htmlspecialchars($kode_pemesanan) ?>">
            <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                <select name="metode" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih metode pembayaran</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                    <option value="va">Virtual Account</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                Bayar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="destinasipage.php" class="text-blue-600 hover:underline">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
