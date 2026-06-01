<?php use App\Core\Controller; ?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <main class="mx-auto max-w-5xl px-5 py-8 sm:px-6 lg:px-8">
        <a href="<?= Controller::url('/provider/offers') ?>" class="inline-flex rounded-full bg-white px-4 py-2 text-sm font-black text-teal-700 shadow-sm ring-1 ring-slate-200 hover:bg-teal-50 hover:no-underline">Kembali ke Open Jastip</a>

        <section class="mt-6 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="bg-gradient-to-br from-teal-50 via-white to-sky-50 p-8">
                <p class="text-sm font-black uppercase tracking-wide text-teal-700">Buat Offer</p>
                <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Buat Open Jastip Baru</h1>
                <p class="mt-3 max-w-2xl text-slate-600">Offer aktif akan tampil di halaman buyer dan menjadi sumber relasi untuk order.</p>
            </div>

            <form method="post" action="<?= Controller::url('/provider/offers/store') ?>" class="grid gap-5 p-6 md:grid-cols-2">
                <label class="block md:col-span-2">
                    <span class="text-sm font-black text-slate-700">Judul Open Jastip</span>
                    <input name="title" type="text" required placeholder="Open Jastip Gramedia BIP Bandung" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                </label>

                <label class="block md:col-span-2">
                    <span class="text-sm font-black text-slate-700">Deskripsi</span>
                    <textarea name="description" rows="4" required placeholder="Sedang di Gramedia BIP, bisa titip alat tulis dan buku." class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600"></textarea>
                </label>
                

                <label class="block">
                    <span class="text-sm font-black text-slate-700">Lokasi</span>
                    <input name="location" type="text" required placeholder="Gramedia BIP, Bandung" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                </label>

                <label class="block">
                    <span class="text-sm font-black text-slate-700">Kategori</span>
                    <select name="category" required class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars(ucfirst($category), ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="block">
                    <span class="text-sm font-black text-slate-700">Deadline</span>
                    <input name="deadline" type="date" required class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                </label>

                <div class="md:col-span-2">
                    <button type="submit" class="rounded-full bg-teal-700 px-6 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800">Simpan Open Jastip</button>
                </div>
            </form>
        </section>
    </main>
</div>
