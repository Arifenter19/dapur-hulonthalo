<?php
require_once 'koneksi.php';

$error = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: kategori.php');
    exit;
}

// Ambil data kategori berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
$stmt->execute([':id' => $id]);
$category = $stmt->fetch();

if (!$category) {
    header('Location: kategori.php');
    exit;
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = trim($_POST['nama_kategori'] ?? '');

    if (empty($nama_kategori)) {
        $error = 'Nama kategori tidak boleh kosong!';
    } else {
        $stmt_update = $pdo->prepare("UPDATE categories SET nama_kategori = :nama_kategori WHERE id = :id");
        $stmt_update->execute([
            ':nama_kategori' => $nama_kategori,
            ':id'            => $id
        ]);
        header('Location: kategori.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori - Dapur Hulonthalo</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #F5EBDD; color: #29483A; margin: 20px; }
        .container { max-width: 400px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #29483A; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-bottom: 15px; }
        .btn-simpan { background-color: #29483A; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-batal { background-color: #B77A4B; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; margin-left: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Nama Kategori</h2>
    <?php if ($error): ?><p style="color: red;"><?= htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="nama_kategori" value="<?= htmlspecialchars($category['nama_kategori']); ?>" required>
        <button type="submit" class="btn-simpan">Update</button>
        <a href="kategori.php" class="btn-batal">Batal</a>
    </form>
</div>
</body>
</html>