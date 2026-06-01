<?php use App\Core\Controller; ?>

<section class="panel">
    <h1>MongoDB Status</h1>
    <p>Halaman ini membuktikan aplikasi PHP Jastipin tersambung langsung ke MongoDB.</p>

    <div class="app-grid">
        <div class="stat">
            <p class="muted">Status koneksi</p>
            <?php if ($status['connected']): ?>
                <h2><span class="badge selesai">Connected</span></h2>
            <?php else: ?>
                <h2><span class="badge pending">Failed</span></h2>
            <?php endif; ?>
        </div>

        <div class="stat">
            <p class="muted">Database</p>
            <h2><?= htmlspecialchars($status['database'], ENT_QUOTES, 'UTF-8') ?></h2>
        </div>

        <div class="stat">
            <p class="muted">MongoDB URI</p>
            <h2 style="font-size: 16px; word-break: break-word;">
                <?= htmlspecialchars($status['uri'], ENT_QUOTES, 'UTF-8') ?>
            </h2>
        </div>
    </div>
</section>

<?php if ($status['error']): ?>
    <section class="panel">
        <h2>Error</h2>
        <p><?= htmlspecialchars($status['error'], ENT_QUOTES, 'UTF-8') ?></p>
    </section>
<?php endif; ?>

<section class="panel">
    <h2>Collections</h2>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Collection</th>
                    <th>Jumlah Documents</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($status['collections'] as $collection): ?>
                    <tr>
                        <td><?= htmlspecialchars($collection['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= (int) $collection['documents'] ?></td>
                        <td>Aplikasi berhasil membaca collection ini dari MongoDB.</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="actions" style="margin-top: 18px;">
        <a class="button" href="<?= Controller::url('/login') ?>">Kembali ke Login</a>
        <a class="button secondary" href="<?= Controller::url('/register') ?>">Register User Baru</a>
    </div>
</section>
