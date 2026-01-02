<!DOCTYPE html>
<html class="light" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profil Restoran - Warung Nasi Ampera</title>

    <!-- Preconnect untuk mempercepat koneksi ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <!-- Konfigurasi Tailwind -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "primary-dark": "#0eb60e",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                        "surface-light": "#ffffff",
                        "surface-dark": "#162e16",
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
                },
            },
        }
    </script>
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.2s ease;
        }

        /* Avatar optimization */
        .avatar-container {
            position: relative;
        }

        .avatar-container::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--tw-gradient-stops));
            z-index: -1;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-text-main dark:text-white font-display flex h-screen overflow-hidden antialiased">

    <!-- SIDEBAR -->
    <aside
        class="w-72 hidden lg:flex flex-col border-r border-[#cfe7cf] dark:border-white/10 bg-surface-light dark:bg-surface-dark h-full z-20">
        <div class="flex flex-col h-full justify-between p-4">
            <div class="flex flex-col gap-6">
                <!-- User Profile Snippet -->
                <div class="flex items-center gap-3 px-2">
                    <div id="sidebar-avatar"
                        class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12 shadow-lg border-2 border-primary/20 shrink-0"
                        role="img" aria-label="Foto Profil Pemilik">
                    </div>
                    <div class="flex flex-col overflow-hidden flex-1 min-w-0">
                        <h1 class="text-text-main dark:text-white text-base font-bold leading-tight truncate">
                            Warung Ampera
                        </h1>
                        <p class="text-text-muted dark:text-gray-400 text-xs font-medium uppercase tracking-wider">
                            Pemilik
                        </p>
                    </div>
                </div>

                <!-- NAVIGATION -->
                <nav class="flex flex-col gap-1">
                    <a href="{{ route('restoran.dashboard') }}"
                        class="group flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">dashboard</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Dashboard</p>
                    </a>
                    <a href="{{ route('restoran.profile') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg bg-[#e7f3e7] dark:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-text-main dark:text-primary">storefront</span>
                        <p class="text-text-main dark:text-white text-sm font-semibold">Profil Restoran</p>
                    </a>
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">restaurant_menu</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Manajemen Menu</p>
                    </a>
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">payments</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Pembayaran</p>
                    </a>
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">reviews</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Ulasan Pengunjung</p>
                    </a>
                    <a href="{{ route('restoran.reservasi-kedatangan') }}"
                        class="group flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400">event_available</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Kelola Reservasi &amp;
                            Kedatangan</p>
                    </a>
                </nav>
            </div>

            <!-- Logout Section -->
            <div class="flex flex-col gap-4">
                <button
                    class="flex w-full cursor-pointer items-center justify-center rounded-lg h-11 px-4 bg-primary hover:bg-primary-dark transition-colors text-text-main text-sm font-bold tracking-[0.015em] shadow-sm shadow-green-200 dark:shadow-none">
                    <span class="material-symbols-outlined text-[20px] mr-2">logout</span>
                    <span class="truncate">Logout</span>
                </button>
                <div class="flex flex-col gap-1 border-t border-[#cfe7cf] dark:border-white/10 pt-4">
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span
                            class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px]">settings</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Pengaturan</p>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-[20px]">help</span>
                        <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Bantuan</p>
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto relative scroll-smooth w-full">
        <div class="max-w-[1200px] mx-auto p-4 md:p-8 flex flex-col gap-8 pb-20">

            <!-- HEADER -->
            <header
                class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-4 border-b border-[#cfe7cf] dark:border-white/10">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/20 text-green-800 dark:text-green-300 border border-primary/20">
                            Terverifikasi
                        </span>
                        <span
                            class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                            Buka
                        </span>
                    </div>
                    <h1 class="text-text-main dark:text-white text-3xl md:text-4xl font-black tracking-tight">Profil
                        Restoran</h1>
                    <p class="text-text-muted dark:text-gray-400 text-base">Atur informasi publik restoran Anda yang
                        akan terlihat oleh pelanggan.</p>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="hidden md:flex items-center justify-center h-10 w-10 rounded-full bg-white dark:bg-surface-dark border border-[#cfe7cf] dark:border-white/20 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button
                        class="flex min-w-[140px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary hover:bg-primary-dark text-text-main text-sm font-bold shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </header>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div
                    class="bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg flex items-center gap-3">
                    <span class="material-symbols-outlined">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('restoran.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                @csrf

                <!-- FORM INPUT SECTION -->
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden h-fit">
                    <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10">
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Informasi Restoran</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Edit detail utama yang akan tampil di
                            aplikasi.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Nama Restoran</span>
                            <input name="name" id="input-nama" required
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm placeholder:text-gray-400"
                                placeholder="Masukkan nama restoran" type="text" />
                            @error('name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Deskripsi
                                Singkat</span>
                            <textarea name="description" id="input-deskripsi" required
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary min-h-[120px] p-4 shadow-sm resize-none placeholder:text-gray-400"
                                placeholder="Ceritakan tentang restoran Anda..."></textarea>
                            @error('description')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Kategori</span>
                                <select name="type" id="input-kategori" required
                                    class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm">
                                    <option value="Masakan Sunda">Masakan Sunda</option>
                                    <option value="Seafood">Seafood</option>
                                    <option value="Chinese Food">Chinese Food</option>
                                    <option value="Nusantara">Nusantara</option>
                                </select>
                                @error('type')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="flex flex-col gap-2">
                                <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Jumlah
                                    Meja</span>
                                <input name="total_tables" id="input-meja" required
                                    class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm"
                                    type="number" min="1" />
                                @error('total_tables')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <label class="flex flex-col gap-2">
                            <span class="text-text-main dark:text-gray-200 text-sm font-semibold">Alamat Lengkap</span>
                            <input name="address" id="input-alamat" required
                                class="w-full rounded-lg border-[#cfe7cf] dark:border-white/20 bg-background-light dark:bg-background-dark text-text-main dark:text-white focus:border-primary focus:ring-primary h-12 px-4 shadow-sm"
                                type="text" />
                            @error('address')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </label>

                        <!-- Tombol Submit -->
                        <button type="submit"
                            class="w-full flex items-center justify-center rounded-lg h-12 px-4 bg-primary hover:bg-primary-dark text-text-main text-sm font-bold shadow-md transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </div>

                <!-- PREVIEW SECTION -->
                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-xl border border-[#cfe7cf] dark:border-white/10 shadow-sm overflow-hidden h-fit sticky top-4">
                    <div class="p-6 border-b border-[#cfe7cf] dark:border-white/10">
                        <h2 class="text-lg font-bold text-text-main dark:text-white">Pratinjau Publik</h2>
                        <p class="text-sm text-text-muted dark:text-gray-400">Tampilan untuk pelanggan</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col relative">
                            <!-- Cover Image -->
                            <div
                                class="bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 rounded-lg overflow-hidden relative aspect-video flex items-center justify-center text-gray-400 dark:text-gray-600 mb-4">
                                <span class="material-symbols-outlined text-5xl opacity-40">image</span>
                                <span
                                    class="absolute bottom-2 right-2 text-xs font-medium bg-black/60 text-white px-2 py-1 rounded backdrop-blur-sm">
                                    Gambar Sampul
                                </span>
                            </div>

                            <!-- Avatar Section (Fixed & Centered) -->
                            <div class="flex justify-start px-2 -mt-14 mb-4 relative z-10">
                                <div id="preview-avatar"
                                    class="w-24 h-24 rounded-full bg-cover bg-center border-4 border-surface-light dark:border-surface-dark shadow-2xl shrink-0 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-700 dark:to-gray-800">
                                </div>
                            </div>

                            <!-- Info Section -->
                            <div class="flex flex-col gap-4 px-2">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <h3 id="preview-nama"
                                            class="text-2xl font-bold text-text-main dark:text-white leading-tight break-words">
                                        </h3>
                                        <p id="preview-kategori"
                                            class="text-sm text-text-muted dark:text-gray-400 mt-1">
                                        </p>
                                    </div>
                                    <div
                                        class="flex items-center gap-1.5 text-yellow-500 bg-yellow-50 dark:bg-yellow-900/10 px-3 py-1.5 rounded-lg shrink-0 shadow-sm">
                                        <span class="material-symbols-outlined text-lg fill-current">star</span>
                                        <span class="font-semibold text-text-main dark:text-white text-sm">4.8</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p id="preview-deskripsi"
                                    class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                </p>

                                <!-- Details -->
                                <div class="flex flex-col gap-2.5">
                                    <div class="flex items-start gap-2 text-text-muted dark:text-gray-400 text-sm">
                                        <span
                                            class="material-symbols-outlined text-lg shrink-0 mt-0.5">location_on</span>
                                        <span id="preview-alamat" class="flex-1 break-words"></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-text-muted dark:text-gray-400 text-sm">
                                        <span
                                            class="material-symbols-outlined text-lg shrink-0">table_restaurant</span>
                                        <span><span id="preview-meja"></span> Meja Tersedia</span>
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div
                                    class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-3 mt-2 pt-4 border-t border-[#cfe7cf] dark:border-white/10">
                                    <button
                                        class="flex items-center justify-center sm:justify-start gap-2 text-sm font-semibold text-primary hover:text-primary-dark transition-colors px-3 py-2 hover:bg-primary/5 rounded-lg">
                                        <span class="material-symbols-outlined text-lg">share</span>
                                        Bagikan Profil
                                    </button>
                                    <span
                                        class="inline-flex items-center justify-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 border border-blue-200 dark:border-blue-800/50">
                                        Buka Sekarang
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- JavaScript Optimized -->
    <script>
        // Configuration
        const CONFIG = {
            initialData: {
                nama: 'Warung Nasi Ampera',
                deskripsi: 'Menyediakan masakan khas Sunda dengan cita rasa otentik sejak 1990.',
                kategori: 'Masakan Sunda',
                meja: 12,
                alamat: 'Jl. Soekarno Hatta No. 123, Bandung'
            },
            avatarUrl: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB9uzivNK40z_4CoqoQxevOpveNgVBKDtIFTCkSGABKjrdqKPSShbx0McfoiELNXRSV7Qm4JqGYbZTMlYPaETSOtCkLsjotpif-omzLzYi--G4uXbWth8CN2JwAJCTYqIEJv2I0aOedTs6wLBzdiFLzplAb-f7pIjq8f_CTUijZdsnzL2k84nKfxvchBvyPDsPq1dBhoN7tUdAzugkald9PYfPdhM9Zq4llXOsXKGaPbssahjc-QrrbIiVQxXN1sBh4FGf0XVx50Jjh',
            debounceDelay: 150
        };

        // Utilities
        const Utils = {
            setBackgroundImage(elementId, url) {
                const el = document.getElementById(elementId);
                if (el) {
                    el.style.backgroundImage = `url('${url}')`;
                    el.style.backgroundSize = 'cover';
                    el.style.backgroundPosition = 'center';
                }
            },

            debounce(func, delay) {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func(...args), delay);
                };
            }
        };

        // Preview Handler (File Upload Handlers DIHAPUS)
        const PreviewHandler = {
            setupFormPreview(fields) {
                fields.forEach(({
                    input,
                    preview,
                    key
                }) => {
                    const inputEl = document.getElementById(input);
                    const previewEl = document.getElementById(preview);

                    if (!inputEl || !previewEl) return;

                    // Set initial value
                    inputEl.value = CONFIG.initialData[key];
                    previewEl.textContent = CONFIG.initialData[key];

                    // Live preview with debounce
                    inputEl.addEventListener('input', Utils.debounce((e) => {
                        previewEl.textContent = e.target.value || `(Masukkan ${key})`;
                    }, CONFIG.debounceDelay));
                });
            }
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            // Set avatars
            ['sidebar-avatar', 'preview-avatar'].forEach(id =>
                Utils.setBackgroundImage(id, CONFIG.avatarUrl)
            );

            // File Preview Setup - DIHAPUS

            // Setup form preview
            PreviewHandler.setupFormPreview([{
                    input: 'input-nama',
                    preview: 'preview-nama',
                    key: 'nama'
                },
                {
                    input: 'input-deskripsi',
                    preview: 'preview-deskripsi',
                    key: 'deskripsi'
                },
                {
                    input: 'input-kategori',
                    preview: 'preview-kategori',
                    key: 'kategori'
                },
                {
                    input: 'input-meja',
                    preview: 'preview-meja',
                    key: 'meja'
                },
                {
                    input: 'input-alamat',
                    preview: 'preview-alamat',
                    key: 'alamat'
                }
            ]);
        });
    </script>
</body>

</html>
