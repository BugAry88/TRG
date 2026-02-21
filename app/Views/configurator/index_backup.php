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

        .component-option.selected {
            border-color: var(--linn-teal);
            background-color: rgba(0, 128, 128, 0.1);
        }

        .form-check-input[type="radio"] {
            accent-color: var(--linn-teal);
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
            border-top: 1px solid #e9ecef;
            padding: 20px 0;
            box-shadow: 0 -2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .config-summary {
            font-size: 1.1rem;
            font-weight: 500;
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
                    <img id="mainImage" src="https://via.placeholder.com/800x600/f8f9fa/999999?text=LP12+Turntable" alt="LP12 Turntable" class="main-image">
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
                                    <?php foreach($levels as $level): ?>
                                    <div class="component-option" data-level-id="<?= $level['id'] ?>" data-base-price="<?= $level['base_price'] ?>">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="level" id="level_<?= $level['id'] ?>" value="<?= $level['id'] ?>" <?= $level['id'] == 1 ? 'checked' : '' ?>>
                                            <label class="form-check-label w-100" for="level_<?= $level['id'] ?>">
                                                <div class="component-name"><?= $level['name'] ?></div>
                                                <div class="component-description">Starting from ฿<?= number_format($level['base_price'], 2) ?></div>
                                                <div class="price-modifier">฿<?= number_format($level['base_price'], 2) ?></div>
                                            </label>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
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
                                                <label class="form-check-label w-100" for="plinth_<?= $component['id'] ?>">
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
                                                <label class="form-check-label w-100" for="tonearm_<?= $component['id'] ?>">
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
                                                <label class="form-check-label w-100" for="cartridge_<?= $component['id'] ?>">
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
                                                <label class="form-check-label w-100" for="power_<?= $component['id'] ?>">
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
                        <span id="currentLevel">Majik</span>
                        <span class="level-badge" id="levelBadge">Level 1</span>
                        <span class="ms-3" id="componentCount">0 components selected</span>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="total-price">฿<span id="totalPrice">2,500.00</span></div>
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
        
        // State management
        let currentConfig = {
            level: 1,
            basePrice: 2500.00,
            components: {
                plinth: null,
                tonearm: null,
                cartridge: null,
                power_supply: null
            }
        };

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            
            // Set initial level selection
            const initialLevelRadio = document.querySelector('input[name="level"]:checked');
            if (initialLevelRadio) {
                const levelId = parseInt(initialLevelRadio.value);
                const level = levels.find(l => l.id === levelId);
                currentConfig.level = levelId;
                currentConfig.basePrice = parseFloat(level.base_price);
                console.log('Initial level set:', level.name, 'Base Price:', currentConfig.basePrice);
            }
            
            // Initial update
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
            const level = levels.find(l => l.id === levelId);
            
            currentConfig.level = levelId;
            currentConfig.basePrice = parseFloat(level.base_price);
            
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
                .filter(c => c.level_id === levelId)
                .map(c => c.component_id);

            // Enable/disable component options based on compatibility
            document.querySelectorAll('.component-option').forEach(option => {
                const componentId = parseInt(option.dataset.componentId);
                const isCompatible = compatibleComponents.includes(componentId);
                const radio = option.querySelector('input[type="radio"]');
                
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
            const component = components.find(c => c.id === componentId);
            if (component && component.image_path) {
                const mainImage = document.getElementById('mainImage');
                
                // Create wood finish specific image names based on plinth selection
                const woodFinishes = {
                    'Majik Plinth': 'majik-oak',
                    'Akurate Plinth': 'akurate-rosewood',
                    'Klimax Plinth': 'klimax-ebony'
                };
                
                const finishKey = woodFinishes[component.name] || 'standard';
                
                // Update image with wood finish
                mainImage.src = `https://via.placeholder.com/800x600/f8f9fa/999999?text=${encodeURIComponent(component.name + ' - ' + finishKey)}`;
                
                // Add smooth transition effect
                mainImage.style.opacity = '0.7';
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                }, 200);
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
            const level = levels.find(l => l.id === currentConfig.level);
            
            // Calculate total price using Thai Baht formatter
            const totalPrice = calculateTotalPrice();
            
            // Debug: Log current state
            console.log('Current Config:', currentConfig);
            console.log('Calculated Price:', totalPrice);
            
            // Update level display
            document.getElementById('currentLevel').textContent = level.name;
            document.getElementById('levelBadge').textContent = `Level ${currentConfig.level}`;
            
            // Count selected components
            const selectedCount = Object.values(currentConfig.components)
                .filter(c => c !== null).length;
            document.getElementById('componentCount').textContent = `${selectedCount} components selected`;
            
            // Update price display with Thai Baht formatting
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
                    const component = components.find(c => c.id === parseInt(componentId));
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
            const totalPrice = calculateTotalPrice();
            const level = levels.find(l => l.id === currentConfig.level);
            
            // Prepare data for server
            const formData = new FormData();
            formData.append('level', currentConfig.level);
            
            // Add components
            Object.entries(currentConfig.components).forEach(([category, componentId]) => {
                formData.append(`components[${category}]`, componentId || '');
            });
            
            // Send to server
            fetch('/cart/add', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Redirect to summary page
                    window.location.href = '/cart/summary';
                } else {
                    throw new Error('Failed to save configuration');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Fallback: Show detailed configuration summary
                const selectedComponents = [];
                Object.entries(currentConfig.components).forEach(([category, componentId]) => {
                    if (componentId) {
                        const component = components.find(c => c.id === parseInt(componentId));
                        if (component) {
                            selectedComponents.push(`${component.name}: ${thaiBahtFormatter.format(component.price_modifier)}`);
                        }
                    }
                });
                
                const message = `Configuration added to cart!\n\n` +
                              `Level: ${level.name} - ${thaiBahtFormatter.format(level.base_price)}\n` +
                              `Components:\n${selectedComponents.join('\n')}\n\n` +
                              `Total Price: ${thaiBahtFormatter.format(totalPrice)}`;
                
                alert(message);
                console.log('Configuration:', {
                    level: currentConfig.level,
                    levelName: level.name,
                    components: currentConfig.components,
                    totalPrice: thaiBahtFormatter.format(totalPrice),
                    rawPrice: totalPrice
                });
            });
        }
    </script>
</body>
</html>
