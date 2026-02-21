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
        :root { --linn-teal: #008080; --linn-teal-dark: #006666; --linn-gray: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background-color: #f5f5f5; }
        .sidebar { background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%); min-height: 100vh; color: white; position: fixed; top: 0; left: 0; width: 250px; z-index: 1000; }
        .sidebar-brand { padding: 20px; font-size: 1.5rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { padding: 20px 0; }
        .sidebar-item { display: block; padding: 15px 20px; color: white; text-decoration: none; transition: all 0.3s ease; border-left: 3px solid transparent; }
        .sidebar-item:hover { background-color: rgba(255,255,255,0.1); border-left-color: white; color: white; }
        .sidebar-item.active { background-color: rgba(255,255,255,0.2); border-left-color: white; }
        .main-content { margin-left: 250px; padding: 20px; }
        .page-header { background: white; border-radius: 15px; padding: 30px; margin-bottom: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .form-container { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); }
        .form-label { font-weight: 500; margin-bottom: 8px; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; }
        .form-control:focus, .form-select:focus { border-color: var(--linn-teal); box-shadow: 0 0 0 0.2rem rgba(0,128,128,0.25); }
        .btn-primary-custom { background-color: var(--linn-teal); color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: var(--linn-teal-dark); color: white; }
        .btn-secondary-custom { background-color: #6c757d; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; }
        .btn-secondary-custom:hover { background-color: #5a6268; color: white; }
        .btn-logout { background-color: #dc3545; color: white; border: none; padding: 8px 20px; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; }
        .btn-logout:hover { background-color: #c82333; color: white; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand"><i class="fas fa-compact-disc me-2"></i>LP12 Admin</div>
        <div class="sidebar-menu">
            <a href="<?= base_url('admin') ?>" class="sidebar-item"><i class="fas fa-tachometer-alt me-3"></i>Dashboard</a>
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item"><i class="fas fa-layer-group me-3"></i>Levels</a>
            <a href="<?= base_url('admin/categories') ?>" class="sidebar-item active"><i class="fas fa-tags me-3"></i>Categories</a>
            <a href="<?= base_url('admin/components') ?>" class="sidebar-item"><i class="fas fa-cogs me-3"></i>Components</a>
            <a href="<?= base_url('admin/compatibility') ?>" class="sidebar-item"><i class="fas fa-link me-3"></i>Compatibility</a>
            <a href="<?= base_url() ?>" class="sidebar-item"><i class="fas fa-store me-3"></i>View Store</a>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Edit Category</h1>
                    <p class="text-muted mb-0">Modify category details</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/categories') ?>" class="btn-secondary-custom me-2"><i class="fas fa-arrow-left me-2"></i>Back to Categories</a>
                    <a href="<?= base_url('admin/logout') ?>" class="btn-logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                </div>
            </div>
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

        <div class="form-container">
            <?php if(isset($category)): ?>
                <form action="<?= base_url('admin/edit-category/' . $category['id']) ?>" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= esc($category['name']) ?>" required>
                            <small class="text-muted">e.g., Plinth, Tonearm, Cartridge, Power Supply</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="display_order" class="form-label">Display Order</label>
                            <input type="number" name="display_order" id="display_order" class="form-control" min="1" value="<?= $category['display_order'] ?>" required>
                            <small class="text-muted">Order in which this category appears (1 = first)</small>
                        </div>
                        
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Describe this component category..."><?= esc($category['description'] ?? '') ?></textarea>
                            <small class="text-muted">Optional description of what this category contains</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Update Category
                        </button>
                        <a href="<?= base_url('admin/categories') ?>" class="btn-secondary-custom">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Category not found
                </div>
                <a href="<?= base_url('admin/categories') ?>" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Back to Categories
                </a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
