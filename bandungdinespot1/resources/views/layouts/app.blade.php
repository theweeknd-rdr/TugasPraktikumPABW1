<!DOCTYPE html>
<html class="light scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BandungDinespot') }}</title>

    <!-- Fonts: Preconnect untuk performa loading font lebih cepat -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Icons: Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS (CDN Mode - Development) -->
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
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d241b",
                        "text-main": "#1b140d",
                        "text-muted": "#9a734c",
                    },
                    fontFamily: {
                        "sans": ["Plus Jakarta Sans", "sans-serif"],
                        "display": ["Plus Jakarta Sans", "sans-serif"],
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
        /* Utility untuk menyembunyikan scrollbar tapi tetap bisa di-scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Pengaturan Font Variation untuk Material Symbols */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <!-- Vite Scripts (Untuk asset production) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-background-light dark:bg-background-dark text-text-main dark:text-[#f3ede7] selection:bg-primary/30">
    <div class="min-h-screen relative flex flex-col">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Content -->
        <!-- Menggunakan flex-1 agar konten mengisi ruang kosong, mendorong footer ke bawah -->
        <main class="flex-1 w-full">
            {{ $slot }}
        </main>

    </div>
</body>

</html>
