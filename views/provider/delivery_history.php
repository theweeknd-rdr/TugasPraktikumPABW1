<?php use App\Core\Controller; ?>

<?php
    $providerName = (string) ($_SESSION['user']['name'] ?? 'Provider');
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
                <p class="mt-1 text-sm text-slate-600">Riwayat pengantaran dan status pesanan.</p>
            </div>

            <nav class="mt-7 grid gap-2 text-sm font-bold text-slate-600">
                <a href="<?= Controller::url('/provider/dashboard') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/provider/offers') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Open Jastip</a>
                <a href="<?= Controller::url('/provider/orders/history') ?>" class="rounded-2xl bg-teal-700 px-4 py-3 text-white hover:no-underline">Pengantaran</a>
                <a href="<?= Controller::url('/orders') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Orders</a>
                <a href="<?= Controller::url('/orders/summary/avg-service-fee') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Rekap</a>
                <a href="<?= Controller::url('/logout') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-rose-600 hover:no-underline">Logout</a>
            </nav>
        </aside>

        <main class="flex-1 px-5 py-6 sm:px-7 lg:px-10">
            <header class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Riwayat Pengantaran</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Aktivitas Pengantaran Provider</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">Pantau semua pesanan yang sudah kamu ambil, sedang diproses, atau selesai diantar.</p>
                </div>
                <a href="<?= Controller::url('/provider/offers') ?>" class="w-fit rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Kelola Open Jastip</a>
            </header>

            <section class="mt-7 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Total Pengantaran</p>
                    <h2 class="mt-3 text-3xl font-black text-slate-950"><?= (int) $stats['total'] ?></h2>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Sedang Diproses</p>
                    <h2 class="mt-3 text-3xl font-black text-sky-700"><?= (int) $stats['diproses'] ?></h2>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Selesai</p>
                    <h2 class="mt-3 text-3xl font-black text-emerald-700"><?= (int) $stats['selesai'] ?></h2>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold text-slate-500">Pendapatan Selesai</p>
                    <h2 class="mt-3 text-3xl font-black text-teal-700">Rp <?= number_format((float) $stats['pendapatan'], 0, ',', '.') ?></h2>
                </article>
            </section>

            <section class="mt-7 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-xl font-black text-slate-950">Daftar Pengantaran</h2>
                        <p class="mt-1 text-sm text-slate-500">ID buyer dipendekkan agar tabel tetap bersih. Arahkan kursor untuk melihat ID lengkap.</p>
                    </div>
                    <span class="rounded-full bg-teal-50 px-3 py-1 text-sm font-black text-teal-700"><?= (int) $stats['total'] ?> data</span>
                </div>

                <?php if (empty($orders)): ?>
                    <div class="mt-5 rounded-3xl bg-slate-50 p-8 text-center">
                        <p class="font-bold text-slate-700">Belum ada riwayat pengantaran.</p>
                        <p class="mt-2 text-sm text-slate-500">Pesanan yang kamu ACC akan muncul di halaman ini.</p>
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
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($orders as $order): ?>
                                    <?php $status = (string) ($order['status'] ?? 'pending'); ?>
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="max-w-[340px] px-4 py-4 font-bold leading-6 text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span></td>
                                        <td class="whitespace-nowrap px-4 py-4 font-black text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></td>
                                        <td class="whitespace-nowrap px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 font-mono text-xs text-slate-500" title="<?= htmlspecialchars((string) ($order['buyer_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($shortId($order['buyer_id'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</div>
