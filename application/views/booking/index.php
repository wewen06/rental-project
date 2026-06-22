<!-- HERO BOOKING -->
<section class="hero-modern">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <span class="section-badge" style="background: rgba(255,255,255,0.15); color: #fcd34d;">
                    <i class="fas fa-file-signature me-1"></i> Booking
                </span>
                <h1 class="hero-title mt-3">
                    Lengkapi <span class="highlight">Pemesanan</span> Anda
                </h1>
                <p class="hero-subtitle mx-auto">
                    Isi formulir di bawah untuk menyelesaikan pemesanan equipment pilihan Anda
                </p>
            </div>
        </div>
    </div>
    <div class="hero-wave"></div>
</section>

<!-- BOOKING FORM -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="form-card">
                    <div class="card-header">
                        <h4 class="fw-bold mb-0" style="color: #1e293b;">
                            <i class="fas fa-edit me-2" style="color: #1a56db;"></i>
                            Form Pemesanan
                        </h4>
                        <p class="text-muted small mt-1">Isi data diri dan detail sewa dengan lengkap</p>
                    </div>
                    
                    <form action="<?= base_url('booking/process') ?>" method="POST">
                        <input type="hidden" name="product_id" id="product_id">
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Pilih Equipment -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-camera me-1" style="color: #1a56db;"></i>
                                        Pilih Equipment
                                    </label>
                                    <select id="product_select" class="form-control-modern w-100" onchange="pilihBarangDariSelect(this)">
                                        <option value="">-- Pilih Equipment --</option>
                                        <?php if(!empty($products)): ?>
                                            <?php foreach($products as $product): ?>
                                            <option value="<?= $product->id ?>" 
                                                    data-name="<?= $product->name ?>" 
                                                    data-price="<?= $product->price_per_day ?>"
                                                    <?= (isset($selected_product) && $selected_product && $selected_product->id == $product->id) ? 'selected' : '' ?>>
                                                <?= $product->name ?> - Rp <?= number_format($product->price_per_day, 0, ',', '.') ?>/hari
                                            </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                
                                <!-- Detail Equipment -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-info-circle me-1" style="color: #1a56db;"></i>
                                        Detail Equipment
                                    </label>
                                    <input type="text" id="product_name" class="form-control-modern w-100 bg-light" 
                                           placeholder="Equipment yang dipilih" readonly>
                                </div>
                                
                                <!-- Nama Lengkap -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-user me-1" style="color: #1a56db;"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="customer_name" class="form-control-modern w-100" 
                                           placeholder="Masukkan nama lengkap Anda" required>
                                </div>
                                
                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-envelope me-1" style="color: #1a56db;"></i>
                                        Email
                                    </label>
                                    <input type="email" name="customer_email" class="form-control-modern w-100" 
                                           placeholder="contoh@email.com">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <!-- No. Telepon -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-phone me-1" style="color: #1a56db;"></i>
                                        No. Telepon
                                    </label>
                                    <input type="tel" name="customer_phone" class="form-control-modern w-100" 
                                           placeholder="0812-3456-7890" required>
                                </div>
                                
                                <!-- Tanggal Mulai -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-calendar-alt me-1" style="color: #1a56db;"></i>
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="start_date" class="form-control-modern w-100" required>
                                </div>
                                
                                <!-- Durasi Sewa -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-calendar-day me-1" style="color: #1a56db;"></i>
                                        Durasi Sewa
                                    </label>
                                    <div class="input-group">
                                        <input type="number" name="days" id="days" min="1" 
                                               class="form-control-modern" placeholder="1" required>
                                        <span class="input-group-text bg-light border-2" style="border-color: #e2e8f0; border-radius: 0 12px 12px 0;">hari</span>
                                    </div>
                                </div>
                                
                                <!-- Total Harga -->
                                <div class="mb-3">
                                    <label class="form-label-modern">
                                        <i class="fas fa-receipt me-1" style="color: #1a56db;"></i>
                                        Total Harga
                                    </label>
                                    <input type="text" id="total_display" class="form-control-modern w-100 fw-bold" 
                                           style="color: #1a56db; font-size: 1.2rem;" placeholder="Rp 0" readonly>
                                    <input type="hidden" name="total_price" id="total_price">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Detail Order -->
                        <div id="detail-order"></div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn-gradient w-100">
                                <i class="fas fa-check-circle me-2"></i>
                                Konfirmasi Booking
                            </button>
                            <p class="text-muted text-center small mt-2">
                                <i class="fas fa-lock me-1"></i> Data Anda aman dan terenkripsi
                            </p>
                        </div>
                    </form>
                </div>
                
                <!-- Informasi Penting -->
                <div class="info-box mt-4">
                    <h5 class="fw-bold mb-3" style="color: #1e293b;">
                        <i class="fas fa-info-circle me-2" style="color: #1a56db;"></i>
                        Informasi Penting
                    </h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle me-2"></i> Booking minimal 1 hari sebelumnya</li>
                        <li><i class="fas fa-truck me-2"></i> Pengambilan barang bisa di kantor kami atau delivery</li>
                        <li><i class="fas fa-money-bill-wave me-2"></i> Deposit 50% dari total harga akan dikonfirmasi via WhatsApp</li>
                        <li><i class="fas fa-clock me-2"></i> Kami akan menghubungi Anda maksimal 1x24 jam setelah booking</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let selectedPrice = 0;
let selectedProductName = '';

function pilihBarangDariSelect(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    if (selectedOption.value) {
        const id = selectedOption.value;
        const name = selectedOption.getAttribute('data-name');
        const price = parseInt(selectedOption.getAttribute('data-price'));
        
        document.getElementById('product_id').value = id;
        document.getElementById('product_name').value = name;
        selectedPrice = price;
        selectedProductName = name;
        
        hitungTotal();
    } else {
        document.getElementById('product_id').value = '';
        document.getElementById('product_name').value = '';
        selectedPrice = 0;
        document.getElementById('total_display').value = '';
        document.getElementById('total_price').value = '';
        document.getElementById('detail-order').innerHTML = '';
    }
}

function hitungTotal() {
    let days = document.getElementById('days').value;
    const detailOrderDiv = document.getElementById('detail-order');
    
    if (days > 0 && selectedPrice > 0) {
        let total = selectedPrice * parseInt(days);
        let formattedTotal = 'Rp ' + total.toLocaleString('id-ID');
        
        document.getElementById('total_display').value = formattedTotal;
        document.getElementById('total_price').value = total;
        
        detailOrderDiv.innerHTML = `
            <div class="alert" style="background: rgba(26,86,219,0.04); border: 1px solid rgba(26,86,219,0.1); border-radius: 16px; padding: 1.5rem; margin-top: 1rem;">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold" style="color: #1e293b;">${selectedProductName}</span>
                    <span style="color: #1a56db; font-weight: 600;">Rp ${selectedPrice.toLocaleString('id-ID')} x ${days} hari</span>
                </div>
                <hr style="border-color: rgba(26,86,219,0.08);">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold" style="color: #1e293b;">Total yang harus dibayar</span>
                    <span style="color: #1a56db; font-size: 1.3rem; font-weight: 700;">Rp ${total.toLocaleString('id-ID')}</span>
                </div>
                <small style="color: #94a3b8;"><i class="fas fa-info-circle me-1"></i> Deposit 50% akan dikonfirmasi setelah booking</small>
            </div>
        `;
    } else {
        document.getElementById('total_display').value = '';
        document.getElementById('total_price').value = '';
        detailOrderDiv.innerHTML = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_select');
    if (productSelect && productSelect.value) {
        pilihBarangDariSelect(productSelect);
    }
    document.getElementById('days').addEventListener('input', hitungTotal);
});
</script>
