<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <span class="section-badge"><i class="fas fa-boxes me-1"></i> Management</span>
            <h2 class="section-title mt-2">Kelola Produk</h2>
            <p class="text-muted">Tambah, edit, atau hapus equipment yang tersedia</p>
        </div>
        <a href="<?= base_url('admin') ?>" class="btn-gradient-outline">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Tambah Produk -->
    <div class="form-card mb-4" data-aos="fade-up">
        <div class="card-header">
            <h5 class="fw-bold mb-0" style="color: #1e293b;">
                <i class="fas fa-plus-circle me-2" style="color: #10b981;"></i>
                Tambah Produk Baru
            </h5>
        </div>
        <form action="<?= base_url('admin/add_product') ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-tag me-1" style="color: #1a56db;"></i>
                        Nama Produk
                    </label>
                    <input type="text" name="name" class="form-control-modern w-100" 
                           placeholder="Contoh: Sony A7IV Camera" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-money-bill-wave me-1" style="color: #1a56db;"></i>
                        Harga per Hari (Rp)
                    </label>
                    <input type="number" name="price" class="form-control-modern w-100" 
                           placeholder="250000" required>
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label-modern">
                        <i class="fas fa-image me-1" style="color: #1a56db;"></i>
                        Gambar Produk
                    </label>
                    <input type="file" name="image" class="form-control-modern w-100" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                </div>
            </div>
            <button type="submit" class="btn-gradient">
                <i class="fas fa-upload me-2"></i>
                Tambah Produk
            </button>
        </form>
    </div>

    <!-- Daftar Produk -->
    <div class="table-modern" data-aos="fade-up">
        <div class="p-3 bg-white" style="border-bottom: 1px solid #f1f5f9;">
            <div>
                <i class="fas fa-list me-2" style="color: #1a56db;"></i>
                <span class="fw-semibold">Daftar Equipment</span>
                <span class="badge bg-light text-muted ms-2 rounded-pill"><?= count($products) ?> items</span>
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-1"></i> ID</th>
                        <th><i class="fas fa-image me-1"></i> Gambar</th>
                        <th><i class="fas fa-tag me-1"></i> Nama Produk</th>
                        <th><i class="fas fa-money-bill-wave me-1"></i> Harga/Hari</th>
                        <th><i class="fas fa-cog me-1"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($products)): ?>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td><span class="fw-bold" style="color: #1a56db;">#<?= str_pad($product->id, 3, '0', STR_PAD_LEFT) ?></span></td>
                            <td>
                                <?php if(!empty($product->image_url) && file_exists($product->image_url)): ?>
                                <img src="<?= base_url($product->image_url) ?>" 
                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 12px;" 
                                     alt="<?= $product->name ?>">
                                <?php else: ?>
                                <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                    <i class="fas fa-image"></i>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-semibold"><?= $product->name ?></td>
                            <td class="fw-semibold" style="color: #10b981;">Rp <?= number_format($product->price_per_day, 0, ',', '.') ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- ========== TOMBOL EDIT ELEGAN ========== -->
                                    <a href="<?= base_url('admin/edit_product/' . $product->id) ?>" 
                                       class="btn-edit-soft">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <!-- ========== TOMBOL HAPUS ========== -->
                                    <button onclick="deleteProduct(<?= $product->id ?>)" class="btn-danger-soft">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
                                <p class="text-muted">Belum ada produk</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* ============================================
   TOMBOL EDIT - ELEGAN DENGAN ANIMASI
   ============================================ */
.btn-edit-soft {
    background: rgba(245, 158, 11, 0.12);
    color: #d97706;
    border: none;
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
}

.btn-edit-soft:hover {
    background: #f59e0b;
    color: white;
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
}

.btn-edit-soft:active {
    transform: scale(0.95);
}

/* ============================================
   TOMBOL HAPUS - YANG SUDAH ADA (DIPERTAHANKAN)
   ============================================ */
.btn-danger-soft {
    background: rgba(239, 68, 68, 0.08);
    color: #ef4444;
    border: none;
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
}

.btn-danger-soft:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
}

.btn-danger-soft:active {
    transform: scale(0.95);
}
</style>

<script>
function deleteProduct(id) {
    if(confirm('Yakin ingin menghapus produk ini? Data yang dihapus tidak dapat dikembalikan.')) {
        window.location.href = '<?= base_url("admin/delete_product/") ?>' + id;
    }
}
</script>
