<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'LuxRent' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: #f8fafc;
            min-height: 100vh;
        }
        
        /* ========== NAVBAR ========== */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-custom .nav-link {
            color: #4a5568;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
        }
        
        .navbar-custom .nav-link:hover {
            color: #1a56db;
            background: rgba(26, 86, 219, 0.06);
        }
        
        .navbar-custom .nav-link.active {
            color: #1a56db;
            background: rgba(26, 86, 219, 0.1);
            font-weight: 600;
        }
        
        /* ========== UNDERLINE UNTUK SEMUA NAV LINK KECUALI LOGIN ========== */
        .navbar-custom .nav-link:not(.no-underline)::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #1a56db;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .navbar-custom .nav-link:not(.no-underline):hover::after {
            width: 70%;
        }
        
        .navbar-custom .nav-link:not(.no-underline).active::after {
            width: 70%;
            background: #1a56db;
        }
        
        /* ========== KHUSUS LOGIN - TANPA UNDERLINE ========== */
        .navbar-custom .nav-link.no-underline::after {
            display: none !important;
        }
        
        .navbar-custom .nav-link.no-underline:hover {
            color: #1a56db;
            background: rgba(26, 86, 219, 0.06);
        }
        
        .navbar-custom .nav-link.no-underline.active {
            color: #1a56db;
            background: rgba(26, 86, 219, 0.1);
            font-weight: 600;
        }
        
        /* ========== NAV CTA (Tombol Sewa Sekarang) ========== */
        .nav-cta {
            background: #1a56db;
            color: white !important;
            padding: 8px 24px !important;
            border-radius: 50px !important;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-cta:hover {
            background: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 86, 219, 0.35);
            color: white !important;
        }
        
        .nav-cta::after {
            display: none !important;
        }
        
        /* ========== KHUSUS LOGOUT ========== */
        .nav-logout {
            color: #ef4444 !important;
        }
        
        .nav-logout:hover {
            background: rgba(239, 68, 68, 0.08) !important;
            color: #dc2626 !important;
        }
        
        .nav-logout::after {
            background: #ef4444 !important;
        }
        
        /* ========== BADGE USER ========== */
        .nav-user-badge {
            background: rgba(26, 86, 219, 0.08);
            color: #1a56db;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .navbar-custom .nav-link i {
            margin-right: 6px;
            font-size: 0.9rem;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #1e293b;
            text-decoration: none;
        }
        
        .navbar-brand span {
            color: #1a56db;
        }
        
        .navbar-brand i {
            color: #1a56db;
            font-size: 1.8rem;
            margin-right: 8px;
        }
        
        /* ========== HERO ========== */
        .hero-modern {
            background: linear-gradient(135deg, #1a56db 0%, #2563eb 40%, #3b82f6 70%, #60a5fa 100%);
            padding: 80px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .hero-modern::after {
            content: '';
            position: absolute;
            bottom: -40%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
            pointer-events: none;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
        }
        
        .hero-title .highlight {
            color: #fcd34d;
            position: relative;
        }
        
        .hero-title .highlight::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(252, 211, 77, 0.3);
            border-radius: 4px;
        }
        
        .hero-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 500px;
            line-height: 1.7;
        }
        
        .hero-btn-primary {
            background: white;
            color: #1a56db;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        
        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
            color: #1a56db;
        }
        
        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.25);
            text-decoration: none;
            display: inline-block;
        }
        
        .hero-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            transform: translateY(-3px);
        }
        
        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            width: 100%;
            height: 80px;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23f8fafc"/></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        /* ========== SECTION HEADER ========== */
        .section-badge {
            display: inline-block;
            background: rgba(26, 86, 219, 0.08);
            color: #1a56db;
            padding: 4px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .section-divider {
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #1a56db, #3b82f6);
            border-radius: 4px;
            margin: 16px auto;
        }
        
        /* ========== PRODUCT CARDS ========== */
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(26, 86, 219, 0.12);
        }
        
        .product-card .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .product-card .card-body {
            padding: 1.5rem;
        }
        
        .product-card .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a56db;
        }
        
        .product-price small {
            font-size: 0.85rem;
            font-weight: 400;
            color: #94a3b8;
        }
        
        .product-image-wrapper {
            position: relative;
            overflow: hidden;
        }
        
        .product-overlay {
            position: absolute;
            inset: 0;
            background: rgba(26, 86, 219, 0.85);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 20px 20px 0 0;
        }
        
        .product-card:hover .product-overlay {
            opacity: 1;
        }
        
        .product-overlay span {
            color: white;
            font-weight: 600;
            padding: 12px 32px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .product-overlay span:hover {
            background: white;
            color: #1a56db;
        }
        
        /* ========== STAT CARDS ========== */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.4s ease;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            cursor: pointer;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
        }
        
        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .stat-icon.blue {
            background: rgba(26, 86, 219, 0.1);
            color: #1a56db;
        }
        
        .stat-icon.green {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }
        
        .stat-icon.purple {
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
        }
        
        .stat-icon.orange {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }
        
        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        /* ========== TABLE ========== */
        .table-modern {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #1a56db 0%, #3b82f6 100%);
            color: white;
        }
        
        .table-modern thead th {
            padding: 16px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }
        
        .table-modern tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table-modern tbody tr {
            transition: background 0.2s ease;
        }
        
        .table-modern tbody tr:hover {
            background: rgba(26, 86, 219, 0.03);
        }
        
        /* ========== BADGE STATUS ========== */
        .badge-status {
            padding: 6px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
        }
        
        .badge-pending {
            background: #fef3c7;
            color: #d97706;
        }
        
        .badge-confirmed {
            background: #dbeafe;
            color: #1a56db;
        }
        
        .badge-completed {
            background: #d1fae5;
            color: #059669;
        }
        
        /* ========== FORM ========== */
        .form-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
            border: none;
        }
        
        .form-card .card-header {
            background: transparent;
            border-bottom: 2px solid #f1f5f9;
            padding: 0 0 1.5rem 0;
            margin-bottom: 1.5rem;
        }
        
        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background: white;
        }
        
        .form-control-modern:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.08);
        }
        
        .form-label-modern {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #1a56db 0%, #3b82f6 100%);
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(26, 86, 219, 0.35);
            color: white;
        }
        
        .btn-gradient-outline {
            background: transparent;
            color: #1a56db;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            border: 2px solid #1a56db;
            transition: all 0.3s ease;
        }
        
        .btn-gradient-outline:hover {
            background: #1a56db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 86, 219, 0.25);
        }
        
        .btn-danger-soft {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
            border: none;
            padding: 8px 18px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-danger-soft:hover {
            background: #ef4444;
            color: white;
        }
        
        /* ========== FEATURES ========== */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            height: 100%;
            border: none;
        }
        
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
        }
        
        .feature-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(26, 86, 219, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: #1a56db;
        }
        
        .feature-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .feature-desc {
            color: #64748b;
            font-size: 0.9rem;
            line-height: 1.6;
        }
        
        /* ========== INFO BOX ========== */
        .info-box {
            background: rgba(26, 86, 219, 0.04);
            border: 1px solid rgba(26, 86, 219, 0.1);
            border-radius: 20px;
            padding: 1.5rem 2rem;
        }
        
        .info-box li {
            margin-bottom: 0.6rem;
            color: #475569;
        }
        
        .info-box li i {
            color: #1a56db;
            width: 20px;
        }
        
        /* ========== FOOTER ========== */
        .footer-modern {
            background: #0f172a;
            padding: 60px 0 30px;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .footer-modern h5 {
            color: white;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }
        
        .footer-modern a {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-modern a:hover {
            color: #60a5fa;
        }
        
        .footer-modern .list-unstyled li {
            margin-bottom: 0.6rem;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.3);
        }
        
        /* ========== ANIMATIONS ========== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .form-card {
                padding: 1.5rem;
            }
            
            .hero-modern {
                padding: 60px 0 80px;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <i class="fas fa-camera-retro"></i>
            Lux<span>Rent</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                <!-- HOME -->
                <li class="nav-item">
                    <a class="nav-link <?= ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : '' ?>" 
                       href="<?= base_url() ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                
                <!-- BOOKING -->
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'booking' ? 'active' : '' ?>" 
                       href="<?= base_url('booking') ?>">
                        <i class="fas fa-calendar-alt"></i> Booking
                    </a>
                </li>
                
                <!-- MENU UNTUK ADMIN (Dashboard & Produk) -->
                <?php if($this->session->userdata('logged_in') && $this->session->userdata('role') == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) != 'products' ? 'active' : '' ?>" 
                       href="<?= base_url('admin') ?>">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'products' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/products') ?>">
                        <i class="fas fa-boxes"></i> Produk
                    </a>
                </li>
                <?php endif; ?>
                
                <!-- MENU LOGIN / LOGOUT -->
                <?php if($this->session->userdata('logged_in')): ?>
                    <!-- Badge User -->
                    <li class="nav-item">
                        <span class="nav-user-badge">
                            <i class="fas fa-user me-1"></i>
                            <?= $this->session->userdata('username') ?>
                            (<?= $this->session->userdata('role') == 'admin' ? 'Admin' : 'User' ?>)
                        </span>
                    </li>
                    <!-- Logout -->
                    <li class="nav-item">
                        <a class="nav-link nav-logout" href="<?= base_url('auth/logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <!-- LOGIN - TANPA UNDERLINE (pakai class no-underline) -->
                    <li class="nav-item">
                        <a class="nav-link no-underline <?= $this->uri->segment(1) == 'auth' || $this->uri->segment(1) == 'login' ? 'active' : '' ?>" 
                           href="<?= base_url('auth') ?>">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <!-- SEWA SEKARANG (Tombol CTA) -->
                    <li class="nav-item">
                        <a class="nav-cta" href="<?= base_url('booking') ?>">
                            <i class="fas fa-plus-circle me-1"></i> Sewa Sekarang
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- SPACER FOR FIXED NAVBAR -->
<div style="height: 80px;"></div>

<!-- ALERT MESSAGES -->
<?php if($this->session->flashdata('success')): ?>
<div class="container mt-3">
    <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm" role="alert" style="background: #d1fae5; color: #065f46;">
        <i class="fas fa-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show border-0 rounded-4 shadow-sm" role="alert" style="background: #fee2e2; color: #991b1b;">
        <i class="fas fa-exclamation-circle me-2"></i> <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
<?php endif; ?>
