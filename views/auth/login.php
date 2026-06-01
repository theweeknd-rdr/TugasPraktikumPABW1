<?php use App\Core\Controller; ?>

<section class="auth-shell">
    <aside class="auth-copy">
        <div>
            <div class="auth-kicker">Platform jastip kampus</div>
            <h1>Pesan bantuan titip dengan alur yang jelas.</h1>
            <p>Buyer bisa membuat pesanan, provider bisa memantau pengantaran dan rekap pendapatan dalam satu tempat.</p>

            <div class="auth-points">
                <div class="auth-point">
                    <span>1</span>
                    <div>
                        <strong>Buyer</strong>
                        <small>Buat pesanan dan cek riwayat pribadi.</small>
                    </div>
                </div>
                <div class="auth-point">
                    <span>2</span>
                    <div>
                        <strong>Provider</strong>
                        <small>Lihat riwayat pengantaran dan pendapatan selesai.</small>
                    </div>
                </div>
            </div>
        </div>

        <p>Jastipin menjaga akses berdasarkan role agar tiap pengguna hanya melihat data yang relevan.</p>
    </aside>

    <div class="auth-form-panel">
        <h1>Masuk ke Jastipin</h1>
        <p>Gunakan email dan password yang sudah terdaftar.</p>

        <form class="auth-form" method="post" action="<?= Controller::url('/login') ?>">
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="buyer@example.com" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <div class="actions">
                <button type="submit">Login</button>
                <a class="button secondary" href="<?= Controller::url('/register') ?>">Buat Akun</a>
            </div>
        </form>

        <div class="auth-footnote">
            Belum punya akun? Pilih role buyer atau provider saat registrasi.
        </div>
    </div>
</section>
