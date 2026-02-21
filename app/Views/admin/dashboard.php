<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - LP12 Admin</title>
    
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
            --linn-gray: #f8f9fa;
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

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background-color: var(--linn-teal);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--linn-teal);
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-weight: 500;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
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

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
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
            <a href="<?= base_url('admin') ?>" class="sidebar-item active">
                <i class="fas fa-tachometer-alt me-3"></i>Dashboard
            </a>
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item">
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
            <a href="<?= base_url('admin/orders') ?>" class="sidebar-item">
                <i class="fas fa-shopping-bag me-3"></i>Orders
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
                    <h1 class="h3 mb-1">Dashboard</h1>
                    <p class="text-muted mb-0">Welcome to LP12 Configurator Admin Panel</p>
                </div>
                <a href="<?= base_url('admin/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
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

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-number"><?= $total_levels ?></div>
                    <div class="stat-label">Total Levels</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-number"><?= $total_categories ?></div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="stat-number"><?= $total_components ?></div>
                    <div class="stat-label">Components</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <div class="stat-number"><?= $total_compatibilities ?></div>
                    <div class="stat-label">Compatibilities</div>
                </div>
            </div>
        </div>

        <!-- Orders Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card" style="border-left: 4px solid #ffc107;">
                    <div class="stat-icon" style="background: #ffc107;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number"><?= $orders_pending ?></div>
                    <div class="stat-label">Pending Orders</div>
                    <a href="<?= base_url('admin/orders') ?>" class="stretched-link"></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left: 4px solid #17a2b8;">
                    <div class="stat-icon" style="background: #17a2b8;">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="stat-number"><?= $orders_processing ?></div>
                    <div class="stat-label">Processing</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left: 4px solid #28a745;">
                    <div class="stat-icon" style="background: #28a745;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number"><?= $orders_completed ?></div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-number"><?= $orders_total ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-rocket me-2 text-primary"></i>Quick Actions
                        </h5>
                        <div class="d-grid gap-2">
                            <a href="<?= base_url('admin/create-level') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Add New Level
                            </a>
                            <a href="<?= base_url('admin/create-component') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Add New Component
                            </a>
                            <a href="<?= base_url('admin/compatibility') ?>" class="btn btn-outline-primary">
                                <i class="fas fa-link me-2"></i>Manage Compatibility
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="fas fa-info-circle me-2 text-info"></i>System Info
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Database Connected
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Models Loaded
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Routes Configured
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-warning me-2"></i>
                                Last Update: <?= date('Y-m-d H:i:s') ?>
                            </li>
                        </ul>
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
