<?php use App\Core\Controller; ?>

<div class="min-h-screen bg-[#f5f7f4] text-slate-900 font-sans">
    <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/90 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 py-4 sm:px-6 lg:px-8">
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 no-underline hover:no-underline">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-teal-700 text-lg font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-xl font-black tracking-normal">Jastipin</span>
            </a>

            <nav class="hidden items-center gap-7 text-sm font-semibold text-slate-600 md:flex">
                <a class="hover:text-teal-700" href="#home">Home</a>
                <a class="hover:text-teal-700" href="#jastip">Jastip</a>
                <a class="hover:text-teal-700" href="<?= Controller::url('/orders') ?>">Riwayat</a>
                <a class="hover:text-teal-700" href="<?= Controller::url('/login') ?>">Profil</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="<?= Controller::url('/login') ?>" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100 hover:no-underline">Login</a>
                <a href="<?= Controller::url('/register') ?>" class="rounded-full bg-teal-700 px-4 py-2 text-sm font-bold text-white shadow-sm shadow-teal-900/10 hover:bg-teal-800 hover:no-underline">Register</a>
            </div>
        </div>
    </header>

    <section id="home" class="relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(125,179,151,0.28),_transparent_34%),radial-gradient(circle_at_78%_12%,_rgba(186,222,235,0.58),_transparent_30%)]"></div>
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 py-14 sm:px-6 md:grid-cols-[1.02fr_0.98fr] lg:px-8 lg:py-20">
            <div>
                <span class="inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-teal-800 shadow-sm ring-1 ring-teal-100">Solusi titip cepat untuk mahasiswa</span>
                <h1 class="mt-6 max-w-3xl text-4xl font-black leading-tight text-slate-950 sm:text-5xl lg:text-6xl">
                    Jastip Mudah, Hemat Waktu. Titip Apa Saja Melalui Jastipin!
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    Temukan provider terdekat untuk membeli makanan, fotocopy modul, atau mengambil perlengkapan kuliah tanpa harus keluar kelas atau antre lama.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="#jastip" class="rounded-full bg-teal-700 px-6 py-3 text-center text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Cari Jastip</a>
                    <a href="<?= Controller::url('/register') ?>" class="rounded-full bg-white px-6 py-3 text-center text-sm font-black text-teal-800 ring-1 ring-teal-100 hover:bg-teal-50 hover:no-underline">Daftar Provider</a>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-5 top-8 h-24 w-24 rounded-3xl bg-sky-200/60"></div>
                <div class="absolute -right-4 bottom-8 h-28 w-28 rounded-full bg-emerald-200/70"></div>
                <img
                    class="relative aspect-[4/3] w-full rounded-[2rem] object-cover shadow-2xl shadow-slate-900/12 ring-1 ring-white"
                    src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80"
                    alt="Mahasiswa menggunakan laptop dan berdiskusi di kampus"
                >
                <div class="absolute bottom-5 left-5 rounded-2xl bg-white/92 p-4 shadow-xl backdrop-blur">
                    <p class="text-xs font-bold uppercase text-slate-500">Pesanan aktif</p>
                    <p class="mt-1 text-2xl font-black text-teal-800">128+</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-5 py-12 sm:px-6 lg:px-8">
        <div class="mb-7 flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-950">Kategori Layanan</h2>
                <p class="mt-2 text-slate-600">Pilih kebutuhan titipan yang paling sering dipakai di area kampus.</p>
            </div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php
                $categories = [
                    ['icon' => 'FD', 'title' => 'Food', 'desc' => 'Makanan, minuman, dan snack sekitar kampus.', 'color' => 'bg-emerald-50 text-emerald-700'],
                    ['icon' => 'FC', 'title' => 'Fotocopy', 'desc' => 'Print modul, fotocopy tugas, dan jilid laporan.', 'color' => 'bg-sky-50 text-sky-700'],
                    ['icon' => 'PK', 'title' => 'Perlengkapan', 'desc' => 'Alat tulis, map, buku, dan kebutuhan kuliah.', 'color' => 'bg-amber-50 text-amber-700'],
                    ['icon' => 'LN', 'title' => 'Lainnya', 'desc' => 'Titipan fleksibel sesuai kebutuhan harian.', 'color' => 'bg-slate-100 text-slate-700'],
                ];
            ?>
            <?php foreach ($categories as $category): ?>
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="<?= $category['color'] ?> grid h-12 w-12 place-items-center rounded-2xl text-sm font-black"><?= $category['icon'] ?></div>
                    <h3 class="mt-5 text-lg font-black text-slate-950"><?= htmlspecialchars($category['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600"><?= htmlspecialchars($category['desc'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="jastip" class="border-y border-slate-200 bg-white/72">
        <div class="mx-auto grid max-w-7xl gap-7 px-5 py-12 sm:px-6 lg:grid-cols-[280px_1fr] lg:px-8">
            <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-xl font-black text-slate-950">Filter & Pencarian</h2>
                <div class="mt-5 space-y-5">
                    <label class="block">
                        <span class="text-sm font-bold text-slate-700">Kategori</span>
                        <select class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-3 py-3 text-sm">
                            <option>Semua kategori</option>
                            <option>Food</option>
                            <option>Fotocopy</option>
                            <option>Perlengkapan</option>
                            <option>Lainnya</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-sm font-bold text-slate-700">Lokasi (Kota)</span>
                        <select class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-3 py-3 text-sm">
                            <option>Bandung</option>
                            <option>Jakarta</option>
                            <option>Yogyakarta</option>
                            <option>Surabaya</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-sm font-bold text-slate-700">Rentang Harga</span>
                        <input type="range" min="5000" max="50000" value="25000" class="mt-3 w-full accent-teal-700">
                        <div class="mt-2 flex justify-between text-xs font-semibold text-slate-500">
                            <span>Rp 5rb</span>
                            <span>Rp 50rb</span>
                        </div>
                    </label>
                    <button class="w-full rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white hover:bg-teal-800">Terapkan Filter</button>
                </div>
            </aside>

            <div>
                <div class="mb-6 flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-2xl font-black text-slate-950">Daftar Jastip Terbaru</h2>
                        <p class="mt-2 text-slate-600">Pilih titipan aktif dari provider sekitar kampus.</p>
                    </div>
                    <input type="search" placeholder="Cari barang atau lokasi" class="w-full rounded-full border-slate-200 bg-white px-5 py-3 text-sm shadow-sm sm:max-w-xs">
                </div>

                <?php
                    $items = [
                        ['image' => 'https://images.unsplash.com/photo-1562967916-eb82221dfb92?auto=format&fit=crop&w=800&q=80', 'title' => 'Paket makan siang kantin', 'desc' => 'Bisa titip menu kantin favorit sebelum jam makan siang.', 'location' => 'Kantin Teknik, Bandung', 'fee' => 'Rp 8.000', 'deadline' => 'Hari ini, 11.30'],
                        ['image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80', 'title' => 'Print dan fotocopy modul', 'desc' => 'Print PDF, fotocopy, dan jilid ringan untuk tugas kuliah.', 'location' => 'Fotocopy Gerbang Utama', 'fee' => 'Rp 12.000', 'deadline' => 'Hari ini, 15.00'],
                        ['image' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?auto=format&fit=crop&w=800&q=80', 'title' => 'Alat tulis dan perlengkapan', 'desc' => 'Pulpen, map, sticky notes, stabilo, dan buku tulis.', 'location' => 'Gramedia BIP', 'fee' => 'Rp 10.000', 'deadline' => 'Besok, 09.00'],
                    ];
                ?>
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    <?php foreach ($items as $item): ?>
                        <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <img class="h-44 w-full object-cover" src="<?= htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?>">
                            <div class="p-5">
                                <h3 class="text-lg font-black text-slate-950"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600"><?= htmlspecialchars($item['desc'], ENT_QUOTES, 'UTF-8') ?></p>
                                <dl class="mt-5 space-y-2 text-sm">
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Lokasi</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars($item['location'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Biaya jasa</dt><dd class="font-bold text-teal-700"><?= htmlspecialchars($item['fee'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Batas waktu</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars($item['deadline'], ENT_QUOTES, 'UTF-8') ?></dd></div>
                                </dl>
                                <a href="<?= Controller::url('/login') ?>" class="mt-5 block rounded-full bg-teal-700 px-5 py-3 text-center text-sm font-black text-white hover:bg-teal-800 hover:no-underline">Pesan Sekarang</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-950 text-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-5 py-10 sm:px-6 md:grid-cols-4 lg:px-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-teal-600 text-lg font-black">J</span>
                    <span class="text-xl font-black">Jastipin</span>
                </div>
                <p class="mt-4 max-w-md text-sm leading-6 text-slate-300">Platform titip barang sederhana untuk membantu mahasiswa menghemat waktu di area kampus.</p>
            </div>
            <div>
                <h3 class="font-black">Panduan</h3>
                <ul class="mt-4 space-y-2 text-sm text-slate-300">
                    <li><a href="<?= Controller::url('/register') ?>" class="hover:text-white">Daftar akun</a></li>
                    <li><a href="#jastip" class="hover:text-white">Cari jastip</a></li>
                    <li><a href="<?= Controller::url('/login') ?>" class="hover:text-white">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-black">Kontak</h3>
                <p class="mt-4 text-sm text-slate-300">support@jastipin.local</p>
                <div class="mt-4 flex gap-3">
                    <a class="grid h-9 w-9 place-items-center rounded-full bg-white/10 hover:bg-white/20" href="#" aria-label="Instagram">Ig</a>
                    <a class="grid h-9 w-9 place-items-center rounded-full bg-white/10 hover:bg-white/20" href="#" aria-label="Twitter">X</a>
                    <a class="grid h-9 w-9 place-items-center rounded-full bg-white/10 hover:bg-white/20" href="#" aria-label="WhatsApp">Wa</a>
                </div>
            </div>
        </div>
    </footer>
</div>
