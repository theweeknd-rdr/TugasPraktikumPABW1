<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: loginMitra.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$jenisMitra = isset($_GET['type']) ? $_GET['type'] : '';
$formTitle = "Pendaftaran Mitra " . ucfirst($jenisMitra);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($jenisMitra) {
        case 'transportasi':
            // Check if user exists in perusahaan_transportasi
            $check_sql = "SELECT id_perusahaan FROM perusahaan_transportasi WHERE id_akun_mitra = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("i", $_SESSION['user_id']);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows === 0) {
                // Insert into perusahaan_transportasi first
                $insert_perusahaan = "INSERT INTO perusahaan_transportasi (id_akun_mitra, nama_perusahaan) VALUES (?, ?)";
                $stmt_perusahaan = $conn->prepare($insert_perusahaan);
                $stmt_perusahaan->bind_param("is", $_SESSION['user_id'], $_SESSION['namaDepan']);
                
                if (!$stmt_perusahaan->execute()) {
                    $message = "Error: Gagal mendaftarkan perusahaan transportasi: " . $stmt_perusahaan->error;
                    break;
                }
                $id_perusahaan = $conn->insert_id;
            } else {
                $row = $result->fetch_assoc();
                $id_perusahaan = $row['id_perusahaan'];
            }

            // Now proceed with transportasi insertion
            $sql = "INSERT INTO transportasi (jenis_transportasi, nama_mitra, jadwal_berangkat, harga, 
                    kapasitas, keberangkatan, tujuan, id_perusahaan, IdNoPolKen, Waktu_tiba) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssisssss", 
                $_POST['jenis_transportasi'],
                $_POST['nama_mitra'],
                $_POST['jadwal_berangkat'],
                $_POST['harga'],
                $_POST['kapasitas'],
                $_POST['keberangkatan'],
                $_POST['tujuan'],
                $id_perusahaan,
                $_POST['IdNoPolKen'],
                $_POST['Waktu_tiba']
            );
            break;

        case 'penginapan':
            // First check if user exists in akun_mitra
            $check_akun = "SELECT id_akun_mitra FROM akun_mitra WHERE id_akun_mitra = ?";
            $stmt_akun = $conn->prepare($check_akun);
            $stmt_akun->bind_param("i", $_SESSION['user_id']);
            $stmt_akun->execute();
            $result_akun = $stmt_akun->get_result();
            
            if ($result_akun->num_rows === 0) {
                $message = "Error: Akun mitra tidak ditemukan. Silahkan daftar sebagai mitra terlebih dahulu.";
                break;
            }

            // Then check if user exists in perusahaan_penginapan
            $check_sql = "SELECT id_penginapan_perusahaan FROM perusahaan_penginapan WHERE id_akun_mitra = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("i", $_SESSION['user_id']);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows === 0) {
                // User not found in perusahaan_penginapan, insert them first
                $insert_perusahaan = "INSERT INTO perusahaan_penginapan (id_akun_mitra, nama_perusahaan) VALUES (?, ?)";
                $stmt_perusahaan = $conn->prepare($insert_perusahaan);
                $stmt_perusahaan->bind_param("is", $_SESSION['user_id'], $_SESSION['namaDepan']);
                
                if (!$stmt_perusahaan->execute()) {
                    $message = "Error: Gagal mendaftarkan perusahaan penginapan: " . $stmt_perusahaan->error;
                    break;
                }
                $id_penginapan_perusahaan = $conn->insert_id;
            } else {
                $row = $result->fetch_assoc();
                $id_penginapan_perusahaan = $row['id_penginapan_perusahaan'];
            }

            // Now proceed with penginapan insertion
            $sql = "INSERT INTO penginapan (nama_penginapan, tipe, harga_per_malam, alamat, kota, provinsi, id_penginapan_perusahaan) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $harga = floatval($_POST['harga_per_malam']);
            $stmt->bind_param("ssdsisi", 
                $_POST['nama_penginapan'],
                $_POST['tipe'],
                $harga,
                $_POST['alamat'],
                $_POST['kota'],
                $_POST['provinsi'],
                $id_penginapan_perusahaan
            );
            break;

        case 'wisata':
            $sql = "INSERT INTO tujuan_wisata (nama_wisata, harga_wisata, lokasi, jalan, kota, provinsi) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdssss", 
                $_POST['nama_wisata'],
                $_POST['harga_wisata'],
                $_POST['lokasi'],
                $_POST['jalan'],
                $_POST['kota'],
                $_POST['provinsi']
            );
            break;
    }

    if (isset($stmt)) {
        if ($stmt->execute()) {
            $message = "Data berhasil disimpan!";
            // Redirect ke dashboard setelah 2 detik
            echo "<script>
                alert('Data berhasil disimpan!');
                setTimeout(function() {
                    window.location.href = 'DashboardMitra.php';
                }, 2000);
            </script>";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pendaftaran Mitra</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-teal-50 via-white to-teal-100 min-h-screen flex items-center justify-center p-6">

  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl p-10 border border-teal-200 relative">
    
    <!-- Lencana -->
    <div class="absolute top-4 right-4 bg-teal-600 text-white text-xs px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
      Mitra TripTIX
    </div>

    <!-- Judul -->
    <h2 class="text-4xl font-extrabold text-teal-700 mb-6 text-center"><?php echo $formTitle; ?></h2>
    <p class="text-center text-gray-500 mb-10">Silakan isi informasi <?php echo $jenisMitra; ?> Anda di bawah ini</p>

    <?php if (!empty($message)): ?>
    <div class="mb-6 p-4 rounded-lg <?php echo strpos($message, 'Error') === false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>

   

    <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8" enctype="multipart/form-data">
      <?php if ($jenisMitra === 'transportasi'): ?>
        <!-- Form Transportasi -->
        <div>
          <label class="block mb-1 font-medium">Nama Mitra</label>
          <input type="text" name="nama_mitra" placeholder="Nama Mitra" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Jenis Kendaraan</label>
          <select name="jenis_transportasi" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500">
            <option value="" disabled selected>Pilih jenis kendaraan</option>
            <option value="Bus">Bus</option>
            <option value="Travel">Travel</option>
            <option value="Kereta">Kereta</option>
            <option value="Pesawat">Pesawat</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-medium">Waktu Keberangkatan</label>
          <input type="datetime-local" name="jadwal_berangkat" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Lokasi Keberangkatan</label>
          <input type="text" name="keberangkatan" placeholder="Contoh: Terminal A" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Kapasitas</label>
          <input type="number" name="kapasitas" placeholder="Contoh: 45" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Lokasi Tujuan</label>
          <input type="text" name="tujuan" placeholder="Contoh: Terminal B" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Harga Tiket</label>
          <input type="number" name="harga" placeholder="Contoh: 100000" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Waktu Tiba</label>
          <input type="datetime-local" name="Waktu_tiba" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">ID / NoPol Kendaraan</label>
          <input type="text" name="IdNoPolKen" placeholder="Contoh: B 1234 ABC" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <!-- Upload Gambar -->
        <div>
          <label class="block mb-1 font-medium">Foto Kendaraan</label>
          <input type="file" name="foto" accept="image/*" class="w-full p-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-700" />
        </div>

      <?php elseif ($jenisMitra === 'penginapan'): ?>
        <!-- Form Penginapan -->
        <div>
          <label class="block mb-1 font-medium">Nama Penginapan</label>
          <input type="text" name="nama_penginapan" placeholder="Nama Penginapan" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Tipe Penginapan</label>
          <select name="tipe" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500">
            <option value="" disabled selected>Pilih tipe penginapan</option>
            <option value="Hotel">Hotel</option>
            <option value="Homestay">Homestay</option>
            <option value="Villa">Villa</option>
            <option value="Guest House">Guest House</option>
          </select>
        </div>

        <div>
          <label class="block mb-1 font-medium">Alamat</label>
          <input type="text" name="alamat" placeholder="Alamat lengkap penginapan" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Kota</label>
          <input type="text" name="kota" placeholder="Kota" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Provinsi</label>
          <input type="text" name="provinsi" placeholder="Provinsi" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Harga per Malam</label>
          <input type="number" name="harga_per_malam" placeholder="Contoh: 200000" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div class="md:col-span-2">
          <label class="block mb-1 font-medium">Foto Penginapan</label>
          <input type="file" name="foto" accept="image/*" class="w-full p-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-700" />
        </div>
        
      <?php elseif ($jenisMitra === 'wisata'): ?>
        <!-- Form Wisata -->
        <div>
            <label class="block mb-1 font-medium">Nama Tempat Wisata <span class="text-red-500">*</span></label>
            <input type="text" name="nama_wisata" required 
                   placeholder="Nama Tempat Wisata" 
                   class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
            <label class="block mb-1 font-medium">Lokasi Wisata <span class="text-red-500">*</span></label>
            <input type="text" name="lokasi" required 
                   placeholder="Detail lokasi wisata" 
                   class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
            <label class="block mb-1 font-medium">Alamat Jalan <span class="text-red-500">*</span></label>
            <input type="text" name="jalan" required 
                   placeholder="Alamat lengkap jalan" 
                   class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
            <label class="block mb-1 font-medium">Harga Tiket <span class="text-red-500">*</span></label>
            <input type="number" name="harga_wisata" required
                   min="0" step="1000"
                   placeholder="Contoh: 15000"
                   class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Kota</label>
          <input type="text" name="kota" placeholder="Kota" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <div>
          <label class="block mb-1 font-medium">Provinsi</label>
          <input type="text" name="provinsi" placeholder="Provinsi" required class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500" />
        </div>

        <!-- Upload Foto Wisata -->
        <div class="md:col-span-2">
            <label class="block mb-1 font-medium">Foto Wisata <span class="text-red-500">*</span></label>
            <input type="file" 
                   name="foto" 
                   accept="image/*" 
                   required
                   class="w-full p-2 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-700" />
            <p class="mt-1 text-sm text-gray-500">Upload foto wisata (Maks. 2MB, format: JPG, PNG)</p>
        </div>

        <!-- Add validation message -->
        <div class="md:col-span-2">
            <p class="text-sm text-gray-500">* Semua field dengan tanda bintang wajib diisi</p>
        </div>
      <?php endif; ?>
      <!-- Deskripsi -->
      <div class="md:col-span-2">
        <label class="block mb-2 font-medium text-gray-700">Deskripsi Tambahan</label>
        <textarea 
          name="deskripsi" 
          rows="4" 
          placeholder="Tulis informasi tambahan yang perlu diketahui..." 
          class="w-full p-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 resize-none transition"
        ></textarea>
      </div>

      <!-- Form Actions -->
      <div class="md:col-span-2">
        <div class="border-t border-gray-200 pt-6 mt-6">
          <div class="flex flex-col-reverse sm:flex-row sm:justify-between sm:space-x-4">
            <a href="DashboardMitra.php" 
               class="mt-3 sm:mt-0 inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
              <i class="fas fa-arrow-left mr-2"></i>
              Kembali ke Dashboard
            </a>
            
            <button type="submit" 
                    class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-colors duration-200">
              <i class="fas fa-paper-plane mr-2"></i>
              Kirim Pendaftaran
            </button>
          </div>
        </div>
      </div>
    </form>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-500">
      <p>&copy; <?php echo date('Y'); ?> TripTIX. All rights reserved.</p>
    </div>
  </div>
</body>
</html>
