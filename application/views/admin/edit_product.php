<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <span class="section-badge"><i class="fas fa-edit me-1"></i> Edit</span>
            <h2 class="section-title mt-2">Edit Produk</h2>
            <p class="text-muted">Ubah data equipment yang tersedia</p>
        </div>
        <a href="<?= base_url('admin/products') ?>" class="btn-gradient-outline">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Edit Produk -->
    <div class="form-card" data-aos="fade-up">
        <div class="card-header">
            <h5 class="fw-bold mb-0" style="color: #1e293b;">
                <i class="fas fa-pen me-2" style="color: #f59e0b;"></i>
                Edit Produk: <span style="color: #1a56db;"><?= $product->name ?></span>
            </h5>
        </div>
        
        <form action="<?= base_url('admin/update_product/' . $product->id) ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-tag me-1" style="color: #1a56db;"></i>
                        Nama Produk
                    </label>
                    <input type="text" name="name" class="form-control-modern w-100" 
                           value="<?= $product->name ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-money-bill-wave me-1" style="color: #1a56db;"></i>
                        Harga per Hari (Rp)
                    </label>
                    <input type="number" name="price" class="form-control-modern w-100" 
                           value="<?= $product->price_per_day ?>" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-image me-1" style="color: #1a56db;"></i>
                        Gambar Produk
                    </label>
                    
                    <!-- Tampilkan gambar saat ini -->
                    <div class="mb-2">
                        <p class="text-muted small">Gambar saat ini:</p>
                        <?php if(!empty($product->image_url) && file_exists($product->image_url)): ?>
                        <img src="<?= base_url($product->image_url) ?>" 
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 12px; border: 2px solid #e2e8f0;">
                        <?php else: ?>
                        <div style="width: 150px; height: 150px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #94a3b8; border: 2px dashed #e2e8f0;">
                            <i class="fas fa-image fa-2x"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <input type="file" name="image" class="form-control-modern w-100" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. (Kosongkan jika tidak ingin mengganti gambar)</small>
                </div>
            </div>
            
            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn-gradient">
                    <i class="fas fa-save me-2"></i>
                    Simpan Perubahan
                </button>
                <a href="<?= base_url('admin/products') ?>" class="btn-gradient-outline">
                    <i class="fas fa-times me-1"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
