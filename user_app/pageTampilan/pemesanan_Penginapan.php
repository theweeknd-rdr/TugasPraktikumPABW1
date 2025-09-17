<?php
session_start();
require_once '../../config.php';

// Get penginapan details
$id_penginapan = $_GET['id_penginapan'] ?? 0;
$nama_penginapan = $_GET['nama'] ?? '';
$harga = $_GET['harga'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Generate booking code
        do {
            $kode_pemesanan = 'TRX' . rand(10000, 99999);
            $check = $conn->query("SELECT kode_pemesanan FROM pemesanan WHERE kode_pemesanan = '$kode_pemesanan'");
        } while ($check->num_rows > 0);

        // Calculate total price and nights
        $checkin = new DateTime($_POST['checkin']);
        $checkout = new DateTime($_POST['checkout']);
        $nights = $checkout->diff($checkin)->days;
        $total = $harga * $nights * $_POST['jumlah_tamu'];

        // Save booking and redirect to payment
        $sql = "INSERT INTO pemesanan (kode_pemesanan, nama_pemesan, tgl_pesan, tgl_berangkat, jumlah_pesan, total_harga, id_penginapan) 
                VALUES (?, ?, NOW(), ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssidi", 
            $kode_pemesanan,
            $_POST['nama'],
            $_POST['checkin'],
            $_POST['jumlah_tamu'],
            $total,
            $id_penginapan
        );

        if ($stmt->execute()) {
            header("Location: pembayaran.php?kode=" . $kode_pemesanan . 
                  "&nama=" . urlencode($_POST['nama']) . 
                  "&tanggal=" . urlencode($_POST['checkin']) . 
                  "&jumlah=" . $_POST['jumlah_tamu'] . 
                  "&total=" . $total);
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Penginapan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Pemesanan Penginapan</h1>

        <form action="proses-pemesanan.php" method="POST" class="space-y-4">
            <!-- Display penginapan details -->
            <div class="mb-6 p-4 bg-blue-50 rounded-xl shadow-sm">
                <h2 class="text-lg font-semibold mb-2">Detail Penginapan</h2>
                <p><span class="font-medium">Nama:</span> <?= htmlspecialchars($nama_penginapan) ?></p>
                <p><span class="font-medium">Harga per malam:</span> Rp <?= number_format($harga, 0, ',', '.') ?></p>
            </div>
            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- ID Pemesanan -->
            <div>
                <label for="id_pemesanan" class="block font-medium mb-1">ID Pemesanan</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Tipe Penginapan -->
            <div>
                <label for="tipe" class="block font-medium mb-1">Tipe Penginapan</label>
                <select id="tipe" name="tipe" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="hotel">Hotel</option>
                    <option value="villa">Villa</option>
                    <option value="guesthouse">Guest House</option>
                    <option value="resort">Resort</option>
                </select>
            </div>

            <!-- Tanggal Check-in -->
            <div>
                <label for="checkin" class="block font-medium mb-1">Tanggal Check-in</label>
                <input type="date" id="checkin" name="checkin" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Tanggal Check-out -->
            <div>
                <label for="checkout" class="block font-medium mb-1">Tanggal Check-out</label>
                <input type="date" id="checkout" name="checkout" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Jumlah Tamu -->
            <div>
                <label for="jumlah_tamu" class="block font-medium mb-1">Jumlah Tamu</label>
                <input type="number" id="jumlah_tamu" name="jumlah_tamu" min="1" max="10" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <label for="pembayaran" class="block font-medium mb-1">Metode Pembayaran</label>
                <select id="pembayaran" name="pembayaran" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Metode --</option>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="e_wallet">E-Wallet (OVO, DANA, dll)</option>
                    <option value="kartu_kredit">Kartu Kredit</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-xl shadow">
                    Pesan Penginapan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
