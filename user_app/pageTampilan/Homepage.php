<?php
session_start();
$nama_user = isset($_SESSION['namaDepan']) ? $_SESSION['namaDepan'] : null;



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TripTix</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
      animation: fadeIn 1s ease-out;
    }
  </style>
</head>
<body>

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

  <main>
    <section class="relative h-screen bg-cover bg-center bg-fixed flex items-center justify-center text-white" style="background-image: url('../img/curug-cipendok-3_169.jpeg');">
      <div class="bg-black bg-opacity-50 p-8 rounded-lg text-center">
        <h3 class="text-4xl font-bold">Pergi Bersama TripTix</h3>
        <p class="mt-4 text-lg">Temukan perjalanan terbaik dan pengalaman tak terlupakan bersama kami.</p>
      </div>
    </section>

    <section class="py-12 bg-white">
      <div class="container mx-auto">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Mau Pesan Layanan Apa?</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
          <div class="flex flex-col items-center">
            <a href="penginapanpage.php" class="flex items-center justify-center w-24 h-24 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition">
              <i class="fas fa-hotel text-3xl"></i>
            </a>
            <h3 class="mt-4 text-lg font-bold">Penginapan</h3>
          </div>
          <div class="flex flex-col items-center">
            <a href="transportasi.php" class="flex items-center justify-center w-24 h-24 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition">
              <i class="fas fa-bus text-3xl"></i>
            </a>
            <h3 class="mt-4 text-lg font-bold">Layanan Transportasi</h3>
          </div>
          <div class="flex flex-col items-center">
            <a href="destinasipage.php" class="flex items-center justify-center w-24 h-24 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 transition">
              <i class="fas fa-map-marker-alt text-3xl"></i>
            </a>
            <h3 class="mt-4 text-lg font-bold">Destinasi Wisata</h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Rekomendasi Wisata (Statik) -->
    <section class="bg-white py-16">
      <div class="max-w-screen-xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-slate-700 mb-8">Rekomendasi Wisata untuk anda</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/uploads/wisata1.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Wisata 1" />
            <div class="p-5">
              <h5 class="text-xl font-bold text-white">Nama Wisata 1</h5>
              <p class="text-white">Deskripsi singkat wisata 1.</p>
            </div>
          </div>
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/uploads/wisata2.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Wisata 2" />
            <div class="p-5">
              <h5 class="text-xl font-bold text-white">Nama Wisata 2</h5>
              <p class="text-white">Deskripsi singkat wisata 2.</p>
            </div>
          </div>
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/uploads/wisata3.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Wisata 3" />
            <div class="p-5">
              <h5 class="text-xl font-bold text-white">Nama Wisata 3</h5>
              <p class="text-white">Deskripsi singkat wisata 3.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tambahan Promo -->
    <section class="bg-white py-16">
      <div class="max-w-screen-xl mx-auto text-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/img/26-Agu-Temanggung.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Temanggung" />
            <div class="p-5">
              <p class="text-white">Air terjun Tumpak Sewa di Banyuwangi adalah salah satu destinasi wisata alam yang menakjubkan dengan pemandangan indah.</p>
            </div>
          </div>
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/img/6801bcff9bd78-air-terjun-tumpak-sewu-destinasi-wisata-memukau-di-jawa-timur_banyuwangi.jpg" class="w-full h-48 object-cover rounded-t-lg" alt="Tumpak Sewu" />
            <div class="p-5">
              <p class="text-white">Air terjun yang memukau dengan deburan air yang kuat, menciptakan pemandangan yang menenangkan di Banyuwangi.</p>
            </div>
          </div>
          <div class="bg-white border rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
            <img src="../../Proyek_TripTix/img/KEreta.png" class="w-full h-48 object-cover rounded-t-lg" alt="Kereta Api" />
            <div class="p-5">
              <p class="text-white">Nikmati perjalanan kereta api yang nyaman menuju Purwokerto sambil menikmati pemandangan indah.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-2xl font-bold mb-6">TripTix</h3>
          <p class="text-gray-400">Sahabat perjalanan anda.</p>
        </div>
        <div>
          <h4 class="font-bold mb-6">Layanan</h4>
          <ul class="space-y-4 text-gray-400">
            <li>Penginapan</li>
            <li>Transportasi</li>
            <li>Destinasi</li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-6">Kontak</h4>
          <p class="text-gray-400">Email: info@triptix.id</p>
          <p class="text-gray-400">Telepon: +62 812-3456-7890</p>
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
