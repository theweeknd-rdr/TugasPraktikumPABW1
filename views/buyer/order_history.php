<?php use App\Core\Controller; ?>

<?php
    $buyerName = (string) ($_SESSION['user']['name'] ?? 'Buyer');
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
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-2xl font-black">Jastipin</span>
            </a>
            <div class="mt-7 rounded-3xl bg-teal-50 p-4">
                <p class="text-xs font-black uppercase tracking-wide text-teal-700">Buyer</p>
                <p class="mt-1 font-black text-slate-950"><?= htmlspecialchars($buyerName, ENT_QUOTES, 'UTF-8') ?></p>
                <p class="mt-1 text-sm text-slate-600">Riwayat semua pesanan kamu.</p>
            </div>
            <nav class="mt-7 grid gap-2 text-sm font-bold text-slate-600">
                <a href="<?= Controller::url('/buyer/dashboard') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/buyer/offers') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Open Jastip</a>
                <a href="<?= Controller::url('/buyer/orders/history') ?>" class="rounded-2xl bg-teal-700 px-4 py-3 text-white hover:no-underline">Riwayat</a>
                <a href="<?= Controller::url('/orders') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Orders</a>
                <a href="<?= Controller::url('/logout') ?>" class="rounded-2xl px-4 py-3 hover:bg-slate-100 hover:text-teal-700 hover:no-underline">Logout</a>
            </nav>
        </aside>

        <main class="flex-1 px-5 py-6 sm:px-7 lg:px-10">
            <header class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Riwayat Pesanan</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Semua Titipan Kamu</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">Lihat status, tanggal, dan biaya jasa dari setiap pesanan.</p>
                </div>
                <a href="<?= Controller::url('/buyer/offers') ?>" class="w-fit rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Cari Open Jastip</a>
            </header>

            <section class="mt-7 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <?php if (empty($orders)): ?>
                    <div class="rounded-3xl bg-slate-50 p-8 text-center">
                        <p class="font-bold text-slate-700">Belum ada riwayat pesanan.</p>
                        <p class="mt-2 text-sm text-slate-500">Pesanan yang kamu buat akan muncul di sini.</p>
                    </div>
                <?php else: ?>
                    <div class="grid gap-4 lg:hidden">
                        <?php foreach ($orders as $order): ?>
                            <?php $status = (string) ($order['status'] ?? 'pending'); ?>
                            <article class="rounded-3xl border border-slate-200 p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h2 class="font-black text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></h2>
                                        <p class="mt-1 text-sm text-slate-500"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></p>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span>
                                </div>
                                <dl class="mt-5 grid gap-3 text-sm">
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Harga jasa</dt><dd class="font-black text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></dd></div>
                                    <div class="flex justify-between gap-3"><dt class="text-slate-500">Tanggal</dt><dd class="font-bold text-slate-700"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd></div>
                                </dl>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <div class="hidden overflow-x-auto lg:block">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 font-black">Barang</th>
                                    <th class="px-4 py-3 font-black">Kategori</th>
                                    <th class="px-4 py-3 font-black">Status</th>
                                    <th class="px-4 py-3 font-black">Harga Jasa</th>
                                    <th class="px-4 py-3 font-black">Tanggal</th>
                                    <th class="px-4 py-3 font-black">Provider</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach ($orders as $order): ?>
                                    <?php
                                        $status = (string) ($order['status'] ?? 'pending');
                                        $providerId = (string) ($order['provider_id'] ?? '-');
                                        $providerLabel = strlen($providerId) > 10 ? substr($providerId, 0, 10) . '...' : $providerId;
                                    ?>
                                    <tr class="hover:bg-slate-50/70">
                                        <td class="px-4 py-4 font-bold text-slate-950"><?= htmlspecialchars((string) ($order['nama_barang'] ?? 'Barang tidak tersedia'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['kategori'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4"><span class="rounded-full px-3 py-1 text-xs font-black ring-1 <?= $statusClass($status) ?>"><?= htmlspecialchars($status, ENT_QUOTES, 'UTF-8') ?></span></td>
                                        <td class="px-4 py-4 font-black text-teal-700">Rp <?= number_format((float) ($order['harga_jasa'] ?? 0), 0, ',', '.') ?></td>
                                        <td class="px-4 py-4 text-slate-600"><?= htmlspecialchars((string) ($order['tanggal'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="px-4 py-4 text-slate-500"><?= htmlspecialchars($providerLabel, ENT_QUOTES, 'UTF-8') ?></td>
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
