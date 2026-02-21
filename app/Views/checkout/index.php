<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - LP12 Configurator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-dark: #006666;
            --linn-gray: #f8f9fa;
        }
        body { font-family: 'Inter', sans-serif; background-color: #fafafa; color: #333; }
        .checkout-header {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white; padding: 50px 0 30px; text-align: center;
        }
        .checkout-header h1 { font-weight: 300; font-size: 2.2rem; }
        .card-custom {
            background: white; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none;
        }
        .section-title {
            font-size: 1.1rem; font-weight: 600; color: var(--linn-teal);
            border-bottom: 2px solid var(--linn-teal); padding-bottom: 10px; margin-bottom: 20px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--linn-teal); box-shadow: 0 0 0 0.2rem rgba(0,128,128,0.2);
        }
        .order-summary-item {
            display: flex; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 0.95rem;
        }
        .order-summary-item:last-child { border-bottom: none; }
        .order-total {
            display: flex; justify-content: space-between;
            font-size: 1.4rem; font-weight: 700; color: var(--linn-teal);
            padding-top: 15px; border-top: 2px solid var(--linn-teal); margin-top: 10px;
        }
        .btn-checkout {
            background-color: var(--linn-teal); color: white; border: none;
            padding: 14px 40px; font-size: 1.1rem; font-weight: 600;
            border-radius: 8px; width: 100%; transition: all 0.3s;
        }
        .btn-checkout:hover { background-color: var(--linn-teal-dark); color: white; transform: translateY(-1px); }
        .btn-back {
            border: 2px solid var(--linn-teal); color: var(--linn-teal);
            background: transparent; padding: 12px 30px; border-radius: 8px;
            font-weight: 500; transition: all 0.3s;
        }
        .btn-back:hover { background-color: var(--linn-teal); color: white; }
        .level-badge {
            background-color: var(--linn-teal); color: white;
            padding: 4px 12px; border-radius: 20px; font-size: 0.85rem;
        }
        .step-indicator {
            display: flex; justify-content: center; gap: 0; margin-bottom: 30px;
        }
        .step {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 20px; font-size: 0.9rem; color: #999;
        }
        .step.active { color: var(--linn-teal); font-weight: 600; }
        .step.done { color: #28a745; }
        .step-num {
            width: 28px; height: 28px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700; border: 2px solid #ddd;
        }
        .step.active .step-num { border-color: var(--linn-teal); background: var(--linn-teal); color: white; }
        .step.done .step-num { border-color: #28a745; background: #28a745; color: white; }
        .step-line { width: 40px; height: 2px; background: #ddd; margin: 0 -5px; }
        .step.done + .step-line { background: #28a745; }
    </style>
</head>
<body>
    <div class="checkout-header">
        <div class="container">
            <h1><i class="fas fa-shopping-bag me-3"></i>Checkout</h1>
            <p class="mt-2 opacity-75">Complete your LP12 order</p>
        </div>
    </div>

    <div class="container py-5">
        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step done">
                <div class="step-num"><i class="fas fa-check" style="font-size:0.7rem"></i></div>
                Configure
            </div>
            <div class="step-line"></div>
            <div class="step done">
                <div class="step-num"><i class="fas fa-check" style="font-size:0.7rem"></i></div>
                Summary
            </div>
            <div class="step-line"></div>
            <div class="step active">
                <div class="step-num">3</div>
                Checkout
            </div>
            <div class="step-line"></div>
            <div class="step">
                <div class="step-num">4</div>
                Confirmed
            </div>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('checkout/place-order') ?>" method="POST">
            <div class="row g-4">
                <!-- Left: Customer Info -->
                <div class="col-lg-7">
                    <div class="card-custom p-4">
                        <div class="section-title"><i class="fas fa-user me-2"></i>Customer Information</div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-500">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control" placeholder="e.g. John Smith" value="<?= esc($customer['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-500">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="customer_email" class="form-control" placeholder="john@example.com" value="<?= esc($customer['email'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-500">Phone Number</label>
                                <input type="tel" name="customer_phone" class="form-control" placeholder="e.g. 081-234-5678" value="<?= esc($customer['phone'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-500">Delivery Address <span class="text-danger">*</span></label>
                                <textarea name="customer_address" class="form-control" rows="3" placeholder="Full delivery address..." required><?= esc($customer['address'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-500">Additional Notes</label>
                                <textarea name="notes" class="form-control" rows="2" placeholder="Any special requests or notes..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-custom p-4 mt-4">
                        <div class="section-title"><i class="fas fa-truck me-2"></i>Delivery Information</div>
                        <div class="alert alert-info d-flex align-items-start gap-3 mb-0" style="border-radius:8px; background:#e8f4f4; border-color:#008080; color:#333;">
                            <i class="fas fa-info-circle mt-1" style="color:var(--linn-teal)"></i>
                            <div>
                                <strong>Delivery Timeline:</strong> 4–6 weeks after order confirmation.<br>
                                <small class="text-muted">Our team will contact you within 24 hours to confirm your order and arrange delivery.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="col-lg-5">
                    <div class="card-custom p-4" style="position: sticky; top: 20px;">
                        <div class="section-title"><i class="fas fa-receipt me-2"></i>Order Summary</div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-600"><?= esc($level['name']) ?> LP12</span>
                                <span class="level-badge"><?= esc($level['name']) ?></span>
                            </div>
                        </div>

                        <div class="order-summary-item">
                            <span class="text-muted">Base Level Price</span>
                            <span class="fw-600">฿<?= number_format($level['base_price'], 2) ?></span>
                        </div>

                        <?php foreach($components as $component): ?>
                        <div class="order-summary-item">
                            <span class="text-muted"><?= esc($component['name']) ?></span>
                            <span><?= $component['price_modifier'] > 0 ? '+' : '' ?>฿<?= number_format($component['price_modifier'], 2) ?></span>
                        </div>
                        <?php endforeach; ?>

                        <div class="order-total">
                            <span>Total</span>
                            <span>฿<?= number_format($total_price, 2) ?></span>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn-checkout">
                                <i class="fas fa-check-circle me-2"></i>Place Order
                            </button>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="<?= base_url('cart/summary') ?>" class="btn-back btn">
                                <i class="fas fa-arrow-left me-2"></i>Back to Summary
                            </a>
                        </div>

                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-lock me-1"></i>Your information is secure and protected
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
