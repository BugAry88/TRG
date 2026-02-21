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
        .upload-area {
            border: 2px dashed #ddd; border-radius: 10px;
            padding: 20px; text-align: center; cursor: pointer;
            transition: all 0.3s; background: #fafafa;
        }
        .upload-area:hover { border-color: var(--linn-teal); background: #f0fafa; }
        .upload-area.dragover { border-color: var(--linn-teal); background: #e8f5f5; }
        .img-preview {
            max-width: 120px; max-height: 120px; border-radius: 8px;
            border: 1px solid #e9ecef; object-fit: contain;
            background: #f8f9fa; padding: 4px;
        }
        .current-img-wrap { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand"><i class="fas fa-compact-disc me-2"></i>LP12 Admin</div>
        <div class="sidebar-menu">
            <a href="<?= base_url('admin') ?>" class="sidebar-item"><i class="fas fa-tachometer-alt me-3"></i>Dashboard</a>
            <a href="<?= base_url('admin/levels') ?>" class="sidebar-item"><i class="fas fa-layer-group me-3"></i>Levels</a>
            <a href="<?= base_url('admin/categories') ?>" class="sidebar-item"><i class="fas fa-tags me-3"></i>Categories</a>
            <a href="<?= base_url('admin/components') ?>" class="sidebar-item active"><i class="fas fa-cogs me-3"></i>Components</a>
            <a href="<?= base_url('admin/compatibility') ?>" class="sidebar-item"><i class="fas fa-link me-3"></i>Compatibility</a>
            <a href="<?= base_url() ?>" class="sidebar-item"><i class="fas fa-store me-3"></i>View Store</a>
        </div>
    </div>

    <div class="main-content">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Edit Component</h1>
                    <p class="text-muted mb-0">Modify component details</p>
                </div>
                <div>
                    <a href="<?= base_url('admin/components') ?>" class="btn-secondary-custom me-2"><i class="fas fa-arrow-left me-2"></i>Back to Components</a>
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
            <?php if(isset($component)): ?>
                <form action="<?= base_url('admin/edit-component/' . $component['id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <?php if(isset($categories)): ?>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $component['category_id'] ? 'selected' : '' ?>>
                                            <?= esc($category['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name" class="form-label">Component Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= esc($component['name']) ?>" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="price_modifier" class="form-label">Price Modifier (฿)</label>
                            <input type="number" name="price_modifier" id="price_modifier" class="form-control" step="0.01" min="0" value="<?= $component['price_modifier'] ?>" required>
                            <small class="text-muted">Additional cost for this component (0 for base component)</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Component Image</label>
                            <?php if(!empty($component['image_path'])): ?>
                            <div class="current-img-wrap" id="currentImgWrap">
                                <img id="imgPreview" src="" data-imgpath="<?= esc(preg_replace('#^/?images/#', '', $component['image_path'])) ?>" class="img-preview" alt="Current image">
                                <div>
                                    <small class="text-muted d-block">Current: <?= esc(basename($component['image_path'])) ?></small>
                                    <small class="text-muted">Upload new to replace</small>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="current-img-wrap" id="currentImgWrap" style="display:none!important">
                                <img id="imgPreview" class="img-preview" alt="Preview">
                            </div>
                            <?php endif; ?>
                            <div class="upload-area" id="uploadArea" onclick="document.getElementById('imageFile').click()">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color:var(--linn-teal)"></i>
                                <p class="mb-0 fw-500">Click to upload image</p>
                                <small class="text-muted">PNG, JPG, SVG, WEBP (max 2MB)</small>
                            </div>
                            <input type="file" name="image_file" id="imageFile" accept="image/*,.svg" style="display:none" onchange="previewImage(this)">
                            <input type="hidden" name="image_path" id="image_path" value="<?= esc($component['image_path'] ?? '') ?>">
                        </div>
                        
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required><?= esc($component['description']) ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-save me-2"></i>Update Component
                        </button>
                        <a href="<?= base_url('admin/components') ?>" class="btn-secondary-custom">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Component not found
                </div>
                <a href="<?= base_url('admin/components') ?>" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Back to Components
                </a>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current image src using window.location (avoids baseURL case issues)
        const pathParts = window.location.pathname.split('/');
        const adminIdx = pathParts.indexOf('admin');
        const baseParts = adminIdx > 0 ? pathParts.slice(0, adminIdx) : pathParts.slice(0, -2);
        const baseUrl = window.location.origin + baseParts.join('/') + '/';

        const existingImg = document.getElementById('imgPreview');
        if (existingImg && existingImg.dataset.imgpath) {
            existingImg.src = baseUrl + 'img/' + existingImg.dataset.imgpath;
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrap = document.getElementById('currentImgWrap');
                    const preview = document.getElementById('imgPreview');
                    preview.src = e.target.result;
                    wrap.style.display = 'flex';
                    wrap.style.removeProperty('display');
                    wrap.querySelector('small') && (wrap.querySelector('small').textContent = 'New: ' + file.name);
                    document.getElementById('uploadArea').innerHTML =
                        '<i class="fas fa-check-circle fa-2x mb-2" style="color:#28a745"></i>' +
                        '<p class="mb-0 fw-500 text-success">' + file.name + '</p>' +
                        '<small class="text-muted">Click to change</small>';
                };
                reader.readAsDataURL(file);
            }
        }

        // Drag and drop
        const uploadArea = document.getElementById('uploadArea');
        uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
        uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
        uploadArea.addEventListener('drop', e => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const dt = e.dataTransfer;
            if (dt.files.length) {
                document.getElementById('imageFile').files = dt.files;
                previewImage(document.getElementById('imageFile'));
            }
        });
    </script>
</body>
</html>
