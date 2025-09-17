<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pemesanan Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Pemesanan Wisata</h1>

        <form action="proses-pemesanan.php" method="POST" class="space-y-4">
            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- ID Pemesanan -->
            <div>
                <label for="id_pemesanan" class="block font-medium mb-1">ID Pemesanan</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Paket Wisata -->
            <div>
                <label for="paket" class="block font-medium mb-1">Paket Wisata</label>
                <select id="paket" name="paket" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">-- Pilih Paket --</option>
                    <option value="pantai_bali">Pantai Bali</option>
                    <option value="gunung_bromo">Gunung Bromo</option>
                    <option value="danau_toba">Danau Toba</option>
                    <option value="raja_ampat">Raja Ampat</option>
                </select>
            </div>

            <!-- Tanggal Keberangkatan -->
            <div>
                <label for="tanggal" class="block font-medium mb-1">Tanggal Keberangkatan</label>
                <input type="date" id="tanggal" name="tanggal" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Jumlah Peserta -->
            <div>
                <label for="jumlah" class="block font-medium mb-1">Jumlah Peserta</label>
                <input type="number" id="jumlah" name="jumlah" min="1" max="50" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <label for="pembayaran" class="block font-medium mb-1">Metode Pembayaran</label>
                <select id="pembayaran" name="pembayaran" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
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
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-xl shadow">
                    Pesan Wisata
                </button>
            </div>
        </form>
    </div>

</body>
</html>
