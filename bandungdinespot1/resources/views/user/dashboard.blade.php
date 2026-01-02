<x-app-layout>
    <!-- Container Utama -->
    <div class="py-8 bg-background-light dark:bg-background-dark min-h-screen">
        <div class="max-w-[1280px] mx-auto px-4 md:px-6 lg:px-8 flex flex-col gap-8">

            <!-- Hero Search Section -->
            <section
                class="rounded-2xl overflow-hidden relative min-h-[400px] flex flex-col items-center justify-center text-center p-6 md:p-10 shadow-lg group">
                <div class="absolute inset-0 z-0">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop"
                        alt="Kuliner Bandung"
                        class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                        fetchpriority="high">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/50 to-black/70"></div>
                </div>

                <div class="relative z-10 w-full max-w-3xl flex flex-col gap-6 items-center">
                    <div class="space-y-2">
                        <h1
                            class="text-white text-3xl md:text-5xl font-black leading-tight tracking-tight drop-shadow-md">
                            Temukan Rasa Terbaik di Bandung
                        </h1>
                        <p class="text-gray-200 text-sm md:text-lg font-medium drop-shadow-sm">
                            Eksplorasi kuliner lokal, cafe hits, hingga jajanan kaki lima
                        </p>
                    </div>

                    <!-- Search Bar -->
                    <div class="w-full max-w-xl">
                        <form action="#" method="GET"
                            class="flex w-full items-center bg-white dark:bg-[#2d241b] rounded-xl shadow-lg p-2 transition-transform focus-within:scale-[1.02] duration-200 border border-transparent focus-within:border-primary/50">
                            <div class="pl-4 text-[#9a734c] flex items-center justify-center">
                                <span class="material-symbols-outlined select-none">search</span>
                            </div>
                            <input type="text" name="search"
                                class="w-full bg-transparent border-none focus:ring-0 text-[#1b140d] dark:text-white placeholder:text-[#9a734c]/70 text-base py-3 px-4"
                                placeholder="Cari nasi goreng, cafe, atau area..." value="{{ request('search') }}"
                                autocomplete="off" />
                            <button type="submit"
                                class="bg-primary hover:bg-[#d5781a] text-white px-6 py-3 rounded-lg font-bold text-sm md:text-base transition-colors shrink-0 shadow-md active:scale-95">
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Popular Tags -->
                    <div class="flex flex-wrap justify-center gap-2 text-white/90 text-xs md:text-sm font-medium">
                        <span>Populer:</span>
                        <a class="underline hover:text-primary transition-colors" href="#">Mie Kocok</a>
                        <a class="underline hover:text-primary transition-colors" href="#">Batagor Kingsley</a>
                        <a class="underline hover:text-primary transition-colors" href="#">Kopi Aroma</a>
                    </div>
                </div>
            </section>

            <!-- Filters & Sorting (Sticky) -->
            <section
                class="flex flex-col md:flex-row gap-4 justify-between items-start md:items-center sticky top-[70px] z-20 bg-background-light/95 dark:bg-background-dark/95 py-4 -mx-4 px-4 md:mx-0 md:px-0 backdrop-blur-md transition-all border-b border-transparent md:border-none shadow-sm md:shadow-none">
                <div class="flex gap-3 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto no-scrollbar">
                    <button type="button"
                        class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-full bg-[#1b140d] dark:bg-white text-white dark:text-[#1b140d] px-5 shadow-md hover:shadow-lg transition-all active:scale-95">
                        <span class="text-sm font-bold">Semua</span>
                    </button>
                    <button type="button"
                        class="group flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-[#3a2e25] border border-[#e5e0dc] dark:border-[#4a3b30] px-5 hover:border-primary hover:text-primary dark:hover:text-primary transition-all shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        <span class="text-sm font-medium">Halal</span>
                    </button>
                    <button type="button"
                        class="group flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-[#3a2e25] border border-[#e5e0dc] dark:border-[#4a3b30] px-5 hover:border-primary hover:text-primary dark:hover:text-primary transition-all shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">local_cafe</span>
                        <span class="text-sm font-medium">Cafe</span>
                    </button>
                    <button type="button"
                        class="group flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-[#3a2e25] border border-[#e5e0dc] dark:border-[#4a3b30] px-5 hover:border-primary hover:text-primary dark:hover:text-primary transition-all shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">storefront</span>
                        <span class="text-sm font-medium">Kaki Lima</span>
                    </button>
                    <button type="button"
                        class="group flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-[#3a2e25] border border-[#e5e0dc] dark:border-[#4a3b30] px-5 hover:border-primary hover:text-primary dark:hover:text-primary transition-all shadow-sm active:scale-95">
                        <span class="material-symbols-outlined text-[18px] text-primary">trending_up</span>
                        <span class="text-sm font-medium">Trending</span>
                    </button>
                </div>

                <button type="button"
                    class="hidden md:flex items-center gap-2 text-sm font-bold text-[#1b140d] dark:text-white bg-white dark:bg-[#3a2e25] border border-[#e5e0dc] dark:border-[#4a3b30] px-4 py-2.5 rounded-lg hover:border-primary hover:text-primary transition-colors shadow-sm active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">tune</span>
                    Filter
                </button>
            </section>

            <!-- Results Grid -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @forelse($restaurants as $restaurant)
                    <!-- Dynamic Card -->
                    <div
                        class="group flex flex-col gap-3 bg-white dark:bg-[#2d241b] rounded-xl p-3 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-transparent hover:border-[#f3ede7] dark:hover:border-[#3a2e25]">

                        <!-- Image Container with Lazy Loading -->
                        <div
                            class="relative w-full aspect-[4/3] rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-800">

                            <!-- LINK KE DETAIL (GAMBAR) -->
                            <a href="{{ route('restaurants.show', $restaurant->id) }}"
                                class="block w-full h-full cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800&auto=format&fit=crop&sig={{ $restaurant->id }}"
                                    alt="{{ $restaurant->name }}" loading="lazy"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            </a>

                            <!-- Save Button -->
                            <button type="button"
                                class="absolute top-2 right-2 bg-white/90 dark:bg-black/70 backdrop-blur-sm p-1.5 rounded-full shadow-sm cursor-pointer hover:bg-primary hover:text-white transition-colors group/btn z-20"
                                aria-label="Simpan">
                                <span class="material-symbols-outlined text-[20px] block">bookmark_border</span>
                            </button>

                            <!-- Rating Badge -->
                            <div
                                class="absolute bottom-2 left-2 bg-white/90 dark:bg-black/70 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold flex items-center gap-1 text-[#1b140d] dark:text-white z-10 pointer-events-none">
                                <span class="material-symbols-outlined text-yellow-500 text-[14px]">star</span>
                                <span>4.5</span>
                                <span class="text-gray-500 dark:text-gray-400 font-normal text-[10px]">(New)</span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="px-1 pb-1">
                            <div class="flex justify-between items-start gap-2">

                                <!-- LINK KE DETAIL (JUDUL) -->
                                <a href="{{ route('restaurants.show', $restaurant->id) }}"
                                    class="block group-hover:text-primary transition-colors">
                                    <h3 class="text-[#1b140d] dark:text-white text-lg font-bold leading-tight line-clamp-1"
                                        title="{{ $restaurant->name }}">
                                        {{ $restaurant->name }}
                                    </h3>
                                </a>

                                <span
                                    class="text-[10px] font-bold px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full shrink-0 uppercase tracking-wide select-none">
                                    Buka
                                </span>
                            </div>

                            <p class="text-[#9a734c] text-sm mt-1 truncate">
                                {{ $restaurant->type }} • {{ Str::limit($restaurant->address, 20) }}
                            </p>

                            <div
                                class="flex items-center gap-2 mt-3 text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-white/5 pt-2">
                                <span class="font-medium text-[#1b140d] dark:text-[#e0d6cd]">$$</span>
                                <span>•</span>
                                <span class="flex items-center gap-1 truncate max-w-[150px]"
                                    title="{{ $restaurant->description }}">
                                    <span class="material-symbols-outlined text-[14px] shrink-0">info</span>
                                    {{ Str::limit($restaurant->description, 25) ?? 'Info belum tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div
                        class="col-span-full flex flex-col items-center justify-center py-20 text-center text-gray-400">
                        <div class="bg-white dark:bg-[#2d241b] p-6 rounded-full shadow-sm mb-4">
                            <span
                                class="material-symbols-outlined text-6xl text-[#e5e0dc] dark:text-[#4a3b30]">store_off</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#1b140d] dark:text-white">Belum ada restoran</h3>
                        <p class="text-sm mt-1 max-w-md mx-auto">Saat ini belum ada data restoran yang sesuai
                            pencarian
                            Anda.</p>
                    </div>
                @endforelse
            </section>

            <!-- Pagination -->
            <div class="flex items-center justify-center pt-4 pb-12">
                {{-- Gunakan komponen pagination Laravel default jika tersedia: $restaurants->links() --}}

                <!-- Placeholder Statis -->
                <div class="flex items-center gap-2">
                    <button type="button" disabled
                        class="flex size-10 items-center justify-center rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25] text-[#1b140d] dark:text-white hover:bg-white dark:hover:bg-[#3a2e25] disabled:opacity-50 disabled:cursor-not-allowed transition-colors shadow-sm bg-white dark:bg-[#2d241b]">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button type="button"
                        class="flex size-10 items-center justify-center rounded-lg bg-primary text-white font-bold text-sm shadow-md transition-transform hover:scale-105 active:scale-95">1</button>
                    <button type="button"
                        class="flex size-10 items-center justify-center rounded-lg border border-transparent text-[#1b140d] dark:text-white hover:bg-white dark:hover:bg-[#3a2e25] text-sm font-medium transition-colors">2</button>
                    <span
                        class="flex size-10 items-center justify-center text-[#1b140d] dark:text-gray-500 text-sm">...</span>
                    <button type="button"
                        class="flex size-10 items-center justify-center rounded-lg border border-[#e5e0dc] dark:border-[#3a2e25] text-[#1b140d] dark:text-white hover:bg-white dark:hover:bg-[#3a2e25] transition-colors shadow-sm bg-white dark:bg-[#2d241b]">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Utility (Hanya untuk scrollbar hide) -->
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>
