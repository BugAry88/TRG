<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linn LP12 - Premium Turntable Systems</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --linn-teal: #008080;
            --linn-teal-light: #00a0a0;
            --linn-teal-dark: #006666;
            --linn-gray: #f8f9fa;
            --linn-text: #333333;
            --linn-light-gray: #6c757d;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--linn-text);
            line-height: 1.6;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn-linn:hover {
            background-color: var(--linn-teal-dark);
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .btn-outline-linn {
            border: 2px solid var(--linn-teal);
            color: var(--linn-teal);
            background-color: transparent;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-linn:hover {
            background-color: var(--linn-teal);
            color: white;
            text-decoration: none;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .hero-image {
            position: relative;
            text-align: center;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        /* Navigation */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--linn-teal) !important;
        }

        .nav-link {
            color: var(--linn-text) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--linn-teal) !important;
        }

        /* Collection Section */
        .collection-section {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
            color: var(--linn-text);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: var(--linn-light-gray);
            margin-bottom: 60px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 250px;
            background: linear-gradient(45deg, var(--linn-gray), #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .product-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--linn-teal);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .product-content {
            padding: 30px;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--linn-text);
        }

        .product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--linn-teal);
            margin-bottom: 15px;
        }

        .product-description {
            color: var(--linn-light-gray);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background-color: var(--linn-gray);
        }

        .feature-card {
            text-align: center;
            padding: 40px 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background-color: var(--linn-teal);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--linn-text);
        }

        .feature-description {
            color: var(--linn-light-gray);
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--linn-teal) 0%, var(--linn-teal-dark) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-subtitle {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .btn-white {
            background-color: white;
            color: var(--linn-teal);
            padding: 15px 40px;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-white:hover {
            background-color: var(--linn-gray);
            color: var(--linn-teal);
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: #1a1a1a;
            color: white;
            padding: 60px 0 30px;
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--linn-teal);
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .newsletter-input {
            flex: 1;
            padding: 12px 20px;
            border: 1px solid #444;
            background-color: #2d2d2d;
            color: white;
            border-radius: 5px;
        }

        .newsletter-input::placeholder {
            color: #999;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: #444;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: var(--linn-teal);
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #444;
            margin-top: 40px;
            padding-top: 30px;
            text-align: center;
            color: #999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-compact-disc me-2"></i>Linn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#collection">Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('configurator') ?>">Configurator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <?php if(session()->get('customer_logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('account') ?>"><i class="fas fa-user me-1"></i><?= esc(session()->get('customer_name')) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Turntables</h1>
                    <p class="hero-subtitle">Experience the perfect blend of tradition and innovation with our premium LP12 turntable systems</p>
                    <a href="<?= base_url('configurator') ?>" class="btn btn-linn btn-lg me-3">
                        <i class="fas fa-cog me-2"></i>Build Your Own
                    </a>
                    <a href="#collection" class="btn btn-outline-linn btn-lg">
                        <i class="fas fa-eye me-2"></i>View Collection
                    </a>
                </div>
                <div class="col-lg-6 hero-image">
                    <img src="https://via.placeholder.com/600x400/1a1a1a/ffffff?text=LP12+Premium+Turntable" alt="Linn LP12 Turntable">
                </div>
            </div>
        </div>
    </section>

    <!-- Collection Section -->
    <section id="collection" class="collection-section">
        <div class="container">
            <h2 class="section-title">Curated Collection</h2>
            <p class="section-subtitle">Handpicked turntable systems for every audiophile</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/300x250/f8f9fa/333333?text=Majik+LP12" alt="Majik LP12" class="img-fluid">
                            <span class="product-badge">Popular</span>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">Majik LP12</h3>
                            <div class="product-price">฿85,000</div>
                            <p class="product-description">Entry-level excellence with renowned Linn precision engineering. Perfect starting point for your vinyl journey.</p>
                            <a href="<?= base_url('configurator?level=1') ?>" class="btn btn-linn">Configure</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/300x250/f8f9fa/333333?text=Akurate+LP12" alt="Akurate LP12" class="img-fluid">
                            <span class="product-badge">Best Value</span>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">Akurate LP12</h3>
                            <div class="product-price">฿195,000</div>
                            <p class="product-description">Advanced performance with enhanced components. The sweet spot for serious music lovers seeking exceptional sound.</p>
                            <a href="<?= base_url('configurator?level=2') ?>" class="btn btn-linn">Configure</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/300x250/f8f9fa/333333?text=Klimax+LP12" alt="Klimax LP12" class="img-fluid">
                            <span class="product-badge">Premium</span>
                        </div>
                        <div class="product-content">
                            <h3 class="product-title">Klimax LP12</h3>
                            <div class="product-price">฿485,000</div>
                            <p class="product-description">The pinnacle of turntable design. Reference-grade performance for the most discerning audiophiles.</p>
                            <a href="<?= base_url('configurator?level=3') ?>" class="btn btn-linn">Configure</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <h2 class="section-title">Upgrade Your System</h2>
            <p class="section-subtitle">Enhance your listening experience with our premium upgrades</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cube"></i>
                        </div>
                        <h3 class="feature-title">Premium Plinths</h3>
                        <p class="feature-description">Choose from oak, rosewood, or ebony finishes to match your decor and enhance acoustic performance.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <h3 class="feature-title">Advanced Tonearms</h3>
                        <p class="feature-description">From basic to Ekos SE, upgrade your tonearm for precise tracking and improved detail retrieval.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-compact-disc"></i>
                        </div>
                        <h3 class="feature-title">High-End Cartridges</h3>
                        <p class="feature-description">Krystal, Kandid, or Klyde cartridges deliver increasingly detailed and dynamic sound reproduction.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-plug"></i>
                        </div>
                        <h3 class="feature-title">Power Supplies</h3>
                        <p class="feature-description">Upgrade from basic to Radikal power supply for cleaner power and more stable performance.</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="feature-title">Innovative Design</h3>
                        <p class="feature-description">Constant innovation in materials and engineering ensures your LP12 remains future-proof.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Build Your Dream System?</h2>
            <p class="cta-subtitle">Use our configurator to design the perfect LP12 for your music collection</p>
            <a href="<?= base_url('configurator') ?>" class="btn-white btn-lg">
                <i class="fas fa-cog me-2"></i>Start Configuring
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-title">Keep in touch</h3>
                    <p>Subscribe to receive the latest news and exclusive offers</p>
                    <form class="newsletter-form" action="#" method="POST">
                        <input type="email" class="newsletter-input" placeholder="Enter your email" required>
                        <button type="submit" class="btn btn-linn">Subscribe</button>
                    </form>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-title">Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('configurator') ?>">Configurator</a></li>
                        <li><a href="#collection">Collection</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#">About Linn</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-title">Sound straight from the source</h3>
                    <p>Experience music as the artist intended with Linn's legendary sound quality.</p>
                    <p><i class="fas fa-phone me-2"></i>+66 2 123 4567</p>
                    <p><i class="fas fa-envelope me-2"></i>info@linn-thailand.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Bangkok, Thailand</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 Linn Products. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>
</html>
