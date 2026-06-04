<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Joki - <?= $web['web_title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-1: #0b1020;
            --bg-2: #131a32;
            --surface: rgba(255, 255, 255, 0.04);
            --surface-strong: rgba(255, 255, 255, 0.07);
            --border: rgba(255, 255, 255, 0.08);
            --text: #e7ecf6;
            --muted: #94a3b8;
            --primary: #6366f1;
            --primary-2: #8b5cf6;
            --blue: #3b82f6;
            --orange: #f59e0b;
            --green: #22c55e;
        }

        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }

        body {
            background:
                radial-gradient(1100px 600px at 85% -10%, rgba(139, 92, 246, 0.18), transparent 60%),
                radial-gradient(900px 500px at 0% 0%, rgba(59, 130, 246, 0.16), transparent 55%),
                linear-gradient(180deg, var(--bg-1), var(--bg-2));
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
        }

        /* ---------- Navbar ---------- */
        .topbar {
            background: rgba(10, 14, 28, 0.7);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .brand {
            font-weight: 800;
            letter-spacing: .2px;
            display: flex;
            align-items: center;
            gap: .65rem;
            color: #fff;
        }
        .brand .logo-badge {
            width: 40px; height: 40px;
            display: grid; place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            box-shadow: 0 8px 22px rgba(99, 102, 241, .45);
            font-size: 1.05rem;
        }
        .user-chip {
            display: inline-flex; align-items: center; gap: .55rem;
            background: var(--surface);
            border: 1px solid var(--border);
            padding: .4rem .8rem;
            border-radius: 999px;
            color: var(--text);
            font-weight: 600;
            font-size: .9rem;
        }
        .user-chip .avatar {
            width: 26px; height: 26px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--primary-2));
            display: grid; place-items: center; font-size: .8rem; color: #fff;
        }
        .btn-logout {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none; color: #fff; font-weight: 600;
            border-radius: 10px; padding: .45rem .9rem;
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn-logout:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(239, 68, 68, .4); }

        /* ---------- Page heading ---------- */
        .page-title { font-weight: 800; font-size: 1.55rem; margin-bottom: .15rem; }
        .page-sub { color: var(--muted); font-size: .95rem; }

        /* ---------- Stat cards ---------- */
        .stat-card {
            position: relative;
            border-radius: 18px;
            padding: 22px 24px;
            color: #fff;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: 0 18px 40px rgba(0,0,0,.35);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 24px 50px rgba(0,0,0,.45); }
        .stat-card .label { font-size: .85rem; opacity: .9; font-weight: 600; letter-spacing: .3px; }
        .stat-card .value { font-size: 2.2rem; font-weight: 800; line-height: 1.1; margin-top: 2px; }
        .stat-card .icon-wrap {
            width: 54px; height: 54px; border-radius: 14px;
            display: grid; place-items: center; font-size: 1.4rem;
            background: rgba(255,255,255,.18);
            backdrop-filter: blur(4px);
        }
        .stat-card .glow {
            position: absolute; right: -30px; top: -30px;
            width: 140px; height: 140px; border-radius: 50%;
            background: rgba(255,255,255,.18); filter: blur(10px);
        }
        .stat-card.blue   { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .stat-card.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .stat-card.purple { background: linear-gradient(135deg, #8b5cf6, #6366f1); }

        /* ---------- Glass panel / table card ---------- */
        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            backdrop-filter: blur(12px);
            box-shadow: 0 18px 40px rgba(0,0,0,.30);
        }
        .panel-head {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; flex-wrap: wrap;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }
        .panel-title { font-weight: 700; font-size: 1.1rem; margin: 0; display: flex; align-items: center; gap: .6rem; }
        .panel-title .dot {
            width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-2)); font-size: .9rem;
        }

        .search-box {
            display: flex; align-items: center; gap: .5rem;
            background: var(--surface-strong);
            border: 1px solid var(--border);
            border-radius: 10px; padding: .35rem .7rem; min-width: 220px;
        }
        .search-box i { color: var(--muted); }
        .search-box input {
            background: transparent; border: none; outline: none;
            color: var(--text); width: 100%; font-size: .9rem;
        }
        .search-box input::placeholder { color: var(--muted); }

        /* ---------- Table ---------- */
        .table { color: var(--text); margin: 0; }
        .table > :not(caption) > * > * { background: transparent; color: var(--text); }
        .table thead th {
            text-transform: uppercase; font-size: .72rem; letter-spacing: .6px;
            color: var(--muted); font-weight: 700; border: none;
            padding: 16px 24px; border-bottom: 1px solid var(--border);
        }
        .table tbody td { border-color: var(--border); padding: 16px 24px; vertical-align: middle; }
        .table tbody tr { transition: background .15s ease; }
        .table tbody tr:hover td { background: var(--surface-strong); }
        .row-index {
            width: 30px; height: 30px; border-radius: 8px; display: inline-grid; place-items: center;
            background: var(--surface-strong); border: 1px solid var(--border);
            font-size: .8rem; font-weight: 700; color: var(--muted);
        }
        .invoice-code {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            background: var(--surface-strong); border: 1px solid var(--border);
            padding: .25rem .55rem; border-radius: 8px; font-size: .82rem; color: #c7d2fe;
        }
        .produk-name { font-weight: 600; }

        .badge-status {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .35rem .7rem; border-radius: 999px;
            font-size: .75rem; font-weight: 700; border: 1px solid transparent;
        }
        .badge-status .pulse { width: 7px; height: 7px; border-radius: 50%; }
        .badge-proses {
            color: #bfdbfe; background: rgba(59, 130, 246, .15); border-color: rgba(59, 130, 246, .35);
        }
        .badge-proses .pulse { background: #60a5fa; box-shadow: 0 0 0 0 rgba(96,165,250,.7); animation: pulse 1.6s infinite; }
        .badge-pending {
            color: #fde68a; background: rgba(245, 158, 11, .15); border-color: rgba(245, 158, 11, .35);
        }
        .badge-pending .pulse { background: #fbbf24; }

        @keyframes pulse {
            0%   { box-shadow: 0 0 0 0 rgba(96,165,250,.6); }
            70%  { box-shadow: 0 0 0 7px rgba(96,165,250,0); }
            100% { box-shadow: 0 0 0 0 rgba(96,165,250,0); }
        }

        .date-cell { color: var(--muted); font-size: .88rem; white-space: nowrap; }

        .btn-proses {
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            color: #fff; border: none; border-radius: 10px;
            padding: .5rem 1rem; font-weight: 600; font-size: .85rem;
            display: inline-flex; align-items: center; gap: .4rem;
            transition: transform .15s ease, box-shadow .15s ease;
            box-shadow: 0 8px 20px rgba(99,102,241,.35);
        }
        .btn-proses:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 12px 26px rgba(99,102,241,.5); }
        .btn-proses i { transition: transform .15s ease; }
        .btn-proses:hover i { transform: translateX(3px); }

        /* Label untuk order Pending (tanpa tombol Proses) */
        .aksi-menunggu {
            display: inline-flex; align-items: center; gap: .35rem;
            color: var(--muted); font-size: .82rem; font-weight: 600;
            background: var(--surface-strong); border: 1px solid var(--border);
            padding: .45rem .8rem; border-radius: 10px;
        }

        /* ---------- Empty state ---------- */
        .empty-state { text-align: center; padding: 60px 20px; }
        .empty-state .empty-icon {
            width: 80px; height: 80px; border-radius: 20px; margin: 0 auto 18px;
            display: grid; place-items: center; font-size: 2rem; color: var(--muted);
            background: var(--surface-strong); border: 1px solid var(--border);
        }

        /* ---------- Alert ---------- */
        .alert-success {
            background: rgba(34, 197, 94, .12); border: 1px solid rgba(34, 197, 94, .35);
            color: #bbf7d0; border-radius: 12px;
        }
        .alert-success .btn-close { filter: invert(1) grayscale(1) brightness(1.6); }

        .no-result { display: none; text-align: center; color: var(--muted); padding: 40px; }
    </style>
</head>
<body>

<!-- ============ TOPBAR ============ -->
<nav class="topbar px-4 py-3">
    <div class="container d-flex align-items-center justify-content-between">
        <span class="brand">
            <span class="logo-badge"><i class="fas fa-gamepad"></i></span>
            <span><?= $web['web_title'] ?> <span class="text-secondary fw-normal">· Joki Panel</span></span>
        </span>
        <div class="d-flex align-items-center gap-3">
            <span class="user-chip">
                <span class="avatar"><i class="fas fa-user"></i></span>
                <?= $jokiUser ?>
            </span>
            <a href="<?= base_url('joki/logout') ?>" class="btn btn-logout btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-circle-check me-1"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Heading -->
    <div class="mb-4">
        <h1 class="page-title">Halo, <?= $jokiUser ?> 👋</h1>
        <p class="page-sub mb-0">Berikut ringkasan order yang perlu kamu proses hari ini.</p>
    </div>

    <!-- ============ STATS ============ -->
    <?php
        $countProses  = count(array_filter($orders, fn($o) => $o['status_pembelian'] == 'Proses'));
        $countPending = count(array_filter($orders, fn($o) => $o['status_pembelian'] == 'Pending'));
        $countTotal   = count($orders);
    ?>
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card blue">
                <span class="glow"></span>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Order Proses</div>
                        <div class="value"><?= $countProses ?></div>
                    </div>
                    <div class="icon-wrap"><i class="fas fa-spinner"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card orange">
                <span class="glow"></span>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Order Pending</div>
                        <div class="value"><?= $countPending ?></div>
                    </div>
                    <div class="icon-wrap"><i class="fas fa-clock"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card purple">
                <span class="glow"></span>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Total Order</div>
                        <div class="value"><?= $countTotal ?></div>
                    </div>
                    <div class="icon-wrap"><i class="fas fa-layer-group"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ TABLE ============ -->
    <div class="panel">
        <div class="panel-head">
            <h5 class="panel-title">
                <span class="dot"><i class="fas fa-list"></i></span>
                Daftar Order Masuk
            </h5>
            <?php if (!empty($orders)): ?>
            <div class="search-box">
                <i class="fas fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Cari invoice / produk...">
            </div>
            <?php endif; ?>
        </div>

        <?php if (empty($orders)): ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                <h6 class="fw-bold mb-1">Belum ada order masuk</h6>
                <p class="page-sub mb-0">Order baru akan muncul di sini secara otomatis.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="orderTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $i => $order): ?>
                        <tr>
                            <td><span class="row-index"><?= $i + 1 ?></span></td>
                            <td><span class="invoice-code"><?= $order['order_id'] ?></span></td>
                            <td class="produk-name"><?= $order['produk'] ?></td>
                            <td>
                                <?php if ($order['status_pembelian'] == 'Proses'): ?>
                                    <span class="badge-status badge-proses"><span class="pulse"></span>Proses</span>
                                <?php else: ?>
                                    <span class="badge-status badge-pending"><span class="pulse"></span>Pending</span>
                                <?php endif; ?>
                            </td>
                            <td class="date-cell"><i class="far fa-calendar me-1"></i><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td class="text-end">
                                <?php if ($order['status_pembelian'] == 'Pending'): ?>
                                    <span class="aksi-menunggu"><i class="fas fa-hourglass-half"></i>Menunggu</span>
                                <?php else: ?>
                                    <a href="<?= base_url('joki/detail/' . $order['order_id']) ?>" class="btn-proses">
                                        Proses <i class="fas fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="no-result" id="noResult">
                    <i class="fas fa-magnifying-glass-minus fa-lg mb-2 d-block"></i>
                    Tidak ada order yang cocok dengan pencarian.
                </div>
            </div>
        <?php endif; ?>
    </div>

    <p class="text-center page-sub mt-4 mb-0">
        &copy; <?= date('Y') ?> <?= $web['web_title'] ?> — Joki Panel
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Live filter tabel order (client-side, tidak mengubah data)
    const input = document.getElementById('searchInput');
    if (input) {
        const rows = Array.from(document.querySelectorAll('#orderTable tbody tr'));
        const noResult = document.getElementById('noResult');
        input.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visible = 0;
            rows.forEach(row => {
                const match = row.innerText.toLowerCase().includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            noResult.style.display = visible === 0 ? 'block' : 'none';
        });
    }
</script>
</body>
</html>
