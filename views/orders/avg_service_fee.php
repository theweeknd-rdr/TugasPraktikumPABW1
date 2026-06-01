<?php use App\Core\Controller; ?>

<?php
    $user = $_SESSION['user'] ?? [];
    $role = (string) ($user['role'] ?? 'buyer');
    $dashboardUrl = $role === 'provider'
        ? Controller::url('/provider/dashboard')
        : Controller::url('/buyer/dashboard');
?>

<div class="min-h-screen bg-[#f5f7f4] font-sans text-slate-900">
    <header class="border-b border-slate-200 bg-white/95">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4 sm:px-6 lg:flex-nowrap lg:px-8">
            <a href="<?= Controller::url('/') ?>" class="flex items-center gap-3 text-slate-950 hover:no-underline">
                <span class="grid h-11 w-11 place-items-center rounded-xl bg-teal-700 text-xl font-black text-white shadow-lg shadow-teal-900/15">J</span>
                <span class="text-2xl font-black">Jastipin</span>
            </a>
            <nav class="order-3 flex w-full gap-1 overflow-x-auto rounded-full border border-slate-200 bg-slate-50 p-1 text-sm font-black text-slate-600 shadow-inner md:order-none md:w-auto md:overflow-visible">
                <a href="<?= $dashboardUrl ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Dashboard</a>
                <a href="<?= Controller::url('/orders') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-teal-700 hover:shadow-sm hover:no-underline">Orders</a>
                <a href="<?= Controller::url('/orders/summary/avg-service-fee') ?>" class="whitespace-nowrap rounded-full bg-white px-4 py-2.5 text-teal-700 shadow-sm ring-1 ring-teal-100 hover:no-underline">Rekap</a>
                <a href="<?= Controller::url('/logout') ?>" class="whitespace-nowrap rounded-full px-4 py-2.5 transition hover:bg-white hover:text-rose-600 hover:shadow-sm hover:no-underline">Logout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-5 py-10 sm:px-6 lg:px-8">
        <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 bg-gradient-to-br from-teal-50 via-white to-sky-50 p-8 md:grid-cols-[1fr_280px]">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Rekapitulasi</p>
                    <h1 class="mt-2 text-3xl font-black tracking-normal text-slate-950 sm:text-4xl">Rata-Rata Harga Jasa</h1>
                    <p class="mt-3 max-w-2xl text-slate-600">Perhitungan hanya mengambil transaksi dengan status selesai, sehingga rekap lebih bersih untuk laporan.</p>
                    <a href="<?= Controller::url('/orders') ?>" class="mt-6 inline-flex rounded-full bg-teal-700 px-5 py-3 text-sm font-black text-white shadow-lg shadow-teal-900/15 hover:bg-teal-800 hover:no-underline">Lihat Daftar Pesanan</a>
                </div>
                <div class="rounded-3xl bg-white p-6 text-center shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-bold text-slate-500">Rata-rata</p>
                    <p class="mt-3 text-4xl font-black text-teal-700">Rp <?= number_format((float) $average, 0, ',', '.') ?></p>
                    <p class="mt-3 text-sm text-slate-500">Harga jasa selesai</p>
                </div>
            </div>
        </section>
    </main>
</div>
