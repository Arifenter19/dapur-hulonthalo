<?php
require_once 'koneksi.php';

$error = '';
$id = $_GET['id'] ?? null;

// Jika tidak ada ID di URL, kembalikan ke index.php
if (!$id) {
    header('Location: admin.php');
    exit;
}

// 1. Ambil data produk berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

// Jika produk tidak ditemukan
if (!$product) {
    header('Location: admin.php');
    exit;
}

// 2. Ambil data kategori untuk pilihan dropdown
$stmt_cat = $pdo->query("SELECT * FROM categories ORDER BY nama_kategori ASC");
$categories = $stmt_cat->fetchAll();

// 3. Proses pembaruan data jika form dikirim (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = trim($_POST['nama_produk'] ?? '');
    $category_id = $_POST['category_id'] ?: null;
    $harga       = $_POST['harga'] ?? 0;
    $deskripsi   = trim($_POST['deskripsi'] ?? '');

    // Validasi input
    if (empty($nama_produk)) {
        $error = 'Nama produk tidak boleh kosong!';
    } elseif (!is_numeric($harga) || $harga < 0) {
        $error = 'Harga produk harus berupa angka bernilai positif!';
    } else {
        // Update data di database menggunakan Prepared Statement
        $sql = "UPDATE products 
                SET nama_produk = :nama_produk, 
                    category_id = :category_id, 
                    harga = :harga, 
                    deskripsi = :deskripsi 
                WHERE id = :id";
        $stmt_update = $pdo->prepare($sql);
        $stmt_update->execute([
            ':nama_produk' => $nama_produk,
            ':category_id' => $category_id,
            ':harga'       => $harga,
            ':deskripsi'   => $deskripsi,
            ':id'          => $id
        ]);

        header('Location: admin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Dapur Hulonthalo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5EBDD;
            color: #29483A;
            margin: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h2 { margin-top: 0; color: #29483A; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-simpan {
            background-color: #29483A;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-batal {
            background-color: #B77A4B;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-left: 10px;
        }
        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Produk</h2>

    <?php if ($error): ?>
        <div class="error-msg"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Nama Produk *</label>
            <input type="text" name="nama_produk" value="<?= htmlspecialchars($product['nama_produk']); ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id']; ?>" <?= ($cat['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($cat['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Harga (Rp) *</label>
            <input type="number" name="harga" value="<?= htmlspecialchars($product['harga']); ?>" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4"><?= htmlspecialchars($product['deskripsi']); ?></textarea>
        </div>

        <button type="submit" class="btn-simpan">Update Produk</button>
        <a href="admin.php" class="btn-batal">Batal</a>
    </form>
</div>

</body>
</html>