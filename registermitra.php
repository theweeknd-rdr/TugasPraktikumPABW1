
    <?php
    session_start();
    require_once 'config.php';

    $message = '';
    $messageType = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        $email = $username . "@triptix.local";
        
        // Check existing username
        $check_query = "SELECT * FROM akun_mitra WHERE username = ? OR email = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ss", $username, $email);
        $check_stmt->execute();
        
        if ($check_stmt->get_result()->num_rows > 0) {
            $message = "Username atau email sudah digunakan!";
            $messageType = "error";
        } else {
            // Insert new mitra
            $sql = "INSERT INTO akun_mitra (username, password, email, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $password, $email, $role);
            
            if ($stmt->execute()) {
                $_SESSION['register_success'] = true;
                $message = "Pendaftaran berhasil! Mengalihkan ke halaman login...";
                $messageType = "success";
                
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'loginMitra.php';
                    }, 1500);
                </script>";
            } else {
                $message = "Error: " . $stmt->error;
                $messageType = "error";
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun Mitra</title>
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

<body>
    <section>
        <div class="min-h-screen bg-slate-600 flex items-center justify-center flex-wrap">
            <div class="bg-slate-800 flex rounded-2xl shadow-lg p-5 max-w-3xl w-full flex-col md:flex-row">
                <div class="w-full md:w-1/2 p-5">
                    <h1 class="font-bold text-white mb-9 text-center text-3xl">Daftar Mitra</h1>
                    
                    <?php if (!empty($message)): ?>
                        <div class="mb-4 p-3 rounded <?php echo $messageType === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'; ?>">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!--Form daftar-->
                    <form method="POST" class="flex flex-col space-y-3">
                        <label for="username" class="text-white font-semibold mb-2">Username :</label>
                        <input type="text" name="username" id="username" placeholder="Username mitra" required class="py-2 px-3 text-center rounded-lg">
                        
                        <label for="role" class="text-white font-semibold">Jenis Mitra :</label>
                        <select name="role" id="role" required class="py-2 px-3 text-center rounded-lg">
                            <option value="">Pilih jenis mitra</option>
                            <option value="transportasi">Transportasi</option>
                            <option value="penginapan">Penginapan</option>
                            <option value="wisata">Wisata</option>
                        </select>
                      
                        <label for="password" class="text-white font-semibold mb-2">Password :</label>
                        <input type="password" name="password" id="password" required class="py-2 px-3 text-center rounded-lg">
                        
                        <div class="flex items-center justify-center mt-2">
                            <p class="text-red-400 text-lg font-semibold flex items-center space-x-2">
                                <span>Pastikan data sudah benar !!</span>
                            </p>
                        </div>   
        
                        <div class="flex justify-center mt-4">
                            <!--Tombol Daftar-->
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full text-sm px-6 py-3 mb-4">Daftar Mitra</button>
                        </div>
                        
                        <p class="text-center text-white font-semibold mt-3">
                            Sudah punya akun?
                            <a href="loginMitra.php" class="text-blue-400 hover:text-lime-400 font-bold">Login di sini</a>
                        </p>
                    </form>
                </div>
                
                <!--gambar-->
                <div class="w-full md:w-1/2 bg-cover bg-center rounded-3xl overflow-hidden" style="background-image:url('img/86ea8970-535d-40c2-8979-90cf7fcc4f65-644a3194a7e0fa085b0670a2.jpg');">
                    <div class="p-8 flex flex-col items-center justify-center h-full bg-black bg-opacity-50">
                        <h1 class="text-center text-white font-semibold text-2xl" style="text-shadow:black 1px 2px;">Bergabung Sebagai Mitra</h1>
                        <h1 class="text-center text-white font-semibold text-2xl" style="text-shadow:black 1px 2px;">TRIpTIx <br> Purwokerto</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
