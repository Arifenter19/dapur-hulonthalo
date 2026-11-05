# Dokumentasi REST API - Dapur Hulonthalo

## 1. Rancangan Endpoint API (`/api/products.php`)

| Method | Endpoint | Deskripsi | Status Code | Body Request (JSON) |
| :--- | :--- | :--- | :--- | :--- |
| **GET** | `/api/products.php` | Ambil semua daftar kuliner | `200 OK` | Tidak ada |
| **GET** | `/api/products.php?id={id}` | Ambil detail 1 kuliner spesifik | `200 OK` / `404 Not Found` | Tidak ada |
| **POST** | `/api/products.php` | Tambah menu kuliner baru | `201 Created` / `422 Unprocessable` | `{"name": "...", "price": 30000, "category_id": 1, "description": "...", "image_url": "..."}` |
| **PUT** | `/api/products.php?id={id}` | Update menu kuliner berdasarkan ID | `200 OK` / `404` / `422` | `{"name": "...", "price": 35000, "category_id": 1, "description": "...", "image_url": "..."}` |
| **DELETE**| `/api/products.php?id={id}` | Hapus kuliner berdasarkan ID | `200 OK` / `404 Not Found` | Tidak ada |

---

## 2. Uji Coba cURL / Postman

### Tambah Produk (POST)
```bash
curl -X POST http://localhost/WEB_DAPUR_HULONTHALO/api/products.php \
  -H "Content-Type: application/json" \
  -d '{"name":"Kue Sabongi Khas Gorontalo","price":20000,"category_id":1,"description":"Kue olahan pisang khas Gorontalo","image_url":"sabongi.jpg"}'