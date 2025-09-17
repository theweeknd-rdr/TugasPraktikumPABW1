<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Halaman Login</title>
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
            <img src="Logo.png" class="h-8 w-full" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-white">TripTix</span>
        </a>
        <div class="hidden md:flex md:w-auto items-center space-x-8">
            <ul class="flex flex-row font-medium p-0 mt-0 space-x-8">
                <li><a href="#beranda" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Destinasi</a></li>
                <li><a href="LayananPublik.html" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Transportasi</a></li>
                <li><a href="#kontak" class="py-2 px-3 text-white rounded hover:bg-gray-600 dark:text-white hover:text-yellow-400">Penginapan</a></li>
            </ul>
        </div>
        <div class="flex items-center space-x-2">
            <a href="loginpage.html" class="text-white text-2xl">
                <i class="fas fa-user-circle"></i>
            </a>
            <a href="loginpage.html" class="text-white text-lg">
                Login
            </a>
        </div>
    </div>
</nav>

<main>
<section class="bg-slate-600 min-h-screen flex items-center justify-center flex-wrap">
    <div class="bg-slate-800 flex rounded-2xl shadow-lg p-5 max-w-3xl w-full flex-col md:flex-row">
        <div class="w-full md:w-1/2 p-5">
            <h1 class="font-bold text-white mb-9 text-center text-3xl">Login</h1>
            <form action="../Proses/prosesLogin.php" method="post" class="flex flex-col space-y-2">
                <label for="email" class="text-white font-semibold mb-2">Email :</label>
                <input type="email" name="email" id="email" placeholder="contohemail@gmail.com" required
                    class="rounded-lg p-3 w-full text-center" />
                <label for="password" class="text-white font-semibold mb-2">Password:</label>
                <input type="password" name="password" id="password" required
                    class="rounded-lg p-3 w-full text-center" />
                <div class="flex flex-col mt-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full text-sm px-4 py-2 mb-4 w-20">Login</button>
                    <p class="text-center text-white font-bold">Belum punya akun ?
                        <a class="text-blue-500 font-semibold hover:text-lime-400" href="../LoginRegister/register.php">Klik disini</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-cover bg-center rounded-3xl overflow-hidden"
            style="background-image:url('img/86ea8970-535d-40c2-8979-90cf7fcc4f65-644a3194a7e0fa085b0670a2.jpg');">
            <div class="p-8 flex flex-col items-center justify-center h-full bg-black bg-opacity-50">
                <h1 class="text-center text-white font-semibold text-2xl" style="text-shadow:black 1px 2px;">TripTix</h1>
            </div>
        </div>
    </div>
</section>
</main>
</body>
</html>
