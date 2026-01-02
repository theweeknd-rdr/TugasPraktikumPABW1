<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Daftar Akun - BandungDinespot</title>

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

    <!-- Left Column: Hero Image (Foodie Theme) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-surface-dark overflow-hidden group h-screen">
        <!-- Hero Image: Social Dining -->
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
            style="background-image: url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-background-dark/95 via-background-dark/40 to-transparent">
        </div>

        <div class="absolute bottom-0 left-0 p-12 xl:p-16 w-full text-white z-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="size-10 text-primary bg-white/10 backdrop-blur-sm p-2 rounded-lg">
                    <span
                        class="material-symbols-outlined text-2xl w-full h-full flex items-center justify-center">restaurant_menu</span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight">BandungDinespot</h2>
            </div>
            <p class="text-4xl xl:text-5xl font-extrabold leading-tight mb-4 tracking-tight">Temukan Rasa <br />Favorit
                Barumu</p>
            <p class="text-lg opacity-80 max-w-md font-medium leading-relaxed">Bergabunglah dengan komunitas pecinta
                kuliner Bandung dan bagikan pengalaman kulinermu.</p>
        </div>
    </div>

    <!-- Right Column: Registration Form -->
    <!-- UPDATED: Added h-screen and specific paddings to match login page -->
    <div
        class="flex-1 w-full lg:w-1/2 flex flex-col justify-center items-center h-screen overflow-y-auto bg-background-light dark:bg-background-dark py-10 px-6 sm:px-12 xl:px-20">

        <!-- UPDATED: Changed max-w-md to max-w-lg -->
        <div class="w-full max-w-lg space-y-8 animate-fade-in">

            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center gap-3 mb-2 text-text-main dark:text-white justify-center">
                <div class="size-8 text-primary">
                    <span class="material-symbols-outlined text-3xl">restaurant_menu</span>
                </div>
                <span class="font-bold text-xl tracking-tight">BandungDinespot</span>
            </div>

            <!-- Header -->
            <div class="flex flex-col gap-2">
                <h1
                    class="text-text-main dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                    Daftar Akun Baru
                </h1>
                <p class="text-text-muted dark:text-gray-400 text-base font-normal">
                    Mulai petualangan kulinermu di Bandung hari ini.
                </p>
            </div>

            <!-- Role Switcher (Tab) -->
            <div
                class="w-full bg-white dark:bg-white/5 p-1 rounded-xl flex border border-border-light dark:border-border-dark">
                <button
                    class="flex-1 py-2 text-sm font-bold rounded-lg bg-primary text-text-main shadow-sm transition-all text-center">
                    Pelanggan
                </button>
                <a href="{{ route('register.restaurant') }}"
                    class="flex-1 py-2 text-sm font-medium text-text-muted dark:text-gray-400 hover:text-text-main dark:hover:text-white transition-all text-center">
                    Pemilik Restoran
                </a>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5 w-full">
                @csrf
                <input type="hidden" name="role" value="user">

                <!-- Name Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="name">Nama
                        Lengkap</label>
                    <!-- UPDATED: h-12 to h-14, text size adjusted -->
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full h-14 px-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                        placeholder="Cth: Budi Santoso" />
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="email">Email</label>
                    <!-- UPDATED: h-12 to h-14 -->
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full h-14 px-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                        placeholder="nama@email.com" />
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold" for="password">Password</label>
                    <!-- UPDATED: h-12 to h-14 -->
                    <input id="password" type="password" name="password" required
                        class="w-full h-14 px-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                        placeholder="Minimal 8 karakter" />
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col gap-2">
                    <label class="text-text-main dark:text-white text-sm font-semibold"
                        for="password_confirmation">Konfirmasi Password</label>
                    <!-- UPDATED: h-12 to h-14 -->
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full h-14 px-4 rounded-lg bg-[#f8fcf8] dark:bg-surface-dark border border-border-light dark:border-border-dark text-text-main dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-base"
                        placeholder="Ulangi password" />
                </div>

                <!-- Submit Button -->
                <!-- UPDATED: h-12 to h-14 -->
                <button type="submit"
                    class="mt-4 w-full h-14 bg-primary hover:bg-[#0fd60f] text-text-main font-bold text-base rounded-lg shadow-lg shadow-primary/20 transition-all hover:scale-[1.01] active:scale-[0.98]">
                    Daftar Sekarang
                </button>
            </form>

            <div class="text-center pt-2">
                <p class="text-sm text-text-muted dark:text-gray-400">
                    Sudah punya akun? <a class="font-bold text-primary hover:underline decoration-2 underline-offset-2"
                        href="{{ route('login') }}">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
