<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - LP12 Configurator</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-dark: #006666;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 500px;
        }

        .login-left {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right {
            padding: 60px 40px;
        }

        .login-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-subtitle {
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--linn-teal);
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 128, 0.25);
        }

        .btn-login {
            background-color: var(--linn-teal);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: var(--linn-teal-dark);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
            
            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="row g-0 h-100">
            <div class="col-md-5">
                <div class="login-left">
                    <div class="login-logo">
                        <i class="fas fa-compact-disc me-3"></i>LINN
                    </div>
                    <h2 class="login-title">Admin Panel</h2>
                    <p class="login-subtitle">Manage your LP12 Configurator system with ease</p>
                    <div class="mt-4">
                        <i class="fas fa-cog fa-3x mb-3"></i>
                        <p>Complete control over levels, components, and compatibility settings</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="login-right">
                    <h3 class="text-center mb-4">Sign In</h3>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/login') ?>" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-login mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <small class="text-muted">
                            Default: admin / admin123
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
