<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pembayaran Restoran - Warung Nasi Ampera</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
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
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-main dark:text-white font-display flex h-screen overflow-hidden antialiased">
    <aside
        class="w-72 hidden lg:flex flex-col border-r border-[#cfe7cf] dark:border-white/10 bg-surface-light dark:bg-surface-dark h-full z-20">
        <div class="flex flex-col h-full justify-between p-4">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-3 px-2">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 shadow-sm border-2 border-primary/20"
                        data-alt="Profile picture of restaurant owner"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB9uzivNK40z_4CoqoQxevOpveNgVBKDtIFTCkSGABKjrdqKPSShbx0McfoiELNXRSV7Qm4JqGYbZTMlYPaETSOtCkLsjotpif-omzLzYi--G4uXbWth8CN2JwAJCTYqIEJv2I0aOedTs6wLBzdiFLzplAb-f7pIjq8f_CTUijZdsnzL2k84nKfxvchBvyPDsPq1dBhoN7tUdAzugkald9PYfPdhM9Zq4llXOsXKGaPbssahjc-QrrbIiVQxXN1sBh4FGf0XVx50Jjh");'>
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <h1 class="text-text-main dark:text-white text-base font-bold leading-tight truncate">Warung
                            Ampera</h1>
                        <p class="text-text-muted dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                            Pemilik</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="{{ route('restoran.dashboard') }}">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">dashboard</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="{{ route('restoran.profile') }}">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">storefront</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Profil Restoran</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="{{ route('restoran.reservasi-kedatangan') }}">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">event_available</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Kelola Reservasi &amp;
                            Kedatangan</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">restaurant_menu</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Manajemen Menu</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg bg-[#e7f3e7] dark:bg-primary/20 group transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-text-main dark:text-primary">payments</span>
                        <p class="text-text-main dark:text-white text-sm font-semibold">Pembayaran</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">reviews</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Ulasan Pengunjung</p>
                    </a>
                </nav>
            </div>
            <div class="flex flex-col gap-4">
                <button
                    class="flex w-full cursor-pointer items-center justify-center rounded-lg h-11 px-4 bg-primary hover:bg-primary-dark transition-colors text-text-main text-sm font-bold tracking-[0.015em] shadow-sm shadow-green-200 dark:shadow-none">
                    <span class="material-symbols-outlined text-[20px] mr-2">logout</span>
                    <span class="truncate">Logout</span>
                </button>
                <div class="flex flex-col gap-1 border-t border-[#cfe7cf] dark:border-white/10 pt-4">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
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
    <main class="flex-1 overflow-y-auto relative scroll-smooth w-full">
        <div class="max-w-[1400px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20">
                            Keuangan
                        </span>
                        <span class="text-text-muted dark:text-gray-500 text-sm">
                            / Transaksi
                        </span>
                    </div>
                    <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black tracking-tight">Pembayaran
                        &amp; Transaksi</h1>
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
                        <p class="text-xs text-text-muted dark:text-gray-500 font-medium mt-1">
                            Segera tindak lanjuti
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
                        <p class="text-xs text-text-muted dark:text-gray-500 font-medium mt-1">
                            Bulan ini
                        </p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg text-blue-600 dark:text-blue-400">
                        <span class="material-symbols-outlined">receipt_long</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col xl:flex-row gap-6 h-[calc(100vh-320px)] min-h-[600px]">
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
                                    class="bg-yellow-50/50 dark:bg-yellow-900/10 border-l-4 border-l-yellow-500 cursor-pointer">
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
                                <tr
                                    class="hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer transition-colors border-l-4 border-l-transparent">
                                    <td class="px-6 py-4 font-medium text-text-main dark:text-white">#TRX-8890</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Rina Wati</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Meja 02</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">24 Okt, 18:30</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 450.000</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300 gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer transition-colors border-l-4 border-l-transparent opacity-60">
                                    <td
                                        class="px-6 py-4 font-medium text-text-main dark:text-white line-through decoration-red-500">
                                        #TRX-8889</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Tamu Walk-in</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Meja 10</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">24 Okt, 12:00</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 0</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            Dibatalkan
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="material-symbols-outlined text-gray-400">chevron_right</span>
                                    </td>
                                </tr>
                                <tr
                                    class="hover:bg-gray-50 dark:hover:bg-white/5 cursor-pointer transition-colors border-l-4 border-l-transparent">
                                    <td class="px-6 py-4 font-medium text-text-main dark:text-white">#TRX-8888</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-text-main dark:text-white">Doni
                                                Ardiansyah</span>
                                            <span class="text-xs text-text-muted dark:text-gray-500">Meja 05</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">23 Okt, 20:10</td>
                                    <td class="px-6 py-4 font-bold text-text-main dark:text-white">Rp 2.100.000</td>
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
                                <div class="w-10 h-10 rounded-full bg-gray-200 bg-cover bg-center"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBfG0Y_QalaDG5PrRUEVtlnr3SmWPAXo25kHPvcFyBulCiO_Agxnamc77LsOCCGTDCGo2y2wVjqXJlD7MbaHic0LtTGCr-cqy7Vn4x02CioKo8AGsnuq4nyHzD4LGZXd7DwERJhFvWdLz5V-pNL9SxJ9cVb0UUsxtFA2WGa8YTY4QfSoHw5XgYeRpwxnZ9nw4hCRnOahiW7uMQ5W3e9MgjJtg7rgcanrhwtaTqK-s6mhrwrOWtB7uM6crag1T7SHnJRPLf6kG2E69un");'>
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
                                    <div class="flex justify-between items-start">
                                        <div class="flex gap-2">
                                            <span class="font-bold text-gray-500 w-5">4x</span>
                                            <span class="text-text-main dark:text-white text-sm">Es Jeruk Kelapa</span>
                                        </div>
                                        <span class="text-text-main dark:text-white text-sm font-medium">Rp
                                            72.000</span>
                                    </div>
                                    <div class="flex justify-between items-start">
                                        <div class="flex gap-2">
                                            <span class="font-bold text-gray-500 w-5">1x</span>
                                            <span class="text-text-main dark:text-white text-sm">Nasi Liwet Kastrol
                                                (Besar)</span>
                                        </div>
                                        <span class="text-text-main dark:text-white text-sm font-medium">Rp
                                            500.000</span>
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
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-sm text-text-muted dark:text-gray-400">Service (5%)</span>
                                    <span class="text-sm text-text-main dark:text-white">Rp 38.350</span>
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
                                    <div class="aspect-[4/3] bg-cover bg-center"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDZSJC6AhgJl-ZUOUeWOC_LPdO-AvfbPGRZcM7DKV2iR1mYpNUQOA1Zt-NP8WcySfxDOikLin_MvAlrjv9jYf7lBpJ6WfFG_QJAmqkVsPaD-2l9Q9YZMCTlXrdxCvX8HqQ8ecvojW2g49lXo9UaRJrpkXpGBM3hhhcywhPqckc8t5rxhavtMeN2RD3qQjFn1XQxYcA9VgivWhy74JTuYnER8KqlrrFLN_jfcYRO-SH0FQQolUOqjzEHSmfhSjmyXJb7NG9l9L9nH1A0"); filter: blur(2px);'>
                                    </div>
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/30 transition-colors">
                                        <span
                                            class="bg-white/90 text-gray-800 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Lihat Bukti Transfer
                                        </span>
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-white/90 dark:bg-surface-dark/90 p-2 text-xs flex justify-between px-3">
                                        <span class="text-gray-500">Bank BCA</span>
                                        <span class="font-mono font-bold">TRF-7728192</span>
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

</body>

</html>
