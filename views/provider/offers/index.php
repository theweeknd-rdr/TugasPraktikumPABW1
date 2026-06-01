<?php use App\Core\Controller; ?>

<?php
    $providerName = (string) ($_SESSION['user']['name'] ?? 'Provider');
    $activeCount = count(array_filter($offers, fn (array $offer): bool => ($offer['status'] ?? '') === 'active' && strtotime((string) ($offer['deadline'] ?? '')) >= strtotime(date('Y-m-d'))));
    $expiredCount = count($offers) - $activeCount;
?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <aside class="border-b border-slate-200 bg-white/95 px-5 py-5 lg:sticky lg:top-0 lg:h-screen lg:w-72 lg:border-b-0 lg:border-r">
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-2xl font-black">Jastipin</span>
            </a>
            <div class="mt-7 rounded-3xl bg-teal-50 p-4">
                <p class="text-xs font-black uppercase tracking-wide text-teal-700">Provider</p>
                <p class="mt-1 font-black text-slate-950"><?= htmlspecialchars($providerName, ENT_QUOTES, 'UTF-8') ?></p>
                <p class="mt-1 text-sm text-slate-600">Kelola Open Jastip yang buyer bisa pesan.</p>
            </div>
            <nav class="mt-7 grid gap-2 text-sm font-bold text-slate-600">
                <a href="<?= Controller::url('/provider/dashboard') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/provider/offers') ?>" class="rounded-2xl bg-teal-700 px-4 py-3 text-white hover:no-underline">Open Jastip</a>
                <a href="<?= Controller::url('/provider/orders/history') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Pengantaran</a>
                <a href="<?= Controller::url('/orders') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Orders</a>
                <a href="<?= Controller::url('/logout') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-rose-600 hover:no-underline">Logout</a>
            </nav>
        </aside>

        <main class="flex-1 px-5 py-6 sm:px-7 lg:px-10">
            <header class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Provider Flow</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Open Jastip Saya</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">Offer disimpan di collection <span class="font-bold">offers</span>. Buyer akan memilih dari daftar offer aktif ini.</p>
                </div>
                <a href="<?= Controller::url('/provider/offers/create') ?>" class="w-fit rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Buat Open Jastip</a>
            </header>

            <section class="mt-7 grid gap-5 md:grid-cols-3">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Total Offer</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950"><?= count($offers) ?></h2>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Active</p>
                    <h2 class="mt-3 text-3xl font-black text-emerald-700"><?= $activeCount ?></h2>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Closed / Expired</p>
                    <h2 class="mt-3 text-3xl font-black text-amber-700"><?= $expiredCount ?></h2>
                </article>
            </section>

            <section class="mt-7 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <?php if (empty($offers)): ?>
                    <div class="rounded-3xl bg-slate-50 p-8 text-center">
                        <p class="font-bold text-slate-700">Belum ada Open Jastip.</p>
                        <p class="mt-2 text-sm text-slate-500">Buat offer pertama agar buyer bisa menitip barang.</p>
                    </div>
                <?php else: ?>
                    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <?php foreach ($offers as $offer): ?>
                            <?php
                                $isActive = ($offer['status'] ?? '') === 'active' && strtotime((string) ($offer['deadline'] ?? '')) >= strtotime(date('Y-m-d'));
                                $badge = $isActive ? 'bg-emerald-50 text-emerald-700 ring-emerald-100' : 'bg-amber-50 text-amber-700 ring-amber-100';
                            ?>
                            <article class="rounded-3xl border border-slate-200 p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h2 class="text-lg font-black text-slate-950"><?= htmlspecialchars((string) ($offer['title'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></h2>
                                        <p class="mt-1 text-sm text-slate-500"><?= htmlspecialchars((string) ($offer['location'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $badge ?>"><?= $isActive ? 'active' : 'expired' ?></span>
                                </div>
                                <p class="mt-4 text-sm leading-6 text-slate-600"><?= htmlspecialchars((string) ($offer['description'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                                <dl class="mt-5 grid gap-2 text-sm">
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Kategori</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['category'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Deadline</dt><dd class="font-bold text-slate-800"><?= htmlspecialchars((string) ($offer['deadline'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                                </dl>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</div>
