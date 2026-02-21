<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LP12 Configurator - Build Your Own</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-light: #00a0a0;
            --linn-teal-dark: #006666;
            --linn-gray: #f8f9fa;
            --linn-text: #333333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: white;
            color: var(--linn-text);
            padding-bottom: 100px;
        }

        .linn-teal {
            color: var(--linn-teal);
        }

        .linn-teal-bg {
            background-color: var(--linn-teal);
        }

        .btn-linn {
            background-color: var(--linn-teal);
            color: white;
            border: none;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-linn:hover {
            background-color: var(--linn-teal-dark);
            color: white;
            transform: translateY(-2px);
        }

        .configurator-header {
            text-align: center;
            padding: 60px 0 40px;
        }

        .configurator-header h1 {
            font-weight: 300;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .configurator-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .main-image-container {
            background-color: var(--linn-gray);
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            color: #999;
            font-size: 1.2rem;
        }

        .build-section {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }

        .build-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            color: var(--linn-text);
        }

        .accordion-item {
            border: none;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 0;
        }

        .accordion-button {
            background-color: white;
            color: var(--linn-text);
            font-weight: 500;
            font-size: 1.1rem;
            padding: 20px 15px;
            border: none;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--linn-gray);
            color: var(--linn-teal);
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .step-number {
            display: inline-block;
            background-color: var(--linn-teal);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            font-size: 0.9rem;
            margin-right: 10px;
            font-weight: 500;
        }

        .component-option {
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .component-option:hover {
            border-color: var(--linn-teal);
            background-color: var(--linn-gray);
        }

        .component-option.selected,
        .component-option:has(.form-check-input:checked) {
            border-color: var(--linn-teal);
            background-color: rgba(0, 128, 128, 0.08);
            box-shadow: 0 0 0 1px var(--linn-teal);
        }

        .component-option .form-check {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 0;
            margin: 0;
        }

        .component-option .form-check-input[type="radio"] {
            display: none;
        }

        .component-option .form-check-label {
            cursor: pointer;
            width: 100%;
            position: relative;
            padding-left: 32px;
        }

        .component-option .form-check-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 3px;
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .component-option .form-check-label::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 8px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: var(--linn-teal);
            transform: scale(0);
            transition: all 0.2s ease;
        }

        .component-option .form-check-input:checked + .form-check-label::before {
            border-color: var(--linn-teal);
        }

        .component-option .form-check-input:checked + .form-check-label::after {
            transform: scale(1);
        }

        .component-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .component-description {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 5px;
        }

        .price-modifier {
            color: var(--linn-teal);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .price-modifier.negative {
            color: #dc3545;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 2px solid var(--linn-teal);
            padding: 20px 0;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .bottom-bar .current-level,
        .bottom-bar .component-count,
        .bottom-bar .total-price {
            transition: all 0.3s ease;
        }

        .bottom-bar .current-level:hover,
        .bottom-bar .component-count:hover {
            transform: translateY(-2px);
        }

        .bottom-bar .total-price:hover {
            transform: scale(1.05);
            color: var(--linn-teal-dark);
        }

        .total-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--linn-teal);
        }

        .level-badge {
            background-color: var(--linn-teal);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .configurator-header h1 {
                font-size: 2rem;
            }
            
            .main-image-container {
                height: 400px;
            }
            
            .build-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Nav -->
    <nav class="navbar navbar-expand-lg" style="background:white;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>" style="color:var(--linn-teal);"><i class="fas fa-compact-disc me-2"></i>LP12</a>
            <div class="d-flex align-items-center gap-2">
                <?php if(session()->get('customer_logged_in')): ?>
                    <a href="<?= base_url('account') ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-user me-1"></i><?= esc(session()->get('customer_name')) ?></a>
                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary btn-sm"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                    <a href="<?= base_url('register') ?>" class="btn btn-sm" style="background:var(--linn-teal);color:white;"><i class="fas fa-user-plus me-1"></i>Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="container">
        <div class="configurator-header">
            <h1 class="linn-teal">LP12 Configurator</h1>
            <p>Build your perfect turntable with our renowned precision engineering</p>
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
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Left Side - Image -->
            <div class="col-md-7 mb-4">
                <div class="main-image-container">
                    <img id="mainImage" data-src="images/products/lp12-main.svg" alt="LP12 Turntable" class="main-image">
                </div>
            </div>

            <!-- Right Side - Build Options -->
            <div class="col-md-5">
                <div class="build-section">
                    <h2 class="build-title">Build Your Own</h2>
                    
                    <!-- Accordion for Categories -->
                    <div class="accordion" id="buildAccordion">
                        <!-- Step 1: Choose Level -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingLevel">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLevel" aria-expanded="true">
                                    <span class="step-number">1</span>Choose Level
                                </button>
                            </h2>
                            <div id="collapseLevel" class="accordion-collapse collapse show" data-bs-parent="#buildAccordion">
                                <div class="accordion-body">
                                    <?php $isFirst = true; foreach($levels as $level): ?>
                                    <div class="component-option <?= $isFirst ? 'selected' : '' ?>" data-level-id="<?= $level['id'] ?>" data-base-price="<?= $level['base_price'] ?>">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="level" id="level_<?= $level['id'] ?>" value="<?= $level['id'] ?>" <?= $isFirst ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="level_<?= $level['id'] ?>">
                                                <div class="component-name"><?= $level['name'] ?></div>
                                                <div class="component-description">Starting from ฿<?= number_format($level['base_price'], 2) ?></div>
                                                <div class="price-modifier">฿<?= number_format($level['base_price'], 2) ?></div>
                                            </label>
                                        </div>
                                    </div>
                                    <?php $isFirst = false; endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Choose Plinth -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPlinth">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlinth" aria-expanded="false">
                                    <span class="step-number">2</span>Choose Plinth
                                </button>
                            </h2>
                            <div id="collapsePlinth" class="accordion-collapse collapse" data-bs-parent="#buildAccordion">
                                <div class="accordion-body">
                                    <?php if(isset($components_by_category[1])): ?>
                                        <?php foreach($components_by_category[1] as $component): ?>
                                        <div class="component-option" data-component-id="<?= $component['id'] ?>" data-category-id="<?= $component['category_id'] ?>" data-price-modifier="<?= $component['price_modifier'] ?>" data-image="<?= $component['image_path'] ?>">
                                            <div class="form-check">
                                                <input class="form-check-input component-radio" type="radio" name="plinth" id="plinth_<?= $component['id'] ?>" value="<?= $component['id'] ?>" data-category="plinth">
                                                <label class="form-check-label" for="plinth_<?= $component['id'] ?>">
                                                    <div class="component-name"><?= $component['name'] ?></div>
                                                    <div class="component-description"><?= $component['description'] ?></div>
                                                    <div class="price-modifier <?= $component['price_modifier'] > 0 ? '' : 'negative' ?>">
                                                        <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Choose Tonearm -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTonearm">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTonearm" aria-expanded="false">
                                    <span class="step-number">3</span>Choose Tonearm
                                </button>
                            </h2>
                            <div id="collapseTonearm" class="accordion-collapse collapse" data-bs-parent="#buildAccordion">
                                <div class="accordion-body">
                                    <?php if(isset($components_by_category[2])): ?>
                                        <?php foreach($components_by_category[2] as $component): ?>
                                        <div class="component-option" data-component-id="<?= $component['id'] ?>" data-category-id="<?= $component['category_id'] ?>" data-price-modifier="<?= $component['price_modifier'] ?>">
                                            <div class="form-check">
                                                <input class="form-check-input component-radio" type="radio" name="tonearm" id="tonearm_<?= $component['id'] ?>" value="<?= $component['id'] ?>" data-category="tonearm">
                                                <label class="form-check-label" for="tonearm_<?= $component['id'] ?>">
                                                    <div class="component-name"><?= $component['name'] ?></div>
                                                    <div class="component-description"><?= $component['description'] ?></div>
                                                    <div class="price-modifier <?= $component['price_modifier'] > 0 ? '' : 'negative' ?>">
                                                        <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Choose Cartridge -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCartridge">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCartridge" aria-expanded="false">
                                    <span class="step-number">4</span>Choose Cartridge
                                </button>
                            </h2>
                            <div id="collapseCartridge" class="accordion-collapse collapse" data-bs-parent="#buildAccordion">
                                <div class="accordion-body">
                                    <?php if(isset($components_by_category[3])): ?>
                                        <?php foreach($components_by_category[3] as $component): ?>
                                        <div class="component-option" data-component-id="<?= $component['id'] ?>" data-category-id="<?= $component['category_id'] ?>" data-price-modifier="<?= $component['price_modifier'] ?>">
                                            <div class="form-check">
                                                <input class="form-check-input component-radio" type="radio" name="cartridge" id="cartridge_<?= $component['id'] ?>" value="<?= $component['id'] ?>" data-category="cartridge">
                                                <label class="form-check-label" for="cartridge_<?= $component['id'] ?>">
                                                    <div class="component-name"><?= $component['name'] ?></div>
                                                    <div class="component-description"><?= $component['description'] ?></div>
                                                    <div class="price-modifier <?= $component['price_modifier'] > 0 ? '' : 'negative' ?>">
                                                        <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Choose Power Supply -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPower">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePower" aria-expanded="false">
                                    <span class="step-number">5</span>Choose Power Supply
                                </button>
                            </h2>
                            <div id="collapsePower" class="accordion-collapse collapse" data-bs-parent="#buildAccordion">
                                <div class="accordion-body">
                                    <?php if(isset($components_by_category[4])): ?>
                                        <?php foreach($components_by_category[4] as $component): ?>
                                        <div class="component-option" data-component-id="<?= $component['id'] ?>" data-category-id="<?= $component['category_id'] ?>" data-price-modifier="<?= $component['price_modifier'] ?>">
                                            <div class="form-check">
                                                <input class="form-check-input component-radio" type="radio" name="power_supply" id="power_<?= $component['id'] ?>" value="<?= $component['id'] ?>" data-category="power_supply">
                                                <label class="form-check-label" for="power_<?= $component['id'] ?>">
                                                    <div class="component-name"><?= $component['name'] ?></div>
                                                    <div class="component-description"><?= $component['description'] ?></div>
                                                    <div class="price-modifier <?= $component['price_modifier'] > 0 ? '' : 'negative' ?>">
                                                        <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Fixed Bar -->
    <div class="bottom-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="config-summary">
                        <span id="currentLevel">-</span>
                        <span class="level-badge" id="levelBadge">-</span>
                        <span class="ms-3" id="componentCount">0 components selected</span>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="total-price" id="totalPrice">-</div>
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-linn btn-lg" id="addToCart">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Build base URL from actual browser location (avoids PHP baseURL case mismatch)
        (function() {
            const parts = window.location.pathname.split('/');
            const confIdx = parts.indexOf('configurator');
            const base = confIdx > 0 ? parts.slice(0, confIdx).join('/') : '';
            window.siteBase = window.location.origin + base + '/';
        })();

        // Set main image src from data-src using real browser base URL
        window.addEventListener('DOMContentLoaded', function() {
            const mainImg = document.getElementById('mainImage');
            if (mainImg && mainImg.dataset.src) {
                mainImg.src = siteBase + 'img/' + mainImg.dataset.src.replace(/^images\//, '');
            }
        });

        // Data from PHP
        const levels = <?= json_encode($levels) ?>;
        const components = <?= json_encode($components) ?>;
        const compatibilities = <?= json_encode($compatibilities) ?>;
        
        // Thai Baht formatter
        const thaiBahtFormatter = new Intl.NumberFormat('th-TH', {
            style: 'currency',
            currency: 'THB',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        
        // State management - basePrice starts at 0, will be set from actual data
        let currentConfig = {
            level: null,
            basePrice: 0,
            components: {
                plinth: null,
                tonearm: null,
                cartridge: null,
                power_supply: null
            }
        };

        // Helper: find level by id (handles string/int mismatch from DB)
        function findLevel(id) {
            return levels.find(l => parseInt(l.id) === parseInt(id));
        }
        function findComponent(id) {
            return components.find(c => parseInt(c.id) === parseInt(id));
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Levels data:', levels);
            console.log('Components data:', components);

            // Set initial level from checked radio
            const initialLevelRadio = document.querySelector('input[name="level"]:checked');
            if (initialLevelRadio) {
                const levelId = parseInt(initialLevelRadio.value);
                const level = findLevel(levelId);
                if (level) {
                    currentConfig.level = levelId;
                    currentConfig.basePrice = parseFloat(level.base_price);
                    console.log('Init level:', level.name, 'Price:', currentConfig.basePrice);
                }
            } else if (levels.length > 0) {
                // Default to first level if none checked
                currentConfig.level = parseInt(levels[0].id);
                currentConfig.basePrice = parseFloat(levels[0].base_price);
                console.log('Default level:', levels[0].name, 'Price:', currentConfig.basePrice);
            }

            initializeEventListeners();
            updateConfig();
        });

        function initializeEventListeners() {
            // Level selection
            document.querySelectorAll('input[name="level"]').forEach(radio => {
                radio.addEventListener('change', handleLevelChange);
            });

            // Component selection
            document.querySelectorAll('.component-radio').forEach(radio => {
                radio.addEventListener('change', handleComponentChange);
            });

            // Component option clicks
            document.querySelectorAll('.component-option').forEach(option => {
                option.addEventListener('click', function(e) {
                    if (e.target.type !== 'radio') {
                        const radio = this.querySelector('input[type="radio"]');
                        if (radio) {
                            radio.checked = true;
                            radio.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });

            // Add to cart button
            document.getElementById('addToCart').addEventListener('click', handleAddToCart);
        }

        function handleLevelChange(e) {
            const levelId = parseInt(e.target.value);
            const level = findLevel(levelId);
            if (!level) return;
            
            currentConfig.level = levelId;
            currentConfig.basePrice = parseFloat(level.base_price);
            
            // Reset components when level changes
            Object.keys(currentConfig.components).forEach(k => currentConfig.components[k] = null);
            
            console.log('Level changed to:', level.name, 'Base Price:', currentConfig.basePrice);
            
            // Update compatibility
            updateComponentCompatibility(levelId);
            
            // Update UI
            updateConfig();
        }

        function handleComponentChange(e) {
            const category = e.target.dataset.category;
            const componentId = e.target.value ? parseInt(e.target.value) : null;
            
            console.log(`Component changed: ${category} = ${componentId}`);
            
            // Update component in config
            currentConfig.components[category] = componentId;
            
            console.log('Updated components config:', currentConfig.components);
            
            // Update image if plinth changed
            if (category === 'plinth' && componentId) {
                updateMainImage(componentId);
            }
            
            // Update UI
            updateComponentSelection(e.target);
            updateConfig();
        }

        function updateComponentCompatibility(levelId) {
            const compatibleComponents = compatibilities
                .filter(c => parseInt(c.level_id) === parseInt(levelId))
                .map(c => parseInt(c.component_id));

            console.log('Compatible components for level', levelId, ':', compatibleComponents);

            // Enable/disable component options based on compatibility
            document.querySelectorAll('.component-option[data-component-id]').forEach(option => {
                const componentId = parseInt(option.dataset.componentId) || 0;
                const isCompatible = compatibleComponents.includes(componentId);
                const radio = option.querySelector('input[type="radio"]');
                
                console.log(`Component ${componentId} compatible: ${isCompatible}`);
                
                if (isCompatible) {
                    option.style.opacity = '1';
                    radio.disabled = false;
                } else {
                    option.style.opacity = '0.5';
                    radio.disabled = true;
                    radio.checked = false;
                }
            });
        }

        function updateMainImage(componentId) {
            const component = findComponent(componentId);
            if (component && component.image_path) {
                const mainImage = document.getElementById('mainImage');
                mainImage.style.opacity = '0.7';
                mainImage.src = siteBase + 'img/' + component.image_path.replace(/^\/?images\//, '');
                setTimeout(() => { mainImage.style.opacity = '1'; }, 200);
            }
        }

        function updateComponentSelection(radio) {
            // Update visual selection
            document.querySelectorAll('.component-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            if (radio.checked) {
                radio.closest('.component-option').classList.add('selected');
            }
        }

        function updateConfig() {
            const level = findLevel(currentConfig.level);
            if (!level) return;

            const totalPrice = calculateTotalPrice();

            // Update level name and badge immediately (no delay)
            document.getElementById('currentLevel').textContent = level.name;
            document.getElementById('levelBadge').textContent = `Level ${currentConfig.level}`;

            // Count selected components
            const selectedCount = Object.values(currentConfig.components)
                .filter(c => c !== null).length;
            document.getElementById('componentCount').textContent =
                `${selectedCount} component${selectedCount !== 1 ? 's' : ''} selected`;

            // Update price immediately
            const priceElement = document.getElementById('totalPrice');
            if (priceElement) {
                priceElement.textContent = thaiBahtFormatter.format(totalPrice);
            }
        }

        function calculateTotalPrice() {
            let totalPrice = parseFloat(currentConfig.basePrice);
            
            console.log('Base Price:', currentConfig.basePrice);
            
            // Add component price modifiers
            Object.entries(currentConfig.components).forEach(([category, componentId]) => {
                if (componentId) {
                    const component = findComponent(componentId);
                    if (component) {
                        const modifier = parseFloat(component.price_modifier);
                        totalPrice += modifier;
                        console.log(`Added ${category}: ${component.name} - ฿${modifier}`);
                    }
                }
            });
            
            console.log('Final Total Price:', totalPrice);
            return totalPrice;
        }

        function handleAddToCart() {
            if (!currentConfig.level) {
                alert('Please select a level first.');
                return;
            }

            const formData = new FormData();
            formData.append('level', currentConfig.level);
            Object.entries(currentConfig.components).forEach(([category, componentId]) => {
                if (componentId) {
                    formData.append(`components[${category}]`, componentId);
                }
            });

            fetch(siteBase + 'cart/add', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Error: ' + (data.message || 'Failed to save configuration'));
                }
            })
            .catch(error => {
                console.error('Add to cart error:', error);
                alert('Failed to add to cart. Please try again.');
            });
        }
    </script>
</body>
</html>
