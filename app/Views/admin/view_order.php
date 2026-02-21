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
        .card-custom { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none; padding: 25px; margin-bottom: 20px; }
        .section-title { font-size: 1rem; font-weight: 600; color: var(--linn-teal); border-bottom: 2px solid var(--linn-teal); padding-bottom: 10px; margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 0.95rem; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #666; }
        .info-value { font-weight: 500; }
        .order-total { display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: 700; color: var(--linn-teal); padding-top: 15px; border-top: 2px solid var(--linn-teal); margin-top: 10px; }
        .status-badge { padding: 5px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #cce5ff; color: #004085; }
        .status-processing { background: #d4edda; color: #155724; }
        .status-shipped { background: #d1ecf1; color: #0c5460; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .btn-back { border: 2px solid var(--linn-teal); color: var(--linn-teal); background: transparent; padding: 8px 20px; border-radius: 8px; font-weight: 500; text-decoration: none; transition: all 0.3s; }
        .btn-back:hover { background-color: var(--linn-teal); color: white; }
        .btn-logout { background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .btn-logout:hover { background-color: #c82333; color: white; text-decoration: none; }
        .btn-update { background-color: var(--linn-teal); color: white; border: none; padding: 10px 24px; border-radius: 8px; font-weight: 500; transition: all 0.3s; }
        .btn-update:hover { background-color: var(--linn-teal-dark); color: white; }
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
                    <h1 class="h3 mb-1" style="color: var(--linn-teal)">
                        <i class="fas fa-receipt me-2"></i><?= esc($order['order_number']) ?>
                    </h1>
                    <p class="text-muted mb-0">Order details and management</p>
                </div>
                <a href="<?= base_url('admin/orders') ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Back to Orders
                </a>
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

        <div class="row g-4">
            <!-- Left: Customer + Order Info -->
            <div class="col-lg-7">
                <div class="card-custom">
                    <div class="section-title"><i class="fas fa-user me-2"></i>Customer Information</div>
                    <div class="info-row">
                        <span class="info-label">Name</span>
                        <span class="info-value"><?= esc($order['customer_name']) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= esc($order['customer_email']) ?></span>
                    </div>
                    <?php if($order['customer_phone']): ?>
                    <div class="info-row">
                        <span class="info-label">Phone</span>
                        <span class="info-value"><?= esc($order['customer_phone']) ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="info-row">
                        <span class="info-label">Delivery Address</span>
                        <span class="info-value"><?= nl2br(esc($order['customer_address'])) ?></span>
                    </div>
                    <?php if($order['notes']): ?>
                    <div class="info-row">
                        <span class="info-label">Notes</span>
                        <span class="info-value"><?= esc($order['notes']) ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="info-row">
                        <span class="info-label">Order Date</span>
                        <span class="info-value"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Current Status</span>
                        <span class="status-badge status-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="card-custom">
                    <div class="section-title"><i class="fas fa-edit me-2"></i>Update Order Status</div>
                    <form action="<?= base_url('admin/orders/' . $order['id'] . '/status') ?>" method="POST">
                        <div class="d-flex gap-3 align-items-end">
                            <div class="flex-grow-1">
                                <label class="form-label fw-500">New Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="confirmed" <?= $order['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                    <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing</option>
                                    <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                    <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-update">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-lg-5">
                <div class="card-custom">
                    <div class="section-title"><i class="fas fa-receipt me-2"></i>Order Summary</div>
                    <div class="info-row">
                        <span class="info-label">Base Level</span>
                        <span class="info-value"><?= esc($order['level_name']) ?> LP12</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Level Price</span>
                        <span class="info-value">฿<?= number_format($order['level_price'], 2) ?></span>
                    </div>

                    <?php foreach($components as $component): ?>
                    <div class="info-row">
                        <span class="info-label"><?= esc($component['name']) ?></span>
                        <span class="info-value">
                            <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                        </span>
                    </div>
                    <?php endforeach; ?>

                    <div class="order-total">
                        <span>Total</span>
                        <span>฿<?= number_format($order['total_price'], 2) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
