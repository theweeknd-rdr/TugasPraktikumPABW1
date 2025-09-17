<?php
session_start();
require_once 'config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: loginMitra.php");
    exit();
}

// Get user data
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$username = $_SESSION['username'];

// Update queries to use correct table names
$tickets_sold = 0;
$total_users = 0;
$monthly_revenue = 0;

// Get statistics based on role
$sql = ''; // Initialize $sql variable
switch($role) {
    case 'transportasi':
        $sql = "SELECT COUNT(*) as total FROM pemesanan_transportasi pt 
                JOIN transportasi t ON pt.id_transportasi = t.id_transportasi
                JOIN perusahaan_transportasi pt2 ON t.id_perusahaan = pt2.id_perusahaan
                WHERE pt2.id_akun_mitra = ?";
        break;
    case 'penginapan':
        $sql = "SELECT COUNT(*) as total FROM penginapan p 
                JOIN perusahaan_penginapan pp ON p.id_penginapan_perusahaan = pp.id_penginapan_perusahaan
                WHERE pp.id_akun_mitra = ?";
        break;
    case 'wisata':
        $sql = "SELECT COUNT(*) as total FROM tujuan_wisata tw 
                JOIN pengelola_wisata pw ON tw.id_wisata = pw.id_wisata
                WHERE pw.id_akun_mitra = ?";
        break;
    default:
        $sql = "SELECT 0 as total"; // Default query if role doesn't match
}

// Only execute if SQL query is not empty
if (!empty($sql)) {
    if ($sql !== "SELECT 0 as total") {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($sql);
    }
    $total_items = $result->fetch_assoc()['total'];
} else {
    $total_items = 0;
}

// Get total registered users (if needed)
$sql = "SELECT COUNT(*) as total FROM pengguna";
$result = $conn->query($sql);
$total_users = $result->fetch_assoc()['total'];

// Get recent orders based on role
$recent_orders_sql = "SELECT pt.*, p.nama_dpn, p.nama_blkg, t.tujuan, pt.created_at, 'success' as status 
                      FROM pemesanan_transportasi pt
                      LEFT JOIN pengguna p ON pt.id_user = p.id_user
                      JOIN transportasi t ON pt.id_transportasi = t.id_transportasi
                      JOIN perusahaan_transportasi ptr ON t.id_perusahaan = ptr.id_perusahaan
                      WHERE ptr.id_akun_mitra = ?
                      ORDER BY pt.created_at DESC LIMIT 3";
$stmt = $conn->prepare($recent_orders_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$recent_orders = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard TripTIX</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

  <!-- Sidebar -->
  
  <div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-72 bg-slate-900 text-white flex flex-col p-5">
      <h1 class="text-2xl font-bold mb-10">TripTIX</h1>
      <div class="bg-slate-800 p-4 rounded-lg shadow mb-6">
        <p class="text-sm text-gray-300">Selamat datang,</p>
        <p class="font-semibold break-words"><?php echo htmlspecialchars($username); ?></p>
      </div>

      <nav class="flex-1 space-y-2">
        <a href="DashboardMitra.php" class="hover:bg-slate-700 p-2 rounded flex items-center space-x-2">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
         </a>
  
        <a href="#" class="hover:bg-slate-700 p-2 rounded flex items-center space-x-2">
          <i class="fas fa-ticket-alt"></i>
          <span>Pemesanan Tiket</span>
        </a>
        <a href="#" class="hover:bg-slate-700 p-2 rounded flex items-center space-x-2">
          <i class="fas fa-history"></i>
          <span>Riwayat</span>
        </a>
        <a href="#" class="hover:bg-slate-700 p-2 rounded flex items-center space-x-2">
          <i class="fas fa-users"></i>
          <span>Manajemen User</span>
        </a>
         <a href="logout.php" class="hover:bg-red-700 p-2 rounded flex items-center space-x-2 mt-auto">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      <div class="mt-auto text-center text-gray-400 text-xs">
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
      <h2 class="text-3xl font-bold mb-6 text-slate-800">
        Selamat Datang <?php echo htmlspecialchars($username); ?> di Dashboard TripTIX
      </h2>

      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
          <div class="text-slate-700 font-bold text-lg mb-2">Total Tiket Terjual</div>
          <div class="text-3xl font-bold text-blue-600"><?php echo number_format($tickets_sold); ?></div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
          <div class="text-slate-700 font-bold text-lg mb-2">Pengguna Terdaftar</div>
          <div class="text-3xl font-bold text-green-600"><?php echo number_format($total_users); ?></div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
          <div class="text-slate-700 font-bold text-lg mb-2">Pendapatan Bulan Ini</div>
          <div class="text-3xl font-bold text-purple-600">Rp <?php echo number_format($monthly_revenue, 0, ',', '.'); ?></div>
        </div>
      </div>

      <!-- Table (Riwayat) -->
      <div class="mt-10 bg-white p-6 rounded-xl shadow">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Riwayat Pemesanan Terbaru</h3>
        <div class="overflow-x-auto">
          <table class="min-w-full border text-center text-sm">
            <thead class="bg-slate-200 text-slate-800">
              <tr>
                <th class="p-2">#</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Tujuan</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($recent_orders->num_rows > 0) {
                $i = 1;
                while($row = $recent_orders->fetch_assoc()) {
                  echo "<tr class='border-t'>";
                  echo "<td class='p-2'>".$i."</td>";
                  echo "<td class='p-2'>".htmlspecialchars($row['nama_dpn'].' '.$row['nama_blkg'])."</td>";
                  echo "<td class='p-2'>".htmlspecialchars($row['tujuan'])."</td>";
                  echo "<td class='p-2'>".date('Y-m-d', strtotime($row['created_at']))."</td>";
                  echo "<td class='p-2 text-green-600 font-semibold'>".htmlspecialchars($row['status'])."</td>";
                  echo "</tr>";
                  $i++;
                }
              } else {
                echo "<tr class='border-t'>";
                echo "<td colspan='5' class='p-2 text-center'>Tidak ada riwayat pemesanan</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
           <div class="mt-6 text-left">
            <a href="inputPilihanMitra.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded transition">
              <i class="fas fa-plus mr-2"></i>Input Data Mitra
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
