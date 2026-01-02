<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>BandungDinespot - Jelajahi Surga Kuliner Bandung</title>

    <!-- Fonts: Preconnect untuk performa -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap"
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
                        "background-light": "#f8fcf8",
                        "background-dark": "#102210",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1a331a",
                        "text-main-light": "#0d1b0d",
                        "text-main-dark": "#e7f3e7",
                        "text-secondary-light": "#4c9a4c",
                        "text-secondary-dark": "#8ac68a",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                    },
                },
            },
        }
    </script>
    <style>
        /* Sembunyikan scrollbar tapi tetap bisa di-scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark font-display antialiased overflow-x-hidden transition-colors duration-300">
    <div class="relative flex flex-col min-h-screen">

        <!-- Navbar -->
        <header
            class="sticky top-0 z-50 w-full border-b border-[#e7f3e7] dark:border-white/10 bg-surface-light/80 dark:bg-surface-dark/80 backdrop-blur-md">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-background-dark">
                            <span class="material-symbols-outlined">restaurant_menu</span>
                        </div>
                        <span class="text-lg font-bold tracking-tight">BandungDinespot</span>
                    </div>

                    <nav class="hidden md:flex items-center gap-8">
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="#">Beranda</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="#">Kategori</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="#">Blog</a>
                    </nav>

                    <!-- Auth Buttons -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="flex h-9 items-center justify-center rounded-lg bg-primary px-4 text-sm font-bold text-[#0d1b0d] hover:bg-primary-dark transition-colors shadow-sm">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="hidden md:flex h-9 items-center justify-center rounded-lg px-4 text-sm font-bold text-text-main-light dark:text-text-main-dark hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="flex h-9 items-center justify-center rounded-lg bg-primary px-4 text-sm font-bold text-[#0d1b0d] hover:bg-primary-dark transition-colors shadow-sm">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <!-- Hero Section -->
            <section class="relative overflow-hidden pt-10 pb-16 md:pt-16 md:pb-24">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="relative rounded-2xl overflow-hidden bg-background-dark shadow-2xl">
                        <!-- Hero Image Background (Optimized) -->
                        <div class="absolute inset-0 z-0">
                            <!-- Menggunakan IMG tag untuk aksesibilitas dan kontrol loading -->
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDl3nOflIpusKvPk4sClwKEO6XVQNUYbbG52LDVsvaoXS5lxZ_5ClXSSNwZd9051kqspaVaO5h0LkIEh5QKJYwg3OQ1S5895L12z5gkZxBFtJXQnWPJUFIyaTplwJndgfQmRJIG26vRoUssujzUlAKxdL08BhmPiPgpi4cE3ZW1lqtFUo9KCHqj9ZJWRUC04IMQmzi9q2rBVyklkOVYkPGzZwAAX_AIC-gxChmWhYpH3aFDu1_2Xd30xe9zBiFfYcOSOEsISoeE-pdP"
                                alt="Makanan Sunda yang lezat di Bandung"
                                class="h-full w-full object-cover object-center" priority>
                            <!-- Eager load untuk Hero Image (LCP) -->

                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/60 to-transparent">
                            </div>
                        </div>

                        <div
                            class="relative z-10 flex min-h-[560px] flex-col justify-center px-6 py-12 md:px-12 lg:w-3/5">
                            <div
                                class="inline-flex w-fit items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-primary backdrop-blur-sm border border-white/10 mb-6">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                Explore Bandung
                            </div>
                            <h1
                                class="text-4xl font-extrabold tracking-tight text-white md:text-5xl lg:text-6xl mb-6 leading-tight">
                                Jelajahi Surga <span class="text-primary">Kuliner</span> Bandung
                            </h1>
                            <p class="text-lg text-gray-200 md:text-xl mb-8 max-w-lg leading-relaxed">
                                Platform rekomendasi terbaik untuk menemukan hidden gems, kafe estetik, dan restoran
                                legendaris di Kota Kembang.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button type="button"
                                    class="flex h-12 items-center justify-center gap-2 rounded-lg bg-primary px-6 text-base font-bold text-[#0d1b0d] hover:bg-primary-dark transition-all hover:scale-105 active:scale-95 shadow-[0_0_20px_rgba(19,236,19,0.3)]">
                                    <span class="material-symbols-outlined">search</span>
                                    Cari Kuliner
                                </button>
                                <button type="button"
                                    class="flex h-12 items-center justify-center gap-2 rounded-lg bg-white/10 border border-white/20 px-6 text-base font-bold text-white hover:bg-white/20 backdrop-blur-sm transition-all hover:scale-105 active:scale-95">
                                    Daftarkan Restoran
                                </button>
                            </div>

                            <!-- Trust indicators -->
                            <div class="mt-10 flex items-center gap-4 text-sm text-gray-300">
                                <div class="flex -space-x-2">
                                    <img alt="User Avatar"
                                        class="inline-block h-8 w-8 rounded-full ring-2 ring-black object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_g_GfwBwfF58_BBF5H5pX4IRdpPIsMPV-uoSj5y6tFdeRIXUZm7HBEMfE2Bg-jUPrLbSwE_yOUHQTWil6TdggdMbrrUX3t5YhqzoX-5L0KXSSw8m3m2kiEcL_EzlYnNvjmiwKvXdI5FFq2KZ7wC0dRBjPUo9lpiE2T01KurVsUfKJtdL77AkXhR8I5fxndlHdtebZsz6UPYH9dFeK_dkouNO39So2dXjP_Hu1wBC4NGXU_jeX4uDgjxkhoXukJu35bvQD9TuXrq-3"
                                        loading="lazy" />
                                    <img alt="User Avatar"
                                        class="inline-block h-8 w-8 rounded-full ring-2 ring-black object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4L9h1dAgw_ex6QFG1FnhUGMuGTLU6XIkvebEkmn-i04ocx0mhdqv1rkrK_P-dqSemAvo8Td_z4Z90d2yUYKr9LuuTRER7DsB0gXy93v7RQiZ5tpexTJGToIGxynaNWWNuM1oRmjSiepADFDH6IpPSJTp_ptZyvdxzkf7kufYHitSVo3p_MubovBUSPlnmCw5_1rMAxBxtMowEaL3XWgr8LJLU9pplGSUjdNCDtHe8ADO0UcTvJ3SU9XNLZM8WA4hRmW8tnW4ioiBv"
                                        loading="lazy" />
                                    <img alt="User Avatar"
                                        class="inline-block h-8 w-8 rounded-full ring-2 ring-black object-cover"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6_EB0W7WidNm4VhpvhXWJfuLyVzDIsD3EIQ0tzNhfdG0kqIetn3JNlu-P-f-feJJ20epTi8a32po4pvaQenUqaZ66682l89K9y94japbWmwlw7n-XPlZcc0q7VbWZwLgd6GGgi9XkLQFKwFY4gtTmH3ieywubxba18rXcY72hohR-WoCQPemi58NzxRdcz1CCunbVIP360IGbYAmDfXEI232KXXxYx0w5RpVbcrOXMX44WJ3vZF3LPzjsWd2hyHea0pfhRYIlHRWC"
                                        loading="lazy" />
                                </div>
                                <span>Dipercaya oleh 10,000+ Foodies</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-16 bg-surface-light dark:bg-surface-dark/50">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
                        <div class="max-w-2xl">
                            <h2
                                class="text-3xl font-bold tracking-tight text-text-main-light dark:text-text-main-dark sm:text-4xl mb-4">
                                Kenapa BandungDinespot?
                            </h2>
                            <p class="text-lg text-text-secondary-light dark:text-text-secondary-dark">
                                Kami menghubungkan pecinta kuliner dengan rasa terbaik di kota ini melalui fitur yang
                                memudahkan hidup Anda.
                            </p>
                        </div>
                        <a class="group flex items-center gap-1 text-primary font-bold hover:text-primary-dark transition-colors"
                            href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                    <div class="grid gap-8 md:grid-cols-3">
                        <!-- Feature 1 -->
                        <div
                            class="group relative overflow-hidden rounded-2xl bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 p-8 shadow-sm transition-all hover:shadow-md hover:-translate-y-1">
                            <div
                                class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-[#0d1b0d] transition-colors">
                                <span class="material-symbols-outlined text-3xl">verified</span>
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-text-main-light dark:text-text-main-dark">Kurasi
                                Terbaik</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark leading-relaxed">
                                Daftar tempat makan pilihan yang telah diverifikasi kualitas rasa, pelayanan, dan
                                kebersihannya oleh tim ahli kami.
                            </p>
                        </div>
                        <!-- Feature 2 -->
                        <div
                            class="group relative overflow-hidden rounded-2xl bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 p-8 shadow-sm transition-all hover:shadow-md hover:-translate-y-1">
                            <div
                                class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-[#0d1b0d] transition-colors">
                                <span class="material-symbols-outlined text-3xl">calendar_month</span>
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-text-main-light dark:text-text-main-dark">Booking
                                Mudah</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark leading-relaxed">
                                Tidak perlu antri panjang. Kelola reservasi meja Anda langsung dari aplikasi dengan
                                sistem yang real-time dan simpel.
                            </p>
                        </div>
                        <!-- Feature 3 -->
                        <div
                            class="group relative overflow-hidden rounded-2xl bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 p-8 shadow-sm transition-all hover:shadow-md hover:-translate-y-1">
                            <div
                                class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-[#0d1b0d] transition-colors">
                                <span class="material-symbols-outlined text-3xl">reviews</span>
                            </div>
                            <h3 class="mb-3 text-xl font-bold text-text-main-light dark:text-text-main-dark">Ulasan
                                Jujur</h3>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark leading-relaxed">
                                Baca pengalaman nyata dari komunitas pecinta kuliner Bandung. Tanpa bot, tanpa ulasan
                                palsu, 100% autentik.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Popular Categories -->
            <section class="py-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold tracking-tight text-text-main-light dark:text-text-main-dark">
                            Kategori Populer
                        </h2>
                        <div class="flex gap-2">
                            <button type="button"
                                class="h-10 w-10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-white/5 text-text-main-light dark:text-text-main-dark transition-colors">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button type="button"
                                class="h-10 w-10 rounded-full border border-gray-200 dark:border-white/10 flex items-center justify-center hover:bg-gray-100 dark:hover:bg-white/5 text-text-main-light dark:text-text-main-dark transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory no-scrollbar">
                        <!-- Card 1 (Refactored to IMG tag) -->
                        <div
                            class="min-w-[280px] md:min-w-[320px] snap-start rounded-xl overflow-hidden bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 shadow-sm group cursor-pointer">
                            <div class="h-48 w-full overflow-hidden relative">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA6t004eLWCbLOM-IBh-3Ql7r0wfuJ7BpdBpRh7Oc3wE2DI4fWmdrJWLY7mcptZhM203-3vk2dvQw0f6C8fiLAgFciiU2B9-UeIS7wLK4vTURzp4K0PC-Np9baHW1S58XOX5N2VsPVrYRORboZ5I2tfqnZ0yahJgBmpJGxVom77v0L9_enOGmqTUNgqRdmCgd6cBBM1glBSF8JPrlARU76TSC5_7Z-16kB6MxaX81a8Ny0dthKNGpKZTUo5y1Z7hhLtzeTzkzj9iqIv"
                                    alt="Kafe Hits" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors">
                                        Kafe Hits
                                    </h3>
                                    <span
                                        class="bg-primary/10 text-primary-dark dark:text-primary text-xs font-bold px-2 py-1 rounded">Trending</span>
                                </div>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-4">
                                    Tempat nongkrong asik dengan kopi terbaik dan wifi kencang.
                                </p>
                                <div
                                    class="flex items-center gap-1 text-sm font-medium text-text-main-light dark:text-text-main-dark">
                                    <span>Lihat 45 Tempat</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div
                            class="min-w-[280px] md:min-w-[320px] snap-start rounded-xl overflow-hidden bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 shadow-sm group cursor-pointer">
                            <div class="h-48 w-full overflow-hidden relative">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD-_ZYare26tjn2Te4HBP31i1gePw1uUwbs3V4UfaOP6vuxhidWc99cf2TiGvTpuaIDqDj54-J9nwIbBQAZBzKUYJUd0CNAqTUmyW-DBV3ukVp9rWxcaur88MiYEunQ-37ewSr6KHgX-aFjbYEnH1LzzcahiJb98_Qz5EVOQY1P0meI_Yg1jWSwK8YIS8qcW4InF-Q5tUIk-6CFMkBYFpYUpu-NAUqhBjGaqmJvKRXGQLbCGVesCY8u0UUh3kSRxEhxCGx_F4o2QWVx"
                                    alt="Street Food Bandung" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors">
                                        Street Food
                                    </h3>
                                    <span
                                        class="bg-primary/10 text-primary-dark dark:text-primary text-xs font-bold px-2 py-1 rounded">Populer</span>
                                </div>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-4">
                                    Jajanan kaki lima legendaris yang wajib dicoba saat ke Bandung.
                                </p>
                                <div
                                    class="flex items-center gap-1 text-sm font-medium text-text-main-light dark:text-text-main-dark">
                                    <span>Lihat 120+ Tempat</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div
                            class="min-w-[280px] md:min-w-[320px] snap-start rounded-xl overflow-hidden bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 shadow-sm group cursor-pointer">
                            <div class="h-48 w-full overflow-hidden relative">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2TtZtSQqLfDAVxuCcr6zEUt9poJ3dMNil---1-_0NwM5K38b2A7bYzKWl3qBQ5MUdYG61o7FKtrab9CNlIwZ-tTh-unUH6LtIATLl5mXv7Zpyx29tI0Kx91QCsqmLM9Msv22Fsm3nHhzCLrFPCGgBby3l9tsw2cjkVgy0OkoY_hle4_zYZo-ge2mt3fQxhahO5ccJQMGSoa7EGCZG5zCyZtBUqxjI4v1Px89PXQdstQi6xyREy5tJMtpR8JofUdNYdAzD_hCA9tlX"
                                    alt="Fine Dining" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors">
                                        Fine Dining
                                    </h3>
                                </div>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-4">
                                    Makan malam romantis dengan pemandangan kota Bandung di malam hari.
                                </p>
                                <div
                                    class="flex items-center gap-1 text-sm font-medium text-text-main-light dark:text-text-main-dark">
                                    <span>Lihat 28 Tempat</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div
                            class="min-w-[280px] md:min-w-[320px] snap-start rounded-xl overflow-hidden bg-white dark:bg-surface-dark border border-[#e7f3e7] dark:border-white/5 shadow-sm group cursor-pointer">
                            <div class="h-48 w-full overflow-hidden relative">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA2ADweXMNopq2Gj9fTis7Fj3V_oLGccLtr57RcDRog-CZsKuMEaKIoAjpgCGBsMm0n-s0qlZVzy48OT4WFFDPy_nCGWd836m60e9UNiJJ3MFbJFAeNfl1AsKZyK_ouxDDhTQNJDMi5z4DxCIXW8JSBoUhCRprrKwpDCs4BRg55mZ4xPSuHG96aPUBX4oHciwbKMDqblfkFA7dkpKSxOBCSk3vqp1zfWY2lqrD4C2OV07PSwDgQcm0p-JS-ijEDwuSSLYQcxK_7QQCY"
                                    alt="Bakery & Pastry" loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors">
                                        Bakery & Pastry
                                    </h3>
                                </div>
                                <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-4">
                                    Roti dan kue viral yang cocok untuk oleh-oleh dari Bandung.
                                </p>
                                <div
                                    class="flex items-center gap-1 text-sm font-medium text-text-main-light dark:text-text-main-dark">
                                    <span>Lihat 50+ Tempat</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonial Section -->
            <section
                class="py-16 bg-surface-light dark:bg-surface-dark/30 border-y border-[#e7f3e7] dark:border-white/5">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-text-main-light dark:text-text-main-dark mb-4">Apa Kata
                            Mereka?</h2>
                        <p class="text-text-secondary-light dark:text-text-secondary-dark">Pengalaman langsung dari
                            pengguna setia kami</p>
                    </div>
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Testimoni 1 -->
                        <div
                            class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-sm border border-[#e7f3e7] dark:border-white/5">
                            <div class="flex gap-1 text-yellow-400 mb-4">
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                            </div>
                            <blockquote class="text-lg font-medium text-text-main-light dark:text-text-main-dark mb-6">
                                "Akhirnya nemu aplikasi yang bener-bener update soal kuliner Bandung. Berkat Dinespot,
                                weekend kemarin dapet tempat ngopi yang cozy banget di Dago Atas!"
                            </blockquote>
                            <div class="flex items-center gap-4">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDygnc39Lofr8Bk3Xb8BDfFRKS-7l1DTsa3CK49JrroNCxrKSofsmVh9GRaJGh94RloYUspT9p1I8fgTBi1SZIrmpYoTRGj8TeBQBjha0WNtgl1qE7GRhi7XTRIagTVyt8ZAOlmOmkvstcwai-H0gU27YX86mvOa9D2IY16oCjKXgQsP3gl4QkBUT0V_i-CIkzwmYOnTa4zlfIvPoliy1HL_twT_z9-dgtJrS58XRHACNTkzvGXKr7sa6HbfulZKzCEtpAraxMmTFyL"
                                    alt="Sarah Amalia" class="h-12 w-12 rounded-full object-cover" loading="lazy">
                                <div>
                                    <div class="font-bold text-text-main-light dark:text-text-main-dark">Sarah Amalia
                                    </div>
                                    <div class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Food
                                        Vlogger</div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimoni 2 -->
                        <div
                            class="bg-white dark:bg-surface-dark p-8 rounded-2xl shadow-sm border border-[#e7f3e7] dark:border-white/5">
                            <div class="flex gap-1 text-yellow-400 mb-4">
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                                <span class="material-symbols-outlined fill-current text-[20px]">star</span>
                            </div>
                            <blockquote class="text-lg font-medium text-text-main-light dark:text-text-main-dark mb-6">
                                "Sangat membantu untuk manajemen reservasi restoran saya. Tamu jadi lebih teratur dan
                                kami bisa fokus memberikan pelayanan terbaik."
                            </blockquote>
                            <div class="flex items-center gap-4">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAeMAkmo42wq8gbbkWvDAMB1wTVHsMStAwTTY-X4eC4LMLY_fKSq8MpBfs68IJXQuJVX2XzSw8dvnX7wgGYlY9AqKPypsqx_HrjyvMTsJAGuUPKNjApkWqF2C-EbG03D84akmH2HtLs93wr6hH2PkPKZgAsbjZLK6thz14jt7bMjcWBRudkSKvCjbtMhSVRwGY5S5-K_7jYjdk71hpHRb6mORmJq9ECmdCdQ8RUOcSKUhwmaU2ZMaywMSsqxyoqps84JFtOBv14aYgG"
                                    alt="Budi Santoso" class="h-12 w-12 rounded-full object-cover" loading="lazy">
                                <div>
                                    <div class="font-bold text-text-main-light dark:text-text-main-dark">Budi Santoso
                                    </div>
                                    <div class="text-sm text-text-secondary-light dark:text-text-secondary-dark">Owner,
                                        Warung Sunda Budi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="py-20 relative overflow-hidden">
                <div class="absolute inset-0 bg-background-dark -z-10">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAYZ6xw9tyl74nNLh5JKexf8RdCH6JYP11H9BCmFhj--0TYxlLt1uE5tiS2JAHtZID3AVM4-t-0E2BQOuazniH-eg9CUKd6-sozAEb7_JDIWgfgM7XNluBtjIL5RkEpHy1bxWb18cl2LaB8UK4qkvtoukW7y-8Fh6aH4GbuT9dKU3_E3ao9xkUCr5urFlkUC_HL5Nsbh3U6aE4FrpnGyfoqHUCQj3urTyEUQ3tRAjCesY6C7bNKfzKqT5ZBxN8UI7fTJ9Q4p7T-UrMz"
                        alt="Background CTA" loading="lazy"
                        class="absolute inset-0 h-full w-full object-cover opacity-20">
                </div>
                <div class="mx-auto max-w-4xl px-4 text-center relative z-10">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6">
                        Siap Memulai Petualangan Rasa?
                    </h2>
                    <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan pecinta kuliner lainnya dan temukan cita rasa otentik Bandung hari
                        ini.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <button type="button"
                            class="flex h-12 items-center justify-center gap-2 rounded-lg bg-primary px-8 text-base font-bold text-[#0d1b0d] hover:bg-primary-dark transition-all hover:scale-105 shadow-[0_0_20px_rgba(19,236,19,0.4)]">
                            Mulai Sekarang Gratis
                        </button>
                        <button type="button"
                            class="flex h-12 items-center justify-center gap-2 rounded-lg border border-white/20 bg-white/5 px-8 text-base font-bold text-white hover:bg-white/10 backdrop-blur-sm transition-all hover:scale-105">
                            Download Aplikasi
                        </button>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer
            class="bg-background-light dark:bg-background-dark border-t border-[#e7f3e7] dark:border-white/10 pt-16 pb-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-2 mb-4">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-background-dark">
                                <span class="material-symbols-outlined">restaurant_menu</span>
                            </div>
                            <span class="text-xl font-bold tracking-tight">BandungDinespot</span>
                        </div>
                        <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-6">
                            Panduan kuliner terpercaya Anda di Bandung. Temukan, nikmati, dan bagikan cerita rasa Anda.
                        </p>
                        <!-- Social Media Links (SVG Icons) -->
                        <div class="flex gap-4">
                            <a class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary transition-colors"
                                href="#">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a class="text-text-secondary-light dark:text-text-secondary-dark hover:text-primary transition-colors"
                                href="#">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewbox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark mb-4">Perusahaan</h3>
                        <ul class="space-y-3 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                            <li><a class="hover:text-primary transition-colors" href="#">Tentang Kami</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Karir</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Media Kit</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark mb-4">Dukungan</h3>
                        <ul class="space-y-3 text-sm text-text-secondary-light dark:text-text-secondary-dark">
                            <li><a class="hover:text-primary transition-colors" href="#">Pusat Bantuan</a></li>
                            <li><a class="hover:text-primary transition-colors" href="#">Syarat & Ketentuan</a>
                            </li>
                            <li><a class="hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark mb-4">Newsletter</h3>
                        <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark mb-4">Dapatkan info
                            tempat makan terbaru tiap minggu.</p>
                        <form class="flex gap-2">
                            <input
                                class="w-full rounded-lg border-gray-300 dark:border-white/10 dark:bg-white/5 text-sm focus:border-primary focus:ring-primary"
                                placeholder="Email Anda" type="email" />
                            <button
                                class="rounded-lg bg-primary p-2 text-[#0d1b0d] hover:bg-primary-dark transition-colors"
                                type="submit">
                                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div
                    class="border-t border-[#e7f3e7] dark:border-white/10 pt-8 text-center text-sm text-text-secondary-light dark:text-text-secondary-dark">
                    © 2024 BandungDinespot. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
