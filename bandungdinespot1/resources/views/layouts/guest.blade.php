<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BandungDinespot') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    <!-- Tailwind Config -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ee8c2b",
                        "primary-dark": "#d5781a",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
                        "surface-light": "#ffffff",
                        "surface-dark": "#2d241b",
                        "text-main": "#1b140d",
                        "text-muted": "#9a734c",
                    },
                    fontFamily: {
                        "sans": ["Plus Jakarta Sans", "sans-serif"],
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
                },
            },
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-text-main antialiased bg-background-light dark:bg-background-dark">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/" class="flex flex-col items-center gap-2">
                <div class="size-12 text-primary">
                    <span class="material-symbols-outlined !text-5xl">restaurant_menu</span>
                </div>
                <span class="text-2xl font-bold tracking-tight text-text-main dark:text-white">BandungDinespot</span>
            </a>
        </div>

        <!-- Card Container -->
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-8 bg-surface-light dark:bg-surface-dark shadow-md overflow-hidden sm:rounded-xl border border-[#e5e0dc] dark:border-[#3a2e25]">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
