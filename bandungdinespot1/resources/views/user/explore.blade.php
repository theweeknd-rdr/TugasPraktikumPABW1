<x-app-layout>
    <!-- Konten Utama -->
    <div class="bg-background-light dark:bg-background-dark min-h-screen font-display flex flex-col">
        <main class="flex-1 w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 py-6">

            <!-- Breadcrumbs -->
            <nav aria-label="Breadcrumb" class="flex flex-wrap gap-2 pb-6 text-sm">
                <a class="text-text-muted hover:text-primary transition-colors font-medium leading-normal"
                    href="{{ route('dashboard') }}">
                    Beranda
                </a>
                <span class="text-text-muted font-medium leading-normal" aria-hidden="true">/</span>
                <span class="text-text-main dark:text-white font-semibold leading-normal" aria-current="page">Jelajah
                    Kuliner</span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Filters Sidebar -->
                <aside class="w-full lg:w-72 shrink-0 space-y-6">
                    <!-- Mobile Filter Toggle -->
                    <div
                        class="lg:hidden flex items-center justify-between p-4 bg-white dark:bg-card-dark rounded-xl shadow-sm border border-[#e7f3e7] dark:border-gray-800">
                        <span class="font-bold text-text-main dark:text-white">Filter Pencarian</span>
                        <button type="button"
                            class="text-primary font-medium text-sm hover:text-primary-dark transition-colors">
                            Buka Filter
                        </button>
                    </div>

                    <!-- Desktop Sidebar Content -->
                    <div class="hidden lg:flex flex-col gap-6 sticky top-24">
                        <!-- Header Filter -->
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-text-main dark:text-white">Filter</h3>
                            <a href="{{ route('explore') }}" class="text-sm font-medium text-primary hover:underline">
                                Reset
                            </a>
                        </div>

                        <!-- Search Bar -->
                        <div
                            class="bg-white dark:bg-card-dark rounded-xl p-5 shadow-sm border border-[#e7f3e7] dark:border-gray-800">
                            <h4 class="font-bold text-text-main dark:text-white mb-4 text-sm uppercase tracking-wide">
                                Pencarian
                            </h4>
                            <form action="{{ route('explore') }}" method="GET">
                                @if (request('type'))
                                    <input type="hidden" name="type" value="{{ request('type') }}">
                                @endif
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-800 border border-[#e7f3e7] dark:border-gray-700 rounded-lg text-sm text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary placeholder-gray-400"
                                        placeholder="Cari restoran..." autocomplete="off">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted text-lg pointer-events-none select-none">
                                        search
                                    </span>
                                </div>
                            </form>
                        </div>

                        <!-- Category Filter -->
                        <div
                            class="bg-white dark:bg-card-dark rounded-xl p-5 shadow-sm border border-[#e7f3e7] dark:border-gray-800">
                            <h4 class="font-bold text-text-main dark:text-white mb-4 text-sm uppercase tracking-wide">
                                Kategori
                            </h4>
                            <div class="space-y-3">
                                @php
                                    $categories = [
                                        '' => 'Semua Kuliner',
                                        'Sunda' => 'Makanan Berat',
                                        'Cafe' => 'Cafe & Kopi',
                                        'Jajanan' => 'Jajanan Pasar',
                                        'Dessert' => 'Dessert',
                                    ];
                                    $currentType = request('type', '');
                                @endphp

                                @foreach ($categories as $value => $label)
                                    <a href="{{ route('explore', ['type' => $value, 'search' => request('search')]) }}"
                                        class="flex gap-x-3 items-center group cursor-pointer">
                                        <div
                                            class="h-4 w-4 rounded border-2 flex items-center justify-center transition-colors {{ $currentType == $value ? 'border-primary bg-primary' : 'border-[#cfe7cf] bg-transparent group-hover:border-primary' }}">
                                            @if ($currentType == $value)
                                                <div class="h-1.5 w-1.5 bg-white rounded-full"></div>
                                            @endif
                                        </div>
                                        <span
                                            class="text-text-main dark:text-gray-300 text-sm font-medium group-hover:text-primary transition-colors {{ $currentType == $value ? 'text-primary font-bold' : '' }}">
                                            {{ $label }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Filter (Visual Only) -->
                        <div
                            class="bg-white dark:bg-card-dark rounded-xl p-5 shadow-sm border border-[#e7f3e7] dark:border-gray-800">
                            <h4 class="font-bold text-text-main dark:text-white mb-6 text-sm uppercase tracking-wide">
                                Rentang Harga
                            </h4>
                            <div class="relative w-full h-1 bg-[#cfe7cf] rounded-full mb-6">
                                <div class="absolute left-[10%] right-[30%] h-full bg-primary rounded-full"></div>
                                <div
                                    class="absolute left-[10%] top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-2 border-primary rounded-full shadow cursor-pointer hover:scale-110 transition-transform">
                                </div>
                                <div
                                    class="absolute right-[30%] top-1/2 -translate-y-1/2 w-4 h-4 bg-white border-2 border-primary rounded-full shadow cursor-pointer hover:scale-110 transition-transform">
                                </div>
                            </div>
                            <div class="flex items-center justify-between text-xs font-medium text-text-muted">
                                <span
                                    class="bg-[#f0f7f0] dark:bg-gray-800 px-2 py-1 rounded border border-[#e7f3e7] dark:border-gray-700">Rp
                                    10rb</span>
                                <span
                                    class="bg-[#f0f7f0] dark:bg-gray-800 px-2 py-1 rounded border border-[#e7f3e7] dark:border-gray-700">Rp
                                    150rb</span>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Results Section -->
                <section class="flex-1 flex flex-col min-w-0">

                    <!-- Results Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-text-main dark:text-white">Kuliner di Bandung</h1>
                            <p class="text-text-muted text-sm mt-1">
                                Menampilkan <span class="font-semibold text-primary">{{ $restaurants->count() }}</span>
                                hasil terbaik
                            </p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span
                                class="text-sm font-medium text-text-main dark:text-gray-300 whitespace-nowrap">Urutkan:</span>
                            <div class="relative">
                                <select
                                    class="pl-3 pr-8 py-2 bg-white dark:bg-card-dark border border-[#e7f3e7] dark:border-gray-700 rounded-lg text-sm font-medium text-text-main dark:text-white focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer appearance-none shadow-sm">
                                    <option>Paling Relevan</option>
                                    <option>Rating Tertinggi</option>
                                    <option>Harga Terendah</option>
                                </select>
                                <span
                                    class="material-symbols-outlined absolute right-2 top-1/2 -translate-y-1/2 text-text-muted pointer-events-none text-lg select-none">
                                    expand_more
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Grid Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($restaurants as $restaurant)
                            <!-- Dynamic Card -->
                            <div
                                class="group flex flex-col bg-white dark:bg-card-dark rounded-xl overflow-hidden shadow-sm border border-[#e7f3e7] dark:border-gray-800 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                <!-- Image Container -->
                                <div class="relative h-48 w-full overflow-hidden bg-gray-200 dark:bg-gray-800">
                                    <!-- Rating Badge -->
                                    <div
                                        class="absolute top-3 left-3 z-10 bg-white/90 dark:bg-black/70 backdrop-blur-sm px-2 py-1 rounded-md flex items-center gap-1 text-xs font-bold text-text-main dark:text-white shadow-sm">
                                        <span class="material-symbols-outlined text-yellow-500 text-sm fill-1"
                                            style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span>4.5</span>
                                    </div>
                                    <!-- Favorite Button -->
                                    <div class="absolute top-3 right-3 z-10">
                                        <button type="button"
                                            class="bg-white/90 dark:bg-black/50 p-1.5 rounded-full text-gray-400 hover:text-red-500 transition-colors backdrop-blur-sm shadow-sm"
                                            aria-label="Simpan ke favorit">
                                            <span class="material-symbols-outlined text-lg">favorite</span>
                                        </button>
                                    </div>
                                    <!-- Image (Lazy Loaded for Performance) -->
                                    <img alt="{{ $restaurant->name }}"
                                        class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop&sig={{ $restaurant->id }}"
                                        loading="lazy" />
                                    <!-- Overlay for hover effect -->
                                    <div
                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="p-4 flex flex-col flex-1">
                                    <div class="flex justify-between items-start mb-2 gap-2">
                                        <h3 class="font-bold text-lg text-text-main dark:text-white line-clamp-1 group-hover:text-primary transition-colors"
                                            title="{{ $restaurant->name }}">
                                            {{ $restaurant->name }}
                                        </h3>
                                        <span
                                            class="text-xs font-semibold px-2 py-0.5 bg-green-100 text-green-700 rounded-full dark:bg-green-900/30 dark:text-green-400 whitespace-nowrap border border-green-200 dark:border-green-800">
                                            {{ $restaurant->status == 'verified' ? 'Buka' : 'Tutup' }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-1 text-text-muted text-xs mb-3">
                                        <span class="material-symbols-outlined text-sm shrink-0">location_on</span>
                                        <span class="truncate">{{ Str::limit($restaurant->address, 30) }}</span>
                                    </div>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span
                                            class="px-2 py-1 bg-background-light dark:bg-gray-800 rounded text-xs font-medium text-text-main dark:text-gray-300 border border-transparent group-hover:border-[#e7f3e7] dark:group-hover:border-gray-700 transition-colors">
                                            {{ $restaurant->type }}
                                        </span>
                                        <span
                                            class="px-2 py-1 bg-background-light dark:bg-gray-800 rounded text-xs font-medium text-text-main dark:text-gray-300 border border-transparent group-hover:border-[#e7f3e7] dark:group-hover:border-gray-700 transition-colors">
                                            $$
                                        </span>
                                    </div>

                                    <div
                                        class="mt-auto pt-3 border-t border-[#f0f7f0] dark:border-gray-800 flex items-center justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-[120px]"
                                            title="{{ $restaurant->description }}">
                                            {{ Str::limit($restaurant->description, 20) ?? 'Info belum tersedia' }}
                                        </span>
                                        <button type="button"
                                            class="text-sm font-bold text-primary hover:text-green-600 transition-colors flex items-center gap-1 group/btn">
                                            Lihat Detail
                                            <span
                                                class="material-symbols-outlined text-base transition-transform group-hover/btn:translate-x-1">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Empty State -->
                            <div
                                class="col-span-full py-12 text-center bg-white dark:bg-card-dark rounded-xl border-2 border-dashed border-[#e7f3e7] dark:border-gray-700">
                                <span
                                    class="material-symbols-outlined text-6xl text-gray-300 mb-2 select-none">store_off</span>
                                <p class="text-gray-500 font-medium text-lg">Tidak ada restoran yang ditemukan.</p>
                                <p class="text-sm text-gray-400 mt-1 max-w-xs mx-auto">Coba ubah kata kunci pencarian
                                    atau reset filter untuk melihat lebih banyak hasil.</p>
                                <a href="{{ route('explore') }}"
                                    class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-primary/10 text-primary rounded-lg font-bold text-sm hover:bg-primary/20 transition-colors">
                                    <span class="material-symbols-outlined text-lg">refresh</span>
                                    Reset Pencarian
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10 flex justify-center">
                        @if ($restaurants instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $restaurants->withQueryString()->links() }}
                        @else
                            <!-- Fallback Pagination (If data is not paginated) -->
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span>Menampilkan semua data</span>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="bg-white dark:bg-card-dark border-t border-[#e7f3e7] dark:border-gray-800 py-10 px-6 lg:px-10 mt-auto">
            <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <div
                        class="flex items-center gap-2 justify-center md:justify-start text-text-main dark:text-white mb-2">
                        <div class="size-8 flex items-center justify-center rounded-lg bg-primary/20 text-primary">
                            <span class="material-symbols-outlined text-xl">restaurant_menu</span>
                        </div>
                        <h2 class="text-lg font-bold tracking-tight">BandungDinespot</h2>
                    </div>
                    <p class="text-sm text-text-muted">Temukan rasa terbaik dari kota kembang.</p>
                </div>
                <div class="flex gap-6 text-sm font-medium text-text-main dark:text-gray-400">
                    <a class="hover:text-primary transition-colors" href="#">Tentang Kami</a>
                    <a class="hover:text-primary transition-colors" href="#">Kontak</a>
                    <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                </div>
                <p class="text-xs text-text-muted">© {{ date('Y') }} BandungDinespot. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
