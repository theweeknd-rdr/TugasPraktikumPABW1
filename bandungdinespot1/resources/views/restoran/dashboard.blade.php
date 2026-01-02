<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Pemilik - {{ config('app.name', 'BandungDinespot') }}</title>

    <!-- Fonts: Preconnect untuk performa load lebih cepat -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Icons: Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Catatan: Untuk Production, sangat disarankan menggunakan 'npm run build' (Vite) untuk mengurangi beban server dan ukuran file -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "primary-dark": "#0eb60e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                        "surface-light": "#ffffff",
                        "surface-dark": "#162e16",
                        "text-main": "#0d1b0d",
                        "text-muted": "#4c9a4c",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                    },
                },
            },
        }
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease;
        }

        /* Utility untuk menyembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Avatar optimization */
        .avatar-initial {
            background: linear-gradient(135deg, #13ec13 0%, #0eb60e 100%);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-main dark:text-white font-display flex h-screen overflow-hidden antialiased selection:bg-primary/30"
    x-data="{
        currentPage: localStorage.getItem('restoranCurrentPage') || 'dashboard',
        sidebarOpen: false
    }" x-init="$watch('currentPage', value => localStorage.setItem('restoranCurrentPage', value))">

    <!-- Overlay Mobile -->
    <div id="mobile-overlay" @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/50 lg:hidden transition-opacity"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed lg:static inset-y-0 left-0 z-30 w-72 transform transition-transform duration-300 ease-in-out flex flex-col border-r border-[#cfe7cf] dark:border-white/10 bg-surface-light dark:bg-surface-dark h-full"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <div class="flex flex-col h-full justify-between p-4">
            <div class="flex flex-col gap-6">
                <!-- Profil Sidebar -->
                <div class="flex items-center gap-3 px-2 mt-2">
                    <!-- Avatar Inisial (Dinamis & Optimized) -->
                    <div
                        class="flex items-center justify-center shrink-0 rounded-full size-12 shadow-sm border-2 border-primary/20 avatar-initial text-white font-bold text-xl uppercase select-none">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex flex-col overflow-hidden flex-1 min-w-0">
                        <h1 class="text-text-main dark:text-white text-base font-bold leading-tight truncate"
                            title="{{ Auth::user()->name }}">
                            {{ Auth::user()->name }}
                        </h1>
                        <p class="text-text-muted dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                            Pemilik
                        </p>
                    </div>
                    <!-- Tombol Close Mobile -->
                    <button @click="sidebarOpen = false"
                        class="lg:hidden shrink-0 p-1 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                        aria-label="Tutup Menu">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <!-- Navigasi -->
                <nav class="flex flex-col gap-1 overflow-y-auto max-h-[calc(100vh-250px)] no-scrollbar">
                    <a @click.prevent="currentPage = 'dashboard'; sidebarOpen = false"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg group transition-colors cursor-pointer"
                        :class="currentPage === 'dashboard' ? 'bg-[#e7f3e7] dark:bg-primary/20' :
                            'hover:bg-gray-100 dark:hover:bg-white/5'"
                        href="#">
                        <span class="material-symbols-outlined"
                            :class="currentPage === 'dashboard' ? 'text-text-main dark:text-primary' :
                                'text-gray-500 dark:text-gray-400 group-hover:text-primary'">dashboard</span>
                        <p class="text-sm font-medium"
                            :class="currentPage === 'dashboard' ? 'text-text-main dark:text-white font-semibold' :
                                'text-gray-700 dark:text-gray-300'">
                            Dashboard</p>
                    </a>

                    <a @click.prevent="currentPage = 'profile'; sidebarOpen = false"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg group transition-colors cursor-pointer"
                        :class="currentPage === 'profile' ? 'bg-[#e7f3e7] dark:bg-primary/20' :
                            'hover:bg-gray-100 dark:hover:bg-white/5'"
                        href="#">
                        <span class="material-symbols-outlined"
                            :class="currentPage === 'profile' ? 'text-text-main dark:text-primary' :
                                'text-gray-500 dark:text-gray-400 group-hover:text-primary'">storefront</span>
                        <p class="text-sm font-medium"
                            :class="currentPage === 'profile' ? 'text-text-main dark:text-white font-semibold' :
                                'text-gray-700 dark:text-gray-300'">
                            Profil Restoran</p>
                    </a>

                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="{{ route('restoran.reservasi-kedatangan') }}">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">event_available</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Kelola Reservasi &amp;
                            Kedatangan</p>
                    </a>

                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors group"
                        href="#">
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-primary transition-colors">restaurant_menu</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Manajemen Menu</p>
                    </a>

                    <a @click.prevent="currentPage = 'payment'; sidebarOpen = false"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg group transition-colors cursor-pointer"
                        :class="currentPage === 'payment' ? 'bg-[#e7f3e7] dark:bg-primary/20' :
                            'hover:bg-gray-100 dark:hover:bg-white/5'"
                        href="#">
                        <span class="material-symbols-outlined"
                            :class="currentPage === 'payment' ? 'text-text-main dark:text-primary' :
                                'text-gray-500 dark:text-gray-400 group-hover:text-primary'">payments</span>
                        <p class="text-sm font-medium"
                            :class="currentPage === 'payment' ? 'text-text-main dark:text-white font-semibold' :
                                'text-gray-700 dark:text-gray-300'">
                            Pembayaran</p>
                    </a>

                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors group"
                        href="#">
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 group-hover:text-primary transition-colors">reviews</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Ulasan</p>
                    </a>
                </nav>
            </div>

            <div class="flex flex-col gap-4">
                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="group flex w-full cursor-pointer items-center justify-center rounded-lg h-11 px-4 bg-primary hover:bg-primary-dark transition-all text-text-main text-sm font-bold tracking-[0.015em] shadow-sm shadow-green-200 dark:shadow-none active:scale-[0.98]">
                        <span
                            class="material-symbols-outlined text-[20px] mr-2 group-hover:-translate-x-1 transition-transform">logout</span>
                        <span class="truncate">Keluar</span>
                    </button>
                </form>

                <div class="flex flex-col gap-1 border-t border-[#cfe7cf] dark:border-white/10 pt-4">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="{{ route('profile.edit') }}">
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px]">settings</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pengaturan</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px]">help</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Bantuan</p>
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto relative scroll-smooth w-full">
        <!-- DASHBOARD CONTENT -->
        <div x-show="currentPage === 'dashboard'" x-transition
            class="max-w-[1200px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">
            <!-- Header -->
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10 sticky top-0 bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm z-10 pt-2">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <!-- Tombol Hamburger Mobile -->
                        <button type="button" @click="sidebarOpen = true"
                            class="lg:hidden p-2 -ml-2 mr-2 text-gray-600 hover:bg-gray-100 rounded-md">
                            <span class="material-symbols-outlined">menu</span>
                        </button>

                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20 select-none">
                            Terverifikasi
                        </span>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50 select-none">
                            Buka
                        </span>
                    </div>
                    <h1
                        class="text-text-main dark:text-white text-2xl md:text-3xl lg:text-4xl font-black tracking-tight">
                        Dashboard Pemilik
                    </h1>
                    <p class="text-text-muted dark:text-gray-400 text-sm md:text-base">
                        Halo, {{ Auth::user()->name }}! Kelola bisnis Anda di sini.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button"
                        class="hidden md:flex items-center justify-center h-10 w-10 rounded-full bg-surface-light dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors relative">
                        <span class="material-symbols-outlined">notifications</span>
                        <!-- Notification Dot -->
                        <span class="absolute top-2 right-2.5 h-2 w-2 rounded-full bg-red-500"></span>
                    </button>
                    <button type="button"
                        class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary hover:opacity-90 active:scale-95 transition-all text-text-main text-sm font-bold shadow-sm">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                        <span>Simpan Semua</span>
                    </button>
                </div>
            </header>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Card 1 -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-text-main dark:text-white">Rp 12.500.000</p>
                    </div>
                    <div class="bg-[#e7f3e7] dark:bg-primary/20 p-3 rounded-lg text-green-700 dark:text-primary">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Total Pesanan</p>
                        <p class="text-2xl font-bold text-text-main dark:text-white">1,248</p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Rating Rata-rata</p>
                        <div class="flex items-baseline gap-1">
                            <p class="text-2xl font-bold text-text-main dark:text-white">4.8</p>
                            <span class="text-sm font-normal text-gray-400">/ 5.0</span>
                        </div>
                    </div>
                    <div
                        class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded-lg text-yellow-600 dark:text-yellow-400">
                        <span class="material-symbols-outlined">star</span>
                    </div>
                </div>
            </div>

            <!-- Reservasi Table -->
            <section
                class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden flex flex-col">
                <div
                    class="p-6 border-b border-[#cfe7cf] dark:border-white/10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Monitor Kedatangan Pelanggan</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Pantau tamu yang diharapkan datang hari
                            ini.</p>
                    </div>
                    <button type="button"
                        class="text-sm text-green-700 dark:text-primary font-medium hover:underline focus:outline-none">
                        Lihat Semua
                    </button>
                </div>
                <!-- Tambahkan max-height dan overflow-y-auto untuk scroll -->
                <div class="p-6 space-y-4 max-h-[500px] overflow-y-auto no-scrollbar">
                    <!-- Item Reservasi -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between bg-background-light dark:bg-background-dark p-4 rounded-lg border border-[#cfe7cf] dark:border-white/10 shadow-sm gap-4 hover:border-primary/50 transition-all">
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/30 to-primary/10 shrink-0 overflow-hidden flex items-center justify-center text-primary font-bold text-sm uppercase">
                                B
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-text-main dark:text-white truncate">
                                    Budi Santoso
                                    <span class="text-xs font-normal text-text-muted dark:text-gray-500">(2
                                        orang)</span>
                                </p>
                                <p class="text-xs text-text-muted dark:text-gray-400 mt-0.5">Meja 5 • 14:00 • Hari ini
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0 flex-wrap sm:flex-nowrap">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">Menunggu</span>
                            <button type="button"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span class="hidden sm:inline">Konfirmasi</span>
                            </button>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between bg-background-light dark:bg-background-dark p-4 rounded-lg border border-[#cfe7cf] dark:border-white/10 shadow-sm gap-4">
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/30 to-primary/10 shrink-0 overflow-hidden flex items-center justify-center text-primary font-bold text-sm uppercase">
                                S
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-text-main dark:text-white truncate">
                                    Siti Aminah
                                    <span class="text-xs font-normal text-text-muted dark:text-gray-500">(4
                                        orang)</span>
                                </p>
                                <p class="text-xs text-text-muted dark:text-gray-400 mt-0.5">Meja 2 • 14:30 • Hari ini
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0 flex-wrap sm:flex-nowrap">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Sudah
                                Datang</span>
                            <button type="button"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/30 cursor-not-allowed opacity-70 text-text-main text-xs font-semibold shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span class="hidden sm:inline">Terkonfirmasi</span>
                            </button>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between bg-background-light dark:bg-background-dark p-4 rounded-lg border border-[#cfe7cf] dark:border-white/10 shadow-sm gap-4 hover:border-primary/50 transition-all">
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/30 to-primary/10 shrink-0 overflow-hidden flex items-center justify-center text-primary font-bold text-sm uppercase">
                                R
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-text-main dark:text-white truncate">
                                    Rizky Pratama
                                    <span class="text-xs font-normal text-text-muted dark:text-gray-500">(3
                                        orang)</span>
                                </p>
                                <p class="text-xs text-text-muted dark:text-gray-400 mt-0.5">Meja 8 • 15:00 • Hari ini
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0 flex-wrap sm:flex-nowrap">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">Menunggu</span>
                            <button type="button"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span class="hidden sm:inline">Konfirmasi</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Restaurant Info Section -->
            <section
                class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Informasi Restoran</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Ringkasan detail restoran Anda.</p>
                    </div>
                    <a @click.prevent="currentPage = 'profile'; sidebarOpen = false"
                        class="text-sm text-green-700 dark:text-primary font-medium hover:underline flex items-center gap-1 cursor-pointer"
                        href="#">
                        <span class="material-symbols-outlined text-[18px]">edit_note</span>
                        Kelola Profil
                    </a>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <p class="text-text-muted dark:text-gray-400 text-sm font-semibold">Nama Restoran</p>
                        <p class="text-text-main dark:text-white text-base font-medium">Warung Nasi Ampera</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-text-muted dark:text-gray-400 text-sm font-semibold">Status Operasional</p>
                        <p class="text-text-main dark:text-white text-base font-medium">Buka</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-text-muted dark:text-gray-400 text-sm font-semibold">Alamat</p>
                        <p class="text-text-main dark:text-white text-base font-medium">Jl. Soekarno Hatta No. 123,
                            Bandung</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-text-muted dark:text-gray-400 text-sm font-semibold">Kategori</p>
                        <p class="text-text-main dark:text-white text-base font-medium">Masakan Sunda</p>
                    </div>
                </div>
            </section>
        </div>

        <!-- PROFILE CONTENT -->
        <div x-show="currentPage === 'profile'" x-transition
            class="max-w-[1200px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">
            <!-- HEADER -->
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <button type="button" @click="sidebarOpen = true"
                            class="lg:hidden p-2 -ml-2 mr-2 text-gray-600 hover:bg-gray-100 rounded-md">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20">
                            Terverifikasi
                        </span>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                            Buka
                        </span>
                    </div>
                    <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black tracking-tight">Profil
                        Restoran</h1>
                    <p class="text-text-muted dark:text-gray-400 text-base">Atur informasi publik restoran Anda yang
                        akan terlihat oleh pelanggan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="hidden md:flex items-center justify-center h-10 w-10 rounded-full bg-white dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button
                        class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary hover:bg-primary-dark text-text-main text-sm font-bold shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </header>

            <section class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- FORM INPUT SECTION -->
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden h-fit">
                    <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10">
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Informasi Restoran</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Edit detail utama yang akan tampil di
                            aplikasi.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Nama Restoran</span>
                            <input id="input-nama"
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm placeholder:text-gray-400"
                                placeholder="Masukkan nama restoran" type="text" />
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Deskripsi
                                Singkat</span>
                            <textarea id="input-deskripsi"
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary min-h-[120px] p-4 shadow-sm resize-none placeholder:text-gray-400"
                                placeholder="Ceritakan tentang restoran Anda..."></textarea>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Kategori</span>
                                <select id="input-kategori"
                                    class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm">
                                    <option>Masakan Sunda</option>
                                    <option>Seafood</option>
                                    <option>Chinese Food</option>
                                    <option>Nusantara</option>
                                </select>
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Jumlah
                                    Meja</span>
                                <input id="input-meja"
                                    class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm"
                                    type="number" />
                            </label>
                        </div>
                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Alamat Lengkap</span>
                            <input id="input-alamat"
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm"
                                type="text" />
                        </label>
                    </div>
                </div>

                <!-- PREVIEW SECTION -->
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden h-fit sticky top-4">
                    <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10">
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Pratinjau Publik</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Tampilan untuk pelanggan</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col relative">
                            <div
                                class="bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 rounded-lg overflow-hidden relative aspect-video flex items-center justify-center text-gray-400 dark:text-gray-600 mb-4">
                                <span class="material-symbols-outlined text-5xl opacity-40">image</span>
                                <span
                                    class="absolute bottom-2 right-2 text-xs font-medium bg-black/60 text-white px-2 py-1 rounded backdrop-blur-sm">Gambar
                                    Sampul</span>
                            </div>
                            <div class="flex justify-start px-2 -mt-14 mb-4 relative z-10">
                                <div id="preview-avatar"
                                    class="w-24 h-24 rounded-full bg-cover bg-center border-4 border-surface-light dark:border-surface-dark shadow-2xl shrink-0 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 px-2">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 id="preview-nama"
                                            class="text-2xl font-bold text-text-main dark:text-white leading-tight break-words">
                                        </h3>
                                        <p id="preview-kategori"
                                            class="text-sm text-text-muted dark:text-gray-400 mt-1"></p>
                                    </div>
                                    <div
                                        class="flex items-center gap-1.5 text-yellow-500 bg-yellow-50 dark:bg-yellow-900/10 px-3 py-1.5 rounded-lg shrink-0 shadow-sm">
                                        <span class="material-symbols-outlined text-lg fill-current">star</span>
                                        <span class="font-semibold text-text-main dark:text-white text-sm">4.8</span>
                                    </div>
                                </div>
                                <p id="preview-deskripsi"
                                    class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed"></p>
                                <div class="flex flex-col gap-2.5">
                                    <div class="flex items-start gap-2 text-text-muted dark:text-gray-400 text-sm">
                                        <span
                                            class="material-symbols-outlined text-lg shrink-0 mt-0.5">location_on</span>
                                        <span id="preview-alamat" class="flex-1 break-words"></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-text-muted dark:text-gray-400 text-sm">
                                        <span
                                            class="material-symbols-outlined text-lg shrink-0">table_restaurant</span>
                                        <span><span id="preview-meja"></span> Meja Tersedia</span>
                                    </div>
                                </div>
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 mt-2 pt-4 border-t border-[#cfe7cf] dark:border-white/10">
                                    <button
                                        class="flex items-center justify-center sm:justify-start gap-2 text-sm font-semibold text-primary hover:text-primary-dark transition-colors px-3 py-2 hover:bg-primary/5 rounded-lg">
                                        <span class="material-symbols-outlined text-lg">share</span>
                                        Bagikan Profil
                                    </button>
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">Buka
                                        Sekarang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- GUEST MONITOR SECTION -->
            <section
                class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Monitor Kedatangan Pelanggan</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Pantau tamu yang diharapkan datang hari
                            ini.</p>
                    </div>
                    <button
                        class="text-sm text-green-700 dark:text-primary font-medium hover:underline flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">history</span>
                        Lihat Riwayat
                    </button>
                </div>
                <div id="guest-list-container" class="divide-y divide-[#cfe7cf] dark:divide-white/10"></div>
                <div class="p-4 text-center">
                    <button
                        class="w-full py-2 text-sm text-center text-text-muted dark:text-gray-400 border border-dashed border-[#cfe7cf] dark:border-white/20 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        Muat Lebih Banyak Tamu
                    </button>
                </div>
            </section>
        </div>

        <!-- PAYMENT CONTENT -->
        <div x-show="currentPage === 'payment'" x-transition
            class="max-w-[1400px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">
            <!-- HEADER -->
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <button type="button" @click="sidebarOpen = true"
                            class="lg:hidden p-2 -ml-2 mr-2 text-gray-600 hover:bg-gray-100 rounded-md">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20">
                            Keuangan
                        </span>
                        <span class="text-text-muted dark:text-gray-500 text-sm">/ Transaksi</span>
                    </div>
                    <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black tracking-tight">
                        Pembayaran &amp; Transaksi</h1>
                    <p class="text-text-muted dark:text-gray-400 text-base">Kelola transaksi masuk, verifikasi
                        pembayaran, dan pantau arus kas.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="hidden md:flex items-center justify-center h-10 w-10 rounded-full bg-white dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 relative">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <button
                        class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-white dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-text-main dark:text-white text-sm font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-[20px] mr-2">download</span>
                        <span>Export Data</span>
                    </button>
                </div>
            </header>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-bold text-text-main dark:text-white">Rp 3.850.000</p>
                        <p class="text-xs text-green-600 font-medium flex items-center mt-1">
                            <span class="material-symbols-outlined text-[16px] mr-1">trending_up</span>
                            +12% dari kemarin
                        </p>
                    </div>
                    <div class="bg-[#e7f3e7] dark:bg-primary/20 p-3 rounded-lg text-green-700 dark:text-primary">
                        <span class="material-symbols-outlined">monetization_on</span>
                    </div>
                </div>
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Perlu Verifikasi</p>
                        <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">4 Transaksi</p>
                        <p class="text-xs text-text-muted dark:text-gray-500 font-medium mt-1">Segera tindak lanjuti
                        </p>
                    </div>
                    <div
                        class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded-lg text-yellow-600 dark:text-yellow-400 relative">
                        <span class="material-symbols-outlined">pending_actions</span>
                        <span
                            class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
                    </div>
                </div>
                <div
                    class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Total Transaksi</p>
                        <p class="text-2xl font-bold text-text-main dark:text-white">142</p>
                        <p class="text-xs text-text-muted dark:text-gray-500 font-medium mt-1">Bulan ini</p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">receipt_long</span>
                    </div>
                </div>
            </div>

            <!-- Transaction List & Detail -->
            <div class="flex flex-col xl:flex-row gap-6 h-[calc(100vh-320px)] min-h-[600px]">
                <!-- Transaction Table -->
                <div
                    class="flex-1 bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex flex-col overflow-hidden">
                    <div
                        class="p-4 border-b border-[#cfe7cf] dark:border-white/10 flex flex-col sm:flex-row gap-4 justify-between items-center bg-gray-50/50 dark:bg-white/5">
                        <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-bold bg-white dark:bg-surface-dark text-primary shadow-sm border border-primary/20 whitespace-nowrap">Semua</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 whitespace-nowrap">Menunggu</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 whitespace-nowrap">Lunas</button>
                            <button
                                class="px-4 py-2 rounded-lg text-sm font-medium text-text-muted dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 whitespace-nowrap">Dibatalkan</button>
                        </div>
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <div class="relative w-full sm:w-64">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                                <input
                                    class="w-full pl-9 pr-4 py-2 rounded-lg border border-[#cfe7cf] dark:border-white/20 bg-white dark:bg-surface-dark text-sm focus:ring-primary focus:border-primary"
                                    placeholder="Cari ID transaksi atau nama..." type="text" />
                            </div>
                            <button
                                class="p-2 rounded-lg border border-[#cfe7cf] dark:border-white/20 hover:bg-gray-100 dark:hover:bg-white/5 text-gray-500">
                                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex-1 overflow-auto">
                        <table class="w-full text-sm text-left">
                            <thead
                                class="bg-gray-50 dark:bg-white/5 text-text-muted dark:text-gray-400 font-semibold sticky top-0 z-10 border-b border-[#cfe7cf] dark:border-white/10">
                                <tr>
                                    <th class="px-6 py-4 whitespace-nowrap">ID Transaksi</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Pelanggan</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Waktu</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Total</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Status</th>
                                    <th class="px-6 py-4 text-right whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#cfe7cf] dark:divide-white/10">
                                <tr
                                    class="bg-yellow-50/50 dark:bg-yellow-900/10 border-l-4 border-l-yellow-500 cursor-pointer hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors">
                                    <td class="px-6 py-4 font-medium text-text-main dark:text-white">#TRX-8893</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Siti Aminah</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Meja 04</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">25 Okt, 14:30</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 850.000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer transition-colors border-l-4 border-l-transparent">
                                    <td class="px-6 py-4 font-medium text-text-main dark:text-white">#TRX-8892</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Budi Santoso</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Meja 08</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">24 Okt, 19:15</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 2.450.000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer transition-colors border-l-4 border-l-transparent">
                                    <td class="px-6 py-4 font-medium text-text-main dark:text-white">#TRX-8891</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Andi Saputra</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Takeaway</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">24 Okt, 18:45</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 125.000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="p-4 border-t border-[#cfe7cf] dark:border-white/10 flex items-center justify-between bg-surface-light dark:bg-surface-dark">
                        <p class="text-sm text-text-muted dark:text-gray-400">Menampilkan 1-6 dari 142 transaksi</p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 rounded border border-[#cfe7cf] dark:border-white/20 text-gray-500 hover:bg-gray-50 dark:hover:bg-white/5 disabled:opacity-50">Sebelumnya</button>
                            <button
                                class="px-3 py-1 rounded border border-[#cfe7cf] dark:border-white/20 text-text-main dark:text-white hover:bg-gray-50 dark:hover:bg-white/5">Selanjutnya</button>
                        </div>
                    </div>
                </div>

                <!-- Transaction Detail Panel -->
                <div class="w-full xl:w-[400px] flex-shrink-0 flex flex-col gap-4">
                    <div
                        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-lg flex flex-col h-full overflow-hidden">
                        <div
                            class="p-6 bg-gradient-to-br from-yellow-50 to-white dark:from-yellow-900/10 dark:to-surface-dark border-b border-[#cfe7cf] dark:border-white/10">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-2xl font-black text-text-main dark:text-white">#TRX-8893</h2>
                                    <p class="text-sm text-text-muted dark:text-gray-400">25 Okt 2023, 14:30 WIB</p>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600"><span
                                        class="material-symbols-outlined">close</span></button>
                            </div>
                            <div
                                class="bg-yellow-100 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3 flex items-start gap-3">
                                <span
                                    class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">info</span>
                                <div>
                                    <p class="font-bold text-yellow-800 dark:text-yellow-300 text-sm">Menunggu
                                        Konfirmasi</p>
                                    <p class="text-xs text-yellow-700 dark:text-yellow-400/80 mt-0.5">Bukti transfer
                                        telah diunggah pelanggan. Silakan cek mutasi rekening Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1 overflow-y-auto p-6 flex flex-col gap-6">
                            <div
                                class="flex items-center gap-4 p-3 rounded-lg bg-gray-50 dark:bg-white/5 border border-[#cfe7cf] dark:border-white/10">
                                <div
                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/30 to-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                    SA
                                </div>
                                <div>
                                    <p class="font-bold text-text-main dark:text-white text-sm">Siti Aminah</p>
                                    <p class="text-xs text-text-muted dark:text-gray-500">0812-3456-7890 • Meja 04</p>
                                </div>
                                <button class="ml-auto text-primary hover:bg-primary/10 p-2 rounded-full">
                                    <span class="material-symbols-outlined text-[20px]">chat</span>
                                </button>
                            </div>
                            <div>
                                <h3
                                    class="text-xs font-bold uppercase text-text-muted dark:text-gray-400 tracking-wider mb-3">
                                    Rincian Pesanan</h3>
                                <div class="flex flex-col gap-3">
                                    <div class="flex justify-between items-start">
                                        <div class="flex gap-2">
                                            <span class="font-bold text-gray-500 w-5">2x</span>
                                            <span class="text-text-main dark:text-white text-sm">Gurame Bakar
                                                Madu</span>
                                        </div>
                                        <span class="text-text-main dark:text-white text-sm font-medium">Rp
                                            170.000</span>
                                    </div>
                                    <div class="flex justify-between items-start">
                                        <div class="flex gap-2">
                                            <span class="font-bold text-gray-500 w-5">1x</span>
                                            <span class="text-text-main dark:text-white text-sm">Cah Kangkung</span>
                                        </div>
                                        <span class="text-text-main dark:text-white text-sm font-medium">Rp
                                            25.000</span>
                                    </div>
                                </div>
                                <div class="h-px bg-gray-200 dark:bg-white/10 my-4"></div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-text-muted dark:text-gray-400">Subtotal</span>
                                    <span class="text-sm text-text-main dark:text-white">Rp 767.000</span>
                                </div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-text-muted dark:text-gray-400">Pajak (10%)</span>
                                    <span class="text-sm text-text-main dark:text-white">Rp 76.700</span>
                                </div>
                                <div
                                    class="flex justify-between items-center mt-3 pt-3 border-t border-dashed border-gray-200 dark:border-white/10">
                                    <span class="font-bold text-lg text-text-main dark:text-white">Total</span>
                                    <span class="font-bold text-xl text-primary">Rp 882.050</span>
                                </div>
                            </div>
                            <div>
                                <h3
                                    class="text-xs font-bold uppercase text-text-muted dark:text-gray-400 tracking-wider mb-3">
                                    Bukti Pembayaran</h3>
                                <div
                                    class="group relative rounded-lg overflow-hidden border border-[#cfe7cf] dark:border-white/10 cursor-pointer">
                                    <div
                                        class="aspect-[4/3] bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
                                        <span
                                            class="material-symbols-outlined text-5xl text-gray-300 dark:text-gray-700">receipt</span>
                                    </div>
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition-colors">
                                        <span
                                            class="bg-white/90 text-gray-800 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Lihat Bukti Transfer
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="p-6 border-t border-[#cfe7cf] dark:border-white/10 bg-gray-50 dark:bg-surface-dark flex gap-3">
                            <button
                                class="flex-1 py-3 rounded-lg border border-red-200 dark:border-red-900/50 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                Tolak
                            </button>
                            <button
                                class="flex-[2] py-3 rounded-lg bg-primary hover:bg-primary-dark text-text-main font-bold text-sm shadow-md hover:shadow-lg transition-all flex justify-center items-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script Optimized -->
    <script>
        // Toggle Sidebar dengan performance optimization
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            if (!sidebar || !overlay) return;

            const isClosed = sidebar.classList.contains('-translate-x-full');

            if (isClosed) {
                overlay.classList.remove('hidden');
                requestAnimationFrame(() => {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('opacity-0');
                });
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // Close sidebar saat klik di luar (optional enhancement)
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('mobile-overlay');
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>

    <!-- Alpine.js untuk state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Script -->
    <script>
        // Data untuk profil
        const initialData = {
            nama: 'Warung Nasi Ampera',
            deskripsi: 'Menyediakan masakan khas Sunda dengan cita rasa otentik sejak 1990. Terkenal dengan sambal dadak dan lalapan segar.',
            kategori: 'Masakan Sunda',
            meja: 12,
            alamat: 'Jl. Soekarno Hatta No. 123, Bandung, Jawa Barat'
        };

        const assets = {
            owner: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB9uzivNK40z_4CoqoQxevOpveNgVBKDtIFTCkSGABKjrdqKPSShbx0McfoiELNXRSV7Qm4JqGYbZTMlYPaETSOtCkLsjotpif-omzLzYi--G4uXbWth8CN2JwAJCTYqIEJv2I0aOedTs6wLBzdiFLzplAb-f7pIjq8f_CTUijZdsnzL2k84nKfxvchBvyPDsPq1dBhoN7tUdAzugkald9PYfPdhM9Zq4llXOsXKGaPbssahjc-QrrbIiVQxXN1sBh4FGf0XVx50Jjh'
        };

        const tamuData = [{
                nama: 'Budi Santoso',
                detail: 'Meja 5 - 14:00 (2 orang)',
                status: 'waiting',
                img: 'https://ui-avatars.com/api/?name=Budi+Santoso&background=13ec13&color=fff'
            },
            {
                nama: 'Siti Aminah',
                detail: 'Meja 2 - 14:30 (4 orang)',
                status: 'arrived',
                img: 'https://ui-avatars.com/api/?name=Siti+Aminah&background=13ec13&color=fff'
            },
            {
                nama: 'Rizky Pratama',
                detail: 'Meja 8 - 15:00 (3 orang)',
                status: 'waiting',
                img: 'https://ui-avatars.com/api/?name=Rizky+Pratama&background=13ec13&color=fff'
            }
        ];

        function renderGuests() {
            const container = document.getElementById('guest-list-container');
            if (!container) return;

            const fragment = document.createDocumentFragment();
            tamuData.forEach(item => {
                const div = document.createElement('div');
                div.className =
                    'flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-4 sm:gap-0';
                div.innerHTML = `
                    <div class="flex items-center gap-3 min-w-0 flex-1">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/30 to-primary/10 shrink-0 flex items-center justify-center text-primary font-bold text-sm uppercase">
                            ${item.nama.charAt(0)}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-text-main dark:text-white truncate">${item.nama}</p>
                            <p class="text-xs text-text-muted dark:text-gray-500 truncate">${item.detail}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0 flex-wrap sm:flex-nowrap">
                        ${item.status === 'waiting' ? '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">Menunggu</span>' : '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">Sudah Datang</span>'}
                        <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg ${item.status === 'waiting' ? 'bg-primary hover:bg-primary-dark' : 'bg-primary/30 cursor-not-allowed opacity-70'} text-text-main text-xs font-semibold shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                            <span class="hidden sm:inline">${item.status === 'waiting' ? 'Konfirmasi' : 'Terkonfirmasi'}</span>
                        </button>
                        <button class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                            <span class="material-symbols-outlined text-[16px]">cancel</span>
                            <span class="hidden sm:inline">Batalkan</span>
                        </button>
                    </div>
                `;
                fragment.appendChild(div);
            });
            container.appendChild(fragment);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Pastikan Alpine.js sudah loaded dan state tersimpan
            const savedPage = localStorage.getItem('restoranCurrentPage');
            if (savedPage) {
                console.log('Memuat halaman tersimpan:', savedPage);
            }

            const avatarUrl = `url('${assets.owner}')`;
            const previewAvatar = document.getElementById('preview-avatar');
            if (previewAvatar) {
                previewAvatar.style.backgroundImage = avatarUrl;
                previewAvatar.style.backgroundSize = 'cover';
                previewAvatar.style.backgroundPosition = 'center';
            }

            const fields = [{
                    input: 'input-nama',
                    preview: 'preview-nama',
                    key: 'nama'
                },
                {
                    input: 'input-deskripsi',
                    preview: 'preview-deskripsi',
                    key: 'deskripsi'
                },
                {
                    input: 'input-kategori',
                    preview: 'preview-kategori',
                    key: 'kategori'
                },
                {
                    input: 'input-meja',
                    preview: 'preview-meja',
                    key: 'meja'
                },
                {
                    input: 'input-alamat',
                    preview: 'preview-alamat',
                    key: 'alamat'
                }
            ];

            fields.forEach(({
                input,
                preview,
                key
            }) => {
                const inputEl = document.getElementById(input);
                const previewEl = document.getElementById(preview);

                if (inputEl && previewEl) {
                    inputEl.value = initialData[key];
                    previewEl.textContent = initialData[key];

                    let timeout;
                    inputEl.addEventListener('input', (e) => {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            previewEl.textContent = e.target.value || `(Masukkan ${key})`;
                        }, 150);
                    });
                }
            });

            renderGuests();
        });
    </script>
</body>

</html>
