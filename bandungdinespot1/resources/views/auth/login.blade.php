<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Masuk - BandungDinespot</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "primary-dark": "#0fb80f",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                        "surface-light": "#ffffff",
                        "surface-dark": "#162b16",
                        "border-light": "#cfe7cf",
                        "border-dark": "#2a4e2a",
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
                    animation: {
                        "fade-in": "fadeIn 0.5s ease-out forwards",
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": {
                                opacity: "0",
                                transform: "translateY(10px)"
                            },
                            "100%": {
                                opacity: "1",
                                transform: "translateY(0)"
                            },
                        },
                    },
                },
            },
        }
    </script>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-text-main dark:text-white min-h-screen flex selection:bg-primary selection:text-text-main overflow-hidden">

    <!-- Left Column: Hero Image & Branding (Desktop Only) -->
    <!-- W-1/2 ensures perfect split like the screenshot -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-surface-dark overflow-hidden group h-screen">
        <!-- Hero Image -->
        <!-- Menggunakan gambar placeholder berkualitas tinggi yang relevan dengan makanan/Indonesian food -->
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
            data-alt="Traditional Indonesian food feast"
            style="background-image: url('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=1980&auto=format&fit=crop');">
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/95 via-background-dark/40 to-transparent">
        </div>

        <!-- Content Overlay -->
        <div class="absolute bottom-0 left-0 p-12 xl:p-16 w-full text-white z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="size-10 text-primary bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <span
                        class="material-symbols-outlined text-2xl w-full h-full flex items-center justify-center">restaurant_menu</span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight">BandungDinespot</h2>
            </div>
            <p class="text-4xl xl:text-5xl font-extrabold leading-tight mb-4 tracking-tight">Jelajahi Rasa <br />Kota
                Kembang</p>
            <p class="text-lg opacity-80 max-w-md font-medium leading-relaxed">Temukan rekomendasi kuliner terbaik, dari
                street food legendaris hingga cafe kekinian yang instagramable.</p>

           

        </div>
    </div>

    <!-- Right Column: Authentication Form -->
    <!-- Menggunakan h-screen dan overflow-y-auto agar scroll hanya terjadi di sisi kanan jika konten panjang -->
    <div
        class="flex-1 w-full lg:w-1/2 flex flex-col justify-center items-center h-screen overflow-y-auto bg-background-light dark:bg-background-dark py-10 px-6 sm:px-12 xl:px-20">

        <!-- ADJUSTMENT: Max-width disesuaikan ke max-w-lg (512px) agar lebih lebar & pas dengan screenshot dibanding max-w-md (448px) -->
        <div class="w-full max-w-lg space-y-8 animate-fade-in">

            <!-- Mobile Logo (Visible only on small screens) -->
            <div class="flex lg:hidden items-center gap-3 mb-2 text-text-main dark:text-white justify-center">
                <div class="size-8 text-primary">
                    <span class="material-symbols-outlined text-3xl">restaurant_menu</span>
                </div>
                <span class="font-bold text-xl tracking-tight">BandungDinespot</span>
            </div>

            <!-- Header Section -->
            <div class="flex flex-col gap-2">
                <h1
                    class="text-text-main dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Selamat Datang Kembali
                </h1>
                <p class="text-text-muted dark:text-gray-400 text-base font-normal">
                    Masuk untuk mengelola rekomendasi kuliner favoritmu di Bandung.
                </p>
            </div>

            <!-- Tab Switcher -->
            <div class="w-full border-b border-border-light dark:border-border-dark flex gap-8">
                <a href="{{ route('login') }}"
                    class="pb-3 border-b-[3px] border-primary text-text-main dark:text-white font-bold text-sm tracking-wide">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="pb-3 border-b-[3px] border-transparent text-text-muted dark:text-gray-500 font-bold text-sm tracking-wide hover:text-text-main dark:hover:text-white transition-colors">
                    Daftar
                </a>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div
                    class="p-4 rounded-lg bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400 font-medium text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5 w-full">
                @csrf

                <!-- Email Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="email">Email</label>
                    <div class="relative group/input">
                        <!-- Icon centered vertically -->
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">mail</span>
                        <!-- ADJUSTMENT: h-14 (3.5rem/56px) untuk input yang lebih tebal sesuai screenshot -->
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username"
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Masukkan email Anda" />
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="password">Password</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">lock</span>
                        <!-- ADJUSTMENT: h-14 untuk konsistensi -->
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full h-14 pl-12 pr-12 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Masukkan password Anda" />
                        <!-- Toggle Password Visibility -->
                        <button type="button"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text-main dark:hover:text-white cursor-pointer transition-colors p-1 rounded-full hover:bg-gray-100 dark:hover:bg-white/10"
                            onclick="const p = document.getElementById('password'); p.type = p.type === 'password' ? 'text' : 'password';">
                            <span class="material-symbols-outlined text-[20px] align-middle">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-1">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer group select-none">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-border-light text-primary focus:ring-primary focus:ring-offset-0 bg-[#f8fcf8] dark:bg-surface-dark dark:border-border-dark cursor-pointer" />
                        <span
                            class="text-sm font-medium text-text-main dark:text-gray-300 group-hover:text-primary transition-colors">Ingat
                            Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-bold text-primary hover:text-green-600 dark:hover:text-green-400 transition-colors">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <!-- Primary Action Button -->
                <!-- ADJUSTMENT: h-14 agar sama tebalnya dengan input field -->
                <button type="submit"
                    class="mt-4 w-full h-14 bg-primary hover:bg-[#0fd60f] text-text-main font-bold text-base rounded-lg shadow-lg shadow-primary/20 transition-all hover:scale-[1.01] active:scale-[0.98] flex items-center justify-center gap-2">
                    <span>Masuk Sekarang</span>
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </button>
            </form>

            <!-- Social Login Divider -->
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-border-light dark:border-border-dark"></div>
                <span class="flex-shrink-0 mx-4 text-xs font-bold text-text-muted uppercase tracking-wider">Atau masuk
                    dengan</span>
                <div class="flex-grow border-t border-border-light dark:border-border-dark"></div>
            </div>

            <!-- Social Buttons -->
            <div class="grid grid-cols-2 gap-4">
                <button type="button"
                    class="flex items-center justify-center gap-3 h-12 border border-border-light dark:border-border-dark rounded-lg hover:bg-white dark:hover:bg-white/5 hover:border-primary/50 transition-all bg-[#f8fcf8] dark:bg-surface-dark group">
                    <!-- Google SVG -->
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    <span class="text-sm font-bold text-text-main dark:text-white">Google</span>
                </button>
                <button type="button"
                    class="flex items-center justify-center gap-3 h-12 border border-border-light dark:border-border-dark rounded-lg hover:bg-white dark:hover:bg-white/5 hover:border-[#1877F2]/50 transition-all bg-[#f8fcf8] dark:bg-surface-dark group">
                    <svg aria-hidden="true" class="w-5 h-5 text-[#1877F2] group-hover:scale-110 transition-transform"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path clip-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            fill-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-bold text-text-main dark:text-white">Facebook</span>
                </button>
            </div>

            <!-- Footer -->
            <div class="text-center pt-2">
                <p class="text-sm text-text-muted dark:text-gray-400">
                    Belum punya akun? <a class="font-bold text-primary hover:underline decoration-2 underline-offset-2"
                        href="{{ route('register') }}">Daftar Gratis</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
