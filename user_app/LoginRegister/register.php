<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran akun</title>
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
    <nav class="bg-dark-blue border-slate-200 dark:bg-gray-900 sticky top-0 z-50">
        <div class="max-w-screen-xl flex flex-col md:flex-row items-center justify-between mx-auto p-4">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="Logo.png" class="h-8 w-full" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-white">TripTix</span>
            </a>

            <!-- Navbar -->
            <div class="hidden md:flex md:w-auto items-center space-x-8">
                <ul class="flex flex-row font-medium p-0 mt-0 space-x-8">
                    <li><a href="#beranda" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Destinasi</a></li>
                    <li><a href="LayananPublik.html" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Transportasi</a></li>
                    <li><a href="#kontak" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Penginapan</a></li>
                </ul>
            </div>
            
            <div class="flex items-center space-x-2">
                <a href="../LoginRegister/loginpage.php" class="text-white text-2xl">
                    <i class="fas fa-user-circle"></i>
                </a>
                <a href="../LoginRegister/loginpage.php" class="text-white text-lg">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <section>
    <div class="min-h-screen bg-slate-600 flex items-center justify-center flex-wrap">
        <div class="bg-slate-800 flex rounded-2xl shadow-lg p-5 max-w-3xl w-full flex-col md:flex-row">
            <div class="w-full md:w-1/2 p-5">
                <h1 class="font-bold text-white mb-4 text-center text-3xl">Daftar</h1>

                <!-- Notifikasi error email sudah terdaftar -->
                <?php if (isset($_GET['error']) && $_GET['error'] == 'email_terdaftar'): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4 text-center">
                        Email sudah terdaftar. Silakan gunakan email lain.
                    </div>
                <?php endif; ?>

                <!-- Form daftar -->
                <form action="../Proses/prosesPendaftaran.php" method="post" class="flex flex-col space-y-1 grid-cols-2 gap-2">
                    <label for="email" class="text-white font-semibold mb-2">Email :</label>
                    <input type="email" name="email" id="email" placeholder="contohemail@gmail.com" required class="py-1 px-2 text-center rounded-lg">

                    <label for="namaDepan" class="text-white font-semibold">Nama Depan :</label>
                    <input type="text" name="namaDepan" id="namaDepan" placeholder="Nama depan" required class="text-center py-1 px-2 w-full rounded-lg">

                    <label for="namaBelakang" class="text-white font-semibold">Nama Belakang :</label>
                    <input type="text" name="namaBelakang" id="namaBelakang" placeholder="Nama Belakang" class="text-center py-1 px-2 w-full rounded-lg">

                    <label for="tgllahir" class="text-white font-semibold">Tanggal Lahir :</label>
                    <input type="date" name="tgllahir" id="tgllahir" required class="text-center py-1 px-2 w-full rounded-lg">

                    <label for="password" class="text-white font-semibold mb-2">Masukan Kata Sandi baru :</label>
                    <input type="password" name="password" id="password" required class="text-center py-1 px-2 rounded-lg">

                    <div class="flex items-center justify-center mt-2">
                        <p class="text-red-400 text-lg font-semibold flex items-center space-x-2">
                            <span>Pastikan data sudah benar !!</span>
                        </p>
                    </div>

                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full text-sm px-4 py-2 mb-4">Daftar</button>
                    </div>

                    <p class="text-center text-white font-bold">Sudah punya akun?
                        <a class="text-blue-500 font-semibold hover:text-lime-400" href="../LoginRegister/loginpage.php">Klik disini</a>
                    </p>
                </form>
            </div>

            <!-- Gambar -->
            <div class="w-full md:w-1/2 bg-cover bg-center rounded-3xl overflow-hidden" style="background-image:url('img/86ea8970-535d-40c2-8979-90cf7fcc4f65-644a3194a7e0fa085b0670a2.jpg');">
                <div class="p-8 flex flex-col items-center justify-center h-full bg-black bg-opacity-50">
                    <h1 class="text-center text-white font-semibold text-2xl">Daftar TripTix</h1>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>
