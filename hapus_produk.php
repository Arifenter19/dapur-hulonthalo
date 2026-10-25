<?php
require_once 'koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // Hapus data produk berdasarkan ID menggunakan Prepared Statement
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// Kembali ke halaman utama setelah proses hapus selesai
header('Location: admin.php');
exit;
?>