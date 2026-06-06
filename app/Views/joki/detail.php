<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Order - <?= $web['web_title'] ?></title>
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

        /* ---------- Topbar ---------- */
        .topbar {
            background: rgba(10, 14, 28, 0.7);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            position: sticky; top: 0; z-index: 50;
        }
        .brand { font-weight: 800; display: flex; align-items: center; gap: .65rem; color: #fff; }
        .brand .logo-badge {
            width: 40px; height: 40px; display: grid; place-items: center; border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            box-shadow: 0 8px 22px rgba(99, 102, 241, .45); font-size: 1.05rem;
        }
        .user-chip {
            display: inline-flex; align-items: center; gap: .55rem;
            background: var(--surface); border: 1px solid var(--border);
            padding: .4rem .8rem; border-radius: 999px; color: var(--text); font-weight: 600; font-size: .9rem;
        }
        .user-chip .avatar {
            width: 26px; height: 26px; border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--primary-2));
            display: grid; place-items: center; font-size: .8rem; color: #fff;
        }
        .btn-soft {
            background: var(--surface-strong); border: 1px solid var(--border); color: var(--text);
            font-weight: 600; border-radius: 10px; padding: .45rem .9rem;
            transition: transform .15s ease, background .15s ease;
        }
        .btn-soft:hover { color: #fff; background: rgba(255,255,255,.12); transform: translateY(-1px); }
        .btn-logout {
            background: linear-gradient(135deg, #ef4444, #dc2626); border: none; color: #fff; font-weight: 600;
            border-radius: 10px; padding: .45rem .9rem; transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn-logout:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(239, 68, 68, .4); }

        /* ---------- Panel ---------- */
        .panel {
            background: var(--surface); border: 1px solid var(--border); border-radius: 18px;
            backdrop-filter: blur(12px); box-shadow: 0 18px 40px rgba(0,0,0,.30); overflow: hidden;
        }
        .panel-head {
            display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;
            padding: 20px 24px; border-bottom: 1px solid var(--border);
        }
        .panel-title { font-weight: 700; font-size: 1.15rem; margin: 0; display: flex; align-items: center; gap: .6rem; }
        .panel-title .dot {
            width: 34px; height: 34px; border-radius: 10px; display: grid; place-items: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-2)); font-size: .9rem;
        }
        .panel-body { padding: 8px 24px 24px; }

        .section-title {
            font-weight: 700; font-size: .95rem; color: var(--muted); text-transform: uppercase; letter-spacing: .6px;
            margin: 26px 0 8px; display: flex; align-items: center; gap: .5rem;
        }

        /* ---------- Info rows ---------- */
        .info-row {
            display: flex; justify-content: space-between; align-items: center; gap: 1rem;
            padding: 14px 4px; border-bottom: 1px solid var(--border);
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            color: var(--muted); font-weight: 600; font-size: .9rem;
            display: flex; align-items: center; gap: .55rem; min-width: 120px;
        }
        .info-value { font-weight: 600; text-align: right; word-break: break-all; }
        .info-value.mono { font-family: ui-monospace, SFMono-Regular, Menlo, monospace; }

        /* ---------- Badge ---------- */
        .badge-status {
            display: inline-flex; align-items: center; gap: .4rem; padding: .35rem .75rem; border-radius: 999px;
            font-size: .78rem; font-weight: 700; border: 1px solid transparent;
        }
        .badge-status .pulse { width: 7px; height: 7px; border-radius: 50%; }
        .badge-proses { color: #bfdbfe; background: rgba(59,130,246,.15); border-color: rgba(59,130,246,.35); }
        .badge-proses .pulse { background: #60a5fa; box-shadow: 0 0 0 0 rgba(96,165,250,.7); animation: pulse 1.6s infinite; }
        .badge-sukses { color: #bbf7d0; background: rgba(34,197,94,.15); border-color: rgba(34,197,94,.35); }
        .badge-sukses .pulse { background: #4ade80; }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(96,165,250,.6); }
            70% { box-shadow: 0 0 0 7px rgba(96,165,250,0); }
            100% { box-shadow: 0 0 0 0 rgba(96,165,250,0); }
        }

        /* ---------- Data Akun (with copy) ---------- */
        .akun-value-wrap { display: flex; align-items: center; gap: .6rem; justify-content: flex-end; flex-wrap: wrap; }
        .akun-value {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-weight: 600;
            background: var(--surface-strong); border: 1px solid var(--border);
            padding: .4rem .7rem; border-radius: 10px; word-break: break-all; color: #e7ecf6;
        }
        .akun-value.empty { color: var(--muted); font-family: inherit; }
        .copy-btn {
            display: inline-flex; align-items: center; gap: .35rem; white-space: nowrap;
            background: linear-gradient(135deg, var(--primary), var(--primary-2)); color: #fff;
            border: none; border-radius: 9px; padding: .4rem .7rem; font-size: .78rem; font-weight: 600;
            cursor: pointer; transition: transform .12s ease, box-shadow .12s ease, background .2s ease;
            box-shadow: 0 6px 16px rgba(99,102,241,.3);
        }
        .copy-btn:hover { transform: translateY(-1px); box-shadow: 0 10px 22px rgba(99,102,241,.45); }
        .copy-btn:active { transform: translateY(0); }
        .copy-btn.copied { background: linear-gradient(135deg, #22c55e, #16a34a); box-shadow: 0 6px 16px rgba(34,197,94,.4); }

        /* ---------- Upload / paste ---------- */
        .paste-area {
            border: 2px dashed var(--border); border-radius: 14px; padding: 34px; text-align: center;
            cursor: pointer; min-height: 160px; outline: none; background: var(--surface-strong);
            transition: border-color .2s ease, background .2s ease;
        }
        .paste-area:hover, .paste-area:focus { border-color: var(--primary); background: rgba(99,102,241,.08); }
        .paste-area .paste-icon { font-size: 1.8rem; color: var(--primary-2); margin-bottom: .5rem; }
        .paste-area p { color: var(--muted); margin: 0; }

        .form-control {
            background: var(--surface-strong); border: 1px solid var(--border); color: var(--text); border-radius: 10px;
        }
        .form-control:focus {
            background: var(--surface-strong); color: var(--text);
            border-color: var(--primary); box-shadow: 0 0 0 .2rem rgba(99,102,241,.25);
        }
        .form-control::file-selector-button {
            background: var(--surface); color: var(--text); border: 0; border-right: 1px solid var(--border);
            border-radius: 8px 0 0 8px; margin-right: 12px; padding: .5rem .9rem;
        }
        .btn-upload {
            background: linear-gradient(135deg, #22c55e, #16a34a); border: none; color: #fff; font-weight: 700;
            border-radius: 10px; padding: .7rem; transition: transform .15s ease, box-shadow .15s ease;
        }
        .btn-upload:hover { color: #fff; transform: translateY(-1px); box-shadow: 0 10px 24px rgba(34,197,94,.4); }

        .alert-success {
            background: rgba(34,197,94,.12); border: 1px solid rgba(34,197,94,.35); color: #bbf7d0; border-radius: 12px;
        }
        .hasil-img { max-height: 400px; cursor: pointer; border: 1px solid var(--border); }

        /* ---------- Toast ---------- */
        .copy-toast {
            position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(20px);
            background: rgba(16, 22, 40, .95); border: 1px solid rgba(34,197,94,.4); color: #bbf7d0;
            padding: .7rem 1.2rem; border-radius: 12px; font-weight: 600; font-size: .9rem;
            display: flex; align-items: center; gap: .5rem; opacity: 0; pointer-events: none;
            transition: opacity .25s ease, transform .25s ease; z-index: 100; box-shadow: 0 12px 30px rgba(0,0,0,.4);
        }
        .copy-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
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
        <div class="d-flex align-items-center gap-2 gap-md-3">
            <span class="user-chip">
                <span class="avatar"><i class="fas fa-user"></i></span>
                <?= $jokiUser ?>
            </span>
            <a href="<?= base_url('joki/dashboard') ?>" class="btn btn-soft btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
            <a href="<?= base_url('joki/logout') ?>" class="btn btn-logout btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="panel mb-4">
                <div class="panel-head">
                    <h5 class="panel-title">
                        <span class="dot"><i class="fas fa-receipt"></i></span>
                        Detail Order
                    </h5>
                    <?php if ($order['status_pembelian'] == 'Proses'): ?>
                        <span class="badge-status badge-proses"><span class="pulse"></span>Proses</span>
                    <?php elseif ($order['status_pembelian'] == 'Sukses'): ?>
                        <span class="badge-status badge-sukses"><span class="pulse"></span>Sukses</span>
                    <?php endif; ?>
                </div>

                <div class="panel-body">

                    <!-- ===== Info Order ===== -->
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-hashtag"></i>Invoice</span>
                        <span class="info-value mono"><?= $order['order_id'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-box"></i>Produk</span>
                        <span class="info-value"><?= $order['produk'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-circle-info"></i>Status</span>
                        <span class="info-value">
                            <?php if ($order['status_pembelian'] == 'Proses'): ?>
                                <span class="badge-status badge-proses"><span class="pulse"></span>Proses</span>
                            <?php elseif ($order['status_pembelian'] == 'Sukses'): ?>
                                <span class="badge-status badge-sukses"><span class="pulse"></span>Sukses</span>
                            <?php else: ?>
                                <?= $order['status_pembelian'] ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label"><i class="far fa-calendar"></i>Tanggal</span>
                        <span class="info-value"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                    </div>

                    <!-- ===== Data Akun (dengan tombol copy) ===== -->
                    <?php if (!empty($jokiData)): ?>
                    <div class="section-title"><i class="fas fa-user-shield"></i>Data Akun</div>
                    <?php
                        $akunFields = [
                            ['label' => 'Email',     'icon' => 'fa-envelope',         'value' => $jokiData['email']],
                            ['label' => 'Password',  'icon' => 'fa-key',              'value' => $jokiData['password']],
                            ['label' => 'Login Via', 'icon' => 'fa-right-to-bracket', 'value' => $jokiData['login']],
                            ['label' => 'Request',   'icon' => 'fa-comment-dots',     'value' => $jokiData['request']],
                        ];
                    ?>
                    <?php foreach ($akunFields as $idx => $f): ?>
                        <?php $val = trim((string) $f['value']); $hasValue = ($val !== '' && $val !== '-'); ?>
                        <div class="info-row">
                            <span class="info-label"><i class="fas <?= $f['icon'] ?>"></i><?= $f['label'] ?></span>
                            <span class="akun-value-wrap">
                                <span class="akun-value <?= $hasValue ? '' : 'empty' ?>" id="akun-<?= $idx ?>"><?= $hasValue ? $f['value'] : '-' ?></span>
                                <?php if ($hasValue): ?>
                                <button type="button" class="copy-btn" data-target="akun-<?= $idx ?>" data-label="<?= $f['label'] ?>">
                                    <i class="far fa-copy"></i> Copy
                                </button>
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- ===== Hasil Pengisian (jika ada) ===== -->
                    <?php if (!empty($order['hasil_joki'])): ?>
                    <div class="section-title"><i class="fas fa-image"></i>Hasil Pengisian</div>
                    <img src="<?= base_url('img/hasil_joki/' . $order['hasil_joki']) ?>"
                         class="img-fluid rounded hasil-img"
                         onclick="window.open(this.src, '_blank')">
                    <?php endif; ?>

                    <!-- ===== Upload (jika belum diupload) ===== -->
                    <?php if (empty($order['upload_at'])): ?>
                    <div class="section-title"><i class="fas fa-cloud-arrow-up"></i>Upload Hasil Pengisian</div>
                    <div id="paste-area" class="paste-area" tabindex="0">
                        <p id="paste-text">
                            <span class="paste-icon d-block"><i class="fas fa-paste"></i></span>
                            Klik area ini lalu tekan <strong class="text-light">Ctrl + V</strong> untuk paste gambar<br>
                            <small>atau pilih file di bawah</small>
                        </p>
                        <img id="preview" src="" style="max-height:300px; display:none;" class="img-fluid rounded mt-2">
                    </div>

                    <form action="<?= base_url('id/upload-hasil/' . $order['order_id']) ?>" method="POST" enctype="multipart/form-data" class="mt-3">
                        <?= csrf_field() ?>
                        <input type="file" name="hasil_joki" id="file-input" class="form-control mb-3" accept="image/*">
                        <button type="submit" class="btn btn-upload w-100">
                            <i class="fas fa-circle-check me-1"></i>Upload &amp; Selesaikan
                        </button>
                    </form>
                    <?php else: ?>
                        <div class="alert alert-success mt-4 mb-0">
                            <i class="fas fa-circle-check me-1"></i>Hasil pengisian sudah diupload!
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast feedback copy -->
<div class="copy-toast" id="copyToast"><i class="fas fa-circle-check"></i><span id="copyToastText">Tersalin!</span></div>

<script>
    /* ============ TOMBOL COPY ============ */
    (function () {
        const toast = document.getElementById('copyToast');
        const toastText = document.getElementById('copyToastText');
        let toastTimer = null;

        function showToast(msg) {
            if (!toast) return;
            toastText.textContent = msg;
            toast.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('show'), 1800);
        }

        function fallbackCopy(text, cb) {
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.focus(); ta.select();
            try { document.execCommand('copy'); } catch (e) {}
            document.body.removeChild(ta);
            if (cb) cb();
        }

        document.querySelectorAll('.copy-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const target = document.getElementById(btn.getAttribute('data-target'));
                const label = btn.getAttribute('data-label') || 'Teks';
                const text = target ? target.textContent.trim() : '';
                if (!text) return;

                const onDone = function () {
                    const original = btn.innerHTML;
                    btn.classList.add('copied');
                    btn.innerHTML = '<i class="fas fa-check"></i> Tersalin';
                    showToast(label + ' tersalin!');
                    setTimeout(function () {
                        btn.innerHTML = original;
                        btn.classList.remove('copied');
                    }, 1500);
                };

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(onDone).catch(function () { fallbackCopy(text, onDone); });
                } else {
                    fallbackCopy(text, onDone);
                }
            });
        });
    })();

    /* ============ PASTE / UPLOAD GAMBAR ============ */
    const pasteArea = document.getElementById('paste-area');
    const fileInput = document.getElementById('file-input');
    const preview   = document.getElementById('preview');
    const pasteText = document.getElementById('paste-text');

    if (pasteArea) {
        window.addEventListener('load', function () { pasteArea.focus(); });
        pasteArea.addEventListener('click', function () { this.focus(); });

        window.addEventListener('paste', function (e) {
            const items = e.clipboardData.items;
            for (let i = 0; i < items.length; i++) {
                if (items[i].type.indexOf('image') !== -1) {
                    const file = items[i].getAsFile();
                    tampilkanPreview(file);
                    masukkanKeInput(file);
                }
            }
        });

        fileInput && fileInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                tampilkanPreview(this.files[0]);
            }
        });
    }

    function tampilkanPreview(file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            pasteText.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    function masukkanKeInput(file) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
    }
</script>

</body>
</html>
