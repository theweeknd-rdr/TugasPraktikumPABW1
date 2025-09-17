<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pilih Login</title>
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
<body class="bg-slate-600 min-h-screen flex items-center justify-center">
  <div class="bg-slate-800 rounded-2xl shadow-lg p-10 max-w-xl w-full animate-fade-in text-center">
    <h1 class="text-3xl font-bold text-white mb-6">Pilih Jenis Login</h1>
    
    <div class="flex flex-col space-y-6">
      <a href="loginMitra.php"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 text-lg">
        Login sebagai Mitra
      </a>
      <a href="user_app/LoginRegister/loginpage.php"
        class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 text-lg">
        Login sebagai Pengguna
      </a>
    </div>

  
  </div>
</body>
</html>
