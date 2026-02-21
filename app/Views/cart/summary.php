<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LP12 Configuration Summary - Your Custom Turntable</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
            background-color: #fafafa;
            color: var(--linn-text);
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

        .summary-header {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white;
            padding: 60px 0 40px;
            text-align: center;
        }

        .summary-header h1 {
            font-weight: 300;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .summary-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .build-receipt {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
            margin: -30px auto 40px;
            max-width: 900px;
            overflow: hidden;
        }

        .receipt-header {
            background-color: var(--linn-gray);
            padding: 30px;
            border-bottom: 2px solid var(--linn-teal);
        }

        .receipt-header h2 {
            font-weight: 600;
            color: var(--linn-teal);
            margin-bottom: 10px;
        }

        .receipt-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .receipt-body {
            padding: 0;
        }

        .component-item {
            display: flex;
            align-items: center;
            padding: 20px 30px;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.3s ease;
        }

        .component-item:hover {
            background-color: var(--linn-gray);
        }

        .component-item:last-child {
            border-bottom: none;
        }

        .component-icon {
            width: 60px;
            height: 60px;
            background-color: var(--linn-teal);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
        }

        .component-details {
            flex: 1;
        }

        .component-category {
            font-size: 0.85rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .component-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .component-description {
            font-size: 0.9rem;
            color: #666;
        }

        .component-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--linn-teal);
            text-align: right;
            min-width: 120px;
        }

        .level-item {
            background-color: rgba(0, 128, 128, 0.1);
            border-left: 4px solid var(--linn-teal);
        }

        .level-item .component-icon {
            background-color: var(--linn-teal-dark);
        }

        .receipt-footer {
            background-color: var(--linn-gray);
            padding: 30px;
            border-top: 2px solid var(--linn-teal);
        }

        .price-breakdown {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .price-label {
            font-weight: 500;
            color: #666;
        }

        .price-value {
            font-weight: 600;
            color: var(--linn-text);
        }

        .total-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--linn-teal);
            padding-top: 20px;
            border-top: 2px solid #dee2e6;
        }

        .action-buttons {
            padding: 30px;
            text-align: center;
            background-color: white;
        }

        .btn-outline-linn {
            border: 2px solid var(--linn-teal);
            color: var(--linn-teal);
            background-color: transparent;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-linn:hover {
            background-color: var(--linn-teal);
            color: white;
            border-color: var(--linn-teal);
        }

        .build-specs {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 30px;
        }

        .spec-badge {
            display: inline-block;
            background-color: var(--linn-teal);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .summary-header h1 {
                font-size: 2rem;
            }
            
            .component-item {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            
            .component-icon {
                margin: 0 auto 15px;
            }
            
            .component-price {
                text-align: center;
                margin-top: 10px;
            }
            
            .price-breakdown {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="summary-header">
        <div class="container">
            <h1><i class="fas fa-compact-disc me-3"></i>Your LP12 Configuration</h1>
            <p>Custom turntable build summary and specifications</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Build Specs -->
        <div class="build-specs">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="linn-teal mb-3">Build Specifications</h3>
                    <div class="mb-2">
                        <strong>Level:</strong> <?= esc($level['name']) ?>
                        <span class="spec-badge">Level <?= $level['id'] ?></span>
                    </div>
                    <div class="mb-2">
                        <strong>Components:</strong> <?= count($components) ?> items selected
                    </div>
                    <div class="mb-2">
                        <strong>Configuration Date:</strong> <?= date('F j, Y, g:i a', strtotime($config_date)) ?>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="component-icon mx-auto mb-2" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-record-vinyl"></i>
                    </div>
                    <h4 class="linn-teal"><?= esc($level['name']) ?> LP12</h4>
                </div>
            </div>
        </div>

        <!-- Build Receipt -->
        <div class="build-receipt">
            <div class="receipt-header">
                <h2><i class="fas fa-receipt me-2"></i>Build Receipt</h2>
                <div class="receipt-meta">
                    <i class="fas fa-calendar me-2"></i><?= date('F j, Y', strtotime($config_date)) ?> | 
                    <i class="fas fa-clock me-2 ms-3"></i><?= date('g:i a', strtotime($config_date)) ?>
                </div>
            </div>

            <div class="receipt-body">
                <!-- Level Item -->
                <div class="component-item level-item">
                    <div class="component-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="component-details">
                        <div class="component-category">Base Level</div>
                        <div class="component-name"><?= esc($level['name']) ?> LP12</div>
                        <div class="component-description">Premium turntable system with <?= esc($level['name']) ?> level components</div>
                    </div>
                    <div class="component-price">
                        ฿<?= number_format($level['base_price'], 2) ?>
                    </div>
                </div>

                <!-- Component Items -->
                <?php foreach($components as $component): ?>
                <div class="component-item">
                    <div class="component-icon">
                        <?php
                        $icon = 'fa-cog';
                        switch(strtolower($component['category'])) {
                            case 'plinth': $icon = 'fa-cube'; break;
                            case 'tonearm': $icon = 'fa-sliders-h'; break;
                            case 'cartridge': $icon = 'fa-compact-disc'; break;
                            case 'power supply': $icon = 'fa-plug'; break;
                        }
                        ?>
                        <i class="fas <?= $icon ?>"></i>
                    </div>
                    <div class="component-details">
                        <div class="component-category"><?= esc($component['category']) ?></div>
                        <div class="component-name"><?= esc($component['name']) ?></div>
                        <div class="component-description"><?= esc($component['description']) ?></div>
                    </div>
                    <div class="component-price">
                        <?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="receipt-footer">
                <div class="price-breakdown">
                    <span class="price-label">Base Level Price:</span>
                    <span class="price-value">฿<?= number_format($level['base_price'], 2) ?></span>
                </div>
                
                <?php foreach($components as $component): ?>
                <div class="price-breakdown">
                    <span class="price-label"><?= esc($component['name']) ?>:</span>
                    <span class="price-value"><?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?></span>
                </div>
                <?php endforeach; ?>
                
                <div class="total-price">
                    <span>Total Price:</span>
                    <span>฿<?= number_format($total_price, 2) ?></span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="<?= base_url('configurator') ?>" class="btn btn-outline-linn btn-lg me-3">
                <i class="fas fa-arrow-left me-2"></i>Build Another
            </a>
            <a href="<?= base_url('cart/clear') ?>" class="btn btn-linn btn-lg me-3">
                <i class="fas fa-trash me-2"></i>Clear Configuration
            </a>
            <a href="<?= base_url('checkout') ?>" class="btn btn-success btn-lg">
                <i class="fas fa-shopping-cart me-2"></i>Proceed to Checkout
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
