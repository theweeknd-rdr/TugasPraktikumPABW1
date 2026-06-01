<?php use App\Core\Controller; ?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4 sm:px-6 lg:flex-nowrap lg:px-8">
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-2xl font-black">Jastipin</span>
            </a>
            <nav class="order-3 flex w-full gap-1 overflow-x-auto rounded-full border border-slate-200 bg-slate-50 p-1 text-sm font-black text-slate-600 shadow-inner md:order-none md:w-auto">
                <a href="<?= Controller::url('/buyer/dashboard') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 hover:bg-white hover:text-teal-700 hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/buyer/offers') ?>" class="whitespace-nowrap rounded-full bg-white px-4 py-2.5 text-teal-700 shadow-sm ring-1 ring-teal-100 hover:no-underline">Open Jastip</a>
                <a href="<?= Controller::url('/buyer/orders/history') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 hover:bg-white hover:text-teal-700 hover:no-underline">Riwayat</a>
                <a href="<?= Controller::url('/logout') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 hover:bg-white hover:text-rose-600 hover:no-underline">Logout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-8 sm:px-6 lg:px-8">
        <section class="rounded-[2rem] border border-slate-200 bg-gradient-to-br from-teal-50 via-white to-sky-50 p-8 shadow-sm">
            <p class="text-sm font-black uppercase tracking-wide text-teal-700">Buyer Flow</p>
            <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Pilih Open Jastip Aktif</h1>
            <p class="mt-3 max-w-2xl text-slate-600">Buyer tidak memilih provider manual lagi. Pilih offer aktif, lalu provider otomatis mengikuti offer tersebut.</p>
        </section>

        <section class="mt-7">
            <?php if (empty($offers)): ?>
                <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                    <p class="font-bold text-slate-700">Belum ada Open Jastip aktif.</p>
                    <p class="mt-2 text-sm text-slate-500">Coba lagi setelah provider membuat offer baru.</p>
                </div>
            <?php else: ?>
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    <?php foreach ($offers as $offer): ?>
                        <?php $providerName = (string) ($offer['provider']['name'] ?? 'Provider'); ?>
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-xl font-black text-slate-950"><?= htmlspecialchars((string) ($offer['title'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></h2>
                                    <p class="mt-2 text-sm text-slate-500"><?= htmlspecialchars((string) ($offer['location'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-black text-emerald-700 ring-1 ring-emerald-100">active</span>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-600"><?= htmlspecialchars((string) ($offer['description'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                            <dl class="mt-5 grid gap-2 text-sm">
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Kategori</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['category'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Provider</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars($providerName, ENT_QUOTES, 'UTF-8') ?></dd></div>
                                <div class="flex justify-between gap-3"><dt class="text-slate-500">Deadline</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['deadline'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                            </dl>
                            <a href="<?= Controller::url('/buyer/orders/create?offer_id=' . urlencode((string) $offer['_id'])) ?>" class="mt-6 block rounded-full bg-teal-700 px-5 py-3 text-center text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Titip Barang</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</div>
