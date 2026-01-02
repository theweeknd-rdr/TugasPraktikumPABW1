<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Partner Restoran - BandungDinespot</title>

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

    <!-- Left Column: Hero Image (Restaurant/Business Theme) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-surface-dark overflow-hidden group h-screen">
        <!-- Hero Image: Professional Kitchen/Chef -->
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
            style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745a30bf?q=80&w=2070&auto=format&fit=crop');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/95 via-background-dark/40 to-transparent">
        </div>

        <div class="absolute bottom-0 left-0 p-12 xl:p-16 w-full text-white z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="size-10 text-primary bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <span
                        class="material-symbols-outlined text-2xl w-full h-full flex items-center justify-center">storefront</span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight">Partner Dinespot</h2>
            </div>
            <p class="text-4xl xl:text-5xl font-extrabold leading-tight mb-4 tracking-tight">Kembangkan Bisnis
                <br />Kuliner Anda
            </p>
            <p class="text-lg opacity-80 max-w-md font-medium leading-relaxed">Jangkau ribuan pelanggan baru dan kelola
                reservasi dengan mudah melalui platform kami.</p>
        </div>
    </div>

    <!-- Right Column: Registration Form -->
    <!-- Added pb-10 to ensure bottom scroll padding -->
    <div
        class="flex-1 w-full lg:w-1/2 flex flex-col justify-start sm:justify-center items-center h-screen overflow-y-auto bg-background-light dark:bg-background-dark py-10 px-6 sm:px-12 xl:px-20 pb-20">

        <div class="w-full max-w-lg space-y-8 animate-fade-in my-auto">

            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center gap-3 mb-2 text-text-main dark:text-white justify-center">
                <div class="size-8 text-primary">
                    <span class="material-symbols-outlined text-3xl">storefront</span>
                </div>
                <span class="font-bold text-xl tracking-tight">BandungDinespot</span>
            </div>

            <!-- Header -->
            <div class="flex flex-col gap-2">
                <!-- UPDATED: Teks diubah menjadi "Daftar Akun Baru" dengan ukuran besar agar sama dengan Login -->
                <h1
                    class="text-text-main dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Daftar Akun Baru
                </h1>
                <p class="text-text-muted dark:text-gray-400 text-base font-normal">
                    Isi data di bawah untuk membuat akun pemilik restoran.
                </p>
            </div>

            <!-- Tab Switcher (Masuk / Daftar) -->
            <div class="w-full border-b border-gray-200 dark:border-gray-700 flex gap-8">
                <a href="{{ route('login') }}"
                    class="pb-3 border-b-[3px] border-transparent text-gray-500 dark:text-gray-400 font-bold text-sm tracking-wide hover:text-gray-900 dark:hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="pb-3 border-b-[3px] border-primary text-gray-900 dark:text-white font-bold text-sm tracking-wide">
                    Daftar
                </a>
            </div>

            <!-- Role Switcher (Tab) -->
            <div
                class="w-full bg-white dark:bg-white/5 p-1 rounded-xl flex border border-border-light dark:border-border-dark">
                <!-- Link to User Register -->
                <a href="{{ route('register') }}"
                    class="flex-1 py-2 text-sm font-medium text-text-muted dark:text-gray-400 hover:text-text-main dark:hover:text-white transition-all text-center">
                    Pelanggan
                </a>
                <!-- Active Tab -->
                <button
                    class="flex-1 py-2 text-sm font-bold rounded-lg bg-primary text-text-main shadow-sm transition-all text-center">
                    Pemilik Restoran
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5 w-full">
                @csrf
                <input type="hidden" name="role" value="restoran">

                <!-- Owner Name Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="name">Nama
                        Pemilik</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">person</span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Nama lengkap Anda" />
                    </div>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Restaurant Name Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="restaurant_name">Nama
                        Restoran</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">store</span>
                        <input id="restaurant_name" type="text" name="restaurant_name"
                            value="{{ old('restaurant_name') }}" required
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Cth: Warung Nasi Ampera" />
                    </div>
                    @error('restaurant_name')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Restaurant Type Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="restaurant_type">Jenis
                        Restoran</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">restaurant</span>
                        <input id="restaurant_type" type="text" name="restaurant_type"
                            value="{{ old('restaurant_type') }}" required
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Cth: Sunda, Barat, Cafe, Kopi" />
                    </div>
                    @error('restaurant_type')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="email">Email
                        Bisnis</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">mail</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="kontak@restoran.com" />
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
                        <input id="password" type="password" name="password" required
                            class="w-full h-14 pl-12 pr-12 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Minimal 8 karakter" />
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

                <!-- Confirm Password -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold"
                        for="password_confirmation">Konfirmasi Password</label>
                    <div class="relative group/input">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted group-focus-within/input:text-primary transition-colors select-none text-[22px]">lock_reset</span>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full h-14 pl-12 pr-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white placeholder:text-text-muted focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                            placeholder="Ulangi password" />
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="mt-4 w-full h-14 bg-primary hover:bg-[#0fd60f] text-text-main font-bold text-base rounded-lg shadow-lg shadow-primary/20 transition-all hover:scale-[1.01] active:scale-[0.98]">
                    Daftar Sebagai Partner
                </button>
            </form>

            <div class="text-center pt-2 pb-6">
                <p class="text-sm text-text-muted dark:text-gray-400">
                    Sudah punya akun partner? <a
                        class="font-bold text-primary hover:underline decoration-2 underline-offset-2"
                        href="{{ route('login') }}">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
