<?php use App\Core\Controller; ?>

<section class="auth-shell">
    <aside class="auth-copy">
        <div>
            <div class="auth-kicker">Akun baru Jastipin</div>
            <h1>Mulai sebagai Buyer atau Provider.</h1>
            <p>Pilih peran sesuai kebutuhan. Buyer membuat pesanan, provider menerima pengantaran dan melihat rekap kerja.</p>

            <div class="auth-points">
                <div class="auth-point">
                    <span>B</span>
                    <div>
                        <strong>Buyer</strong>
                        <small>Membuat pesanan dan melihat progres titipan.</small>
                    </div>
                </div>
                <div class="auth-point">
                    <span>P</span>
                    <div>
                        <strong>Provider</strong>
                        <small>Mengelola pengantaran dan pendapatan jasa.</small>
                    </div>
                </div>
            </div>
        </div>

        <p>Email harus unik dan password disimpan menggunakan hash.</p>
    </aside>

    <div class="auth-form-panel">
        <h1>Buat akun</h1>
        <p>Lengkapi data utama untuk mulai menggunakan Jastipin.</p>

        <form class="auth-form" method="post" action="<?= Controller::url('/register') ?>">
            <div class="app-grid">
                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" type="text" name="name" placeholder="Nama lengkap" required>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="nama@email.com" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="field">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars(ucfirst($role), ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field">
                    <label for="phone">Nomor HP</label>
                    <input id="phone" type="text" name="phone" placeholder="08xxxxxxxxxx">
                </div>

                <div class="field">
                    <label for="address">Alamat</label>
                    <input id="address" type="text" name="address" placeholder="Area atau alamat utama">
                </div>

                <div class="field field-full">
                    <label for="avatar">Avatar URL</label>
                    <input id="avatar" type="url" name="avatar" placeholder="https://example.com/avatar.jpg">
                </div>
            </div>

            <div class="actions">
                <button type="submit">Register</button>
                <a class="button secondary" href="<?= Controller::url('/login') ?>">Sudah Punya Akun</a>
            </div>
        </form>

        <div class="auth-footnote">
            Setelah registrasi berhasil, kamu akan diarahkan ke halaman login.
        </div>
    </div>
</section>
