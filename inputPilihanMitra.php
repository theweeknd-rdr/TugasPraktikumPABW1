<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pilihan Mitra</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .card:hover {
      transform: scale(1.05);
      transition: 0.3s;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-white to-green-100 min-h-screen flex items-center justify-center p-6">
  <!-- Back to Dashboard Button -->
  <div class="fixed top-6 left-6 z-10">
    <a href="DashboardMitra.php" 
       class="flex items-center gap-2 bg-slate-800 text-white px-4 py-2 rounded-lg hover:bg-slate-700 transition-colors shadow-lg">
      <i class="fas fa-arrow-left"></i>
      <span>Kembali ke Dashboard</span>
    </a>
  </div>

  <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-4xl text-center">
    <h2 class="text-3xl font-bold text-slate-800 mb-6">Pilih Jenis Mitra</h2>
    <p class="text-gray-600 mb-10">Silakan pilih kategori mitra yang ingin Anda daftarkan</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Transportasi -->
      <form action="InputPendaftaranMitra.php" method="GET">
        <div class="bg-blue-500 text-white rounded-xl p-8 shadow-md card cursor-pointer hover:bg-blue-600">
          <div class="text-5xl mb-4">🚌</div>
          <h3 class="text-xl font-bold mb-2">Transportasi</h3>
          <p class="mb-4 text-sm">Daftarkan mitra layanan transportasi seperti bus, travel, atau ojek wisata.</p>
          <input type="hidden" name="type" value="transportasi">
          <button type="submit" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-full hover:bg-slate-100">Pilih</button>
        </div>
      </form>

      <!-- Penginapan -->
      <form action="InputPendaftaranMitra.php" method="GET">
        <div class="bg-green-500 text-white rounded-xl p-8 shadow-md card cursor-pointer hover:bg-green-600">
          <div class="text-5xl mb-4">🏨</div>
          <h3 class="text-xl font-bold mb-2">Penginapan</h3>
          <p class="mb-4 text-sm">Daftarkan hotel, homestay, atau penginapan lain sebagai mitra kami.</p>
          <input type="hidden" name="type" value="penginapan">
          <button type="submit" class="bg-white text-green-600 font-semibold px-4 py-2 rounded-full hover:bg-slate-100">Pilih</button>
        </div>
      </form>

      <!-- Wisata -->
      <form action="InputPendaftaranMitra.php" method="GET">
        <div class="bg-yellow-500 text-white rounded-xl p-8 shadow-md card cursor-pointer hover:bg-yellow-600">
          <div class="text-5xl mb-4">🌄</div>
          <h3 class="text-xl font-bold mb-2">Wisata</h3>
          <p class="mb-4 text-sm">Daftarkan destinasi wisata atau pemandu wisata ke dalam platform kami.</p>
          <input type="hidden" name="type" value="wisata">
          <button type="submit" class="bg-white text-yellow-600 font-semibold px-4 py-2 rounded-full hover:bg-slate-100">Pilih</button>
        </div>
      </form>

    </div>
  </div>

</body>
</html>
