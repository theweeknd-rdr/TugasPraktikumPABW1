<?php use App\Core\Controller; ?>

<?php $providerName = (string) ($offer['provider']['name'] ?? 'Provider'); ?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <main class="mx-auto max-w-6xl px-5 py-8 sm:px-6 lg:px-8">
        <a href="<?= Controller::url('/buyer/offers') ?>" class="inline-flex rounded-full bg-white px-4 py-2 text-sm font-black text-teal-700 shadow-sm ring-1 ring-slate-200 hover:bg-teal-50 hover:no-underline">Kembali ke Open Jastip</a>

        <section class="mt-6 grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
            <aside class="h-fit rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-black uppercase tracking-wide text-teal-700">Offer Terpilih</p>
                <h1 class="mt-2 text-2xl font-black text-slate-950"><?= htmlspecialchars((string) ($offer['title'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="mt-3 text-sm leading-6 text-slate-600"><?= htmlspecialchars((string) ($offer['description'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                <dl class="mt-6 grid gap-3 text-sm">
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Lokasi</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['location'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Kategori</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['category'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Provider</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars($providerName, ENT_QUOTES, 'UTF-8') ?></dd></div>
                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Deadline</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['deadline'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                </dl>
            </aside>

            <section class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-black uppercase tracking-wide text-teal-700">Order Flow</p>
                <h2 class="mt-2 text-3xl font-black tracking-normal text-slate-950">Titip Barang</h2>
                <p class="mt-3 text-sm text-slate-500">Provider otomatis diambil dari offer. Buyer cukup mengisi barang dan kebutuhan tanggal.</p>

                <form method="post" action="<?= Controller::url('/buyer/orders/store') ?>" class="mt-6 grid gap-5 md:grid-cols-2">
                    <input type="hidden" name="offer_id" value="<?= htmlspecialchars((string) $offer['_id'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="hidden" name="provider_id" value="<?= htmlspecialchars((string) $offer['provider_id'], ENT_QUOTES, 'UTF-8') ?>">

                    <label class="block md:col-span-2">
                        <span class="text-sm font-black text-slate-700">Nama Barang</span>
                        <input name="item_name" type="text" required placeholder="Contoh: Buku tulis, pulpen, nasi ayam" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-700">Kategori</span>
                        <input value="<?= htmlspecialchars((string) ($offer['category'] ?? '-'), ENT_QUOTES, 'UTF-8') ?>" disabled class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-100 px-4 py-3 text-sm text-slate-500">
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-700">Biaya Jasa</span>
                        <input name="service_fee" type="number" min="0" step="500" required placeholder="10000" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-700">Tanggal Dibutuhkan</span>
                        <input name="needed_date" type="date" required class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                    </label>

                    <div class="md:col-span-2">
                        <button type="submit" class="rounded-full bg-teal-700 px-6 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800">Simpan Pesanan</button>
                    </div>
                </form>
            </section>
        </section>
    </main>
</div>
