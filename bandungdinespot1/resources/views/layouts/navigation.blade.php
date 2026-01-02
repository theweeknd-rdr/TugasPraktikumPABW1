<nav x-data="{ open: false }"
    class="bg-white dark:bg-[#221910] border-b border-[#e5e0dc] dark:border-[#3a2e25] sticky top-0 z-50 font-sans">
    <!-- Menu Navigasi Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-2 group transition-opacity hover:opacity-80">
                        <!-- Ikon Logo -->
                        <span class="material-symbols-outlined text-3xl text-[#ee8c2b]">restaurant_menu</span>
                        <!-- Nama Brand -->
                        <span
                            class="font-bold text-lg text-[#1b140d] dark:text-white tracking-tight">BandungDinespot</span>
                    </a>
                </div>
            </div>

            <!-- Tautan Navigasi (Desktop) -->
            <div class="hidden sm:flex sm:flex-1 sm:justify-end sm:gap-8 sm:items-center">
                <div class="flex items-center gap-6">
                    <!-- Link Home / Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'text-[#ee8c2b] font-bold' : 'text-[#1b140d] dark:text-white hover:text-[#ee8c2b]' }}">
                        {{ __('Home') }}
                    </a>

                    <!-- Link Jelajah (Sudah Disambungkan) -->
                    <a href="{{ route('explore') }}"
                        class="text-sm font-medium transition-colors {{ request()->routeIs('explore') ? 'text-[#ee8c2b] font-bold' : 'text-[#1b140d] dark:text-white hover:text-[#ee8c2b]' }}">
                        Jelajah
                    </a>

                    <!-- Link Rekomendasi (Placeholder) -->
                    <a href="#"
                        class="text-sm font-medium text-[#1b140d] dark:text-white hover:text-[#ee8c2b] transition-colors">
                        Rekomendasi
                    </a>
                </div>

                <!-- Dropdown Pengaturan (Desktop) -->
                <div class="relative ms-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-[#1b140d] dark:text-white bg-[#f8f7f6] dark:bg-[#3a2e25] hover:bg-gray-200 dark:hover:bg-[#4a3b30] focus:outline-none transition ease-in-out duration-150 gap-2">
                                <!-- Placeholder Avatar (Inisial Nama) -->
                                <div
                                    class="w-7 h-7 rounded-full bg-[#ee8c2b] text-white flex items-center justify-center text-xs font-bold uppercase shadow-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <!-- Nama Pengguna -->
                                <div class="hidden md:block font-bold">{{ Auth::user()->name }}</div>

                                <div class="ms-1 text-[#9a734c]">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="hover:text-[#ee8c2b] hover:bg-[#fff8f0]">
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <!-- Autentikasi -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" class="hover:text-red-600 hover:bg-red-50"
                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#1b140d] dark:text-white hover:text-[#ee8c2b] hover:bg-gray-100 dark:hover:bg-[#3a2e25] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi Responsif (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-[#221910] border-t border-[#e5e0dc] dark:border-[#3a2e25]">
        <div class="pt-2 pb-3 space-y-1">

            <!-- Mobile Home Link -->
            <a href="{{ route('dashboard') }}"
                class="block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'border-[#ee8c2b] text-[#ee8c2b] bg-[#fff8f0]' : 'border-transparent text-[#1b140d] dark:text-white hover:text-[#ee8c2b] hover:bg-[#fff8f0] hover:border-[#ee8c2b]' }}">
                {{ __('Home') }}
            </a>

            <!-- Mobile Jelajah Link -->
            <a href="{{ route('explore') }}"
                class="block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out {{ request()->routeIs('explore') ? 'border-[#ee8c2b] text-[#ee8c2b] bg-[#fff8f0]' : 'border-transparent text-[#1b140d] dark:text-white hover:text-[#ee8c2b] hover:bg-[#fff8f0] hover:border-[#ee8c2b]' }}">
                Jelajah
            </a>

            <!-- Mobile Rekomendasi Link -->
            <a href="#"
                class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#1b140d] dark:text-white hover:text-[#ee8c2b] hover:bg-[#fff8f0] hover:border-[#ee8c2b] transition duration-150 ease-in-out">
                Rekomendasi
            </a>

        </div>

        <!-- Opsi Pengaturan Responsif -->
        <div class="pt-4 pb-1 border-t border-[#e5e0dc] dark:border-[#3a2e25] bg-[#f8f7f6] dark:bg-[#2d241b]">
            <div class="px-4 flex items-center gap-3">
                <!-- Avatar -->
                <div
                    class="w-10 h-10 rounded-full bg-[#ee8c2b] text-white flex items-center justify-center text-lg font-bold uppercase shrink-0 shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <!-- Info Pengguna -->
                <div>
                    <div class="font-bold text-base text-[#1b140d] dark:text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-[#9a734c]">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="hover:text-[#ee8c2b] hover:bg-[#fff8f0]">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Autentikasi -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" class="hover:text-red-600 hover:bg-red-50"
                        onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
