<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Kelola Reservasi &amp; Kedatangan - Warung Nasi Ampera</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
    class="bg-background-light dark:bg-background-dark text-text-main dark:text-white font-display flex h-screen overflow-hidden antialiased"
    x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'today' }">
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
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg bg-[#e7f3e7] dark:bg-primary/20 group transition-colors"
                        href="{{ route('restoran.reservasi-kedatangan') }}">
                        <span class="material-symbols-outlined text-text-main dark:text-primary">event_available</span>
                        <p class="text-text-main dark:text-white text-sm font-semibold">Kelola Reservasi &amp;
                            Kedatangan</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">restaurant_menu</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Manajemen Menu</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">payments</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Pembayaran</p>
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
                        <span class="material-symbols-outlined text-[20px]">settings</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pengaturan</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[20px]">help</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Bantuan</p>
                    </a>
                </div>
            </div>
        </div>
    </aside>
    <main class="flex-1 overflow-y-auto relative scroll-smooth w-full">
        <div class="max-w-[1200px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20">
                            Terverifikasi
                        </span>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                            Buka
                        </span>
                    </div>
                    <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black tracking-tight">Kelola
                        Reservasi &amp; Kedatangan</h1>
                    <p class="text-text-muted dark:text-gray-400 text-base">Pantau reservasi hari ini dan kedatangan
                        mendatang untuk operasional yang lancar.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="hidden md:flex items-center justify-center h-10 w-10 rounded-full bg-white dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button
                        class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-text-main text-sm font-bold shadow-sm hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-[20px] mr-2">add</span>
                        <span>Reservasi Baru</span>
                    </button>
                </div>
            </header>

            <!-- TAB NAVIGATION -->
            <div
                class="flex border-b border-[#cfe7cf] dark:border-white/10 gap-6 -mx-4 md:-mx-8 px-4 md:px-8 overflow-x-auto whitespace-nowrap scroll-smooth">
                <a @click.prevent="activeTab = 'today'"
                    :class="activeTab === 'today' ? 'border-primary text-primary' :
                        'border-transparent text-text-muted hover:text-primary hover:border-primary/50'"
                    class="inline-flex items-center gap-2 pb-3 text-sm font-semibold border-b-2 transition-colors cursor-pointer"
                    href="#">
                    <span class="material-symbols-outlined text-base">today</span>
                    <span>Ringkasan Hari Ini</span>
                </a>
                <a @click.prevent="activeTab = 'upcoming'"
                    :class="activeTab === 'upcoming' ? 'border-primary text-primary' :
                        'border-transparent text-text-muted hover:text-primary hover:border-primary/50'"
                    class="inline-flex items-center gap-2 pb-3 text-sm font-semibold border-b-2 transition-colors cursor-pointer"
                    href="#">
                    <span class="material-symbols-outlined text-base">calendar_month</span>
                    <span>Reservasi Mendatang</span>
                </a>
            </div>

            <!-- TAB CONTENT: RINGKASAN HARI INI -->
            <div x-show="activeTab === 'today'" x-transition class="flex flex-col gap-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Total Reservasi Hari
                                Ini
                            </p>
                            <p class="text-3xl font-bold text-text-main dark:text-white">42</p>
                        </div>
                        <div class="bg-[#e7f3e7] dark:bg-primary/20 p-3 rounded-lg text-green-700 dark:text-primary">
                            <span class="material-symbols-outlined text-3xl">event</span>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Kedatangan Diharapkan
                            </p>
                            <p class="text-3xl font-bold text-text-main dark:text-white">18</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg text-blue-600 dark:text-blue-400">
                            <span class="material-symbols-outlined text-3xl">group</span>
                        </div>
                    </div>
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-5 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-text-muted dark:text-gray-400 text-sm font-medium mb-1">Kapasitas Tersisa
                            </p>
                            <p class="text-3xl font-bold text-text-main dark:text-white">65%</p>
                        </div>
                        <div
                            class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded-lg text-yellow-600 dark:text-yellow-400">
                            <span class="material-symbols-outlined text-3xl">table_bar</span>
                        </div>
                    </div>
                </div>

                <section
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-bold text-text-main dark:text-white">Kedatangan Segera</h2>
                            <p class="text-sm text-text-muted dark:text-gray-400">Daftar reservasi untuk beberapa jam
                                ke
                                depan.</p>
                        </div>
                        <a @click.prevent="activeTab = 'upcoming'"
                            class="text-sm text-green-700 dark:text-primary font-medium hover:underline flex items-center gap-1 cursor-pointer"
                            href="#">
                            <span class="material-symbols-outlined text-[18px]">history</span>
                            Lihat Semua Reservasi
                        </a>
                    </div>
                    <div class="divide-y divide-[#cfe7cf] dark:divide-white/10">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiCwpJn12e9wK5e-ZLZZBuTpeRTT2TzPaq1j-ZLS-8cFfQTdmbOau6NownwMhg0Yw8DY1gI668dQKm5MCKWoJ0qNaHQz7KaN0PL7e_gsDUZD11-zFzd33pOJMAXBB6_b1yz3jnSP9N5s7hOBO5-hk6e8rgdQAgL-Tp9_0f1DyRWDkFmTTCxfeq9Y-M-XycUwV7ItnPH7FlFfS96wLuXO0HSPi1ga_MJFO-DvXpBIXYiJLmOl0kDX5b5TYdrMBg9PeCYz-IQxI77zbZ");'>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-main dark:text-white">Budi Santoso</p>
                                    <p class="text-xs text-text-muted dark:text-gray-500"><span
                                            class="font-semibold text-text-main dark:text-white">14:00</span> - Meja 5
                                        (<span class="font-semibold text-text-main dark:text-white">2</span> orang)</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    Konfirmasi Kedatangan
                                </button>
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                                    Batalkan
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBfG0Y_QalaDG5PrRUEVtlnr3SmWPAXo25kHPvcFyBulCiO_Agxnamc77LsOCCGTDCGo2y2wVjqXJlD7MbaHic0LtTGCr-cqy7Vn4x02CioKo8AGsnuq4nyHzD4LGZXd7DwERJhFvWdLz5V-pNL9SxJ9cVb0UUsxtFA2WGa8YTY4QfSoHw5XgYeRpwxnZ9nw4hCRnOahiW7uMQ5W3e9MgjJtg7rgcanrhwtaTqK-s6mhrwrOWtB7uM6crag1T7SHnJRPLf6kG2E69un");'>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-main dark:text-white">Siti Aminah</p>
                                    <p class="text-xs text-text-muted dark:text-gray-500"><span
                                            class="font-semibold text-text-main dark:text-white">14:30</span> - Meja 2
                                        (<span class="font-semibold text-text-main dark:text-white">4</span> orang)</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/30 text-primary-dark dark:text-primary text-xs font-semibold cursor-not-allowed opacity-70">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    Terkonfirmasi
                                </button>
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                                    Batalkan
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDMFRSHbI56vFzOYrJfj1DrENbGU7INVcirai7Re7ijHCzDoAp7-gLXrV3cgsRc_LoL4nfmASNhGPNGl9T4ykTbHkSDVpz1Arq8zhuZI4-2U1B4WuhFEND_8Fsi0YZI7QkV8N5Mj4xpQ1czDZBvlz2Di4M2BI4-gtU-V53Kuj-T2WJqfucLVfk5OiLlTJ9rgwzfI1Nvsn39OTH0v7Ybul_0CxKGagPR_5IQKZ7w5G2czsBFsw86VVKZg5CKESlCKYAoAleCY-C2s-iN");'>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-main dark:text-white">Rizky Pratama</p>
                                    <p class="text-xs text-text-muted dark:text-gray-500"><span
                                            class="font-semibold text-text-main dark:text-white">15:00</span> - Meja 8
                                        (<span class="font-semibold text-text-main dark:text-white">3</span> orang)</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    Konfirmasi Kedatangan
                                </button>
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                                    Batalkan
                                </button>
                            </div>
                        </div>
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiCwpJn12e9wK5e-ZLZZBuTpeRTT2TzPaq1j-ZLS-8cFfQTdmbOau6NownwMhg0Yw8DY1gI668dQKm5MCKWoJ0qNaHQz7KaN0PL7e_gsDUZD11-zFzd33pOJMAXBB6_b1yz3jnSP9N5s7hOBO5-hk6e8rgdQAgL-Tp9_0f1DyRWDkFmTTCxfeq9Y-M-XycUwV7ItnPH7FlFfS96wLuXO0HSPi1ga_MJFO-DvXpBIXYiJLmOl0kDX5b5TYdrMBg9PeCYz-IQxI77zbZ");'>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-main dark:text-white">Dewi Puspitasari</p>
                                    <p class="text-xs text-text-muted dark:text-gray-500"><span
                                            class="font-semibold text-text-main dark:text-white">15:45</span> - Meja 12
                                        (<span class="font-semibold text-text-main dark:text-white">5</span> orang)</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                    Konfirmasi Kedatangan
                                </button>
                                <button
                                    class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                                    Batalkan
                                </button>
                            </div>
                        </div>
                        <div class="p-4 text-center">
                            <button
                                class="w-full py-2 text-sm text-center text-text-muted dark:text-gray-400 border border-dashed border-[#cfe7cf] dark:border-white/20 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                Muat Lebih Banyak Tamu
                            </button>
                        </div>
                    </div>
                </section>
            </div>

            <!-- TAB CONTENT: RESERVASI MENDATANG -->
            <div x-show="activeTab === 'upcoming'" x-transition class="flex flex-col lg:flex-row gap-8">
                <div
                    class="w-full lg:w-1/3 bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <button
                            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                        <h3 class="text-lg font-bold text-text-main dark:text-white">Mei 2024</h3>
                        <button
                            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 text-gray-700 dark:text-gray-300">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    </div>
                    <div
                        class="grid grid-cols-7 text-center text-xs font-medium text-text-muted dark:text-gray-400 mb-2">
                        <div>Min</div>
                        <div>Sen</div>
                        <div>Sel</div>
                        <div>Rab</div>
                        <div>Kam</div>
                        <div>Jum</div>
                        <div>Sab</div>
                    </div>
                    <div class="grid grid-cols-7 text-center gap-y-1">
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                        <div class="py-1">
                            <span class="block w-2.5 h-2.5 rounded-full bg-primary mx-auto"></span>
                        </div>
                    </div>
                    <p class="text-center text-xs text-text-muted dark:text-gray-400 mt-4">
                        <span class="inline-block w-2 h-2 rounded-full bg-primary mr-1"></span> Hari dengan Reservasi
                    </p>
                </div>

                <div class="w-full lg:w-2/3 flex flex-col gap-6">
                    <div
                        class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm">
                        <h2 class="text-lg font-bold text-text-main dark:text-white mb-2">Reservasi pada 14 Mei 2024
                        </h2>
                        <p class="text-sm text-text-muted dark:text-gray-400 mb-4">Daftar reservasi untuk tanggal yang
                            dipilih.</p>

                        <div class="flex flex-wrap gap-3 mb-4">
                            <div class="relative">
                                <select
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-surface-dark py-2 pl-3 pr-8 text-sm text-text-main dark:text-white focus:border-primary focus:ring-primary">
                                    <option>Semua Status</option>
                                    <option>Terkonfirmasi</option>
                                    <option>Menunggu</option>
                                    <option>Dibatalkan</option>
                                    <option>Selesai</option>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-base">expand_more</span>
                            </div>
                            <div class="relative">
                                <select
                                    class="block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white dark:bg-surface-dark py-2 pl-3 pr-8 text-sm text-text-main dark:text-white focus:border-primary focus:ring-primary">
                                    <option>Semua Waktu</option>
                                    <option>Pagi (08:00 - 11:00)</option>
                                    <option>Siang (11:00 - 14:00)</option>
                                    <option>Sore (14:00 - 17:00)</option>
                                    <option>Malam (17:00 - Tutup)</option>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-base">expand_more</span>
                            </div>
                        </div>

                        <div class="divide-y divide-[#cfe7cf] dark:divide-white/10">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiCwpJn12e9wK5e-ZLZZBuTpeRTT2TzPaq1j-ZLS-8cFfQTdmbOau6NownwMhg0Yw8DY1gI668dQKm5MCKWoJ0qNaHQz7KaN0PL7e_gsDUZD11-zFzd33pOJMAXBB6_b1yz3jnSP9N5s7hOBO5-hk6e8rgdQAgL-Tp9_0f1DyRWDkFmTTCxfeq9Y-M-XycUwV7ItnPH7FlFfS96wLuXO0HSPi1ga_MJFO-DvXpBIXYiJLmOl0kDX5b5TYdrMBg9PeCYz-IQxI77zbZ");'>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-text-main dark:text-white">Budi Santoso</p>
                                        <p class="text-xs text-text-muted dark:text-gray-500"><span
                                                class="font-semibold text-text-main dark:text-white">14:00</span> -
                                            Meja 5
                                            (<span class="font-semibold text-text-main dark:text-white">2</span> orang)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                        Konfirmasi Kedatangan
                                    </button>
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">cancel</span>
                                        Batalkan
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBfG0Y_QalaDG5PrRUEVtlnr3SmWPAXo25kHPvcFyBulCiO_Agxnamc77LsOCCGTDCGo2y2wVjqXJlD7MbaHic0LtTGCr-cqy7Vn4x02CioKo8AGsnuq4nyHzD4LGZXd7DwERJhFvWdLz5V-pNL9SxJ9cVb0UUsxtFA2WGa8YTY4QfSoHw5XgYeRpwxnZ9nw4hCRnOahiW7uMQ5W3e9MgjJtg7rgcanrhwtaTqK-s6mhrwrOWtB7uM6crag1T7SHnJRPLf6kG2E69un");'>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-text-main dark:text-white">Siti Aminah</p>
                                        <p class="text-xs text-text-muted dark:text-gray-500"><span
                                                class="font-semibold text-text-main dark:text-white">14:30</span> -
                                            Meja 2
                                            (<span class="font-semibold text-text-main dark:text-white">4</span> orang)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary/30 text-primary-dark dark:text-primary text-xs font-semibold cursor-not-allowed opacity-70">
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                        Terkonfirmasi
                                    </button>
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">cancel</span>
                                        Batalkan
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDMFRSHbI56vFzOYrJfj1DrENbGU7INVcirai7Re7ijHCzDoAp7-gLXrV3cgsRc_LoL4nfmASNhGPNGl9T4ykTbHkSDVpz1Arq8zhuZI4-2U1B4WuhFEND_8Fsi0YZI7QkV8N5Mj4xpQ1czDZBvlz2Di4M2BI4-gtU-V53Kuj-T2WJqfucLVfk5OiLlTJ9rgwzfI1Nvsn39OTH0v7Ybul_0CxKGagPR_5IQKZ7w5G2czsBFsw86VVKZg5CKESlCKYAoAleCY-C2s-iN");'>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-text-main dark:text-white">Rizky Pratama</p>
                                        <p class="text-xs text-text-muted dark:text-gray-500"><span
                                                class="font-semibold text-text-main dark:text-white">15:00</span> -
                                            Meja 8
                                            (<span class="font-semibold text-text-main dark:text-white">3</span> orang)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                        Konfirmasi Kedatangan
                                    </button>
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">cancel</span>
                                        Batalkan
                                    </button>
                                </div>
                            </div>
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors gap-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-cover bg-center"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiCwpJn12e9wK5e-ZLZZBuTpeRTT2TzPaq1j-ZLS-8cFfQTdmbOau6NownwMhg0Yw8DY1gI668dQKm5MCKWoJ0qNaHQz7KaN0PL7e_gsDUZD11-zFzd33pOJMAXBB6_b1yz3jnSP9N5s7hOBO5-hk6e8rgdQAgL-Tp9_0f1DyRWDkFmTTCxfeq9Y-M-XycUwV7ItnPH7FlFfS96wLuXO0HSPi1ga_MJFO-DvXpBIXYiJLmOl0kDX5b5TYdrMBg9PeCYz-IQxI77zbZ");'>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-text-main dark:text-white">Dewi Puspitasari
                                        </p>
                                        <p class="text-xs text-text-muted dark:text-gray-500"><span
                                                class="font-semibold text-text-main dark:text-white">15:45</span> -
                                            Meja 12
                                            (<span class="font-semibold text-text-main dark:text-white">5</span> orang)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-primary hover:bg-primary-dark text-text-main text-xs font-semibold shadow-sm transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                        Konfirmasi Kedatangan
                                    </button>
                                    <button
                                        class="flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 text-gray-700 dark:text-gray-300 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">cancel</span>
                                        Batalkan
                                    </button>
                                </div>
                            </div>
                            <div class="p-4 text-center">
                                <button
                                    class="w-full py-2 text-sm text-center text-text-muted dark:text-gray-400 border border-dashed border-[#cfe7cf] dark:border-white/20 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    Muat Lebih Banyak Tamu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
