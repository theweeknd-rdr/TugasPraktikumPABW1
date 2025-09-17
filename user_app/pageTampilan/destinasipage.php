<?php
session_start();
$nama_user = isset($_SESSION['namaDepan']) ? $_SESSION['namaDepan'] : null;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Destinasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50">

  <!-- Navbar -->
  <nav class="bg-dark-blue border-slate-200 dark:bg-gray-900 sticky top-0 z-50">
    <div class="max-w-screen-xl flex flex-col md:flex-row items-center justify-between mx-auto p-4">
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="../img/LogoTripTix.jpg" class="h-10 w-full" alt="Logo" />
      </a>

      <div class="hidden md:flex md:w-auto items-center space-x-8">
        <ul class="flex flex-row font-medium p-0 mt-0 space-x-8">
          <li><a href="destinasipage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Destinasi</a></li>
          <li><a href="transportasipage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Transportasi</a></li>
          <li><a href="penginapanpage.php" class="py-2 px-3 text-white rounded hover:bg-gray-600 hover:text-yellow-400">Penginapan</a></li>
        </ul>
      </div>

      <div class="flex space-x-4 items-center mt-4 md:mt-0">
        <input type="search" class="bg-gray-800 py-2 px-4 rounded-lg text-left p-2 placeholder:font-bold focus:outline-none text-white" placeholder="Cari...." />
      </div>

      <div class="flex items-center space-x-2">
        <i class="fas fa-user-circle text-white text-2xl"></i>
        <span class="text-white text-lg"><?= htmlspecialchars($nama_user) ?></span>
        <a href="../../logout.php" class="ml-2 text-yellow-400 hover:text-yellow-600 text-sm">(Logout)</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="relative h-screen bg-cover bg-center bg-fixed flex items-center justify-center" 
    style="background-image: url('../img/curug-cipendok-3_169.jpeg');">
    <div class="bg-black bg-opacity-50 p-6 rounded-xl shadow-lg w-full max-w-4xl">
      <div class="bg-black bg-opacity-50 p-6 rounded-xl w-full max-w-5xl">
        <form class="grid grid-cols-1 sm:grid-cols-4 gap-4">
          <div>
            <label for="kota" class="text-white font-medium">Pilih Kota</label>
            <select id="kota" name="kota" class="w-full mt-1 px-3 py-2 rounded-lg">
              <option value="">-- Pilih Kota --</option>
              <option value="Purwokerto">Purwokerto</option>
              <option value="Bandung">Bandung</option>
              <option value="Yogyakarta">Yogyakarta</option>
              <option value="Jakarta">Jakarta</option>
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
    </div>
  </section>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-10">
    <!-- Judul -->
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Destinasi Populer</h1>

    <!-- Kartu Destinasi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <?php
      require_once '../../config.php';
      
      // Query untuk mengambil data wisata dengan id
      $sql = "SELECT id_wisata, nama_wisata, kota, provinsi, harga_wisata, foto FROM tujuan_wisata";
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc()): 
        // Generate clean URL-safe values
        $wisata_id = htmlspecialchars($row['id_wisata']); // Changed from 'id' to 'id_wisata'
        $nama_wisata = htmlspecialchars($row['nama_wisata']);
      ?>
      <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
        <img src="<?= $row['foto'] ?? 'https://source.unsplash.com/400x250/?tourism' ?>" 
             alt="<?= $nama_wisata ?>" 
             class="w-full h-48 object-cover">
        <div class="p-4">
          <h2 class="text-lg font-semibold text-gray-800"><?= $nama_wisata ?></h2>
          <p class="text-sm text-gray-500"><?= htmlspecialchars($row['kota']) ?>, <?= htmlspecialchars($row['provinsi']) ?></p>
          <p class="mt-2 text-blue-600 font-bold text-lg">Rp<?= number_format($row['harga_wisata'], 0, ',', '.') ?></p>
          <a href="form_pemesanan.php?id_wisata=<?= $wisata_id ?>&item=<?= urlencode($nama_wisata) ?>" 
             class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded text-center transition duration-300 mt-3">
            Pesan Sekarang
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Kategori -->
    <h2 class="text-2xl font-bold text-gray-800 mt-16 mb-6 text-center">Jelajahi Berdasarkan Kategori</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div class="bg-yellow-100 hover:bg-yellow-200 text-center py-6 rounded-lg shadow cursor-pointer">
        <p class="text-lg font-semibold text-yellow-800">Pantai</p>
      </div>
      <div class="bg-yellow-100 hover:bg-yellow-200 text-center py-6 rounded-lg shadow cursor-pointer">
        <p class="text-lg font-semibold text-yellow-800">Pegunungan</p>
      </div>
      <div class="bg-yellow-100 hover:bg-yellow-200 text-center py-6 rounded-lg shadow cursor-pointer">
        <p class="text-lg font-semibold text-yellow-800">Air Terjun</p>
      </div>
      <div class="bg-yellow-100 hover:bg-yellow-200 text-center py-6 rounded-lg shadow cursor-pointer">
        <p class="text-lg font-semibold text-yellow-800">Kota Tua</p>
      </div>
    </div>
  </main>
</body>
</html>
