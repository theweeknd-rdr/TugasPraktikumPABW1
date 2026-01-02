<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Detail Kuliner - {{ $restaurant->name }}</title>

    <!-- Preconnect Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind Config -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ee8c2b",
                        "primary-dark": "#d97b1f",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-[#1b140d] dark:text-[#f3ede7]">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">

        <!-- Header -->
        <header
            class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#e5e0dc] dark:border-[#3a2e25] bg-background-light dark:bg-background-dark px-6 md:px-10 py-3 sticky top-0 z-50">
            <div class="flex items-center gap-4 text-[#1b140d] dark:text-white">
                <a href="{{ route('dashboard') }}" class="size-8 text-primary hover:text-primary-dark transition-colors"
                    aria-label="Kembali ke Dashboard">
                    <span class="material-symbols-outlined !text-3xl">arrow_back</span>
                </a>
                <h2 class="text-[#1b140d] dark:text-white text-lg font-bold leading-tight tracking-[-0.015em]">
                    Detail Restoran
                </h2>
            </div>
            <nav class="hidden md:flex flex-1 justify-end gap-8">
                <div class="flex items-center gap-9">
                    <a class="text-[#1b140d] dark:text-[#e0d6cd] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="{{ route('dashboard') }}">Home</a>
                    <a class="text-primary text-sm font-bold leading-normal" href="#">Jelajah</a>
                    <a class="text-[#1b140d] dark:text-[#e0d6cd] text-sm font-medium leading-normal hover:text-primary transition-colors"
                        href="#">Rekomendasi</a>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-1 w-full max-w-[1280px] mx-auto px-4 md:px-6 lg:px-8 py-6 flex flex-col gap-6">

            <!-- Breadcrumbs -->
            <nav aria-label="Breadcrumb" class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                <a class="hover:text-primary transition-colors" href="{{ route('dashboard') }}">Home</a>
                <span class="material-symbols-outlined text-base mx-2 select-none">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="#">Jelajah</a>
                <span class="material-symbols-outlined text-base mx-2 select-none">chevron_right</span>
                <span class="font-medium text-[#1b140d] dark:text-white select-none">{{ $restaurant->name }}</span>
            </nav>

            <!-- Image Gallery Grid -->
            <section class="grid grid-cols-1 md:grid-cols-4 gap-4 h-[300px] md:h-[450px]">
                <!-- Main Image (LCP Priority) -->
                <div
                    class="md:col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group cursor-pointer bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop&sig={{ $restaurant->id }}"
                        alt="Foto Utama {{ $restaurant->name }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        fetchpriority="high">
                </div>
                <!-- Secondary Images (Lazy Load) -->
                <div class="relative rounded-2xl overflow-hidden group cursor-pointer hidden md:block bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=800&auto=format&fit=crop"
                        alt="Suasana Restoran 1"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                </div>
                <div class="relative rounded-2xl overflow-hidden group cursor-pointer hidden md:block bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=800&auto=format&fit=crop"
                        alt="Suasana Restoran 2"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                </div>
                <div class="relative rounded-2xl overflow-hidden group cursor-pointer hidden md:block bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=800&auto=format&fit=crop"
                        alt="Menu Makanan"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                </div>
                <div class="relative rounded-2xl overflow-hidden group cursor-pointer bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?q=80&w=800&auto=format&fit=crop"
                        alt="Menu Minuman"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">
                    <div
                        class="absolute inset-0 bg-black/50 items-center justify-center transition-opacity hover:bg-black/60 hidden md:flex">
                        <span class="text-white font-bold text-lg">+ Foto Lainnya</span>
                    </div>
                </div>
            </section>

            <!-- Title & Actions -->
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-[#e5e0dc] dark:border-[#3a2e25] pb-6">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-[#1b140d] dark:text-white tracking-tight">
                            {{ $restaurant->name }}
                        </h1>
                        <span class="material-symbols-outlined text-blue-500 text-[24px]"
                            title="Verified Merchant">verified</span>
                    </div>
                    <p class="text-[#9a734c] font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">location_on</span>
                        {{ $restaurant->address }}
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <div class="flex items-center gap-1 text-yellow-500 font-bold">
                            <span class="material-symbols-filled">star</span>
                            <span class="text-[#1b140d] dark:text-white">4.8</span>
                            <span
                                class="text-gray-500 dark:text-gray-400 font-medium underline cursor-pointer hover:text-primary">(1.2k
                                Ulasan)</span>
                        </div>
                        <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                        <span class="text-[#1b140d] dark:text-[#e0d6cd]">{{ $restaurant->type }}</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                        <span class="text-[#1b140d] dark:text-[#e0d6cd]">$$ (Rp 50k - 150k)</span>
                        <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                        <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs font-bold">Buka
                            Sekarang</span>
                    </div>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <button type="button"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25] text-[#1b140d] dark:text-white font-bold hover:bg-[#f3ede7] dark:hover:bg-[#3a2e25] transition-colors">
                        <span class="material-symbols-outlined">share</span>
                        Bagikan
                    </button>
                    <button type="button"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25] text-[#1b140d] dark:text-white font-bold hover:bg-[#f3ede7] dark:hover:bg-[#3a2e25] transition-colors">
                        <span class="material-symbols-outlined">bookmark_border</span>
                        Simpan
                    </button>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 relative">

                <!-- Main Content Column -->
                <div class="lg:col-span-2 flex flex-col gap-10">
                    <section class="space-y-4">
                        <h3 class="text-xl font-bold text-[#1b140d] dark:text-white">Tentang Tempat Ini</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $restaurant->description ?? 'Deskripsi restoran belum tersedia.' }}
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <span
                                class="px-3 py-1.5 rounded-full bg-[#f3ede7] dark:bg-[#2d241b] text-sm text-[#1b140d] dark:text-[#e0d6cd] font-medium border border-transparent dark:border-[#3a2e25]">#CoffeeShop</span>
                            <span
                                class="px-3 py-1.5 rounded-full bg-[#f3ede7] dark:bg-[#2d241b] text-sm text-[#1b140d] dark:text-[#e0d6cd] font-medium border border-transparent dark:border-[#3a2e25]">#Instagrammable</span>
                            <span
                                class="px-3 py-1.5 rounded-full bg-[#f3ede7] dark:bg-[#2d241b] text-sm text-[#1b140d] dark:text-[#e0d6cd] font-medium border border-transparent dark:border-[#3a2e25]">#WFCFriendly</span>
                        </div>
                    </section>

                    <section class="space-y-4">
                        <h3 class="text-xl font-bold text-[#1b140d] dark:text-white">Fasilitas</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div
                                class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25]">
                                <span class="material-symbols-outlined text-primary">wifi</span>
                                <span class="text-sm font-medium dark:text-gray-200">WiFi Kencang</span>
                            </div>
                            <div
                                class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25]">
                                <span class="material-symbols-outlined text-primary">electrical_services</span>
                                <span class="text-sm font-medium dark:text-gray-200">Stopkontak</span>
                            </div>
                            <div
                                class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25]">
                                <span class="material-symbols-outlined text-primary">ac_unit</span>
                                <span class="text-sm font-medium dark:text-gray-200">Ber-AC</span>
                            </div>
                            <div
                                class="flex items-center gap-3 p-3 rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25]">
                                <span class="material-symbols-outlined text-primary">local_parking</span>
                                <span class="text-sm font-medium dark:text-gray-200">Parkir Luas</span>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Sticky Sidebar -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-[100px] flex flex-col gap-6">
                        <div
                            class="bg-white dark:bg-[#2d241b] rounded-2xl shadow-lg border border-[#e5e0dc] dark:border-[#3a2e25] overflow-hidden">
                            <div class="bg-[#1b140d] dark:bg-[#3a2e25] p-4 text-white">
                                <h3 class="font-bold text-lg flex items-center gap-2">
                                    <span class="material-symbols-outlined">table_restaurant</span>
                                    Reservasi Meja
                                </h3>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <!-- Tombol Pesan Sekarang -->
                                <a href="{{ route('reservation.form', $restaurant->id) }}"
                                    class="w-full bg-primary hover:bg-[#d5781a] text-white font-bold py-3.5 rounded-xl shadow-md hover:shadow-lg transition-all active:scale-[0.98] mt-2 block text-center flex justify-center items-center gap-2">
                                    <span>Pesan Sekarang</span>
                                </a>
                                <p class="text-center text-xs text-gray-400">
                                    Gratis pembatalan hingga 2 jam sebelum waktu reservasi.
                                </p>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </main>
    </div>
</body>

</html>
