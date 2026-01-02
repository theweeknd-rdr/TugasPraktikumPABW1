<x-app-layout>
    <!-- Konten Utama -->
    <div class="bg-background-light dark:bg-background-dark min-h-screen font-display">
        <main class="flex-1 w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 py-6">

            <!-- Breadcrumbs -->
            <div class="flex flex-wrap gap-2 pb-6 text-sm">
                <a class="text-text-muted hover:text-primary transition-colors font-medium leading-normal"
                    href="{{ route('dashboard') }}">Beranda</a>
                <span class="text-text-muted font-medium leading-normal">/</span>
                <span class="text-text-main dark:text-white font-semibold leading-normal">Profil Pengguna</span>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">

                <!-- Sidebar Profil (Kiri) -->
                <aside class="w-full lg:w-80 shrink-0 space-y-6">
                    <div
                        class="bg-white dark:bg-card-dark rounded-xl p-6 shadow-sm border border-[#e7f3e7] dark:border-gray-800 flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <div
                                class="size-28 rounded-full bg-gradient-to-br from-primary/20 to-green-200 flex items-center justify-center text-primary ring-4 ring-white dark:ring-card-dark shadow-lg overflow-hidden text-4xl font-bold uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <!-- Tombol Edit Foto (Placeholder) -->
                            <button
                                class="absolute bottom-0 right-0 p-1.5 bg-primary text-white rounded-full hover:bg-green-600 transition-colors shadow-md border-2 border-white dark:border-card-dark">
                                <span class="material-symbols-outlined text-sm font-bold">edit</span>
                            </button>
                        </div>
                        <h1 class="text-xl font-bold text-text-main dark:text-white mb-1">{{ $user->name }}</h1>
                        <p class="text-sm text-text-muted mb-4">{{ $user->email }}</p>

                        <!-- Statistik Dummy -->
                        <div class="w-full grid grid-cols-2 gap-2 mb-6">
                            <div class="bg-background-light dark:bg-gray-800 p-2 rounded-lg">
                                <span class="block text-lg font-bold text-text-main dark:text-white">0</span>
                                <span class="text-xs text-text-muted font-medium">Ulasan</span>
                            </div>
                            <div class="bg-background-light dark:bg-gray-800 p-2 rounded-lg">
                                <span class="block text-lg font-bold text-text-main dark:text-white">0</span>
                                <span class="text-xs text-text-muted font-medium">Favorit</span>
                            </div>
                        </div>

                        <button
                            class="w-full py-2.5 px-4 bg-white dark:bg-transparent border border-[#e7f3e7] dark:border-gray-700 rounded-lg text-sm font-bold text-text-main dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-lg">settings</span>
                            Pengaturan Akun
                        </button>
                    </div>

                    <!-- Menu Navigasi Profil -->
                    <div
                        class="bg-white dark:bg-card-dark rounded-xl overflow-hidden shadow-sm border border-[#e7f3e7] dark:border-gray-800 hidden lg:block">
                        <nav class="flex flex-col text-sm font-medium">
                            <a class="flex items-center gap-3 px-5 py-3.5 bg-primary/10 text-primary border-l-4 border-primary"
                                href="#">
                                <span class="material-symbols-outlined">person</span>
                                Informasi Profil
                            </a>
                            <a class="flex items-center gap-3 px-5 py-3.5 text-text-main dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors border-l-4 border-transparent"
                                href="#">
                                <span class="material-symbols-outlined">lock</span>
                                Ganti Password
                            </a>
                            <div class="h-px bg-[#e7f3e7] dark:bg-gray-800 mx-5 my-1"></div>

                            <!-- Tombol Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center gap-3 px-5 py-3.5 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors border-l-4 border-transparent">
                                    <span class="material-symbols-outlined">logout</span>
                                    Keluar
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                <!-- Konten Form (Kanan) -->
                <div class="flex-1 w-full space-y-8">

                    <!-- Mobile Greeting -->
                    <div class="lg:hidden bg-primary/10 rounded-xl p-4 border border-primary/20">
                        <h3 class="font-bold text-text-main dark:text-white mb-1">Halo,
                            {{ explode(' ', $user->name)[0] }}! 👋</h3>
                        <p class="text-sm text-text-muted">Kelola informasi akun Anda di sini.</p>
                    </div>

                    <!-- 1. Update Profile Information -->
                    <section
                        class="bg-white dark:bg-card-dark p-6 rounded-xl border border-[#e7f3e7] dark:border-gray-800 shadow-sm">
                        <header class="mb-5">
                            <h2 class="text-lg font-bold text-text-main dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">badge</span>
                                Informasi Profil
                            </h2>
                            <p class="text-sm text-text-muted">Perbarui informasi profil akun dan alamat email Anda.</p>
                        </header>

                        <!-- Form Update Profil -->
                        @include('profile.partials.update-profile-information-form')
                    </section>

                    <!-- 2. Update Password -->
                    <section
                        class="bg-white dark:bg-card-dark p-6 rounded-xl border border-[#e7f3e7] dark:border-gray-800 shadow-sm">
                        <header class="mb-5">
                            <h2 class="text-lg font-bold text-text-main dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">lock_reset</span>
                                Perbarui Password
                            </h2>
                            <p class="text-sm text-text-muted">Pastikan akun Anda menggunakan password yang panjang dan
                                acak agar tetap aman.</p>
                        </header>

                        @include('profile.partials.update-password-form')
                    </section>

                    <!-- 3. Delete Account -->
                    <section
                        class="bg-white dark:bg-card-dark p-6 rounded-xl border border-red-100 dark:border-red-900/30 shadow-sm">
                        <header class="mb-5">
                            <h2 class="text-lg font-bold text-red-600 dark:text-red-400 flex items-center gap-2">
                                <span class="material-symbols-outlined">warning</span>
                                Hapus Akun
                            </h2>
                            <p class="text-sm text-text-muted">Setelah akun Anda dihapus, semua sumber daya dan data
                                akan dihapus secara permanen.</p>
                        </header>

                        @include('profile.partials.delete-user-form')
                    </section>

                </div>
            </div>
        </main>

        <!-- Footer (Include jika belum ada di layout global) -->
        <footer
            class="mt-auto bg-white dark:bg-card-dark border-t border-[#e7f3e7] dark:border-gray-800 py-10 px-6 lg:px-10">
            <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <div
                        class="flex items-center gap-2 justify-center md:justify-start text-text-main dark:text-white mb-2">
                        <div class="size-6 flex items-center justify-center rounded bg-primary/20 text-primary">
                            <span class="material-symbols-outlined text-lg">restaurant_menu</span>
                        </div>
                        <h2 class="text-lg font-bold">BandungKuliner</h2>
                    </div>
                    <p class="text-sm text-text-muted">Temukan rasa terbaik dari kota kembang.</p>
                </div>
                <div class="flex gap-6 text-sm font-medium text-text-main dark:text-gray-400">
                    <a class="hover:text-primary transition-colors" href="#">Tentang Kami</a>
                    <a class="hover:text-primary transition-colors" href="#">Kontak</a>
                    <a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                </div>
                <p class="text-xs text-text-muted">© 2023 BandungKuliner. All rights reserved.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
