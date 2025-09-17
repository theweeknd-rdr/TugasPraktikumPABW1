<?php
session_start();
$nama_user = isset($_SESSION['namaDepan']) ? $_SESSION['namaDepan'] : null;

// Add database connection and query
require_once '../../config.php';
$sql = "SELECT * FROM penginapan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Penginapan - TripTix</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
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

  </nav>


  <!-- Hero Search Section -->
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
  </div>
</section>


  <!-- Daftar Penginapan -->
  <main class="max-w-7xl mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Rekomendasi Penginapan</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php while($row = $result->fetch_assoc()): ?>
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="<?= $row['foto'] ?? 'https://source.unsplash.com/400x250/?hotel' ?>" alt="<?= htmlspecialchars($row['nama_penginapan']) ?>" class="w-full h-48 object-cover">
        <div class="p-4">
          <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($row['nama_penginapan']) ?></h3>
          <p class="text-gray-600 text-sm"><?= htmlspecialchars($row['alamat']) ?></p>
          <p class="mt-2 text-blue-600 font-semibold">Rp<?= number_format($row['harga_per_malam'], 0, ',', '.') ?> / malam</p>
          <a href="pemesanan_Penginapan.php?id_penginapan=<?= htmlspecialchars($row['id_penginapan']) ?>&nama=<?= urlencode($row['nama_penginapan']) ?>&harga=<?= $row['harga_per_malam'] ?>" 
             class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-center transition duration-300">
            Pesan Sekarang
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </main>

  <!-- Form Tambah Penginapan (Modal) -->
  <div id="tambahPenginapanModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
      <h3 class="text-xl font-bold mb-4">Tambah Penginapan</h3>
      <form id="tambahPenginapanForm" method="POST" enctype="multipart/form-data">
        <div>
          <label class="block mb-1 font-medium">Nama Penginapan <span class="text-red-500">*</span></label>
          <input type="text" name="nama_penginapan" required 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div>
          <label class="block mb-1 font-medium">Kota <span class="text-red-500">*</span></label>
          <input type="text" name="kota" required 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div>
          <label class="block mb-1 font-medium">Tipe Penginapan <span class="text-red-500">*</span></label>
          <select name="tipe" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" 
                  oninvalid="this.setCustomValidity('Silakan pilih tipe penginapan')" 
                  oninput="setCustomValidity('')">
            <option value="">-- Pilih Tipe Penginapan --</option>
            <option value="Hotel">Hotel</option>
            <option value="Villa">Villa</option>
            <option value="Guest House">Guest House</option>
            <option value="Homestay">Homestay</option>
          </select>
          <p class="text-xs text-gray-500 mt-1">*) Wajib dipilih</p>
        </div>
        
        <div>
          <label class="block mb-1 font-medium">Harga per Malam <span class="text-red-500">*</span></label>
          <input type="number" name="harga_per_malam" min="0" step="1000" required 
                 placeholder="Contoh: 200000" 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div>
          <label class="block mb-1 font-medium">Alamat <span class="text-red-500">*</span></label>
          <input type="text" name="alamat" required 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div>
          <label class="block mb-1 font-medium">Provinsi <span class="text-red-500">*</span></label>
          <input type="text" name="provinsi" required 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div>
          <label class="block mb-1 font-medium">Deskripsi</label>
          <textarea name="deskripsi" rows="3" 
                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500"></textarea>
        </div>
        <div class="mt-4">
          <label class="block mb-1 font-medium">Foto</label>
          <input type="file" name="foto" 
                 class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>
        <div class="mt-4">
          <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Penginapan
          </button>
        </div>
      </form>
      <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width={2} d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
<footer class="bg-gray-900 text-white py-16" id="Kontak">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-6">TripTix</h3>
                    <p class="text-gray-400"></p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Layanan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white"></a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white"></a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white"></a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Kontak</h4>
                    <div class="space-y-4">
                        <p class="text-gray-400"></p>
                        <p class="text-gray-400"></p>
                        <p class="text-gray-400">Triptix.id</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-2xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-500">&copy; 2024 TRIPTIX. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
  
</body>
</html>
