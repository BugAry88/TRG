<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - LP12 Configurator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --linn-teal: #008080; --linn-teal-dark: #006666; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f5f5; color: #333; }
        .account-header {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white; padding: 40px 0 30px;
        }
        .account-header h1 { font-weight: 300; font-size: 2rem; }
        .card-custom { background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none; }
        .section-title { font-size: 1.1rem; font-weight: 600; color: var(--linn-teal); border-bottom: 2px solid var(--linn-teal); padding-bottom: 10px; margin-bottom: 20px; }
        .form-control, .form-select { border-radius: 8px; padding: 10px 14px; border: 1px solid #ddd; }
        .form-control:focus { border-color: var(--linn-teal); box-shadow: 0 0 0 0.2rem rgba(0,128,128,0.15); }
        .btn-teal { background-color: var(--linn-teal); color: white; border: none; border-radius: 8px; padding: 10px 25px; font-weight: 500; }
        .btn-teal:hover { background-color: var(--linn-teal-dark); color: white; }
        .btn-outline-teal { border: 1px solid var(--linn-teal); color: var(--linn-teal); border-radius: 8px; padding: 10px 25px; font-weight: 500; background: transparent; }
        .btn-outline-teal:hover { background-color: var(--linn-teal); color: white; }
        .nav-custom .nav-link { color: #555; font-weight: 500; border-radius: 8px; padding: 10px 20px; }
        .nav-custom .nav-link.active { background-color: var(--linn-teal); color: white; }
        .nav-custom .nav-link:hover:not(.active) { background-color: #f0f0f0; }
        .order-card { border: 1px solid #e9ecef; border-radius: 10px; padding: 20px; margin-bottom: 15px; transition: all 0.2s; }
        .order-card:hover { box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .badge-status { padding: 5px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-confirmed { background: #cce5ff; color: #004085; }
        .badge-processing { background: #d4edda; color: #155724; }
        .badge-shipped { background: #d1ecf1; color: #0c5460; }
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-cancelled { background: #f8d7da; color: #721c24; }
        .navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-custom .navbar-brand { color: var(--linn-teal); font-weight: 700; }
        .empty-state { text-align: center; padding: 60px 20px; color: #aaa; }
        .empty-state i { font-size: 3rem; margin-bottom: 15px; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><i class="fas fa-compact-disc me-2"></i>LP12</a>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= base_url('configurator') ?>" class="btn btn-outline-teal btn-sm"><i class="fas fa-cog me-1"></i>Configurator</a>
                <span class="text-muted"><i class="fas fa-user me-1"></i><?= esc($customer['name']) ?></span>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="account-header">
        <div class="container">
            <h1><i class="fas fa-user-circle me-2"></i>My Account</h1>
            <p class="mb-0 opacity-75">Manage your profile and view order history</p>
        </div>
    </div>

    <div class="container py-4">
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

        <!-- Tabs -->
        <ul class="nav nav-custom gap-2 mb-4" id="accountTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab">
                    <i class="fas fa-shopping-bag me-1"></i>My Orders
                    <?php if(!empty($orders)): ?>
                        <span class="badge bg-secondary ms-1"><?= count($orders) ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab">
                    <i class="fas fa-user-edit me-1"></i>Edit Profile
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Orders Tab -->
            <div class="tab-pane fade show active" id="orders" role="tabpanel">
                <?php if(!empty($orders)): ?>
                    <?php foreach($orders as $order): ?>
                    <div class="order-card">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div>
                                <h6 class="mb-1 fw-bold"><?= esc($order['order_number']) ?></h6>
                                <small class="text-muted"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></small>
                            </div>
                            <div class="text-end">
                                <span class="badge-status badge-<?= esc($order['status']) ?>"><?= ucfirst(esc($order['status'])) ?></span>
                                <div class="fw-bold mt-1" style="color: var(--linn-teal);">
                                    &#3647;<?= number_format($order['total_price'], 2) ?>
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">Level:</small>
                                <strong><?= esc($order['level_name']) ?></strong>
                            </div>
                            <div class="col-md-6">
                                <?php
                                    $comps = json_decode($order['components_json'] ?? '[]', true);
                                    $compNames = [];
                                    if (is_array($comps)) {
                                        foreach ($comps as $c) {
                                            $compNames[] = $c['name'] ?? $c['component_name'] ?? '';
                                        }
                                    }
                                ?>
                                <?php if(!empty($compNames)): ?>
                                    <small class="text-muted">Components:</small>
                                    <span class="small"><?= esc(implode(', ', array_filter($compNames))) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card-custom p-4">
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <h5>No Orders Yet</h5>
                            <p>You haven't placed any orders yet. Start building your dream turntable!</p>
                            <a href="<?= base_url('configurator') ?>" class="btn btn-teal"><i class="fas fa-cog me-2"></i>Go to Configurator</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Profile Tab -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <div class="card-custom p-4">
                    <h5 class="section-title"><i class="fas fa-user-edit me-2"></i>Edit Profile</h5>
                    <form action="<?= base_url('account/update') ?>" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-500">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= esc($customer['name']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-500">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= esc($customer['email']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-500">Phone Number</label>
                                <input type="tel" name="phone" id="phone" class="form-control" value="<?= esc($customer['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="new_password" class="form-label fw-500">New Password <small class="text-muted">(leave blank to keep current)</small></label>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter new password" minlength="6">
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label fw-500">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Your delivery address"><?= esc($customer['address'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-teal"><i class="fas fa-save me-2"></i>Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
