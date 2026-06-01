<?php

use App\Core\Controller; ?>

<?php
$providerName = (string) ($_SESSION['user']['name'] ?? 'Provider');
$monthlyIncome = [120000, 180000, 150000, 260000, 320000, max(450000, (float) $summary['total_pendapatan'])];
$points = ['40,128', '138,101', '236,112', '334,76', '432,52', '530,30'];

$statusClass = function (string $status): string {
    return match ($status) {
        'selesai' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
        'diproses' => 'bg-sky-50 text-sky-700 ring-sky-100',
        default => 'bg-amber-50 text-amber-700 ring-amber-100',
    };
};
?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <aside class="border-b border-slate-200 bg-white/95 px-5 py-5 lg:sticky lg:top-0 lg:h-screen lg:w-72 lg:border-b-0 lg:border-r">
            <div class="flex items-center justify-between gap-4 lg:block">
                <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                    <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                    <span class="text-2xl font-black">Jastipin</span>
                </a>
                <a href="<?= Controller::url('/logout') ?>" class="rounded-full bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 hover:no-underline lg:hidden">Logout</a>
            </div>

            <div class="mt-7 rounded-3xl bg-teal-50 p-4">
                <p class="text-xs font-black uppercase tracking-wide text-teal-700">Provider</p>
                <p class="mt-1 font-black text-slate-950"><?= htmlspecialchars($providerName, ENT_QUOTES, 'UTF-8') ?></p>
                <p class="mt-1 text-sm text-slate-600">Kelola pesanan masuk dan rekap pemasukan.</p>
            </div>

            <nav class="mt-7 grid gap-2 text-sm font-bold text-slate-600">
                <a href="<?= Controller::url('/provider/dashboard') ?>" class="rounded-2xl bg-teal-700 px-4 py-3 text-white hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/provider/offers') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Open Jastip</a>
                <a href="#pesanan-masuk" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Pesanan Masuk</a>
                <a href="#diproses" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Diproses</a>
                <a href="<?= Controller::url('/provider/orders/history') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Riwayat</a>
                <a href="<?= Controller::url('/orders/summary/avg-service-fee') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Rekap</a>
            </nav>

            <a href="<?= Controller::url('/logout') ?>" class="mt-7 hidden rounded-2xl bg-slate-100 px-4 py-3 text-center text-sm font-black text-slate-600 hover:bg-slate-200 hover:no-underline lg:block">Logout</a>
        </aside>

        <main class="flex-1 px-5 py-6 sm:px-7 lg:px-10">
            <header class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Dashboard Provider</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Rekapitulasi Pengantaran</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">Pantau pemasukan, pesanan masuk, dan pengantaran terbaru dalam satu halaman.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="<?= Controller::url('/provider/offers/create') ?>" class="w-fit rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Buat Open Jastip</a>
                    <a href="#pesanan-masuk" class="w-fit rounded-full bg-white px-5 py-3 text-sm font-black text-teal-700 ring-1 ring-teal-100 hover:bg-teal-50 hover:no-underline">Lihat Pesanan</a>
                </div>
            </header>

            <section class="mt-7 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Total Pendapatan</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950">Rp <?= number_format((float) $summary['total_pendapatan'], 0, ',', '.') ?></h2>
                    <p class="mt-3 text-sm text-emerald-700">Dari pesanan selesai</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Total Pesanan Selesai</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950"><?= (int) $summary['jumlah_pesanan_selesai'] ?></h2>
                    <p class="mt-3 text-sm text-sky-700">Riwayat sukses</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Pesanan Pending</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950"><?= count($incomingOrders) ?></h2>
                    <p class="mt-3 text-sm text-amber-700">Menunggu ACC provider</p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Sedang Diproses</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950"><?= count($activeOrders) ?></h2>
                    <p class="mt-3 text-sm text-teal-700">Dalam pengantaran</p>
                </article>
            </section>

            <section class="mt-7 grid gap-5 xl:grid-cols-[1fr_0.95fr]">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                        <div>
                            <h2 class="text-xl font-black text-slate-950">Tren Pemasukan Bulanan</h2>
                            <p class="mt-1 text-sm text-slate-500">Contoh grafik garis untuk rekap pemasukan provider.</p>
                        </div>
                        <span class="rounded-full bg-sky-50 px-3 py-1 text-sm font-bold text-sky-700">6 bulan</span>
                    </div>
                    <div class="mt-6 overflow-hidden rounded-3xl bg-gradient-to-b from-sky-50 to-white p-4">
                        <svg viewBox="0 0 570 170" class="h-56 w-full" role="img" aria-label="Line chart pemasukan bulanan">
                            <line x1="40" y1="140" x2="540" y2="140" stroke="#cbd5e1" stroke-width="1" />
                            <line x1="40" y1="20" x2="40" y2="140" stroke="#cbd5e1" stroke-width="1" />
                            <polyline points="<?= implode(' ', $points) ?>" fill="none" stroke="#0f766e" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                            <?php foreach ($points as $point): ?>
                                <?php [$x, $y] = explode(',', $point); ?>
                                <circle cx="<?= $x ?>" cy="<?= $y ?>" r="6" fill="#0f766e" stroke="#ffffff" stroke-width="4" />
                            <?php endforeach; ?>
                            <text x="38" y="163" font-size="12" fill="#64748b">Jan</text>
                            <text x="136" y="163" font-size="12" fill="#64748b">Feb</text>
                            <text x="234" y="163" font-size="12" fill="#64748b">Mar</text>
                            <text x="332" y="163" font-size="12" fill="#64748b">Apr</text>
                            <text x="430" y="163" font-size="12" fill="#64748b">Mei</text>
                            <text x="528" y="163" font-size="12" fill="#64748b">Jun</text>
                        </svg>
                    </div>
                </article>

                <article id="diproses" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-black text-slate-950">Sedang Diproses</h2>
                    <p class="mt-1 text-sm text-slate-500">Pesanan yang sudah di-ACC dan sedang diantar.</p>
                    <div class="mt-5 space-y-3">
                        <?php if (empty($activeOrders)): ?>
                            <p class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-500">Belum ada pesanan yang sedang diproses.</p>
                        <?php endif; ?>
                        <?php foreach ($activeOrders as $order): ?>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="font-black text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></p>
                                        <p class="mt-1 text-sm text-slate-500"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?> &middot; Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></p>
                                    </div>
                                    <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-black text-sky-700 ring-1 ring-sky-100">diproses</span>
                                </div>
                                <form class="mt-4" method="post" action="<?= Controller::url('/provider/orders/complete') ?>">
                                    <input type="hidden" name="order_id" value="<?= htmlspecialchars((string) $order['_id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="w-full rounded-full bg-teal-700 px-4 py-2 text-sm font-black text-white hover:bg-teal-800">Selesaikan</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </article>
            </section>

            <section id="pesanan-masuk" class="mt-7 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-xl font-black text-slate-950">Pesanan Masuk</h2>
                        <p class="mt-1 text-sm text-slate-500">Pesanan pending dari Open Jastip kamu. Klik ACC saat barang siap diantar.</p>
                    </div>
                    <span class="rounded-full bg-amber-50 px-3 py-1 text-sm font-black text-amber-700"><?= count($incomingOrders) ?> pending</span>
                </div>

                <div class="mt-5 overflow-x-auto">
                    <?php if (empty($incomingOrders)): ?>
                        <p class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-500">Belum ada pesanan pending dari buyer.</p>
                    <?php else: ?>
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 font-black">Barang</th>
                                    <th class="px-4 py-3 font-black">Kategori</th>
                                    <th class="px-4 py-3 font-black">Status</th>
                                    <th class="px-4 py-3 font-black">Harga Jasa</th>
                                    <th class="px-4 py-3 font-black">Tanggal</th>
                                    <th class="px-4 py-3 font-black">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($incomingOrders as $order): ?>
                                    <tr>
                                        <td class="px-4 py-4 font-bold text-slate-900"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4"><span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-black text-amber-700 ring-1 ring-amber-100">pending</span></td>
                                        <td class="px-4 py-4 font-bold text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4">
                                            <form method="post" action="<?= Controller::url('/provider/orders/accept') ?>">
                                                <input type="hidden" name="order_id" value="<?= htmlspecialchars((string) $order['_id'], ENT_QUOTES, 'UTF-8') ?>">
                                                <button type="submit" class="rounded-full bg-teal-700 px-4 py-2 text-sm font-black text-white hover:bg-teal-800">ACC</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </section>

            <section class="mt-7 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-black text-slate-950">Riwayat Pengantaran Terbaru</h2>
                <div class="mt-5 overflow-x-auto">
                    <?php if (empty($orders)): ?>
                        <p class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-500">Belum ada riwayat untuk provider ini.</p>
                    <?php else: ?>
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 font-black">Tanggal</th>
                                    <th class="px-4 py-3 font-black">Barang</th>
                                    <th class="px-4 py-3 font-black">Buyer</th>
                                    <th class="px-4 py-3 font-black">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($orders as $order): ?>
                                    <?php $status = (string) ($order['status'] ?? 'pending'); ?>
                                    <tr>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 font-bold text-slate-900"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['buyer_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>
</div>
