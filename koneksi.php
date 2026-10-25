<?php
$host     = 'localhost';
$dbname   = 'db_dapur_hulonthalo';
$username = 'root';
$password = '';

try {
    // Membuat koneksi PDO ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Mengatur mode error PDO agar menampilkan exception jika ada masalah
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode ke associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Tampilkan pesan jika koneksi gagal
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>