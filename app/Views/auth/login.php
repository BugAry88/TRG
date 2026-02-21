<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LP12 Configurator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --linn-teal: #008080; --linn-teal-dark: #006666; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f0 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .auth-card {
            background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            max-width: 440px; width: 100%; padding: 40px; margin: 20px;
        }
        .auth-logo { text-align: center; margin-bottom: 30px; }
        .auth-logo i { font-size: 2.5rem; color: var(--linn-teal); }
        .auth-logo h2 { font-weight: 700; color: #333; margin-top: 10px; }
        .auth-logo p { color: #888; font-size: 0.9rem; }
        .form-label { font-weight: 500; color: #555; }
        .form-control { border-radius: 10px; padding: 12px 15px; border: 1px solid #ddd; }
        .form-control:focus { border-color: var(--linn-teal); box-shadow: 0 0 0 0.2rem rgba(0,128,128,0.15); }
        .btn-login {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white; border: none; border-radius: 10px; padding: 12px; font-weight: 600;
            width: 100%; font-size: 1rem; transition: all 0.3s;
        }
        .btn-login:hover { opacity: 0.9; color: white; transform: translateY(-1px); box-shadow: 0 4px 15px rgba(0,128,128,0.3); }
        .divider { text-align: center; margin: 20px 0; color: #aaa; position: relative; }
        .divider::before, .divider::after { content: ''; position: absolute; top: 50%; width: 40%; height: 1px; background: #ddd; }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
        .auth-footer { text-align: center; margin-top: 20px; }
        .auth-footer a { color: var(--linn-teal); text-decoration: none; font-weight: 500; }
        .auth-footer a:hover { text-decoration: underline; }
        .back-link { text-align: center; margin-top: 15px; }
        .back-link a { color: #888; text-decoration: none; font-size: 0.9rem; }
        .back-link a:hover { color: var(--linn-teal); }
        .input-group-text { background: #f8f9fa; border-radius: 10px 0 0 10px; border: 1px solid #ddd; border-right: none; color: #888; }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-logo">
            <i class="fas fa-compact-disc"></i>
            <h2>Welcome Back</h2>
            <p>Sign in to your LP12 account</p>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="your@email.com" value="<?= old('email') ?>" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Sign In
            </button>
        </form>

        <div class="divider">or</div>

        <div class="auth-footer">
            Don't have an account? <a href="<?= base_url('register') ?>">Create Account</a>
        </div>

        <div class="back-link">
            <a href="<?= base_url() ?>"><i class="fas fa-arrow-left me-1"></i>Back to Store</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
