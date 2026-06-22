<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login - LuxRent' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a56db 0%, #3b82f6 40%, #60a5fa 80%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2.5rem;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeInUp 0.6s ease-out;
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
        
        .login-logo {
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .login-logo .logo-icon {
            font-size: 3rem;
            color: #1a56db;
            background: rgba(26, 86, 219, 0.1);
            padding: 20px;
            border-radius: 100%;
            display: inline-block;
        }
        
        .login-logo h2 {
            font-weight: 700;
            color: #1e293b;
            margin-top: 1rem;
            margin-bottom: 0.25rem;
        }
        
        .login-logo h2 span {
            color: #1a56db;
        }
        
        .login-logo p {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px 12px 46px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background: white;
            width: 100%;
        }
        
        .form-control-modern:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 4px rgba(26, 86, 219, 0.08);
            outline: none;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #1a56db 0%, #3b82f6 100%);
            color: white;
            padding: 14px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(26, 86, 219, 0.35);
            color: white;
        }
        
        .btn-gradient:active {
            transform: translateY(0);
        }
        
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 12px 18px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-custom.success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }
        
        .alert-custom.error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #94a3b8;
            font-size: 0.8rem;
        }
        
        .login-footer a {
            color: #1a56db;
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .form-label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }
        
        .input-icon-wrapper {
            position: relative;
        }
        
        .input-icon-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            z-index: 1;
        }
        
        .input-icon-wrapper .form-control-modern {
            padding-left: 46px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #94a3b8;
            font-size: 0.8rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        .credential-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #475569;
            margin-top: 1rem;
        }
        
        .credential-info strong {
            color: #1a56db;
        }
        
        .credential-info .row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <div class="logo-icon">
            <i class="fas fa-camera-retro"></i>
        </div>
        <h2>Lux<span>Rent</span></h2>
        <p>Admin Panel</p>
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert-custom error">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert-custom success">
            <i class="fas fa-check-circle me-2"></i>
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <form action="<?= base_url('auth/login') ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">
                <i class="fas fa-user me-1" style="color: #1a56db;"></i>
                Username
            </label>
            <div class="input-icon-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-control-modern" 
                       placeholder="Masukkan username" required autofocus>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">
                <i class="fas fa-lock me-1" style="color: #1a56db;"></i>
                Password
            </label>
            <div class="input-icon-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control-modern" 
                       placeholder="Masukkan password" required>
            </div>
        </div>
        
        <button type="submit" class="btn-gradient">
            <i class="fas fa-sign-in-alt me-2"></i>
            Login
        </button>
    </form>
    
    <div class="divider">Informasi Login</div>
    
    <div class="credential-info">
        <div class="row">
            <span><strong>Admin:</strong> admin / 123456</span>
            <span><span class="badge bg-primary">Akses Penuh</span></span>
        </div>
    </div>
    
    <div class="login-footer">
        <p>&copy; 2024 LuxRent. All rights reserved.</p>
        <p><a href="<?= base_url() ?>"><i class="fas fa-home me-1"></i>Kembali ke Home</a></p>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
