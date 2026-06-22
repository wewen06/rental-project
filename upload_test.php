<?php
// ============================================
// UPLOAD TEST - TANPA CodeIgniter
// ============================================

$message = '';

// Proses upload jika ada file
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $target_dir = "uploads/";
    
    // Buat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Cek apakah file gambar
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Cek ukuran file (max 2MB)
        if ($_FILES["image"]["size"] <= 2000000) {
            // Cek format file
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $message = "✅ UPLOAD BERHASIL! File: " . basename($_FILES["image"]["name"]);
                } else {
                    $message = "❌ Gagal memindahkan file. Error: " . error_get_last()['message'];
                }
            } else {
                $message = "❌ Format file tidak didukung. Gunakan: JPG, JPEG, PNG, GIF, WEBP";
            }
        } else {
            $message = "❌ File terlalu besar. Maksimal 2MB.";
        }
    } else {
        $message = "❌ File bukan gambar.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
    <style>
        body { font-family: Arial; padding: 40px; background: #f0f2f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        input[type="file"] { padding: 10px; border: 2px dashed #ccc; border-radius: 8px; width: 100%; }
        input[type="submit"] { background: #1a56db; color: white; padding: 12px 30px; border: none; border-radius: 8px; cursor: pointer; margin-top: 10px; }
        .message { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        h2 { color: #1e293b; margin-bottom: 10px; }
        .info { background: #eff6ff; padding: 15px; border-radius: 8px; margin-top: 20px; font-size: 14px; color: #1e40af; }
        .info strong { color: #1a56db; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📤 Upload Test</h2>
        <p style="color: #64748b;">Test upload file TANPA CodeIgniter</p>
        
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'BERHASIL') !== false ? 'success' : 'error' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" required>
            <br>
            <input type="submit" value="Upload Gambar">
        </form>
        
        <div class="info">
            <strong>📁 Info:</strong><br>
            Folder uploads: <strong><?= realpath('uploads/') ?></strong><br>
            Bisa ditulis: <strong><?= is_writable('uploads/') ? '✅ Ya' : '❌ Tidak' ?></strong><br>
            Current directory: <strong><?= getcwd() ?></strong>
        </div>
    </div>
</body>
</html>
