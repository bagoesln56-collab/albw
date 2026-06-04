<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Joki - <?= $web['web_title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body { background: #f0f2f5; }
        .navbar-brand img { height: 35px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
        .badge-proses { background: #3b82f6; }
        .badge-pending { background: #f59e0b; }
        .table thead th { background: #1e293b; color: white; border: none; }
        .btn-proses { background: #3b82f6; color: white; border: none; border-radius: 8px; padding: 5px 16px; }
        .btn-proses:hover { background: #2563eb; color: white; }
        .stat-card { border-radius: 12px; padding: 20px; color: white; }
        .stat-card.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .stat-card.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4 py-3">
    <span class="navbar-brand fw-bold">
        <i class="fas fa-gamepad me-2"></i><?= $web['web_title'] ?> - Joki Panel
    </span>
    <div class="d-flex align-items-center gap-3">
        <span class="text-white"><i class="fas fa-user-circle me-1"></i><?= $jokiUser ?></span>
        <a href="<?= base_url('joki/logout') ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-sign-out-alt me-1"></i>Logout
        </a>
    </div>
</nav>

<div class="container py-4">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card blue">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">Order Proses</div>
                        <div class="fs-3 fw-bold">
                            <?= count(array_filter($orders, fn($o) => $o['status_pembelian'] == 'Proses')) ?>
                        </div>
                    </div>
                    <i class="fas fa-spinner fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card orange">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">Order Pending</div>
                        <div class="fs-3 fw-bold">
                            <?= count(array_filter($orders, fn($o) => $o['status_pembelian'] == 'Pending')) ?>
                        </div>
                    </div>
                    <i class="fas fa-clock fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4"><i class="fas fa-list me-2 text-primary"></i>Daftar Order Masuk</h5>

            <?php if (empty($orders)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada order masuk saat ini</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Produk</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $i => $order): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><code><?= $order['order_id'] ?></code></td>
                                <td><?= $order['produk'] ?></td>
                                <td>
                                    <?php if ($order['status_pembelian'] == 'Proses'): ?>
                                        <span class="badge badge-proses">Proses</span>
                                    <?php else: ?>
                                        <span class="badge badge-pending">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('joki/detail/' . $order['order_id']) ?>" class="btn-proses btn btn-sm">
                                        <i class="fas fa-arrow-right me-1"></i>Proses
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
