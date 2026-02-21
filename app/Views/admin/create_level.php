<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Level - LP12 Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-light: #00a0a0;
            --linn-teal-dark: #006666;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }

        .sidebar {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 20px;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-item {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background-color: rgba(255,255,255,0.1);
            border-left-color: white;
            text-decoration: none;
            color: white;
        }

        .sidebar-item.active {
            background-color: rgba(255,255,255,0.2);
            border-left-color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--linn-teal);
            box-shadow: 0 0 0 0.2rem rgba(0, 128, 128, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .btn-primary-custom {
            background-color: var(--linn-teal);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--linn-teal-dark);
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary-custom:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c82333;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-compact-disc me-2"></i>LP12 Admin
        </div>
        <div class="sidebar-menu">
            <a href="<?= base_url('admin') ?>" class="sidebar-item">
                <i class="fas fa-tachometer-alt me-3"></i>Dashboard
            </a>
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item active">
                <i class="fas fa-layer-group me-3"></i>Levels
            </a>
            <a href="<?= base_url('admin/categories') ?>" class="sidebar-item">
                <i class="fas fa-tags me-3"></i>Categories
            </a>
            <a href="<?= base_url('admin/components') ?>" class="sidebar-item">
                <i class="fas fa-cogs me-3"></i>Components
            </a>
            <a href="<?= base_url('admin/compatibility') ?>" class="sidebar-item">
                <i class="fas fa-link me-3"></i>Compatibility
            </a>
            <a href="<?= base_url() ?>" class="sidebar-item">
                <i class="fas fa-store me-3"></i>View Store
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Create New Level</h1>
                    <p class="text-muted mb-0">Add a new LP12 performance level</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/levels') ?>" class="btn-secondary-custom me-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Levels
                    </a>
                    <a href="<?= base_url('admin/logout') ?>" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
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

        <!-- Form -->
        <div class="form-container">
            <form action="<?= base_url('admin/create-level') ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="name" class="form-label">Level Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <small class="text-muted">e.g., Majik, Akurate, Klimax</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="base_price" class="form-label">Base Price (THB)</label>
                            <input type="number" class="form-control" id="base_price" name="base_price" 
                                   step="0.01" min="0" required>
                            <small class="text-muted">Base price for this level</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i>Create Level
                    </button>
                    <a href="<?= base_url('admin/levels') ?>" class="btn btn-secondary-custom">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
