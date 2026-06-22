<!-- HERO SECTION -->
<section class="hero-modern">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #fcd34d; backdrop-filter: blur(10px);">
                    <i class="fas fa-star me-1"></i> Premium Equipment
                </span>
                <h1 class="hero-title mt-3">
                    Sewa Peralatan<br>
                    <span class="highlight">Multimedia & Fotografi</span>
                </h1>
                <p class="hero-subtitle mt-3">
                    Dapatkan akses ke peralatan profesional berkualitas tinggi untuk 
                    mewujudkan karya kreatif Anda. Mulai dari kamera, lighting, hingga audio.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="<?= base_url('booking') ?>" class="hero-btn-primary">
                        <i class="fas fa-calendar-alt me-2"></i> Sewa Sekarang
                    </a>
                    <a href="#products" class="hero-btn-secondary">
                        <i class="fas fa-arrow-down me-2"></i> Lihat Equipment
                    </a>
                </div>
                <div class="d-flex gap-5 mt-5">
                    <div>
                        <span class="text-white fw-bold fs-4">50+</span>
                        <p class="text-white-50 small mb-0">Equipment</p>
                    </div>
                    <div>
                        <span class="text-white fw-bold fs-4">200+</span>
                        <p class="text-white-50 small mb-0">Pelanggan Puas</p>
                    </div>
                    <div>
                        <span class="text-white fw-bold fs-4">24/7</span>
                        <p class="text-white-50 small mb-0">Support</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                <div class="text-center float-animation">
                    <i class="fas fa-camera-retro" style="font-size: 12rem; color: rgba(255,255,255,0.08);"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-wave"></div>
</section>

<!-- PRODUCTS SECTION -->
<section id="products" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge"><i class="fas fa-camera me-1"></i> Our Collection</span>
            <h2 class="section-title mt-2">Equipment Tersedia</h2>
            <div class="section-divider"></div>
            <p class="text-muted">Pilih peralatan yang sesuai dengan kebutuhan kreatif Anda</p>
        </div>

        <div class="row g-4">
            <?php if(!empty($products)): ?>
                <?php foreach($products as $index => $product): ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 50 ?>">
                    <div class="product-card" onclick="window.location.href='<?= base_url('booking?product_id=' . $product->id) ?>'">
                        <div class="product-image-wrapper">
                            <?php if(!empty($product->image_url) && file_exists($product->image_url)): ?>
                            <img src="<?= base_url($product->image_url) ?>" class="card-img-top" alt="<?= $product->name ?>">
                            <?php else: ?>
                            <img src="https://placehold.co/400x400/f1f5f9/94a3b8?text=No+Image" class="card-img-top" alt="No Image">
                            <?php endif; ?>
                            <div class="product-overlay">
                                <span><i class="fas fa-shopping-cart me-2"></i>Booking</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $product->name ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp <?= number_format($product->price_per_day, 0, ',', '.') ?> <small>/ hari</small></span>
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2">
                                    <i class="fas fa-star text-warning me-1"></i> 4.9
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                    <p class="text-muted">Belum ada equipment tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section class="py-5" style="background: white;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="section-badge"><i class="fas fa-thumbs-up me-1"></i> Why LuxRent</span>
            <h2 class="section-title mt-2">Kenapa Memilih Kami?</h2>
            <div class="section-divider"></div>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5 class="feature-title">Garansi & Asuransi</h5>
                    <p class="feature-desc">Semua equipment dalam kondisi prima dan terlindungi asuransi penuh.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-truck"></i></div>
                    <h5 class="feature-title">Free Delivery</h5>
                    <p class="feature-desc">Gratis antar-jemput untuk area Jabodetabek dengan jadwal fleksibel.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-headset"></i></div>
                    <h5 class="feature-title">Support 24/7</h5>
                    <p class="feature-desc">Tim support siap membantu kebutuhan teknis Anda kapan saja.</p>
                </div>
            </div>
        </div>
    </div>
</section>
