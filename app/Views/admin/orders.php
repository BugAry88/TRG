<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - LP12 Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --linn-teal: #008080; --linn-teal-dark: #006666; --linn-gray: #f8f9fa; --linn-text: #333; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f5f5; }
        .sidebar { background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%); min-height: 100vh; color: white; position: fixed; top: 0; left: 0; width: 250px; z-index: 1000; }
        .sidebar-brand { padding: 20px; font-size: 1.5rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { padding: 20px 0; }
        .sidebar-item { display: block; padding: 15px 20px; color: white; text-decoration: none; transition: all 0.3s; border-left: 3px solid transparent; }
        .sidebar-item:hover, .sidebar-item.active { background-color: rgba(255,255,255,0.15); border-left-color: white; color: white; text-decoration: none; }
        .main-content { margin-left: 250px; padding: 20px; }
        .page-header { background: white; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .data-table { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .table th { background-color: var(--linn-gray); border-bottom: 2px solid var(--linn-teal); font-weight: 600; }
        .btn-action { padding: 6px 12px; border-radius: 6px; text-decoration: none; margin: 0 2px; transition: all 0.3s; }
        .btn-view { background-color: var(--linn-teal); color: white; }
        .btn-view:hover { background-color: var(--linn-teal-dark); color: white; text-decoration: none; }
        .btn-logout { background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .btn-logout:hover { background-color: #c82333; color: white; text-decoration: none; }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #cce5ff; color: #004085; }
        .status-processing { background: #d4edda; color: #155724; }
        .status-shipped { background: #d1ecf1; color: #0c5460; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand"><i class="fas fa-record-vinyl me-2"></i>LP12 Admin</div>
        <nav class="sidebar-menu">
            <a href="<?= base_url('admin') ?>" class="sidebar-item"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item"><i class="fas fa-layer-group me-2"></i>Levels</a>
            <a href="<?= base_url('admin/categories') ?>" class="sidebar-item"><i class="fas fa-tags me-2"></i>Categories</a>
            <a href="<?= base_url('admin/components') ?>" class="sidebar-item"><i class="fas fa-cogs me-2"></i>Components</a>
            <a href="<?= base_url('admin/compatibility') ?>" class="sidebar-item"><i class="fas fa-link me-2"></i>Compatibility</a>
            <a href="<?= base_url('admin/orders') ?>" class="sidebar-item active"><i class="fas fa-shopping-bag me-2"></i>Orders</a>
            <a href="<?= base_url('admin/logout') ?>" class="sidebar-item btn-logout mt-3"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1" style="color: var(--linn-teal)"><i class="fas fa-shopping-bag me-2"></i>Orders</h1>
                    <p class="text-muted mb-0">Manage customer orders</p>
                </div>
                <span class="badge bg-secondary fs-6"><?= count($orders) ?> orders</span>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="data-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Level</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($orders)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-2x mb-3 d-block"></i>No orders yet
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td><strong style="color: var(--linn-teal)"><?= esc($order['order_number']) ?></strong></td>
                        <td>
                            <div><?= esc($order['customer_name']) ?></div>
                            <small class="text-muted"><?= esc($order['customer_email']) ?></small>
                        </td>
                        <td><?= esc($order['level_name']) ?></td>
                        <td><strong>฿<?= number_format($order['total_price'], 2) ?></strong></td>
                        <td>
                            <span class="status-badge status-<?= $order['status'] ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td><small><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></small></td>
                        <td>
                            <a href="<?= base_url('admin/orders/' . $order['id']) ?>" class="btn-action btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
