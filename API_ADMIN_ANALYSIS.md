# 📊 ANALISIS ENDPOINT & API ADMIN - BACKEND FLUTTER

> **Tanggal Analisis:** 3 Desember 2025  
> **Project:** E-Pinggirpapas-Sumenep  
> **Backend:** Laravel (Herd)  
> **Frontend Target:** Flutter  

---

## 🎯 RINGKASAN EKSEKUTIF

### ✅ SUDAH ADA (LENGKAP):
1. **Authentication API** - ✅ Lengkap (User & Admin)
2. **Produk API (Public)** - ✅ Lengkap
3. **Virtual Tour API (Public)** - ✅ Lengkap
4. **Content API (Public)** - ✅ Lengkap
5. **Pemesanan API (User)** - ✅ Lengkap
6. **Admin Authentication API** - ✅ Lengkap
7. **Admin User Management API** - ✅ Lengkap
8. **Admin Order Management API** - ✅ Lengkap
9. **Admin Statistics API** - ✅ Lengkap

### ❌ BELUM ADA (BUTUH DIBUAT):
1. **Admin Product Management API** - ❌ Controller tidak ditemukan
2. **Admin Content Management API** - ❌ Controller tidak ditemukan
3. **Admin Virtual Tour Management API** - ❌ Controller tidak ditemukan
4. **Admin Category Management API** - ❌ Controller tidak ditemukan
5. **Admin Export/Backup API** - ⚠️ Parsial (perlu penyempurnaan)

---

## 📋 DETAIL ENDPOINT API

### 1️⃣ **AUTHENTICATION API (USER)** ✅

**Base URL:** `/api/auth`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| POST | `/auth/register` | ✅ | Register user baru |
| POST | `/auth/login` | ✅ | Login user |
| GET | `/auth/me` | ✅ | Get user profile (auth) |
| POST | `/auth/logout` | ✅ | Logout user (auth) |

**Controller:** `AuthApiController.php` ✅  
**Model:** `User.php` ✅  

---

### 2️⃣ **ADMIN AUTHENTICATION API** ✅

**Base URL:** `/api/admin`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| POST | `/admin/login` | ✅ | Login khusus admin |
| POST | `/admin/logout` | ✅ | Logout admin (auth) |
| GET | `/admin/me` | ✅ | Get admin profile (auth) |

**Controller:** `AdminAuthController.php` ✅  
**Middleware:** `auth:sanctum, admin` ✅  

**Request Login:**
```json
{
  "email": "admin@epinggirpapas.com",
  "password": "admin123",
  "device_name": "flutter_app"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@epinggirpapas.com",
      "role": "admin"
    },
    "token": "1|xxxxxxxxxxx"
  }
}
```

---

### 3️⃣ **PRODUK API (PUBLIC)** ✅

**Base URL:** `/api/produk`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/produk` | ✅ | List semua produk (paginated) |
| GET | `/produk/{id}` | ✅ | Detail produk |

**Controller:** `ProdukApiController.php` ✅  
**Model:** `Kuliner.php` ✅  

**Query Parameters:**
- `per_page` - Jumlah item per halaman (default: 12)

---

### 4️⃣ **VIRTUAL TOUR API (PUBLIC)** ✅

**Base URL:** `/api/virtual-tour`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/virtual-tour` | ✅ | List virtual tours (paginated) |
| GET | `/virtual-tour/{id}` | ✅ | Detail virtual tour |

**Controller:** `VirtualTourApiController.php` ✅  
**Model:** `Virtual.php` ✅  

---

### 5️⃣ **CONTENT API (PUBLIC)** ✅

**Base URL:** `/api/content`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/content/about` | ✅ | Tentang Kami |
| GET | `/content/blue-economy` | ✅ | Blue Economy |
| GET | `/content/gfk` | ✅ | Garam Fortifikasi Kelor |

**Controller:** `ContentApiController.php` ✅  

---

### 6️⃣ **PEMESANAN API (USER)** ✅

**Base URL:** `/api/pemesanan`

| Method | Endpoint | Status | Middleware | Keterangan |
|--------|----------|--------|------------|-----------|
| POST | `/pemesanan` | ✅ | auth:sanctum | Buat pesanan baru |
| GET | `/pemesanan` | ✅ | auth:sanctum | List pesanan user |
| GET | `/pemesanan/track/{nomor}` | ✅ | public | Track pesanan by nomor |

**Controller:** `PemesananApiController.php` ✅  
**Model:** `Pemesanan.php` ✅  

**Request Body (Create Order):**
```json
{
  "produk_id": 1,
  "qty": 5,
  "alamat_pengiriman": "Jl. Contoh No. 123",
  "catatan": "Kirim pagi"
}
```

---

### 7️⃣ **ADMIN USER MANAGEMENT API** ✅

**Base URL:** `/api/admin/users`  
**Middleware:** `auth:sanctum, role:admin`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/admin/users` | ✅ | List semua user (paginated) |
| POST | `/admin/users` | ✅ | Create user baru |
| GET | `/admin/users/{id}` | ✅ | Detail user |
| PUT/PATCH | `/admin/users/{id}` | ✅ | Update user |
| DELETE | `/admin/users/{id}` | ✅ | Delete user |

**Controller:** `AdminApiController.php` ✅  

---

### 8️⃣ **ADMIN ORDER MANAGEMENT API** ✅

**Base URL:** `/api/admin/orders`  
**Middleware:** `auth:sanctum, role:admin`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/admin/orders` | ✅ | List semua pesanan (filter, paginated) |
| GET | `/admin/orders/{id}` | ✅ | Detail pesanan |
| PUT | `/admin/orders/{id}/status` | ✅ | Update status pesanan |

**Controller:** `AdminApiController.php` ✅  

**Query Parameters (Filter):**
- `status` - Filter by status (menunggu, diproses, dikirim, selesai, dibatalkan)
- `start_date` - Tanggal mulai
- `end_date` - Tanggal akhir

**Status Values:**
- `menunggu` - Pending
- `diproses` - Processing
- `dikirim` - Shipped
- `selesai` - Delivered
- `dibatalkan` - Cancelled

---

### 9️⃣ **ADMIN STATISTICS API** ✅

**Base URL:** `/api/admin/statistics`  
**Middleware:** `auth:sanctum, role:admin`

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| GET | `/admin/statistics` | ✅ | Dashboard statistics |

**Response:**
```json
{
  "success": true,
  "data": {
    "total_orders": 150,
    "pending_orders": 10,
    "completed_orders": 100,
    "total_products": 25,
    "total_virtual_tours": 8,
    "total_users": 200,
    "revenue_this_month": 15000000,
    "revenue_chart": [
      {"month": "Jun 2025", "total": 5000000},
      {"month": "Jul 2025", "total": 7000000}
    ]
  }
}
```

---

## ❌ ENDPOINT YANG BELUM ADA

### 🔴 1. **ADMIN PRODUCT MANAGEMENT API**

**Base URL:** `/api/admin/products`  
**Status:** ❌ BELUM ADA

Controller yang **dipanggil di routes tapi TIDAK DITEMUKAN:**
- `AdminProductController.php` (line 60 di routes/api.php)
- `AdminProductApiController.php` (line 116 di routes/api.php)

**Endpoint yang Dibutuhkan:**

| Method | Endpoint | Keterangan |
|--------|----------|-----------|
| GET | `/admin/products` | List semua produk |
| POST | `/admin/products` | Create produk baru |
| GET | `/admin/products/{id}` | Detail produk |
| PUT/PATCH | `/admin/products/{id}` | Update produk |
| DELETE | `/admin/products/{id}` | Delete produk |
| POST | `/admin/products/{id}/upload-image` | Upload gambar produk |

---

### 🔴 2. **ADMIN CONTENT MANAGEMENT API**

**Base URL:** `/api/admin/contents`  
**Status:** ❌ BELUM ADA

Controller yang **dipanggil di routes tapi TIDAK DITEMUKAN:**
- `AdminContentApiController.php` (line 127 di routes/api.php)

**Endpoint yang Dibutuhkan:**

| Method | Endpoint | Keterangan |
|--------|----------|-----------|
| GET | `/admin/contents` | List semua content |
| POST | `/admin/contents` | Create content baru |
| GET | `/admin/contents/{id}` | Detail content |
| PUT/PATCH | `/admin/contents/{id}` | Update content |
| DELETE | `/admin/contents/{id}` | Delete content |

**Content Types:**
- `about` - Tentang Kami
- `blue_economy` - Blue Economy
- `gfk` - GFK Info

---

### 🔴 3. **ADMIN VIRTUAL TOUR MANAGEMENT API**

**Base URL:** `/api/admin/virtual-tours`  
**Status:** ❌ BELUM ADA

Controller yang **dipanggil di routes tapi TIDAK DITEMUKAN:**
- `AdminVirtualTourApiController.php` (line 130 di routes/api.php)

**Endpoint yang Dibutuhkan:**

| Method | Endpoint | Keterangan |
|--------|----------|-----------|
| GET | `/admin/virtual-tours` | List semua virtual tours |
| POST | `/admin/virtual-tours` | Create virtual tour baru |
| GET | `/admin/virtual-tours/{id}` | Detail virtual tour |
| PUT/PATCH | `/admin/virtual-tours/{id}` | Update virtual tour |
| DELETE | `/admin/virtual-tours/{id}` | Delete virtual tour |

---

### ⚠️ 4. **ADMIN EXPORT & BACKUP API**

**Status:** ⚠️ PARSIAL (Ada tapi perlu perbaikan)

| Method | Endpoint | Status | Keterangan |
|--------|----------|--------|-----------|
| POST | `/admin/export/orders` | ⚠️ | Export orders (perlu library Excel) |
| POST | `/admin/backup/database` | ⚠️ | Backup DB (perlu penyesuaian) |

**Masalah:**
- Export belum implementasi library Excel (maatwebsite/excel)
- Backup database butuh penyesuaian untuk Windows/Herd

---

## 🔧 MIDDLEWARE & SECURITY

### Middleware yang Digunakan:

1. **`auth:sanctum`** - Laravel Sanctum token authentication ✅
2. **`admin`** - Custom middleware untuk cek role admin ✅
3. **`role:admin`** - Alias untuk admin middleware ✅

### File Middleware:
- `app/Http/Middleware/AdminMiddleware.php` ✅

---

## 📦 MODEL & DATABASE

### Models yang Digunakan:

| Model | File | Status | Table |
|-------|------|--------|-------|
| User | User.php | ✅ | users |
| Pemesanan | Pemesanan.php | ✅ | pemesanans |
| Kuliner | Kuliner.php | ✅ | kuliners |
| Virtual | Virtual.php | ✅ | virtuals |
| Produk | Produk.php | ✅ | produks |
| About | About.php | ✅ | abouts |
| Document | Document.php | ✅ | documents |
| Pengurus | Pengurus.php | ✅ | pengurus |
| Post | Post.php | ✅ | posts |
| Category | Category.php | ✅ | categories |

---

## 🎯 AKSI YANG DIPERLUKAN

### 🔴 PRIORITAS TINGGI:

1. **Buat AdminProductApiController.php**
   - CRUD produk lengkap
   - Upload gambar produk
   - Validasi input

2. **Buat AdminContentApiController.php**
   - CRUD content
   - Manage About, Blue Economy, GFK

3. **Buat AdminVirtualTourApiController.php**
   - CRUD virtual tours
   - Upload thumbnail
   - Validasi link YouTube

### 🟡 PRIORITAS SEDANG:

4. **Perbaiki Export Orders**
   - Install `maatwebsite/excel`
   - Implementasi export Excel/CSV

5. **Perbaiki Backup Database**
   - Sesuaikan untuk Windows/Herd
   - Atau gunakan package Laravel Backup

### 🟢 OPTIONAL (ENHANCEMENT):

6. **Tambahkan Pagination Meta**
   - Standardisasi response pagination
   - Total pages, current page, dll

7. **Tambahkan Search & Filter**
   - Search produk by nama
   - Filter produk by kategori

8. **Tambahkan Image Upload Helper**
   - Resize dan optimize gambar
   - Generate thumbnail

9. **Tambahkan API Versioning**
   - `/api/v1/...`
   - Future-proof untuk update

---

## 📝 CATATAN UNTUK FLUTTER DEVELOPER

### Headers yang Dibutuhkan:

```dart
// Untuk endpoint public
headers: {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
}

// Untuk endpoint yang butuh auth
headers: {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
  'Authorization': 'Bearer $token',
}
```

### Base URL (Lokal):
```
http://wisatalembung.test/api
```

### Base URL (Production):
```
https://kugar.e-pinggirpapas-sumenep.com/api
```

### Standard Response Format:

**Success:**
```json
{
  "success": true,
  "data": {...},
  "message": "Optional message"
}
```

**Error:**
```json
{
  "success": false,
  "message": "Error message",
  "errors": {...}
}
```

### Pagination Response:
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "first_page_url": "...",
    "last_page": 5,
    "per_page": 15,
    "total": 75
  }
}
```

---

## 🚀 LANGKAH SELANJUTNYA

1. ✅ Analisis selesai
2. 🔄 Buat controller yang hilang
3. 🔄 Test semua endpoint
4. 📖 Dokumentasi Postman/Swagger
5. 🎨 Implementasi di Flutter

---

**Dibuat oleh:** Cascade AI Assistant  
**Versi:** 1.0  
**Last Update:** 3 Desember 2025
