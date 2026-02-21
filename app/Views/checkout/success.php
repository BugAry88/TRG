<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - LP12 Configurator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-dark: #006666;
        }
        body { font-family: 'Inter', sans-serif; background-color: #fafafa; color: #333; }
        .success-header {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white; padding: 60px 0 40px; text-align: center;
        }
        .success-header h1 { font-weight: 300; font-size: 2.5rem; }
        .success-icon {
            width: 80px; height: 80px; background: rgba(255,255,255,0.2);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 2.5rem; margin: 0 auto 20px;
        }
        .card-custom {
            background: white; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none;
        }
        .order-number {
            font-size: 1.6rem; font-weight: 700; color: var(--linn-teal);
            letter-spacing: 2px;
        }
        .section-title {
            font-size: 1.1rem; font-weight: 600; color: var(--linn-teal);
            border-bottom: 2px solid var(--linn-teal); padding-bottom: 10px; margin-bottom: 20px;
        }
        .info-row {
            display: flex; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 0.95rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #666; }
        .info-value { font-weight: 500; }
        .order-total {
            display: flex; justify-content: space-between;
            font-size: 1.4rem; font-weight: 700; color: var(--linn-teal);
            padding-top: 15px; border-top: 2px solid var(--linn-teal); margin-top: 10px;
        }
        .status-badge {
            display: inline-block; padding: 6px 16px; border-radius: 20px;
            font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .btn-linn {
            background-color: var(--linn-teal); color: white; border: none;
            padding: 12px 30px; border-radius: 8px; font-weight: 500; transition: all 0.3s;
        }
        .btn-linn:hover { background-color: var(--linn-teal-dark); color: white; }
        .btn-outline-linn {
            border: 2px solid var(--linn-teal); color: var(--linn-teal);
            background: transparent; padding: 12px 30px; border-radius: 8px;
            font-weight: 500; transition: all 0.3s;
        }
        .btn-outline-linn:hover { background-color: var(--linn-teal); color: white; }
        .timeline-item {
            display: flex; gap: 15px; padding: 12px 0;
        }
        .timeline-icon {
            width: 36px; height: 36px; border-radius: 50%; background: #f0f0f0;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem; flex-shrink: 0; color: #999;
        }
        .timeline-icon.active { background: var(--linn-teal); color: white; }
        .timeline-content { padding-top: 6px; }
        .timeline-title { font-weight: 600; font-size: 0.95rem; }
        .timeline-desc { font-size: 0.85rem; color: #666; }
    </style>
</head>
<body>
    <div class="success-header">
        <div class="container">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1>Order Confirmed!</h1>
            <p class="mt-2 opacity-90">Thank you for your LP12 order. We'll be in touch shortly.</p>
        </div>
    </div>

    <div class="container py-5">
        <!-- Order Number Banner -->
        <div class="card-custom p-4 mb-4 text-center">
            <p class="text-muted mb-1">Your Order Number</p>
            <div class="order-number"><?= esc($order['order_number']) ?></div>
            <p class="text-muted mt-2 mb-0 small">
                <i class="fas fa-envelope me-1"></i>
                A confirmation will be sent to <strong><?= esc($order['customer_email']) ?></strong>
            </p>
        </div>

        <div class="row g-4">
            <!-- Left: Order Details -->
            <div class="col-lg-7">
                <!-- Customer Info -->
                <div class="card-custom p-4 mb-4">
                    <div class="section-title"><i class="fas fa-user me-2"></i>Customer Details</div>
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
                    <div class="info-row">
                        <span class="info-label">Order Date</span>
                        <span class="info-value"><?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock me-1"></i><?= ucfirst($order['status']) ?>
                        </span>
                    </div>
                </div>

                <!-- What Happens Next -->
                <div class="card-custom p-4">
                    <div class="section-title"><i class="fas fa-road me-2"></i>What Happens Next</div>
                    <div class="timeline-item">
                        <div class="timeline-icon active"><i class="fas fa-check"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Order Received</div>
                            <div class="timeline-desc">Your order has been successfully placed.</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon"><i class="fas fa-phone"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Confirmation Call</div>
                            <div class="timeline-desc">Our team will contact you within 24 hours to confirm your order.</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon"><i class="fas fa-tools"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Assembly & Quality Check</div>
                            <div class="timeline-desc">Your LP12 will be hand-assembled and tested by our engineers.</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon"><i class="fas fa-truck"></i></div>
                        <div class="timeline-content">
                            <div class="timeline-title">Delivery</div>
                            <div class="timeline-desc">Estimated delivery: 4–6 weeks from order confirmation.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-lg-5">
                <div class="card-custom p-4">
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

                    <?php if($order['notes']): ?>
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted"><strong>Notes:</strong> <?= esc($order['notes']) ?></small>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="mt-4 d-flex flex-column gap-3">
                    <a href="<?= base_url('configurator') ?>" class="btn btn-linn text-center">
                        <i class="fas fa-plus me-2"></i>Build Another LP12
                    </a>
                    <a href="<?= base_url('/') ?>" class="btn btn-outline-linn text-center">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
