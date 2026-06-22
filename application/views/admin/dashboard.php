<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
        <div>
            <span class="section-badge"><i class="fas fa-chart-pie me-1"></i> Dashboard</span>
            <h2 class="section-title mt-2">Selamat Datang, Administrator!</h2>
            <p class="text-muted">Kelola semua pemesanan dan equipment di sini</p>
        </div>
        <button onclick="window.location.reload()" class="btn-gradient-outline">
            <i class="fas fa-sync-alt me-1"></i> Refresh
        </button>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-number"><?= $total_orders ?></div>
                        <small class="text-muted">Semua waktu</small>
                    </div>
                    <div class="stat-icon blue"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Pendapatan</div>
                        <div class="stat-number" style="color: #10b981;">Rp <?= number_format($total_revenue, 0, ',', '.') ?></div>
                        <small class="text-muted">Dari semua pesanan</small>
                    </div>
                    <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Pesanan Hari Ini</div>
                        <div class="stat-number" style="color: #f59e0b;"><?= $today_orders ?></div>
                        <small class="text-muted"><?= date('d M Y') ?></small>
                    </div>
                    <div class="stat-icon orange"><i class="fas fa-calendar-day"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card" onclick="window.location.href='<?= base_url('admin/products') ?>'" style="cursor: pointer;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-number" style="color: #8b5cf6;"><?= $total_products ?></div>
                        <small class="text-muted">Equipment tersedia</small>
                    </div>
                    <div class="stat-icon purple"><i class="fas fa-camera"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4" data-aos="fade-up">
        <div class="col-md-4">
            <div class="stat-card" onclick="window.location.href='<?= base_url('admin/products') ?>'" style="cursor: pointer;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-plus-circle me-2" style="color: #10b981;"></i>
                        <span class="fw-semibold">Tambah Produk Baru</span>
                    </div>
                    <i class="fas fa-chevron-right text-muted"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- ========== EKSPOR DATA (SUDAH AKTIF) ========== -->
            <a href="<?= base_url('admin/export_data') ?>" style="text-decoration: none; color: inherit;">
                <div class="stat-card" style="cursor: pointer;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-file-export me-2" style="color: #1a56db;"></i>
                            <span class="fw-semibold">Ekspor Data</span>
                        </div>
                        <i class="fas fa-chevron-right text-muted"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-bell me-2" style="color: #f59e0b;"></i>
                        <span class="fw-semibold">Notifikasi</span>
                    </div>
                    <i class="fas fa-chevron-right text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <div data-aos="fade-up">
        <div class="table-modern">
            <div class="d-flex justify-content-between align-items-center p-3 bg-white" style="border-bottom: 1px solid #f1f5f9;">
                <div>
                    <i class="fas fa-table-list me-2" style="color: #1a56db;"></i>
                    <span class="fw-semibold">Daftar Pemesanan</span>
                    <span class="badge bg-light text-muted ms-2 rounded-pill"><?= $total_orders ?> items</span>
                </div>
                <div>
                    <input type="text" id="searchInput" class="form-control-modern" 
                           placeholder="Cari pesanan..." style="padding: 8px 16px; width: 200px;">
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-1"></i> ID</th>
                            <th><i class="fas fa-user me-1"></i> Pelanggan</th>
                            <th><i class="fas fa-camera me-1"></i> Produk</th>
                            <th><i class="fas fa-clock me-1"></i> Durasi</th>
                            <th><i class="fas fa-tag me-1"></i> Total</th>
                            <th><i class="fas fa-calendar me-1"></i> Tanggal</th>
                            <th><i class="fas fa-chart-line me-1"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable">
                        <?php if(!empty($orders)): ?>
                            <?php foreach($orders as $order): ?>
                            <tr>
                                <td><span class="fw-bold" style="color: #1a56db;">#<?= str_pad($order->id, 4, '0', STR_PAD_LEFT) ?></span></td>
                                <td>
                                    <div class="fw-semibold"><?= $order->customer_name ?></div>
                                    <?php if($order->customer_phone): ?>
                                    <small class="text-muted"><?= $order->customer_phone ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><?= $order->product_name ?></td>
                                <td><?= $order->days ?> hari</td>
                                <td class="fw-semibold" style="color: #10b981;">Rp <?= number_format($order->total_price, 0, ',', '.') ?></td>
                                <td><?= date('d M Y', strtotime($order->order_date)) ?></td>
                                <td>
                                    <select onchange="updateStatus(<?= $order->id ?>, this.value)" 
                                            class="badge-status border-0 <?= $order->status == 'pending' ? 'badge-pending' : ($order->status == 'confirmed' ? 'badge-confirmed' : 'badge-completed') ?>">
                                        <option value="pending" <?= $order->status == 'pending' ? 'selected' : '' ?>>⏳ Menunggu</option>
                                        <option value="confirmed" <?= $order->status == 'confirmed' ? 'selected' : '' ?>>✅ Dikonfirmasi</option>
                                        <option value="completed" <?= $order->status == 'completed' ? 'selected' : '' ?>>🎉 Selesai</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada pemesanan</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="p-3 bg-white d-flex justify-content-between" style="border-top: 1px solid #f1f5f9;">
                <small class="text-muted">
                    <i class="fas fa-database me-1"></i>
                    Menampilkan <?= count($orders) ?> dari <?= $total_orders ?> data
                </small>
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>
                    Terakhir diperbarui: <?= date('H:i:s') ?>
                </small>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput')?.addEventListener('keyup', function() {
    let searchValue = this.value.toLowerCase();
    let rows = document.querySelectorAll('#ordersTable tr');
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});

function updateStatus(orderId, newStatus) {
    fetch('<?= base_url("admin/update_status") ?>', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + orderId + '&status=' + newStatus
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'success') location.reload();
        else alert('Gagal mengupdate status');
    })
    .catch(() => alert('Terjadi kesalahan'));
}
</script>
