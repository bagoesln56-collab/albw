<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Joki - <?= $web['web_title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-1: #0b1020;
            --bg-2: #131a32;
            --surface: rgba(255, 255, 255, 0.05);
            --surface-strong: rgba(255, 255, 255, 0.08);
            --border: rgba(255, 255, 255, 0.10);
            --text: #e7ecf6;
            --muted: #94a3b8;
            --primary: #6366f1;
            --primary-2: #8b5cf6;
            --blue: #3b82f6;
        }

        * { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background:
                radial-gradient(1100px 600px at 85% -10%, rgba(139, 92, 246, 0.20), transparent 60%),
                radial-gradient(900px 500px at 0% 110%, rgba(59, 130, 246, 0.18), transparent 55%),
                linear-gradient(180deg, var(--bg-1), var(--bg-2));
            color: var(--text);
            padding: 20px;
        }

        /* dekorasi blob bercahaya */
        .glow-blob {
            position: fixed; border-radius: 50%; filter: blur(90px); opacity: .5; z-index: 0; pointer-events: none;
        }
        .glow-blob.one { width: 320px; height: 320px; background: #6366f1; top: -80px; right: -60px; }
        .glow-blob.two { width: 280px; height: 280px; background: #3b82f6; bottom: -80px; left: -60px; }

        .login-wrap { width: 100%; max-width: 420px; position: relative; z-index: 1; }

        .login-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            padding: 36px 32px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 30px 60px rgba(0,0,0,.45);
        }

        .login-logo {
            width: 64px; height: 64px; margin: 0 auto 16px;
            display: grid; place-items: center; border-radius: 18px; font-size: 1.7rem; color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            box-shadow: 0 12px 30px rgba(99,102,241,.5);
        }
        .login-title { text-align: center; font-weight: 800; font-size: 1.4rem; margin-bottom: 2px; }
        .login-sub { text-align: center; color: var(--muted); font-size: .9rem; margin-bottom: 26px; }

        .field-label { font-weight: 600; font-size: .85rem; color: var(--text); margin-bottom: .4rem; display: block; }

        .input-wrap { position: relative; margin-bottom: 18px; }
        .input-wrap .ico {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .95rem;
        }
        .input-wrap .form-control {
            background: var(--surface-strong); border: 1px solid var(--border); color: var(--text);
            border-radius: 12px; padding: .75rem 2.8rem; height: auto; font-size: .95rem;
        }
        .input-wrap .form-control::placeholder { color: var(--muted); }
        .input-wrap .form-control:focus {
            background: var(--surface-strong); color: var(--text);
            border-color: var(--primary); box-shadow: 0 0 0 .2rem rgba(99,102,241,.25);
        }
        .toggle-pass {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            background: transparent; border: none; color: var(--muted); cursor: pointer;
            padding: .4rem .6rem; border-radius: 8px; transition: color .15s ease;
        }
        .toggle-pass:hover { color: var(--text); }

        .btn-login {
            width: 100%; border: none; border-radius: 12px; padding: .8rem; font-weight: 700; color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-2));
            box-shadow: 0 12px 26px rgba(99,102,241,.45);
            transition: transform .15s ease, box-shadow .15s ease;
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 16px 34px rgba(99,102,241,.6); color: #fff; }
        .btn-login:active { transform: translateY(0); }

        .alert-danger {
            background: rgba(239,68,68,.12); border: 1px solid rgba(239,68,68,.4); color: #fecaca;
            border-radius: 12px; font-size: .9rem; display: flex; align-items: center; gap: .5rem;
        }

        .login-foot { text-align: center; color: var(--muted); font-size: .82rem; margin-top: 22px; }
    </style>
</head>
<body>

<span class="glow-blob one"></span>
<span class="glow-blob two"></span>

<div class="login-wrap">
    <div class="login-card">
        <div class="login-logo"><i class="fas fa-gamepad"></i></div>
        <h1 class="login-title">Login Joki Panel</h1>
        <p class="login-sub"><?= $web['web_title'] ?></p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-circle-exclamation"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('joki/login') ?>" method="POST">
            <?= csrf_field() ?>

            <label class="field-label">Username</label>
            <div class="input-wrap">
                <i class="fas fa-user ico"></i>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>

            <label class="field-label">Password</label>
            <div class="input-wrap">
                <i class="fas fa-lock ico"></i>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan password">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-right-to-bracket"></i> Login
            </button>
        </form>
    </div>

    <p class="login-foot">&copy; <?= date('Y') ?> <?= $web['web_title'] ?></p>
</div>

<script>
    const toggle = document.getElementById('togglePass');
    const pass = document.getElementById('password');
    if (toggle && pass) {
        toggle.addEventListener('click', function () {
            const isHidden = pass.type === 'password';
            pass.type = isHidden ? 'text' : 'password';
            this.querySelector('i').className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    }
</script>

</body>
</html>
