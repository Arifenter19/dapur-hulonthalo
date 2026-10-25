<?php
require_once 'koneksi.php';

$error = '';
$sukses = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_kategori'])) {
    $nama_kategori = trim($_POST['nama_kategori'] ?? '');

    if (empty($nama_kategori)) {
        $error = 'Nama kategori tidak boleh kosong!';
    } else {
        $stmt = $pdo->prepare("INSERT INTO categories (nama_kategori) VALUES (:nama_kategori)");
        $stmt->execute([':nama_kategori' => $nama_kategori]);
        $sukses = 'Kategori baru berhasil ditambahkan!';
    }
}

$stmt = $pdo->query("SELECT * FROM categories ORDER BY id DESC");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori - Dapur Hulonthalo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #F5EBDD; color: #29483A; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #29483A; margin-top: 10px; }
        .nav { margin-bottom: 20px; }
        .nav a { color: #29483A; text-decoration: none; font-weight: bold; }
        .form-group { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-simpan { background-color: #29483A; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #e0e0e0; padding: 10px; text-align: left; }
        th { background-color: #29483A; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .alert-sukses { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .btn-edit { background-color: #B77A4B; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 12px; }
        .btn-hapus { background-color: #d9534f; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 12px; margin-left: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div class="nav">
        <a href="admin.php">← Kembali ke Kelola Produk</a>
    </div>

    <h1>Kelola Kategori Produk</h1>
    <p>Tambah, edit, dan lihat kategori kue Dapur Hulonthalo.</p>

    <?php if ($error): ?><div class="alert-error"><?= htmlspecialchars($error); ?></div><?php endif; ?>
    <?php if ($sukses): ?><div class="alert-sukses"><?= htmlspecialchars($sukses); ?></div><?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="nama_kategori" placeholder="Nama Kategori Baru" required>
            <button type="submit" name="tambah_kategori" class="btn-simpan">+ Tambah Kategori</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Kategori</th>
                <th style="width: 130px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categories) > 0): ?>
                <?php $no = 1; foreach ($categories as $cat): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= htmlspecialchars($cat['nama_kategori']); ?></strong></td>
                        <td style="text-align: center;">
                            <a href="edit_kategori.php?id=<?= $cat['id']; ?>" class="btn-edit">Edit</a>
                            <a href="hapus_kategori.php?id=<?= $cat['id']; ?>" class="btn-hapus" onclick="return confirm('Menghapus kategori akan mengosongkan kategori pada produk terkait. Yakin?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Belum ada kategori.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>