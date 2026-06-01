<?php use App\Core\Controller; ?>

<?php
    $user = $_SESSION['user'] ?? [];
    $role = (string) ($user['role'] ?? 'buyer');
    $name = (string) ($user['name'] ?? 'User');

    $dashboardUrl = $role === 'provider'
        ? Controller::url('/provider/dashboard')
        : Controller::url('/buyer/dashboard');

    $historyUrl = $role === 'provider'
        ? Controller::url('/provider/orders/history')
        : Controller::url('/buyer/orders/history');

    $shortId = function (mixed $id): string {
        $value = (string) ($id ?? '-');
        return strlen($value) > 12 ? substr($value, 0, 8) . '...' . substr($value, -4) : $value;
    };

    $statusClass = function (string $status): string {
        return match ($status) {
            'selesai' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
            'diproses' => 'bg-sky-50 text-sky-700 ring-sky-100',
            default => 'bg-amber-50 text-amber-700 ring-amber-100',
        };
    };

    $categoryLabel = $selectedCategory !== '' ? ucfirst($selectedCategory) : 'Semua kategori';
?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4 sm:px-6 lg:flex-nowrap lg:px-8">
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-2xl font-black">Jastipin</span>
            </a>

            <nav class="order-3 flex w-full gap-1 overflow-x-auto rounded-full border border-slate-200 bg-slate-50 p-1 text-sm font-black text-slate-600 shadow-inner md:order-none md:w-auto md:overflow-visible">
                <a href="<?= $dashboardUrl ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline"><?= $role === 'provider' ? 'Provider' : 'Buyer' ?></a>
                <?php if ($role !== 'provider'): ?>
                    <a href="<?= Controller::url('/buyer/offers') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Open Jastip</a>
                <?php else: ?>
                    <a href="<?= Controller::url('/provider/offers') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Open Jastip</a>
                <?php endif; ?>
                <a href="<?= $historyUrl ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Riwayat</a>
                <a href="<?= Controller::url('/orders') ?>" class="whitespace-nowrap rounded-full bg-white px-4 py-2.5 text-teal-700 shadow-sm ring-1 ring-teal-100 hover:no-underline">Orders</a>
                <a href="<?= Controller::url('/orders/summary/avg-service-fee') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Rekap</a>
                <a href="<?= Controller::url('/logout') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-rose-600 hover:shadow-sm hover:no-underline">Logout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-7 sm:px-6 lg:px-8">
        <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-6 bg-gradient-to-br from-teal-50 via-white to-sky-50 p-6 md:grid-cols-[1fr_340px] md:p-8">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Daftar Pesanan</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Pantau Semua Pesanan Jastip</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">
                        Halo <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>, lihat status pesanan berdasarkan kategori, biaya jasa, dan tanggal kebutuhan titipan.
                    </p>
                </div>

                <div class="rounded-3xl bg-white/80 p-5 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-bold text-slate-500">Filter aktif</p>
                    <p class="mt-2 text-2xl font-black text-slate-950"><?= htmlspecialchars($categoryLabel, ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="mt-2 text-sm text-slate-500"><?= (int) $stats['total'] ?> pesanan ditampilkan</p>
                </div>
            </div>
        </section>

        <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">Total</p>
                <h2 class="mt-2 text-3xl font-black text-slate-950"><?= (int) $stats['total'] ?></h2>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">Pending</p>
                <h2 class="mt-2 text-3xl font-black text-amber-700"><?= (int) $stats['pending'] ?></h2>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">Diproses</p>
                <h2 class="mt-2 text-3xl font-black text-sky-700"><?= (int) $stats['diproses'] ?></h2>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">Selesai</p>
                <h2 class="mt-2 text-3xl font-black text-emerald-700"><?= (int) $stats['selesai'] ?></h2>
            </article>
        </section>

        <section class="mt-6 grid gap-6 lg:grid-cols-[320px_1fr]">
            <aside class="h-fit rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-black text-slate-950">Filter Pesanan</h2>
                <p class="mt-2 text-sm text-slate-500">Pilih kategori untuk mempersempit daftar pesanan.</p>

                <form method="get" action="<?= Controller::url('/orders') ?>" class="mt-5 space-y-5">
                    <label class="block">
                        <span class="text-sm font-black text-slate-700">Kategori</span>
                        <select id="category" name="category" class="mt-2 w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-teal-600 focus:ring-teal-600">
                            <option value="">Semua kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>>
                                    <?= htmlspecialchars(ucfirst($category), ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <div class="grid gap-3">
                        <button type="submit" class="rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800">Terapkan Filter</button>
                        <a href="<?= Controller::url('/orders') ?>" class="rounded-full bg-slate-100 px-5 py-3 text-center text-sm font-black text-slate-600 hover:bg-slate-200 hover:no-underline">Reset</a>
                    </div>
                </form>
            </aside>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-xl font-black text-slate-950">Hasil Pesanan</h2>
                        <p class="mt-1 text-sm text-slate-500">Tampilan desktop memakai tabel, mobile otomatis menjadi kartu.</p>
                    </div>
                    <span class="rounded-full bg-teal-50 px-3 py-1 text-sm font-black text-teal-700"><?= (int) $stats['total'] ?> data</span>
                </div>

                <?php if (empty($orders)): ?>
                    <div class="mt-5 rounded-3xl bg-slate-50 p-8 text-center">
                        <p class="font-bold text-slate-700">Tidak ada pesanan untuk filter ini.</p>
                        <p class="mt-2 text-sm text-slate-500">Coba pilih kategori lain atau reset filter.</p>
                    </div>
                <?php else: ?>
                    <div class="mt-5 grid gap-4 lg:hidden">
                        <?php foreach ($orders as $order): ?>
                            <?php $status = (string) ($order['status'] ?? 'pending'); ?>
                            <article class="rounded-3xl border border-slate-200 p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="font-black text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></h3>
                                        <p class="mt-1 text-sm text-slate-500"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?> &middot; <?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span>
                                </div>
                                <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                                    <span class="text-sm text-slate-500">Harga jasa</span>
                                    <span class="font-black text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></span>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-5 hidden overflow-x-auto lg:block">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 font-black">Barang</th>
                                    <th class="px-4 py-3 font-black">Kategori</th>
                                    <th class="px-4 py-3 font-black">Status</th>
                                    <th class="px-4 py-3 font-black">Harga Jasa</th>
                                    <th class="px-4 py-3 font-black">Tanggal</th>
                                    <th class="px-4 py-3 font-black">Buyer</th>
                                    <th class="px-4 py-3 font-black">Provider</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($orders as $order): ?>
                                    <?php $status = (string) ($order['status'] ?? 'pending'); ?>
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="max-w-[260px] px-4 py-4 font-bold leading-6 text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span></td>
                                        <td class="whitespace-nowrap px-4 py-4 font-black text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></td>
                                        <td class="whitespace-nowrap px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 font-mono text-xs text-slate-500" title="<?= htmlspecialchars((string) ($order['buyer_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($shortId($order['buyer_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 font-mono text-xs text-slate-500" title="<?= htmlspecialchars((string) ($order['provider_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($shortId($order['provider_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </section>
    </main>
</div>
