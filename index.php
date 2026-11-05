<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Hulonthalo | Oleh-Oleh Khas Gorontalo</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5EBDD; /* Cream */
            color: #29483A; /* Hijau Tua */
        }
        header {
            background-color: #29483A;
            color: #F5EBDD;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            font-size: 24px;
        }
        header nav a {
            color: #E8C69A;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        header nav a:hover {
            color: #ffffff;
        }
        .hero {
            text-align: center;
            padding: 50px 20px;
            background-color: #E8C69A; /* Krem Keemasan */
            color: #29483A;
        }
        .hero h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .section-title {
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
            color: #29483A;
        }
        .grid-produk {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        .card-produk {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease;
        }
        .card-produk:hover {
            transform: translateY(-5px);
        }
        .card-body {
            padding: 20px;
        }
        .badge-kategori {
            display: inline-block;
            background-color: #F5EBDD;
            color: #B77A4B;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 15px;
            margin-bottom: 10px;
        }
        .nama-produk {
            font-size: 20px;
            margin-bottom: 8px;
            color: #29483A;
        }
        .deskripsi-produk {
            font-size: 14px;
            color: #555555;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        .card-footer {
            padding: 15px 20px;
            background-color: #fafafa;
            border-top: 1px solid #eeeeee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .harga-produk {
            font-size: 18px;
            font-weight: bold;
            color: #B77A4B; /* Cokelat */
        }
        .btn-pesan {
            background-color: #29483A;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
            font-weight: bold;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #29483A;
            color: #F5EBDD;
            margin-top: 50px;
        }
        footer a {
            color: #E8C69A;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <header>
        <h1>Dapur Hulonthalo</h1>
        <nav>
            <a href="#katalog">Katalog Kue</a>
            <a href="admin.php" target="_blank">Panel Admin 🔒</a>
        </nav>
    </header>

    <section class="hero">
        <h2>Cita Rasa Autentik Kue Khas Gorontalo</h2>
        <p>Nikmati kelezatan olahan kue tradisional dan kue kering berkualitas dari Dapur Hulonthalo.</p>
    </section>

    <div class="container" id="katalog">
        <h2 class="section-title">Katalog Produk Kami</h2>

        <!-- Tempat produk dimuat secara dinamis via REST API -->
        <div class="grid-produk" id="grid-produk">
            <p style="text-align: center; grid-column: 1 / -1;">Memuat data kue dari REST API...</p>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> Dapur Hulonthalo. All rights reserved. | <a href="admin.php">Kelola Website</a></p>
    </footer>

    <!-- Script JavaScript untuk mengambil data REST API -->
    <script>
        async function muatKatalogDariAPI() {
            const container = document.getElementById('grid-produk');
            try {
                const response = await fetch('api/products.php');
                const result = await response.json();

                if (response.ok && result.data && result.data.length > 0) {
                    container.innerHTML = '';
                    result.data.forEach(row => {
                        const nama = row.nama_produk || row.name || 'Produk Kue';
                        const deskripsi = row.deskripsi || row.description || '';
                        const harga = row.harga || row.price || 0;
                        const kategori = row.category_name || 'Kue Khas';
                        const hargaFormat = new Intl.NumberFormat('id-ID').format(harga);

                        const card = `
                            <div class="card-produk">
                                <div class="card-body">
                                    <span class="badge-kategori">${kategori}</span>
                                    <h3 class="nama-produk">${nama}</h3>
                                    <p class="deskripsi-produk">${deskripsi}</p>
                                </div>
                                <div class="card-footer">
                                    <span class="harga-produk">Rp ${hargaFormat}</span>
                                    <a href="#" class="btn-pesan">Pesan</a>
                                </div>
                            </div>
                        `;
                        container.innerHTML += card;
                    });
                } else {
                    container.innerHTML = '<p style="text-align: center; grid-column: 1 / -1;">Belum ada produk kue yang ditampilkan.</p>';
                }
            } catch (error) {
                console.error('Error fetching API:', error);
                container.innerHTML = '<p style="text-align: center; color: red; grid-column: 1 / -1;">Gagal memuat data produk dari API.</p>';
            }
        }

        document.addEventListener('DOMContentLoaded', muatKatalogDariAPI);
    </script>

</body>
</html>