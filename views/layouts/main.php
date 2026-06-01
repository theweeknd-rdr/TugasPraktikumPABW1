<?php

use App\Core\Controller;

$user = $_SESSION['user'] ?? null;
$flash = $_SESSION['flash'] ?? [];
unset($_SESSION['flash']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?> - Jastipin</title>
    <?php if (! empty($useTailwind)): ?>
        <script>
            tailwind = {
                config: {
                    theme: {
                        extend: {
                            fontFamily: {
                                sans: ['Inter', 'Segoe UI', 'Arial', 'sans-serif']
                            },
                            colors: {
                                sage: {
                                    50: '#f4f7f4',
                                    100: '#e6efe8',
                                    500: '#7aa68a',
                                    700: '#32634c'
                                }
                            }
                        }
                    }
                }
            }
        </script>
        <script src="https://cdn.tailwindcss.com"></script>
    <?php endif; ?>
    <style>
        :root {
            color-scheme: light;
            --bg: #f4f7f6;
            --surface: #ffffff;
            --surface-soft: #f9fbff;
            --text: #1f2937;
            --muted: #6b7280;
            --line: #dde5ef;
            --primary: #0f766e;
            --primary-dark: #0b5f59;
            --primary-soft: #e7f6f3;
            --accent: #f59e0b;
            --accent-soft: #fff7e6;
            --success: #13795b;
            --success-soft: #eaf7f1;
            --warning: #9a6700;
            --warning-soft: #fff7e6;
            --danger: #b42318;
            --danger-soft: #fff1f0;
            --shadow: 0 10px 28px rgba(31, 41, 55, 0.06);
            --space-xs: 4px;
            --space-sm: 8px;
            --space-md: 16px;
            --space-lg: 24px;
            --space-xl: 32px;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 16px;
            line-height: 1.5;
        }

        a { color: var(--primary); text-decoration: none; }
        a:hover { text-decoration: underline; }

        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .nav {
            max-width: 1080px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
        }

        .brand {
            font-weight: 700;
            color: var(--text);
            font-size: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .brand::before {
            content: "J";
            display: inline-grid;
            place-items: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font-size: 18px;
            box-shadow: 0 8px 18px rgba(15, 118, 110, 0.25);
        }

        .links {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .links a {
            color: var(--muted);
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .links a:hover {
            background: var(--primary-soft);
            color: var(--primary);
            text-decoration: none;
        }

        .container {
            max-width: 1080px;
            margin: 0 auto;
            padding: 34px 24px 56px;
        }

        .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 24px;
            margin-bottom: 24px;
        }

        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            align-items: start;
        }

        h1, h2 { margin: 0 0 16px; line-height: 1.2; letter-spacing: 0; }
        h1 { font-size: 28px; }
        h2 { font-size: 20px; }
        p { color: var(--muted); margin: 0 0 16px; }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: var(--text);
        }

        input, select, button {
            width: 100%;
            min-height: 44px;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid var(--line);
            font: inherit;
            background: #fff;
            color: var(--text);
        }

        input:focus, select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
            outline: none;
        }

        button, .button {
            display: inline-block;
            width: auto;
            border: 0;
            background: var(--primary);
            color: #fff;
            cursor: pointer;
            font-weight: 700;
            padding: 10px 14px;
            border-radius: 6px;
            min-height: 44px;
            line-height: 24px;
        }

        button:hover, .button:hover {
            background: var(--primary-dark);
            text-decoration: none;
        }

        .button.secondary {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .button.secondary:hover {
            background: #d8efeb;
        }

        .field { margin-bottom: 16px; }

        .alert {
            border-radius: 6px;
            padding: 12px 14px;
            margin-bottom: 16px;
            background: var(--success-soft);
            color: var(--success);
            border: 1px solid #b7e1d5;
        }

        .alert.error {
            background: var(--danger-soft);
            color: var(--danger);
            border-color: #ffc9c2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--surface);
        }

        th, td {
            border-bottom: 1px solid var(--line);
            text-align: left;
            padding: 13px 12px;
            vertical-align: top;
        }

        th {
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
            background: var(--surface-soft);
        }

        tbody tr:hover {
            background: #fbfdff;
        }

        .badge {
            display: inline-block;
            min-width: 72px;
            padding: 4px 9px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 13px;
            font-weight: 700;
            text-align: center;
        }

        .badge.pending {
            background: var(--warning-soft);
            color: var(--warning);
        }

        .badge.diproses {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge.selesai {
            background: var(--success-soft);
            color: var(--success);
        }

        .stat {
            background: var(--surface-soft);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            min-height: 112px;
        }

        .stat h2 {
            margin-bottom: 0;
        }

        .muted { color: var(--muted); }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .table-wrap { overflow-x: auto; }

        .auth-shell {
            display: grid;
            grid-template-columns: 0.85fr 1.25fr;
            min-height: 620px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 22px 60px rgba(31, 41, 55, 0.11);
        }

        .auth-copy {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 32px;
            padding: 42px;
            background:
                linear-gradient(135deg, rgba(245, 158, 11, 0.18), transparent 38%),
                #123f43;
            color: #fff;
        }

        .auth-copy::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 180px;
            background:
                repeating-linear-gradient(
                    135deg,
                    rgba(255, 255, 255, 0.08) 0,
                    rgba(255, 255, 255, 0.08) 1px,
                    transparent 1px,
                    transparent 18px
                );
            pointer-events: none;
        }

        .auth-copy > * {
            position: relative;
            z-index: 1;
        }

        .auth-kicker {
            display: inline-flex;
            width: fit-content;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            color: #dff7f3;
            font-weight: 700;
            font-size: 13px;
        }

        .auth-copy h1 {
            max-width: 360px;
            margin-top: 22px;
            color: #fff;
            font-size: 34px;
        }

        .auth-copy p {
            max-width: 360px;
            color: #c9e4df;
            font-size: 15px;
        }

        .auth-points {
            display: grid;
            gap: 12px;
            margin-top: 24px;
        }

        .auth-point {
            display: grid;
            grid-template-columns: 36px 1fr;
            gap: 12px;
            align-items: start;
            color: #eefbf8;
        }

        .auth-point span {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.13);
            color: #f8c15c;
            font-weight: 800;
        }

        .auth-point strong {
            display: block;
            margin-bottom: 2px;
            color: #fff;
        }

        .auth-point small {
            color: #c9e4df;
            line-height: 1.4;
        }

        .auth-form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 44px;
        }

        .auth-form-panel h1 {
            margin-bottom: 8px;
        }

        .auth-form-panel > p {
            max-width: 560px;
            margin-bottom: 28px;
        }

        .auth-form {
            max-width: 760px;
        }

        .auth-form .app-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 20px;
        }

        .auth-form .field-full {
            grid-column: 1 / -1;
        }

        .auth-form .actions {
            margin-top: 6px;
        }

        .auth-form button,
        .auth-form .button {
            padding-left: 18px;
            padding-right: 18px;
        }

        .auth-footnote {
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 14px;
        }

        @media (max-width: 640px) {
            .nav, .container {
                padding-left: 16px;
                padding-right: 16px;
            }

            .panel {
                padding: 18px;
            }

            h1 {
                font-size: 24px;
            }

            .links {
                width: 100%;
            }

            .auth-shell {
                display: block;
                border-radius: 10px;
            }

            .auth-copy {
                padding: 28px;
            }

            .auth-copy h1 {
                font-size: 27px;
            }

            .auth-form-panel {
                padding: 28px;
            }

            .auth-form .app-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 641px) and (max-width: 920px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-copy {
                padding: 34px;
            }

            .auth-form-panel {
                padding: 36px;
            }
        }
    </style>
</head>
<body>
    <?php if (empty($hideAppHeader)): ?>
    <header class="topbar">
        <nav class="nav">
            <a class="brand" href="<?= Controller::url('/') ?>">Jastipin</a>
            <div class="links">
                <?php if ($user): ?>
                    <?php if ($user['role'] === 'buyer'): ?>
                        <a href="<?= Controller::url('/buyer/dashboard') ?>">Buyer</a>
                        <a href="<?= Controller::url('/buyer/offers') ?>">Open Jastip</a>
                        <a href="<?= Controller::url('/buyer/orders/history') ?>">Riwayat</a>
                    <?php endif; ?>
                    <?php if ($user['role'] === 'provider'): ?>
                        <a href="<?= Controller::url('/provider/dashboard') ?>">Provider</a>
                        <a href="<?= Controller::url('/provider/offers') ?>">Open Jastip</a>
                        <a href="<?= Controller::url('/provider/orders/history') ?>">Pengantaran</a>
                    <?php endif; ?>
                    <a href="<?= Controller::url('/orders') ?>">Orders</a>
                    <a href="<?= Controller::url('/orders/summary/avg-service-fee') ?>">Rekap</a>
                    <a href="<?= Controller::url('/logout') ?>">Logout</a>
                <?php else: ?>
                    <a href="<?= Controller::url('/login') ?>">Login</a>
                    <a href="<?= Controller::url('/register') ?>">Register</a>
                    <a href="<?= Controller::url('/mongodb/status') ?>">MongoDB Status</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <?php endif; ?>

    <main class="<?= ! empty($fullBleed) ? '' : 'container' ?>">
        <?php foreach ($flash as $type => $message): ?>
            <div class="alert <?= $type === 'error' ? 'error' : '' ?>">
                <?= htmlspecialchars((string) $message, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endforeach; ?>

        <?= $content ?>
    </main>
</body>
</html>
