<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Halaman Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

<body class="bg-slate-600">

  <!-- Navbar -->
  <nav class="bg-slate-800 p-4 shadow-lg flex justify-between items-center">
    <div class="text-white text-2xl font-bold">TripTIX</div>
    <div class="flex items-center space-x-3">
      <a href="inputMitra.html" class="text-white text-2xl"><i class="fas fa-user-circle"></i></a>
      <a href="inputMitra.html" class="text-white text-lg hover:underline">Login</a>
    </div>
  </nav>

  <!-- Main Section -->
  <main>
    <section class="min-h-screen flex items-center justify-center px-4 py-12">

      <!-- Login Container -->
      <div class="bg-slate-800 rounded-2xl shadow-lg p-5 max-w-4xl w-full flex flex-col md:flex-row animate-fade-in">

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-6">
          <h1 class="text-3xl font-bold text-white text-center mb-6">Login</h1>
          <form method="POST" class="flex flex-col space-y-4">
            <div>
              <label for="email" class="text-white font-semibold block mb-1">Username:</label>
              <input type="text" name="email" id="email" placeholder="Masukkan username"
                required class="w-full p-3 rounded-lg text-center">
            </div>

            <div>
              <label for="password" class="text-white font-semibold block mb-1">Password:</label>
              <input type="password" name="password" id="password" required
                class="w-full p-3 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full py-2 mt-4 w-full">
              Login
            </button>

            <p class="text-center text-white font-semibold mt-3">
              Belum punya akun?
              <a href="registermitra.php" class="text-blue-400 hover:text-lime-400 font-bold">Klik di sini</a>
            </p>
          </form>

          <!-- Add success message display -->
          <?php if (!empty($success)): ?>
              <div class="bg-green-500 text-white p-3 rounded-lg mb-4 text-center">
                  <?php echo htmlspecialchars($success); ?>
              </div>
          <?php endif; ?>

          <!-- Add error message display -->
          <?php if (!empty($error)): ?>
              <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-center">
                  <?php echo htmlspecialchars($error); ?>
              </div>
          <?php endif; ?>
        </div>

        <!-- Image Section -->
        <div class="w-full md:w-1/2 bg-cover bg-center rounded-2xl overflow-hidden"
          style="background-image: url('img/86ea8970-535d-40c2-8979-90cf7fcc4f65-644a3194a7e0fa085b0670a2.jpg');">
          <div class="flex flex-col justify-center items-center h-full bg-black bg-opacity-50 p-6">
            <h2 class="text-white text-2xl font-semibold text-center mb-2">Selamat Datang</h2>
            <p class="text-white text-xl font-semibold text-center">
              Di Website <br /> 
            </p>
          </div>
        </div>

      </div>

    </section>
  </main>

  <?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if (isset($_SESSION['register_success'])) {
    $success = "Pendaftaran berhasil! Silakan login.";
    unset($_SESSION['register_success']);
}

// Pindahkan proses login ke atas sebelum HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM akun_mitra WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id_akun_mitra'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: DashboardMitra.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
    $stmt->close();
}
?>

</body>
</html>
