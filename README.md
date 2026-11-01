# LuxRent - Sistem Penyewaan Peralatan Multimedia & Fotografi

LuxRent adalah aplikasi web penyewaan peralatan kamera dan multimedia (kamera, lensa, aksesori, smartphone, dan sejenisnya). Pelanggan dapat melihat katalog, memilih alat, lalu mengirim pesanan sewa. Admin mengelola produk dan memantau pesanan lewat dashboard.

Dibangun dengan **PHP** dan framework **CodeIgniter 3**, menggunakan database **MySQL** dan antarmuka **Bootstrap 5**.

## Fitur

### Pengunjung dan Pelanggan
- Halaman beranda dengan katalog produk (gambar, nama, dan harga sewa per hari)
- Form booking: pilih produk, isi data diri, durasi sewa, dan tanggal mulai
- Total harga dihitung otomatis dari harga per hari dan durasi
- Pesanan tersimpan dengan status awal **Menunggu**

### Admin
- Login dengan pembagian peran (admin dan user)
- Dashboard ringkasan: total pesanan, total pendapatan, pesanan hari ini, dan jumlah produk
- Daftar semua pesanan beserta data pelanggan
- Ubah status pesanan langsung dari tabel tanpa memuat ulang halaman (AJAX): Menunggu, Dikonfirmasi, Selesai
- Ekspor laporan pesanan ke file **CSV** (kompatibel dengan Excel)
- Kelola produk (CRUD): tambah, ubah, dan hapus produk, termasuk unggah gambar
- Validasi unggahan gambar: harus berupa gambar, maksimal 2 MB, format JPG, JPEG, PNG, GIF, atau WEBP
- Pratinjau gambar sebelum diunggah

## Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Bahasa | PHP |
| Framework | CodeIgniter 3 (pola MVC) |
| Database | MySQL / MariaDB (driver `mysqli`) |
| Front-end | Bootstrap 5.3, Font Awesome 6.5, AOS (animasi scroll) |
| Web server | Apache dengan `mod_rewrite` (tersedia `.htaccess`) |

## Struktur Proyek

```
.
├── application/
│   ├── config/          # config.php, database.php, routes.php, autoload.php
│   ├── controllers/
│   │   ├── Home.php     # Beranda dan katalog produk
│   │   ├── Booking.php  # Form dan proses pemesanan
│   │   ├── Auth.php     # Login dan logout
│   │   └── Admin.php    # Dashboard, produk, pesanan, ekspor CSV
│   ├── models/
│   │   ├── Product_model.php
│   │   └── Order_model.php
│   └── views/
│       ├── templates/   # header dan footer
│       ├── home/        # Halaman beranda
│       ├── booking/     # Halaman pemesanan
│       ├── auth/        # Halaman login
│       └── admin/       # Dashboard, daftar produk, edit produk
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── system/              # Inti framework CodeIgniter
├── uploads/             # Gambar produk yang diunggah
├── index.php            # Front controller
└── .htaccess            # URL rewriting
```

## Rute Utama

| URL | Fungsi | Akses |
|-----|--------|-------|
| `/` | Beranda dan katalog | Publik |
| `/booking` | Form pemesanan | Publik |
| `/auth` | Halaman login | Publik |
| `/auth/logout` | Keluar | Login |
| `/admin` | Dashboard dan daftar pesanan | Admin |
| `/admin/products` | Kelola produk | Admin |
| `/admin/export_data` | Unduh laporan pesanan (CSV) | Admin |

## Instalasi

### Prasyarat
- PHP 7.4 atau lebih baru (direkomendasikan; CodeIgniter 3 juga mendukung versi lebih lama)
- MySQL atau MariaDB
- Apache dengan `mod_rewrite` aktif (misalnya lewat XAMPP atau Laragon)

### Langkah

1. **Salin proyek** ke folder web server, misalnya `htdocs/rentalgear_ci` pada XAMPP.

   ```bash
   git clone https://github.com/<username>/rental-project.git rentalgear_ci
   ```

2. **Buat database** bernama `rental_db`, lalu buat tabel berikut (lihat bagian Skema Database di bawah).

3. **Atur koneksi database** di `application/config/database.php`:

   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',          // isi sesuai password MySQL kamu
   'database' => 'rental_db',
   ```

4. **Atur base URL** di `application/config/config.php` agar sesuai dengan nama folder:

   ```php
   $config['base_url'] = 'http://localhost/rentalgear_ci/';
   ```

5. **Pastikan folder `uploads/` dapat ditulis** oleh web server (di Linux: `chmod -R 775 uploads`).

6. **Jalankan** Apache dan MySQL, lalu buka `http://localhost/rentalgear_ci/` di browser.

## Skema Database

Skema di bawah disusun dari kolom yang dipakai oleh kode (model dan controller). Sesuaikan tipe data jika perlu.

```sql
CREATE DATABASE IF NOT EXISTS rental_db;
USE rental_db;

CREATE TABLE products (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(150) NOT NULL,
    price_per_day DECIMAL(12,2) NOT NULL,
    image_url     VARCHAR(255)
);

CREATE TABLE orders (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    product_id     INT NOT NULL,
    customer_name  VARCHAR(150) NOT NULL,
    customer_email VARCHAR(150),
    customer_phone VARCHAR(30) NOT NULL,
    days           INT NOT NULL,
    start_date     DATE NOT NULL,
    total_price    DECIMAL(14,2) NOT NULL,
    status         ENUM('pending','confirmed','completed') DEFAULT 'pending',
    order_date     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

## Penggunaan

1. Buka `/auth` dan login. Akun disimpan langsung di `application/controllers/Auth.php` (satu akun admin dan satu akun user biasa).
2. Sebagai **admin**, kamu diarahkan ke dashboard. Tambahkan produk lewat menu kelola produk, lengkap dengan gambar dan harga per hari.
3. Pelanggan membuka `/booking`, memilih produk, mengisi data, dan mengirim pesanan.
4. Admin melihat pesanan di dashboard, mengubah statusnya, dan mengunduh laporan CSV bila diperlukan.

## Catatan Keamanan

Proyek ini dibuat untuk keperluan pembelajaran. Sebelum dipakai di lingkungan produksi, perhatikan hal berikut:

- Akun login masih ditulis langsung (*hardcode*) di `Auth.php`. Gunakan tabel pengguna dengan password ter-hash (`password_hash`).
- Jangan menyimpan password database asli di repositori publik. Pakai kredensial lokal yang tidak di-commit.
- Hapus `upload_test.php` pada deployment, karena itu hanya berkas uji unggahan.
- Aktifkan proteksi CSRF dan isi `encryption_key` pada `application/config/config.php`.
- Pertimbangkan hitung ulang total harga di sisi server, bukan hanya mengandalkan nilai dari form.

## Pengembangan Selanjutnya

- Sistem registrasi dan manajemen pengguna berbasis database
- Pengecekan ketersediaan alat pada rentang tanggal tertentu
- Notifikasi pesanan lewat email atau WhatsApp
- Integrasi pembayaran online
- Pencarian dan filter kategori pada katalog

## Lisensi

Framework CodeIgniter dirilis dengan lisensi MIT (lihat `license.txt`). Untuk kode aplikasi LuxRent, tambahkan lisensi sesuai kebutuhan.

## Pembuat

Dikembangkan oleh **Wendy** sebagai proyek pembelajaran.
