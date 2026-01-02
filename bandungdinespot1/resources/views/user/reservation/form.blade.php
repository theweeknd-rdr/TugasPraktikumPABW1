<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reservasi Meja - {{ $restaurant->name }}</title>

    <!-- Preconnect Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
                        "primary": "#ee8c2b", // Orange sesuai request
                        "primary-dark": "#d97b1f",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-[#111811] antialiased min-h-screen flex flex-col">

    <!-- TopNavBar (Sticky) -->
    <header class="bg-white border-b border-[#f0f4f0] sticky top-0 z-50 shadow-sm">
        <div class="max-w-[1280px] mx-auto px-4 lg:px-10">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-6">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('restaurants.show', $restaurant->id) }}"
                        class="flex items-center gap-2 text-[#111811] hover:text-primary transition-colors group">
                        <span
                            class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
                        <span class="text-sm font-bold">Kembali</span>
                    </a>
                    <div class="h-6 w-px bg-gray-200"></div>
                    <h2 class="text-[#111811] text-lg font-bold leading-tight tracking-tight">Reservasi Meja</h2>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-[1280px] mx-auto px-4 lg:px-10 py-8">

        <!-- Breadcrumb -->
        <nav aria-label="Breadcrumb" class="mb-6 flex items-center gap-2 text-sm text-gray-500">
            <span class="hover:text-[#111811] transition-colors">{{ $restaurant->name }}</span>
            <span class="text-gray-300 select-none">/</span>
            <span class="font-semibold text-[#111811] select-none">Form Reservasi</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- Left Column: Booking Form -->
            <div class="lg:col-span-8 flex flex-col gap-6">

                <!-- Hero Card (Optimized Image) -->
                <div
                    class="bg-white rounded-xl shadow-sm overflow-hidden border border-[#f0f4f0] group relative h-[200px]">
                    <!-- Image using IMG tag for LCP Performance -->
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop&sig={{ $restaurant->id }}"
                        alt="{{ $restaurant->name }}" class="absolute inset-0 w-full h-full object-cover"
                        fetchpriority="high">

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 p-6 w-full z-10">
                        <h1 class="text-white text-3xl font-black tracking-tight mb-1 drop-shadow-md">
                            {{ $restaurant->name }}</h1>
                        <div class="flex items-center gap-4 text-white/90 text-sm font-medium">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                {{ Str::limit($restaurant->address, 40) }}
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">restaurant</span>
                                {{ $restaurant->type }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="bg-white rounded-xl shadow-sm border border-[#f0f4f0] p-6 sm:p-8">
                    <form action="#" method="POST" class="flex flex-col gap-8">
                        @csrf

                        <!-- Step 1: Detail Kunjungan -->
                        <section>
                            <h2 class="text-[#111811] text-xl font-bold mb-6 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/20 text-[#111811] text-sm font-extrabold">1</span>
                                Detail Kunjungan
                            </h2>
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="flex-1 min-w-[200px]">
                                    <label for="date" class="block text-sm font-bold text-[#111811] mb-2">Tanggal
                                        Kunjungan</label>
                                    <input type="date" id="date" name="date"
                                        class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] text-[#111811] focus:border-primary focus:ring-primary h-12 px-4 transition-colors cursor-pointer"
                                        required>
                                </div>
                                <div class="flex-1 grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="time"
                                            class="block text-sm font-bold text-[#111811] mb-2">Waktu</label>
                                        <div class="relative">
                                            <select id="time" name="time"
                                                class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] text-[#111811] focus:border-primary focus:ring-primary h-12 px-4 appearance-none cursor-pointer">
                                                <option>10:00</option>
                                                <option>11:00</option>
                                                <option>12:00</option>
                                                <option>13:00</option>
                                                <option>19:00</option>
                                            </select>
                                            <span
                                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">expand_more</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="pax"
                                            class="block text-sm font-bold text-[#111811] mb-2">Tamu</label>
                                        <div class="relative">
                                            <select id="pax" name="pax"
                                                class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] text-[#111811] focus:border-primary focus:ring-primary h-12 px-4 appearance-none cursor-pointer">
                                                <option>2 Orang</option>
                                                <option>4 Orang</option>
                                                <option>6 Orang</option>
                                                <option>8+ Orang</option>
                                            </select>
                                            <span
                                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">group</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="border-t border-gray-100"></div>

                        <!-- Step 2: Data Pemesan -->
                        <section>
                            <h2 class="text-[#111811] text-xl font-bold mb-6 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/20 text-[#111811] text-sm font-extrabold">2</span>
                                Data Pemesan
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col gap-1">
                                    <label for="name" class="text-sm font-bold text-[#111811]">Nama Lengkap</label>
                                    <input id="name" name="name" type="text"
                                        class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] focus:border-primary focus:ring-primary h-12 px-4 placeholder-gray-400 transition-shadow"
                                        placeholder="Nama Anda" autocomplete="name" required />
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="phone" class="text-sm font-bold text-[#111811]">Nomor
                                        WhatsApp</label>
                                    <input id="phone" name="phone" type="tel"
                                        class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] focus:border-primary focus:ring-primary h-12 px-4 placeholder-gray-400 transition-shadow"
                                        placeholder="0812xxxx" autocomplete="tel" required />
                                </div>
                                <div class="md:col-span-2 flex flex-col gap-1">
                                    <label for="notes" class="text-sm font-bold text-[#111811]">Catatan Khusus
                                        (Opsional)</label>
                                    <textarea id="notes" name="notes" rows="3"
                                        class="w-full rounded-lg border-gray-200 bg-[#f8f9fa] focus:border-primary focus:ring-primary p-4 resize-none placeholder-gray-400 transition-shadow"
                                        placeholder="Contoh: Saya butuh kursi bayi atau area bebas asap rokok..."></textarea>
                                </div>
                            </div>
                        </section>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-4 rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex justify-center items-center gap-2 text-lg active:scale-[0.98]">
                                Konfirmasi Reservasi
                                <span class="material-symbols-outlined text-[24px]">check_circle</span>
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-4">
                                Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan reservasi.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Sticky Summary -->
            <aside class="lg:col-span-4 relative hidden lg:block">
                <div class="sticky top-24 flex flex-col gap-4">
                    <div class="bg-white rounded-xl shadow-lg border border-[#f0f4f0] overflow-hidden">
                        <div class="bg-[#111811] text-white p-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">store</span>
                            <h3 class="font-bold text-lg">Info Restoran</h3>
                        </div>
                        <div class="p-5 flex flex-col gap-5">
                            <div class="flex gap-4 pb-5 border-b border-gray-100">
                                <!-- Lazy Load Thumbnail -->
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=200&auto=format&fit=crop&sig={{ $restaurant->id }}"
                                    alt="Thumbnail {{ $restaurant->name }}" loading="lazy"
                                    class="size-16 rounded-lg object-cover shrink-0 border border-gray-100">
                                <div>
                                    <p class="font-bold text-[#111811] text-base leading-tight mb-1">
                                        {{ $restaurant->name }}</p>
                                    <p class="text-xs text-gray-500 leading-relaxed">{{ $restaurant->address }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm text-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Jam Buka</span>
                                    <span class="font-bold text-[#111811]">10:00 - 22:00</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Telepon</span>
                                    <span class="font-bold text-[#111811]">(022) 123456</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Kategori</span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-gray-100 text-xs font-bold text-gray-700">{{ $restaurant->type }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-4 text-xs text-gray-500 text-center border-t border-gray-100">
                            Butuh bantuan? <a href="#" class="text-primary font-bold hover:underline">Hubungi
                                CS</a>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </main>

</body>

</html>
