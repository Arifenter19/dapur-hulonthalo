<?php
require_once 'koneksi.php';

// Ambil data produk beserta nama kategorinya
$query = "SELECT products.*, categories.nama_kategori 
          FROM products 
          LEFT JOIN categories ON products.category_id = categories.id 
          ORDER BY products.id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk - Dapur Hulonthalo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5EBDD;
            color: #29483A;
            margin: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        h1 { color: #29483A; margin: 0; }
        .btn-tambah {
            background-color: #29483A;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn-kategori {
            background-color: #B77A4B;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-right: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }
        th { background-color: #29483A; color: #ffffff; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .harga { color: #B77A4B; font-weight: bold; }
        .btn-edit {
            background-color: #B77A4B;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
        }
        .btn-hapus {
            background-color: #d9534f;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-flex">
        <div>
            <h1>Daftar Produk Dapur Hulonthalo</h1>
            <p style="margin: 5px 0 0 0;">Kelola produk kue tradisional dan kue kering Gorontalo.</p>
        </div>
        <div>
            <a href="kategori.php" class="btn-kategori">Kelola Kategori</a>
            <a href="tambah_produk.php" class="btn-tambah">+ Tambah Produk</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th style="width: 140px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php $no = 1; foreach ($products as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= htmlspecialchars($row['nama_produk']); ?></strong></td>
                        <td><?= htmlspecialchars($row['nama_kategori'] ?? 'Tanpa Kategori'); ?></td>
                        <td class="harga">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td style="text-align: center;">
                            <a href="edit_produk.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="hapus_produk.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data produk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>