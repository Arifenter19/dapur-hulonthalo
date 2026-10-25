# Dapur Hulonthalo

**Website UMKM Kue Tradisional Khas Gorontalo**

## Deskripsi Proyek
Dapur Hulonthalo merupakan prototipe website UMKM yang dirancang untuk memperkenalkan kue tradisional dan kue kering khas Gorontalo. Website ini membantu pengunjung melihat informasi produk dan menghubungi penjual melalui WhatsApp.

## Tujuan
- Memperkenalkan produk kue tradisional khas Gorontalo.
- Menampilkan foto, nama, dan harga produk.
- Memudahkan pengunjung menghubungi penjual.

## Fitur Website
- Halaman Beranda.
- Katalog produk.
- Informasi tentang usaha.
- Tombol kontak WhatsApp.
- Tampilan responsif untuk berbagai ukuran layar.

## Teknologi
- HTML untuk struktur halaman.
- CSS untuk desain dan tata letak.
- Git dan GitHub untuk pengelolaan versi dan penyimpanan kode.

## Arsitektur
Pengunjung membuka website melalui browser, melihat katalog produk, kemudian dapat menghubungi penjual melalui WhatsApp. Prototipe ini belum menggunakan database atau sistem pembayaran otomatis.

## Catatan
Nama usaha dan informasi produk merupakan bagian dari prototipe tugas perkuliahan. Harga yang ditampilkan adalah contoh untuk kebutuhan demonstrasi.

## Pengembang
Mahasiswa Program Studi Teknologi Informasi

---

## Cek Pemahaman & Refleksi Sprint (Pertemuan 5)

### Cek Pemahaman
1. **Mengapa validasi HTML saja tidak cukup?**  
   Validasi HTML hanya berjalan di sisi *client* (browser) dan mudah dimatikan. Validasi PHP di sisi *server* wajib ada agar data yang masuk ke database tetap aman.
2. **Apa beda GET dan POST?**  
   GET mengirim data via URL (terlihat jelas), cocok untuk mengambil data (`edit_produk.php?id=1`). POST mengirim data secara tersembunyi di dalam *request body*, cocok untuk manipulasi database.
3. **Mengapa delete perlu konfirmasi?**  
   Untuk mencegah data terhapus secara tidak sengaja (*accidental deletion*) karena perintah hapus di database bersifat permanen.
4. **Di bagian mana aturan penyimpanan dikoordinasikan?**  
   Di sisi *backend* PHP sebelum query dieksekusi, serta dijaga oleh *Prepared Statement* PDO dan *Foreign Key* database.

### Refleksi
1. **Apa yang sudah dipahami?**  
   Alur CRUD PHP PDO, relasi tabel `products` & `categories`, serta integrasi database ke *landing page* dinamis.
2. **Kendala & Solusi:**  
   Pemisahan alur antara halaman pengunjung (`index.php`) dan halaman admin (`admin.php`), diselesaikan dengan mengatur ulang navigasi dan *redirect header*.
3. **Kontribusi:**  
   Membangun fungsi CRUD backend, merancang database MySQL, dan menyusun tampilan antarmuka web UMKM Dapur Hulonthalo.
