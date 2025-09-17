<?php
session_start();
require_once '../../config.php';

// Get transportasi details
$id_transportasi = $_GET['id_transportasi'] ?? 0;
$nama_transportasi = $_GET['nama'] ?? '';
$harga = $_GET['harga'] ?? 0;
$tujuan = $_GET['tujuan'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Generate booking code
        do {
            $kode_pemesanan = 'TRX' . rand(10000, 99999);
            $check = $conn->query("SELECT kode_pemesanan FROM pemesanan WHERE kode_pemesanan = '$kode_pemesanan'");
        } while ($check->num_rows > 0);

        // Calculate total
        $total = $harga * $_POST['jumlah'];

        // Insert booking
        $sql = "INSERT INTO pemesanan (kode_pemesanan, nama_pemesan, tgl_pesan, tgl_berangkat, 
                jumlah_pesan, total_harga, id_transportasi) 
                VALUES (?, ?, NOW(), ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssidi", 
            $kode_pemesanan,
            $_POST['nama'],
            $_POST['tanggal'],
            $_POST['jumlah'],
            $total,
            $id_transportasi
        );

        if ($stmt->execute()) {
            header("Location: pembayaran.php?" . http_build_query([
                'kode' => $kode_pemesanan,
                'nama' => $_POST['nama'],
                'tanggal' => $_POST['tanggal'],
                'jumlah' => $_POST['jumlah'],
                'total' => $total
            ]));
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
    <title>Form Pemesanan Tiket Transportasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Pemesanan Tiket</h1>

        <form method="POST" class="space-y-4">
            <input type="hidden" name="id_transportasi" value="<?= htmlspecialchars($id_transportasi) ?>">
            <!-- Display transportation details -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <p class="font-medium"><?= htmlspecialchars($nama_transportasi) ?></p>
                <p class="text-gray-600">Tujuan: <?= htmlspecialchars($tujuan) ?></p>
                <p class="text-blue-600 font-bold">Rp <?= number_format($harga, 0, ',', '.') ?></p>
            </div>

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- ID Tiket -->
            <div>
                <label for="id_tiket" class="block font-medium mb-1">ID Tiket</label>
                <input type="text" id="id_tiket" name="id_tiket" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jenis Transportasi -->
            <div>
                <label for="jenis" class="block font-medium mb-1">Jenis Transportasi</label>
                <select id="jenis" name="jenis" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih --</option>
                    <option value="bus">Bus</option>
                    <option value="kereta">Kereta</option>
                    <option value="pesawat">Pesawat</option>
                </select>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div>
                <label for="tanggal" class="block font-medium mb-1">Tanggal Keberangkatan</label>
                <input type="date" id="tanggal" name="tanggal" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jumlah Tiket -->
            <div>
                <label for="jumlah" class="block font-medium mb-1">Jumlah Tiket</label>
                <input type="number" id="jumlah" name="jumlah" min="1" max="10" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <label for="pembayaran" class="block font-medium mb-1">Metode Pembayaran</label>
                <select id="pembayaran" name="pembayaran" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-xl shadow">
                    Pesan Tiket
                </button>
            </div>
        </form>
    </div>

</body>
</html>
