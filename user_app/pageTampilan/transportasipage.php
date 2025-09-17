<?php
session_start();
$nama_user = isset($_SESSION['namaDepan']) ? $_SESSION['namaDepan'] : null;
require_once '../../config.php';

// Query untuk mengambil data transportasi
$sql = "SELECT * FROM transportasi";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transportasi - TripTix</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-dark-blue border-slate-200 dark:bg-gray-900 sticky top-0 z-50">
    <div class="max-w-screen-xl flex flex-col md:flex-row items-center justify-between mx-auto p-4">
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="../img/LogoTripTix.jpg" class="h-10 w-full" alt="Logo" />
      </a>

      <!-- Menu Navigasi -->
      <div class="hidden md:flex md:w-auto items-center space-x-8">
        <ul class="flex flex-row font-medium p-0 mt-0 space-x-8">
          <li><a href="destinasipage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Destinasi</a></li>
          <li><a href="transportasipage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Transportasi</a></li>
          <li><a href="penginapanpage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Penginapan</a></li>
        </ul>
      </div>

      <!-- Search dan User Info -->
      <div class="flex space-x-4 items-center mt-4 md:mt-0">
        <input type="search" id="search" class="bg-gray-800 py-2 px-4 rounded-lg placeholder:font-bold focus:outline-none text-white" placeholder="Cari....">
      </div>

      <div class="flex items-center space-x-2">
  <i class="fas fa-user-circle text-white text-2xl"></i>
  <span class="text-white text-lg"><?= htmlspecialchars($nama_user) ?></span>
  <a href="logout.php" class="ml-2 text-yellow-400 hover:text-yellow-600 text-sm">(Logout)</a>
</div>
  </nav>

  <!-- Hero Search Section -->
  <section class="relative h-screen bg-cover bg-center bg-fixed flex items-center justify-center" style="background-image: url('../img/curug-cipendok-3_169.jpeg');">
    <div class="bg-black bg-opacity-50 p-6 rounded-xl shadow-lg w-full max-w-4xl">
      <form class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div>
          <label class="text-white font-medium">Kota Tujuan</label>
          <select class="w-full mt-1 px-3 py-2 rounded-lg">
            <option>-- Pilih Kota Tujuan --</option>
            <option>Purwokerto</option>
            <option>Bandung</option>
            <option>Yogyakarta</option>
            <option>Jakarta</option>
          </select>
        </div>
        <div>
          <label for="checkin" class="text-white font-medium">Check-in</label>
          <input type="date" id="checkin" name="checkin" class="w-full mt-1 px-3 py-2 rounded-lg" />
        </div>
        <div>
          <label for="checkout" class="text-white font-medium">Check-out</label>
          <input type="date" id="checkout" name="checkout" class="w-full mt-1 px-3 py-2 rounded-lg" />
        </div>
        <div class="flex items-end">
          <button class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">Cari Penginapan</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Daftar Transportasi -->
  <main class="max-w-7xl mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Pilihan Transportasi</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php while($row = $result->fetch_assoc()): ?>
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-4">
            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($row['nama_mitra']) ?></h3>
            <p class="text-gray-600 text-sm mb-2"><?= htmlspecialchars($row['jenis_transportasi']) ?></p>
            <p class="text-gray-600 text-sm"><span class="font-semibold">Rute:</span> <?= htmlspecialchars($row['keberangkatan']) ?> → <?= htmlspecialchars($row['tujuan']) ?></p>
            <p class="text-gray-600 text-sm"><span class="font-semibold">Jadwal:</span> <?= htmlspecialchars($row['jadwal_berangkat']) ?></p>
            <p class="mt-2 text-blue-600 font-bold">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
            <p class="text-sm text-gray-500 mb-3"><span class="font-semibold">Kapasitas:</span> <?= htmlspecialchars($row['kapasitas']) ?> orang</p>
            <a href="Pemesanan_Transportasi.php?id_transportasi=<?= htmlspecialchars($row['id_transportasi']) ?>&nama=<?= urlencode($row['nama_mitra']) ?>&harga=<?= $row['harga'] ?>&tujuan=<?= urlencode($row['tujuan']) ?>" 
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-center transition duration-300">
                Pesan Sekarang
            </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </main>

  <!-- Modal Pemesanan -->
  <div id="modalPemesanan" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
      <button onclick="tutupModalPemesanan()" class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-2xl font-bold">×</button>
      <h3 class="text-xl font-bold mb-4">Form Pemesanan Tiket</h3>
      <form>
        <input type="hidden" id="id_transportasi" name="id_transportasi">
        <div class="mb-4">
          <label class="block font-medium">Nama Pemesan</label>
          <input type="text" name="nama" required class="w-full border border-gray-300 p-2 rounded-lg">
        </div>
        <div class="mb-4">
          <label class="block font-medium">Jumlah Tiket</label>
          <input type="number" name="jumlah" value="1" min="1" required class="w-full border border-gray-300 p-2 rounded-lg">
        </div>
        <div class="mb-4">
          <label class="block font-medium">Tanggal Berangkat</label>
          <input type="date" name="tanggal" required class="w-full border border-gray-300 p-2 rounded-lg">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Konfirmasi Pemesanan</button>
      </form>
    </div>
  </div>

  <!-- Script -->
  <script>
    function bukaModalPemesanan(idTransportasi) {
      document.getElementById('modalPemesanan').classList.remove('hidden');
      document.getElementById('id_transportasi').value = idTransportasi;
    }

    function tutupModalPemesanan() {
      document.getElementById('modalPemesanan').classList.add('hidden');
    }
  </script>

</body>
</html>
