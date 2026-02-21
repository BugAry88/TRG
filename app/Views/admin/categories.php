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

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--linn-gray);
            border-bottom: 2px solid var(--linn-teal);
            font-weight: 600;
            color: var(--linn-text);
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background-color: #e0a800;
            color: #212529;
            text-decoration: none;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            color: white;
            text-decoration: none;
        }

        .btn-primary-custom {
            background-color: var(--linn-teal);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--linn-teal-dark);
            color: white;
            text-decoration: none;
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

        .badge-category {
            background-color: var(--linn-teal);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
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
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item">
                <i class="fas fa-layer-group me-3"></i>Levels
            </a>
            <a href="<?= base_url('admin/categories') ?>" class="sidebar-item active">
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
                    <h1 class="h3 mb-1">Manage Categories</h1>
                    <p class="text-muted mb-0">Configure component categories</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/create-category') ?>" class="btn-primary-custom me-2">
                        <i class="fas fa-plus me-2"></i>Add Category
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

        <!-- Categories Table -->
        <div class="data-table">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Display Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($categories && count($categories) > 0): ?>
                            <?php foreach($categories as $category): ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td>
                                    <strong><?= esc($category['name']) ?></strong>
                                </td>
                                <td>
                                    <span class="badge-category">Order <?= $category['display_order'] ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/edit-category/' . $category['id']) ?>" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/delete-category/' . $category['id']) ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">No categories found. <a href="<?= base_url('admin/create-category') ?>">Add your first category</a></p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
