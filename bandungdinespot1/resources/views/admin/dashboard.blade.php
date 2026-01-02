<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Bandung Kuliner</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS (CDN Development) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Icons */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .icon-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-50 font-display transition-colors duration-200 overflow-hidden">
    <div class="flex h-screen w-full">

        <!-- Sidebar -->
        <aside
            class="w-64 flex flex-col h-full bg-white dark:bg-[#152815] border-r border-slate-200 dark:border-green-900/30 flex-shrink-0 transition-colors duration-200">
            <!-- Logo Area -->
            <div class="p-6 flex items-center gap-3">
                <div
                    class="size-10 rounded-lg bg-primary flex items-center justify-center text-background-dark font-bold text-xl select-none">
                    B
                </div>
                <div class="flex flex-col">
                    <h1 class="text-base font-bold leading-tight">Bandung Kuliner</h1>
                    <p class="text-xs text-slate-500 dark:text-green-400 font-medium">Admin Panel</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 flex flex-col gap-2 overflow-y-auto custom-scrollbar">
                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/10 dark:bg-primary/20 text-green-800 dark:text-green-300 group"
                    href="#">
                    <span class="material-symbols-outlined icon-filled">dashboard</span>
                    <span class="text-sm font-semibold">Dashboard</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-green-900/20 transition-colors group"
                    href="#">
                    <span class="material-symbols-outlined">storefront</span>
                    <span class="text-sm font-medium">Kelola Kuliner</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-green-900/20 transition-colors group"
                    href="#">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Kelola Pengguna</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-green-900/20 transition-colors group"
                    href="#">
                    <div class="relative">
                        <span class="material-symbols-outlined">verified</span>
                        <span
                            class="absolute top-0 right-0 -mt-0.5 -mr-0.5 size-2 bg-red-500 rounded-full animate-pulse"></span>
                    </div>
                    <span class="text-sm font-medium">Verifikasi Ulasan</span>
                </a>

                <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 mt-6">Sistem</p>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-green-900/20 transition-colors group"
                    href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm font-medium">Pengaturan</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-green-900/20 transition-colors group"
                    href="#">
                    <span class="material-symbols-outlined">help</span>
                    <span class="text-sm font-medium">Bantuan</span>
                </a>
            </nav>

            <!-- User Profile Bottom -->
            <div class="p-4 border-t border-slate-200 dark:border-green-900/30">
                <div
                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 dark:hover:bg-green-900/20 cursor-pointer group">
                    <div
                        class="size-9 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm select-none">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate"
                            title="{{ Auth::user()->name }}">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate">Administrator</p>
                    </div>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center text-slate-400 hover:text-red-500 transition-colors"
                            title="Keluar">
                            <span class="material-symbols-outlined text-[20px]">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-full overflow-hidden relative">

            <!-- Top Header -->
            <header
                class="flex items-center justify-between px-8 py-5 bg-background-light dark:bg-background-dark z-10 sticky top-0">
                <div class="flex flex-col">
                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                        Selamat Datang, {{ explode(' ', Auth::user()->name)[0] }}!
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Berikut adalah ringkasan performa platform
                        hari ini.</p>
                </div>
                <div class="flex items-center gap-6">
                    <!-- Search -->
                    <div
                        class="hidden md:flex items-center bg-white dark:bg-[#152815] rounded-lg border border-transparent focus-within:border-primary px-4 py-2.5 shadow-sm w-80 transition-all">
                        <span class="material-symbols-outlined text-slate-400 select-none">search</span>
                        <input
                            class="bg-transparent border-none focus:ring-0 text-sm w-full text-slate-700 dark:text-slate-200 placeholder:text-slate-400 dark:placeholder:text-slate-500 ml-2"
                            placeholder="Cari tempat, pengguna..." type="text" />
                    </div>
                    <!-- Notification -->
                    <button type="button"
                        class="relative p-2 rounded-full bg-white dark:bg-[#152815] text-slate-600 dark:text-slate-300 hover:text-primary transition-colors shadow-sm">
                        <span class="material-symbols-outlined">notifications</span>
                        <span
                            class="absolute top-2 right-2 size-2 bg-red-500 rounded-full ring-2 ring-white dark:ring-[#152815]"></span>
                    </button>
                </div>
            </header>

            <!-- Scrollable Content Area -->
            <div class="flex-1 overflow-y-auto p-8 pt-0 pb-20 custom-scrollbar">

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Stat 1 -->
                    <div
                        class="bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 flex flex-col gap-4 group hover:border-primary/50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div
                                class="p-2 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-600 dark:text-green-400 group-hover:bg-primary group-hover:text-black transition-colors">
                                <span class="material-symbols-outlined">storefront</span>
                            </div>
                            <span
                                class="flex items-center text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded-full">
                                +12% <span class="material-symbols-outlined text-[14px] ml-0.5">trending_up</span>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Total Tempat Kuliner
                            </p>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">1,240</h3>
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div
                        class="bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 flex flex-col gap-4 group hover:border-primary/50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div
                                class="p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">group</span>
                            </div>
                            <span
                                class="flex items-center text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded-full">
                                +5% <span class="material-symbols-outlined text-[14px] ml-0.5">trending_up</span>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Pengguna Terdaftar
                            </p>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">8,500</h3>
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div
                        class="bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 flex flex-col gap-4 group hover:border-primary/50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div
                                class="p-2 bg-orange-50 dark:bg-orange-900/20 rounded-lg text-orange-600 dark:text-orange-400 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">reviews</span>
                            </div>
                            <span
                                class="flex items-center text-xs font-bold text-orange-500 bg-orange-100 dark:bg-orange-900/30 px-2 py-1 rounded-full">Action
                                Needed</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Ulasan Pending</p>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">45</h3>
                        </div>
                    </div>
                    <!-- Stat 4 -->
                    <div
                        class="bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 flex flex-col gap-4 group hover:border-primary/50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div
                                class="p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600 dark:text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                            </div>
                            <span
                                class="flex items-center text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded-full">
                                +8% <span class="material-symbols-outlined text-[14px] ml-0.5">trending_up</span>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Kunjungan Harian</p>
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">1,850</h3>
                        </div>
                    </div>
                </div>

                <!-- Middle Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Analytics Chart -->
                    <div
                        class="lg:col-span-2 bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Pertumbuhan Pengguna</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Statistik 30 hari terakhir</p>
                            </div>
                            <select
                                class="bg-slate-50 dark:bg-[#1a331a] border-none text-sm font-semibold rounded-lg text-slate-700 dark:text-slate-300 focus:ring-1 focus:ring-primary py-2 pl-3 pr-8 cursor-pointer">
                                <option>30 Hari Terakhir</option>
                                <option>Minggu Ini</option>
                                <option>Tahun Ini</option>
                            </select>
                        </div>
                        <div class="relative h-64 w-full">
                            <!-- SVG Chart -->
                            <svg class="w-full h-full overflow-visible" viewbox="0 0 800 250"
                                preserveAspectRatio="none">
                                <defs>
                                    <linearGradient id="chartGradient" x1="0" x2="0" y1="0"
                                        y2="1">
                                        <stop offset="0%" stop-color="#13ec13" stop-opacity="0.2"></stop>
                                        <stop offset="100%" stop-color="#13ec13" stop-opacity="0"></stop>
                                    </linearGradient>
                                </defs>
                                <!-- Grid Lines -->
                                <line class="stroke-slate-200 dark:stroke-green-900/30" stroke-width="1"
                                    x1="0" x2="800" y1="200" y2="200"></line>
                                <line class="stroke-slate-200 dark:stroke-green-900/30" stroke-dasharray="4 4"
                                    stroke-width="1" x1="0" x2="800" y1="150" y2="150">
                                </line>
                                <line class="stroke-slate-200 dark:stroke-green-900/30" stroke-dasharray="4 4"
                                    stroke-width="1" x1="0" x2="800" y1="100" y2="100">
                                </line>
                                <line class="stroke-slate-200 dark:stroke-green-900/30" stroke-dasharray="4 4"
                                    stroke-width="1" x1="0" x2="800" y1="50" y2="50">
                                </line>

                                <!-- Graph -->
                                <path
                                    d="M0,200 C50,200 50,120 100,120 C150,120 150,160 200,160 C250,160 250,80 300,80 C350,80 350,140 400,140 C450,140 450,60 500,60 C550,60 550,100 600,100 C650,100 650,40 700,40 C750,40 750,90 800,90"
                                    fill="none" stroke="#13ec13" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="3"></path>
                                <path
                                    d="M0,200 C50,200 50,120 100,120 C150,120 150,160 200,160 C250,160 250,80 300,80 C350,80 350,140 400,140 C450,140 450,60 500,60 C550,60 550,100 600,100 C650,100 650,40 700,40 C750,40 750,90 800,90 V200 H0 Z"
                                    fill="url(#chartGradient)" opacity="0.6"></path>

                                <!-- Points -->
                                <circle cx="300" cy="80" fill="#13ec13" r="6" stroke="white"
                                    stroke-width="2" class="dark:stroke-[#152815]"></circle>
                                <circle cx="700" cy="40" fill="#13ec13" r="6" stroke="white"
                                    stroke-width="2" class="dark:stroke-[#152815]"></circle>
                            </svg>
                            <div class="flex justify-between text-xs text-slate-400 mt-4 px-2 font-medium">
                                <span>1 Nov</span><span>7 Nov</span><span>14 Nov</span><span>21 Nov</span><span>28
                                    Nov</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex flex-col gap-6">
                        <div
                            class="bg-white dark:bg-[#152815] p-6 rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Aksi Cepat</h3>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button"
                                    class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg bg-slate-50 dark:bg-green-900/20 hover:bg-primary/20 hover:text-green-700 dark:hover:text-green-200 transition-all border border-transparent hover:border-primary/30 group">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300 group-hover:text-inherit">add_business</span>
                                    <span
                                        class="text-xs font-semibold text-slate-600 dark:text-slate-300 group-hover:text-inherit text-center">Tambah
                                        Kuliner</span>
                                </button>
                                <button type="button"
                                    class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg bg-slate-50 dark:bg-green-900/20 hover:bg-primary/20 hover:text-green-700 dark:hover:text-green-200 transition-all border border-transparent hover:border-primary/30 group">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300 group-hover:text-inherit">campaign</span>
                                    <span
                                        class="text-xs font-semibold text-slate-600 dark:text-slate-300 group-hover:text-inherit text-center">Broadcast</span>
                                </button>
                                <button type="button"
                                    class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg bg-slate-50 dark:bg-green-900/20 hover:bg-primary/20 hover:text-green-700 dark:hover:text-green-200 transition-all border border-transparent hover:border-primary/30 group">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300 group-hover:text-inherit">verified_user</span>
                                    <span
                                        class="text-xs font-semibold text-slate-600 dark:text-slate-300 group-hover:text-inherit text-center">Verifikasi
                                        User</span>
                                </button>
                                <button type="button"
                                    class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg bg-slate-50 dark:bg-green-900/20 hover:bg-primary/20 hover:text-green-700 dark:hover:text-green-200 transition-all border border-transparent hover:border-primary/30 group">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300 group-hover:text-inherit">summarize</span>
                                    <span
                                        class="text-xs font-semibold text-slate-600 dark:text-slate-300 group-hover:text-inherit text-center">Laporan</span>
                                </button>
                            </div>
                        </div>

                        <!-- Important Notif -->
                        <div
                            class="bg-primary text-black p-6 rounded-xl shadow-md flex-1 flex flex-col justify-between overflow-hidden relative">
                            <div class="absolute -right-4 -top-4 size-24 rounded-full bg-white/20 blur-xl"></div>
                            <div class="absolute -left-4 -bottom-4 size-32 rounded-full bg-white/20 blur-xl"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-2 mb-3">
                                    <span
                                        class="material-symbols-outlined bg-black/10 p-1.5 rounded-lg">priority_high</span>
                                    <h3 class="text-lg font-bold">Perhatian Diperlukan</h3>
                                </div>
                                <p class="text-sm font-medium opacity-90 leading-relaxed mb-4">
                                    Ada lonjakan laporan pengguna pada ulasan "Sate Maranggi Pak Edi". Mohon segera
                                    tinjau.
                                </p>
                            </div>
                            <button type="button"
                                class="relative z-10 w-full bg-white/90 hover:bg-white text-black text-sm font-bold py-2.5 rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm">
                                Tinjau Sekarang
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section: Tables -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Pending Verification Table -->
                    <div
                        class="bg-white dark:bg-[#152815] rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 overflow-hidden">
                        <div
                            class="p-6 border-b border-slate-100 dark:border-green-900/20 flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-orange-500">pending_actions</span>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Verifikasi Tertunda</h3>
                            </div>
                            <button class="text-sm font-semibold text-primary hover:text-green-400">Lihat
                                Semua</button>
                        </div>
                        <table class="w-full text-left border-collapse">
                            <tbody class="divide-y divide-slate-100 dark:divide-green-900/20">
                                <!-- Row 1 -->
                                <tr class="hover:bg-slate-50 dark:hover:bg-green-900/10 transition-colors">
                                    <td class="p-4 pl-6">
                                        <div class="flex items-center gap-3">
                                            <!-- Lazy loaded Image -->
                                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLzGuu8FYuza7InlZ2CIuvyL2sYp7wW2rtdh0GRhd_VfMTBAW42ov_85LDzEus7UW7PaDn7KtAebDYz3BB4Y86eRcRBv6pgzMXVE85QUCGApa_CuNqg5KvHs0p0BfGocxib2oZJZCPYTBF4PBvX8xRN8Ixo_W4ruWn7OSdagXRrOlct6ySqHwgn7qEyKW4lKg5PfpdVxirR8t6Qk9sFIuZ5ysTWOwNMuiSLic7feIIICrmElwZOqaJw7GbXghVZcCB0_OxMu2ydEtw"
                                                alt="Warung Nasi Ibu Imas" loading="lazy"
                                                class="size-10 rounded-lg object-cover">
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white text-sm">Warung Nasi
                                                    Ibu Imas</p>
                                                <p class="text-xs text-slate-500">Submitted by: User123</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right pr-6">
                                        <div class="flex gap-2 justify-end">
                                            <button type="button"
                                                class="p-2 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors"
                                                title="Approve">
                                                <span class="material-symbols-outlined text-[18px]">check</span>
                                            </button>
                                            <button type="button"
                                                class="p-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors"
                                                title="Reject">
                                                <span class="material-symbols-outlined text-[18px]">close</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="hover:bg-slate-50 dark:hover:bg-green-900/10 transition-colors">
                                    <td class="p-4 pl-6">
                                        <div class="flex items-center gap-3">
                                            <!-- Lazy loaded Image -->
                                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDp0rIfR00I3lY53HRHMJa8zx7ofr_dr3GyWynZXOa2QiT-Wfe-M9bYsEX9E9VxTeo7u7p_6XfW8hAlJr9yxcqPegr_D2kqPZXspvWTbwc1-CaLoDNo3crIcPKnXeIAlEy3ryqrduemm1rVN8HO9wbepG6ZSEOqDe0W5Et34AFTsXC-toWpC5npgc0xzNxjRm2XYBCBPbCTAtJA4FMeF6Ah24rvbqJ86SsJNEgnOm_H__7qlvYqbv6EH36oJYlDnWeKP6CxayXwccfz"
                                                alt="Salad Point Dago" loading="lazy"
                                                class="size-10 rounded-lg object-cover">
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white text-sm">Salad Point
                                                    Dago</p>
                                                <p class="text-xs text-slate-500">Submitted by: HealthyEater</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right pr-6">
                                        <div class="flex gap-2 justify-end">
                                            <button type="button"
                                                class="p-2 rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors"
                                                title="Approve">
                                                <span class="material-symbols-outlined text-[18px]">check</span>
                                            </button>
                                            <button type="button"
                                                class="p-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors"
                                                title="Reject">
                                                <span class="material-symbols-outlined text-[18px]">close</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- New Registrations List -->
                    <div
                        class="bg-white dark:bg-[#152815] rounded-xl shadow-sm border border-slate-100 dark:border-green-900/20 overflow-hidden">
                        <div
                            class="p-6 border-b border-slate-100 dark:border-green-900/20 flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-500">person_add</span>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Pengguna Baru</h3>
                            </div>
                            <button class="text-sm font-semibold text-primary hover:text-green-400">Lihat
                                Semua</button>
                        </div>
                        <div class="flex flex-col">
                            <!-- Item 1 -->
                            <div
                                class="flex items-center justify-between p-4 px-6 hover:bg-slate-50 dark:hover:bg-green-900/10 transition-colors border-b border-slate-50 dark:border-green-900/10">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-300 font-bold select-none">
                                        JD</div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white text-sm">John Doe</p>
                                        <p class="text-xs text-slate-500">john@example.com</p>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-slate-400">2 min ago</span>
                            </div>
                            <!-- Item 2 -->
                            <div
                                class="flex items-center justify-between p-4 px-6 hover:bg-slate-50 dark:hover:bg-green-900/10 transition-colors border-b border-slate-50 dark:border-green-900/10">
                                <div class="flex items-center gap-3">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHe6L-5tVg9hGlUTEZSMkUYEKyP9l8gdNinBDnJTqxPjXLvKpJER4SPswhyjx8fQ_L2aE9RCA16t83i8zUlfx2hPK7PJdpisPMEyeWo_UnWe9bDI4SjgTxhBJLl6W23rckeyDBYpIUwQpIQZEFJTsgYn5Oy8kfLCYmwkEYB2mCL6ZhN9yEsdKCJ0K6qybO8FlQ9cEEvdJexbXllkkDVveqBk4lt91XK6hyNBXwzn3NU-DMyh1xZg2KH3LbK5QJDj88pCaVFhDPXKaM"
                                        alt="Sarah Wijaya" loading="lazy" class="size-10 rounded-full object-cover">
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white text-sm">Sarah Wijaya</p>
                                        <p class="text-xs text-slate-500">sarah.w@gmail.com</p>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-slate-400">15 min ago</span>
                            </div>
                            <!-- Item 3 -->
                            <div
                                class="flex items-center justify-between p-4 px-6 hover:bg-slate-50 dark:hover:bg-green-900/10 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="size-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-300 font-bold select-none">
                                        RK</div>
                                    <div>
                                        <p class="font-bold text-slate-900 dark:text-white text-sm">Ridwan Kamil KW</p>
                                        <p class="text-xs text-slate-500">kang.emil@bandung.go.id</p>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-slate-400">1 hour ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
