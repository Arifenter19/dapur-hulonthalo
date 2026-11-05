awaban Cek Pemahaman & Refleksi Sprint - Dapur Hulonthalo

## A. Jawaban Cek Pemahaman

1. **Mengapa endpoint memakai kata benda, bukan kata kerja?**
   - Karena REST API berorientasi pada resource (sumber data). URL/endpoint menunjuk ke alamat sumber data (`/products`), sedangkan aksi diwakili oleh HTTP Method (`GET`, `POST`, `PUT`, `DELETE`).

2. **Apa beda status code 400, 404, dan 422?**
   - **400 Bad Request**: Kiriman data JSON rusak sintaksnya.
   - **404 Not Found**: Endpoint atau ID produk kuliner tidak ditemukan di database.
   - **422 Unprocessable Entity**: Format JSON valid, tetapi isi datanya tidak memenuhi validasi bisnis.

3. **Mengapa POST yang berhasil memakai status code 201, bukan 200?**
   - Status `201 Created` secara spesifik menginformasikan bahwa resource data baru telah berhasil dibuat di server.

4. **Apa arti stateless pada REST?**
   - *Stateless* berarti setiap request yang dikirimkan oleh klien ke server berdiri sendiri tanpa menyimpan riwayat sesi (*session*) sebelumnya di server.

---

## B. Refleksi Sprint PBL

1. **Apa yang sudah benar-benar saya pahami?**
   - Memahami arsitektur REST API berformat JSON, penggunaan HTTP Status Code, serta integrasi data API ke frontend menggunakan JavaScript `fetch()`.

2. **Bagian mana yang masih saya ikuti tanpa memahami?**
   - Penyesuaian nama kolom database SQL saat mapping data JSON ke komponen antarmuka.

3. **Bug/kesalahan apa yang muncul dan bagaimana saya memperbaikinya?**
   - *Unknown column 'c.name'*: Terjadi akibat perbedaan nama kolom tabel kategori di database. Solusinya dengan menyesuaikan query SQL menjadi `c.nama_kategori AS category_name`.

4. **Apa kontribusi saya pada sprint ini?**
   - Membangun endpoint REST API Dapur Hulonthalo, melakukan integrasi fetch katalog kuliner, serta melengkapi dokumentasi API dan refleksi sprint tugas.