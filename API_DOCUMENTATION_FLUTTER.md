# 📚 API ENDPOINT DOCUMENTATION - FLUTTER DEVELOPER GUIDE

> **Project:** E-Pinggirpapas-Sumenep Backend  
> **Last Update:** 3 Desember 2025  
> **Base URL (Local):** `http://wisatalembung.test/api`  
> **Base URL (Production):** `https://kugar.e-pinggirpapas-sumenep.com/api`  

---

## 📋 TABLE OF CONTENTS

1. [Authentication](#authentication)
2. [Admin Authentication](#admin-authentication)
3. [Products (Public)](#products-public)
4. [Virtual Tours (Public)](#virtual-tours-public)
5. [Content (Public)](#content-public)
6. [Orders/Pemesanan (User)](#orderspemesanan-user)
7. [Admin - User Management](#admin---user-management)
8. [Admin - Product Management](#admin---product-management)
9. [Admin - Order Management](#admin---order-management)
10. [Admin - Virtual Tour Management](#admin---virtual-tour-management)
11. [Admin - Content Management](#admin---content-management)
12. [Admin - Statistics](#admin---statistics)
13. [Admin - Export & Backup](#admin---export--backup)

---

## 🔐 AUTHENTICATION

### Register User

```
POST /auth/register
```

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

**Response (201):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "token": "1|xxxxxxxxxxx"
  }
}
```

---

### Login User

```
POST /auth/login
```

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    },
    "token": "1|xxxxxxxxxxx"
  }
}
```

---

### Get Current User

```
GET /auth/me
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "user"
  }
}
```

---

### Logout User

```
POST /auth/logout
```

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Logged out"
}
```

---

## 👨‍💼 ADMIN AUTHENTICATION

### Admin Login

```
POST /admin/login
```

**Request Body:**
```json
{
  "email": "admin@epinggirpapas.com",
  "password": "admin123",
  "device_name": "flutter_app"
}
```

**Response (200):**
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
    "token": "2|xxxxxxxxxxx"
  }
}
```

---

### Admin Logout

```
POST /admin/logout
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

### Get Admin Profile

```
GET /admin/me
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@epinggirpapas.com",
      "role": "admin"
    }
  }
}
```

---

## 🛒 PRODUCTS (PUBLIC)

### Get All Products

```
GET /produk?per_page=12
```

**Query Parameters:**
- `per_page` (optional) - Items per page (default: 12)

**Response (200):**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "title": "Garam Premium",
        "text": "Deskripsi garam...",
        "price": 15000,
        "image": "garam1.jpg",
        "nama": "Garam Premium",
        "deskripsi": "Deskripsi garam...",
        "harga": 15000,
        "satuan": "500 gram",
        "image_url": "http://wisatalembung.test/storage/kuliners/garam1.jpg"
      }
    ],
    "per_page": 12,
    "total": 25
  }
}
```

---

### Get Product Detail

```
GET /produk/{id}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Garam Premium",
    "text": "Deskripsi lengkap...",
    "price": 15000,
    "image_url": "http://wisatalembung.test/storage/kuliners/garam1.jpg",
    "alamat": "Jl. Contoh No. 123",
    "nomor_hp": "081234567890"
  }
}
```

---

## 🎥 VIRTUAL TOURS (PUBLIC)

### Get All Virtual Tours

```
GET /virtual-tour?per_page=12
```

**Query Parameters:**
- `per_page` (optional) - Items per page (default: 12)

**Response (200):**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "title": "Tour Tambak Garam",
        "description": "Virtual tour ke tambak garam",
        "link": "https://youtube.com/watch?v=xxxxx",
        "thumbnail": "https://img.youtube.com/vi/xxxxx/hqdefault.jpg",
        "is_active": true,
        "order": 1
      }
    ]
  }
}
```

---

### Get Virtual Tour Detail

```
GET /virtual-tour/{id}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Tour Tambak Garam",
    "description": "Virtual tour ke tambak garam",
    "link": "https://youtube.com/watch?v=xxxxx",
    "thumbnail_url": "https://img.youtube.com/vi/xxxxx/hqdefault.jpg"
  }
}
```

---

## 📄 CONTENT (PUBLIC)

### Get About Content

```
GET /content/about
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "slug": "about",
    "title": "Tentang Kami",
    "about": {
      "title": "E-Pinggirpapas Sumenep",
      "content": "Tentang kami..."
    },
    "documents": [],
    "pengurus": []
  }
}
```

---

### Get Blue Economy Content

```
GET /content/blue-economy
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "slug": "blue-economy",
    "title": "Blue Economy",
    "prinsip": [
      {
        "title": "Keberlanjutan Lingkungan",
        "description": "...",
        "icon": "🌊",
        "color": "primary"
      }
    ],
    "documents": [],
    "blogs": []
  }
}
```

---

### Get GFK Content

```
GET /content/gfk
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "slug": "gfk",
    "title": "Garam Fortifikasi Kelor",
    "manfaat": [
      {
        "icon": "🌿",
        "title": "Kaya Nutrisi",
        "description": "Mengandung vitamin..."
      }
    ],
    "produk_gfk": [],
    "artikel_gfk": []
  }
}
```

---

## 📦 ORDERS/PEMESANAN (USER)

### Create Order

```
POST /pemesanan
```

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
  "produk_id": 1,
  "qty": 5,
  "alamat_pengiriman": "Jl. Example No. 123, Sumenep",
  "catatan": "Kirim pagi hari"
}
```

**Response (201):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nomor_pesanan": "ABC123XYZ",
    "user_id": 1,
    "produk_id": 1,
    "qty": 5,
    "total_harga": 75000,
    "status": "pending",
    "alamat_pengiriman": "Jl. Example No. 123, Sumenep",
    "catatan": "Kirim pagi hari"
  }
}
```

---

### Get User Orders

```
GET /pemesanan?per_page=10
```

**Headers:**
```
Authorization: Bearer {token}
```

**Query Parameters:**
- `per_page` (optional) - Items per page (default: 10)

**Response (200):**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nomor_pesanan": "ABC123XYZ",
        "total_harga": 75000,
        "status": "pending",
        "created_at": "2025-12-03T10:00:00Z"
      }
    ]
  }
}
```

---

### Track Order (Public)

```
GET /pemesanan/track/{nomor_pesanan}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "nomor_pesanan": "ABC123XYZ",
    "status": "dikirim",
    "total_harga": 75000,
    "created_at": "2025-12-03T10:00:00Z"
  }
}
```

---

## 👥 ADMIN - USER MANAGEMENT

**All endpoints require admin authentication**

### Get All Users

```
GET /admin/users?per_page=10
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "user",
        "created_at": "2025-12-01T10:00:00Z"
      }
    ]
  }
}
```

---

### Create User

```
POST /admin/users
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "user"
}
```

**Response (201):**
```json
{
  "success": true,
  "message": "User berhasil dibuat",
  "data": {
    "id": 3,
    "name": "Jane Doe",
    "email": "jane@example.com",
    "role": "user"
  }
}
```

---

### Get User Detail

```
GET /admin/users/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

---

### Update User

```
PUT /admin/users/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "name": "Updated Name",
  "email": "updated@example.com",
  "role": "staff"
}
```

---

### Delete User

```
DELETE /admin/users/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "User berhasil dihapus"
}
```

---

## 🛍️ ADMIN - PRODUCT MANAGEMENT

**All endpoints require admin authentication**

### Get All Products

```
GET /admin/products?per_page=15&search=garam
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Query Parameters:**
- `per_page` (optional) - Items per page (default: 15)
- `search` (optional) - Search by title or description

---

### Create Product

```
POST /admin/products
Content-Type: multipart/form-data
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body (form-data):**
- `title` (required) - Product name
- `text` (required) - Product description
- `price` (required) - Product price
- `alamat` (optional) - Address
- `nomor_hp` (optional) - Phone number
- `image` (optional) - Image file (jpeg, jpg, png, webp, max 2MB)

**Response (201):**
```json
{
  "success": true,
  "message": "Produk berhasil dibuat",
  "data": {
    "id": 5,
    "title": "Garam Baru",
    "price": 20000,
    "image_url": "..."
  }
}
```

---

### Update Product

```
PUT /admin/products/{id}
Content-Type: multipart/form-data
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body (form-data):**
- Same as Create Product (all optional)

---

### Delete Product

```
DELETE /admin/products/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Produk berhasil dihapus"
}
```

---

### Upload Product Image

```
POST /admin/products/{id}/upload-image
Content-Type: multipart/form-data
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body (form-data):**
- `image` (required) - Image file

**Response (200):**
```json
{
  "success": true,
  "message": "Gambar berhasil diupload",
  "data": {
    "image": "1701612345_garam-premium.jpg",
    "image_url": "http://wisatalembung.test/storage/kuliners/1701612345_garam-premium.jpg"
  }
}
```

---

## 📋 ADMIN - ORDER MANAGEMENT

**All endpoints require admin authentication**

### Get All Orders

```
GET /admin/orders?status=menunggu&start_date=2025-12-01&end_date=2025-12-31&per_page=15
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Query Parameters:**
- `status` (optional) - Filter: menunggu, diproses, dikirim, selesai, dibatalkan
- `start_date` (optional) - Start date filter
- `end_date` (optional) - End date filter
- `per_page` (optional) - Items per page (default: 15)

**Response (200):**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nomor_pesanan": "ABC123XYZ",
        "user": {
          "id": 2,
          "name": "John Doe"
        },
        "items": [],
        "total_harga": 75000,
        "status": "menunggu",
        "created_at": "2025-12-03T10:00:00Z"
      }
    ]
  }
}
```

---

### Get Order Detail

```
GET /admin/orders/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nomor_pesanan": "ABC123XYZ",
    "user": {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "081234567890"
    },
    "items": [
      {
        "produk": {
          "id": 1,
          "nama": "Garam Premium"
        },
        "jumlah": 5,
        "harga_satuan": 15000,
        "subtotal": 75000
      }
    ],
    "total_harga": 75000,
    "status": "menunggu",
    "alamat_pengiriman": "Jl. Example No. 123"
  }
}
```

---

### Update Order Status

```
PUT /admin/orders/{id}/status
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "status": "diproses",
  "catatan_admin": "Sedang disiapkan"
}
```

**Status Values:**
- `menunggu` - Pending
- `diproses` - Processing
- `dikirim` - Shipped
- `selesai` - Delivered
- `dibatalkan` - Cancelled

**Response (200):**
```json
{
  "success": true,
  "message": "Status pesanan berhasil diupdate",
  "data": {
    "id": 1,
    "nomor_pesanan": "ABC123XYZ",
    "status": "diproses"
  }
}
```

---

## 🎥 ADMIN - VIRTUAL TOUR MANAGEMENT

**All endpoints require admin authentication**

### Get All Virtual Tours

```
GET /admin/virtual-tours?per_page=15&search=tambak
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

---

### Create Virtual Tour

```
POST /admin/virtual-tours
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "title": "Tour Tambak Garam Baru",
  "description": "Deskripsi tour",
  "link": "https://youtube.com/watch?v=xxxxx",
  "thumbnail": "https://img.youtube.com/vi/xxxxx/hqdefault.jpg",
  "is_active": true,
  "order": 1
}
```

**Response (201):**
```json
{
  "success": true,
  "message": "Virtual tour berhasil dibuat",
  "data": {
    "id": 5,
    "title": "Tour Tambak Garam Baru",
    "link": "https://youtube.com/watch?v=xxxxx"
  }
}
```

---

### Update Virtual Tour

```
PUT /admin/virtual-tours/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

---

### Delete Virtual Tour

```
DELETE /admin/virtual-tours/{id}
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

---

### Toggle Active Status

```
POST /admin/virtual-tours/{id}/toggle-active
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Status berhasil diubah",
  "data": {
    "id": 1,
    "is_active": false
  }
}
```

---

### Reorder Virtual Tours

```
POST /admin/virtual-tours/reorder
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "orders": [
    {"id": 1, "order": 1},
    {"id": 2, "order": 2},
    {"id": 3, "order": 3}
  ]
}
```

---

## 📝 ADMIN - CONTENT MANAGEMENT

**All endpoints require admin authentication**

### Get Content Overview

```
GET /admin/contents
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

---

### About Management

#### Get About
```
GET /admin/contents/about
```

#### Update About
```
PUT /admin/contents/about
```

**Request Body:**
```json
{
  "title": "E-Pinggirpapas Sumenep",
  "content": "Tentang kami...",
  "vision": "Visi kami...",
  "mission": "Misi kami..."
}
```

---

### Pengurus Management

#### Get All Pengurus
```
GET /admin/contents/pengurus?per_page=15
```

#### Create Pengurus
```
POST /admin/contents/pengurus
```

**Request Body:**
```json
{
  "name": "John Doe",
  "position": "Ketua",
  "photo": "https://example.com/photo.jpg",
  "bio": "Bio singkat",
  "order": 1
}
```

#### Update Pengurus
```
PUT /admin/contents/pengurus/{id}
```

#### Delete Pengurus
```
DELETE /admin/contents/pengurus/{id}
```

---

### Documents Management

#### Get All Documents
```
GET /admin/contents/documents?type=about&per_page=15
```

#### Create Document
```
POST /admin/contents/documents
```

**Request Body:**
```json
{
  "title": "Dokumen Profil",
  "type": "about",
  "file_url": "https://example.com/doc.pdf",
  "description": "Deskripsi dokumen",
  "status": "published"
}
```

**Document Types:**
- `about` - About page
- `blue_economy` - Blue Economy page
- `gfk` - GFK page
- `other` - Other

**Status:**
- `draft` - Draft
- `published` - Published

#### Update Document
```
PUT /admin/contents/documents/{id}
```

#### Delete Document
```
DELETE /admin/contents/documents/{id}
```

---

### Posts/Blog Management

#### Get All Posts
```
GET /admin/contents/posts?category=blue-economy&status=published&per_page=15
```

#### Create Post
```
POST /admin/contents/posts
```

**Request Body:**
```json
{
  "title": "Artikel Baru",
  "content": "Konten artikel...",
  "excerpt": "Ringkasan artikel",
  "category": "blue-economy",
  "featured_image": "https://example.com/image.jpg",
  "status": "published"
}
```

#### Update Post
```
PUT /admin/contents/posts/{id}
```

#### Delete Post
```
DELETE /admin/contents/posts/{id}
```

---

## 📊 ADMIN - STATISTICS

### Get Dashboard Statistics

```
GET /admin/statistics
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
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
      {"month": "Jul 2025", "total": 7000000},
      {"month": "Aug 2025", "total": 6000000},
      {"month": "Sep 2025", "total": 8000000},
      {"month": "Oct 2025", "total": 9000000},
      {"month": "Nov 2025", "total": 10000000}
    ]
  }
}
```

---

## 💾 ADMIN - EXPORT & BACKUP

### Export Orders

```
POST /admin/export/orders
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Request Body:**
```json
{
  "format": "xlsx",
  "start_date": "2025-12-01",
  "end_date": "2025-12-31"
}
```

**Format Options:**
- `csv` - CSV file
- `xlsx` - Excel file

**Response (200):**
```json
{
  "success": true,
  "message": "Data berhasil diekspor",
  "data": [...],
  "download_url": "http://wisatalembung.test/storage/exports/laporan-pesanan-2025-12-03.xlsx"
}
```

---

### Backup Database

```
POST /admin/backup/database
```

**Headers:**
```
Authorization: Bearer {admin_token}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Backup database berhasil",
  "download_url": "http://wisatalembung.test/storage/backups/backup-2025-12-03.sql"
}
```

---

## 🔒 AUTHENTICATION FLOW

### For Regular Users:

1. **Register** → `POST /auth/register`
2. **Login** → `POST /auth/login` → Get token
3. **Use token** for all authenticated endpoints
4. **Logout** → `POST /auth/logout`

### For Admin:

1. **Login** → `POST /admin/login` → Get admin token
2. **Use admin token** for all admin endpoints
3. **Logout** → `POST /admin/logout`

---

## 📌 IMPORTANT NOTES

### Headers Format:

**For Public Endpoints:**
```dart
headers: {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
}
```

**For Authenticated Endpoints:**
```dart
headers: {
  'Accept': 'application/json',
  'Content-Type': 'application/json',
  'Authorization': 'Bearer $token',
}
```

**For Multipart (File Upload):**
```dart
headers: {
  'Accept': 'application/json',
  'Content-Type': 'multipart/form-data',
  'Authorization': 'Bearer $token',
}
```

---

### Error Response Format:

**Validation Error (422):**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "email": ["Email sudah digunakan"],
    "password": ["Password minimal 8 karakter"]
  }
}
```

**Unauthorized (401):**
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

**Forbidden (403):**
```json
{
  "success": false,
  "message": "Akses ditolak. Hanya admin yang dapat login."
}
```

**Not Found (404):**
```json
{
  "success": false,
  "message": "Resource tidak ditemukan"
}
```

**Server Error (500):**
```json
{
  "success": false,
  "message": "Server error"
}
```

---

## 🎯 TESTING TIPS

1. **Use Postman or Insomnia** untuk testing API sebelum implement di Flutter
2. **Save token** setelah login untuk digunakan di request berikutnya
3. **Test error cases** - invalid data, unauthorized, etc.
4. **Check pagination** - current_page, last_page, total
5. **Verify image URLs** - pastikan URL gambar bisa diakses

---

**Created by:** Cascade AI Assistant  
**For:** Flutter Developer  
**Date:** 3 Desember 2025
