# 🔐 PANDUAN ADMIN E-PINGGIRPAPAS-SUMENEP

## 📋 DAFTAR ISI
1. [Login Admin](#login-admin)
2. [Fitur Admin](#fitur-admin)
3. [Kelola Pesanan](#kelola-pesanan)
4. [Kelola Produk](#kelola-produk)
5. [Export Data](#export-data)

---

## 🔑 LOGIN ADMIN

### Kredensial Admin Default

```
Email    : admin@epinggirpapas.com
Password : admin123
```

⚠️ **PENTING:** Ganti password ini setelah login pertama kali!

### Cara Login

1. **Buka halaman login:**
   ```
   http://wisatalembung.test/login
   ```

2. **Masukkan kredensial admin:**
   - Email: `admin@epinggirpapas.com`
   - Password: `admin123`

3. **Klik "Log in"**

4. **Redirect otomatis:**
   - Admin → `/admin/dashboard`
   - User biasa → `/` (homepage)

---

## 🎯 FITUR ADMIN

### Dashboard Admin
**URL:** `http://wisatalembung.test/admin/dashboard`

**Statistik yang ditampilkan:**
- ✅ Total Pemesanan
- ✅ Pemesanan Pending
- ✅ Pemesanan Proses
- ✅ Pemesanan Selesai
- ✅ Total Produk
- ✅ Revenue Bulan Ini
- ✅ Revenue Hari Ini
- ✅ 10 Pesanan Terbaru

---

## 📦 KELOLA PESANAN

### URL Kelola Pesanan
```
http://wisatalembung.test/admin/pemesanan
```

### Fitur-Fitur Admin Pemesanan

#### 1. **Lihat Semua Pesanan**
- **Route:** `GET /admin/pemesanan`
- **Fitur:**
  - List semua pesanan
  - Pagination (20 pesanan per halaman)
  - Status pesanan (badge warna)
  - Info pemesan
  - Total harga

#### 2. **Edit Pesanan**
- **Route:** `GET /admin/pemesanan/{id}/edit`
- **Fitur:**
  - Edit status pesanan
  - Tambah catatan admin
  - Update detail pesanan

#### 3. **Hapus Pesanan** ✅
- **Route:** `DELETE /admin/pemesanan/{id}`
- **Method:** Form dengan `@method('DELETE')`
- **Fitur:**
  - Hapus pesanan permanent
  - Konfirmasi sebelum hapus
  - Alert success/error

**Contoh implementasi:**
```blade
<form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" 
      method="POST" 
      onsubmit="return confirm('Yakin hapus pesanan ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i> Hapus
    </button>
</form>
```

#### 4. **Update Status Pesanan**

**Quick Actions (POST requests):**

a. **Konfirmasi Pesanan**
```
POST /admin/pemesanan/{id}/konfirmasi
```
- Mengubah status → `confirmed`
- Menandai waktu konfirmasi

b. **Proses Pesanan**
```
POST /admin/pemesanan/{id}/proses
```
- Mengubah status → `processing`

c. **Kirim Pesanan**
```
POST /admin/pemesanan/{id}/kirim
```
- Mengubah status → `shipped`
- Menandai waktu pengiriman

d. **Selesaikan Pesanan**
```
POST /admin/pemesanan/{id}/selesai
```
- Mengubah status → `delivered`
- Menandai waktu diterima

e. **Batalkan Pesanan**
```
POST /admin/pemesanan/{id}/batal
```
- Mengubah status → `cancelled`

**AJAX Update Status:**
```
PATCH /admin/pemesanan/{id}/status
```
- Update status via AJAX (tanpa reload page)

#### 5. **Export Pesanan**
```
GET /admin/pemesanan/export/{format}
```

Format yang tersedia:
- `excel` - Export ke Excel (.xlsx)
- `pdf` - Export ke PDF
- `csv` - Export ke CSV

**Contoh:**
```
http://wisatalembung.test/admin/pemesanan/export/excel
```

---

## 🛍️ KELOLA PRODUK

### URL Kelola Produk
```
http://wisatalembung.test/admin/produk
```

### Fitur-Fitur Admin Produk

#### 1. **Lihat Semua Produk**
- **Route:** `GET /admin/produk`
- List semua produk garam
- Pagination 15 produk per halaman

#### 2. **Tambah Produk Baru**
- **Route:** `GET /admin/produk/create`
- Form untuk membuat produk baru

#### 3. **Edit Produk**
- **Route:** `GET /admin/produk/{id}/edit`
- Update info produk
- Upload gambar produk

---

## 📊 STATUS PESANAN

### Alur Status Normal:

```
1. PENDING
   ↓ (Admin klik "Konfirmasi")
2. CONFIRMED
   ↓ (Admin klik "Proses")
3. PROCESSING
   ↓ (Admin klik "Kirim")
4. SHIPPED
   ↓ (Admin klik "Selesai")
5. DELIVERED ✅
```

### Status Alternatif:

```
PENDING → CANCELLED ❌
(Admin klik "Batalkan")
```

### Warna Badge Status:

| Status | Badge | Color |
|--------|-------|-------|
| Pending | 🟡 | Yellow |
| Confirmed | 🔵 | Blue |
| Processing | 🟢 | Green |
| Shipped | 🔵 | Cyan |
| Delivered | 🟢 | Dark Green |
| Cancelled | 🔴 | Red |

---

## 🔧 CARA KERJA ADMIN

### Workflow Terima Pesanan:

**Skenario: User membuat pesanan baru**

1. **User membuat pesanan**
   - URL: `/pemesanan/buat`
   - Status: `PENDING`

2. **Admin melihat pesanan baru**
   - Buka: `/admin/pemesanan`
   - Lihat pesanan dengan badge 🟡 PENDING

3. **Admin konfirmasi pesanan**
   - Klik tombol "Konfirmasi"
   - Status berubah → `CONFIRMED`
   - Email notifikasi dikirim ke user (optional)

4. **Admin proses pesanan**
   - Siapkan produk
   - Klik tombol "Proses"
   - Status berubah → `PROCESSING`

5. **Admin kirim pesanan**
   - Setelah diserahkan ke kurir
   - Klik tombol "Kirim"
   - Status berubah → `SHIPPED`
   - Input resi pengiriman (optional)

6. **Admin tandai selesai**
   - Setelah user terima barang
   - Klik tombol "Selesai"
   - Status berubah → `DELIVERED`

---

## 🗑️ CARA HAPUS PESANAN

### Option 1: Dari List Pesanan

```blade
<!-- Di admin/pemesanan/index.blade.php -->

<table>
    <tr>
        <td>{{ $pemesanan->nomor_pesanan }}</td>
        <td>{{ $pemesanan->nama_pemesan }}</td>
        <td>{{ $pemesanan->status }}</td>
        <td>
            <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Yakin hapus pesanan ini?')"
                  style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </td>
    </tr>
</table>
```

### Option 2: Dari Detail Pesanan

```blade
<!-- Di admin/pemesanan/edit.blade.php -->

<div class="card-footer">
    <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" 
          method="POST" 
          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini? Tindakan ini tidak dapat dibatalkan!')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash-alt me-2"></i>Hapus Pesanan
        </button>
    </form>
</div>
```

---

## 📱 MENU NAVIGASI ADMIN

Setelah login sebagai admin, dropdown user menampilkan:

```
┌─────────────────────────────┐
│ 👤 Admin E-Pinggirpapas     │
├─────────────────────────────┤
│ 📊 Admin Dashboard          │
│ 📦 Kelola Produk           │
│ 📋 Kelola Pesanan          │
│ ─────────────────────────  │
│ 🚪 Logout                   │
└─────────────────────────────┘
```

---

## 🔐 MIDDLEWARE PROTECTION

### AdminMiddleware
**File:** `app/Http/Middleware/AdminMiddleware.php`

**Proteksi:**
- Cek apakah user sudah login
- Cek apakah role = 'admin'
- Jika bukan admin → redirect ke homepage dengan error

**Routes yang dilindungi:**
```php
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Semua routes admin di sini
});
```

---

## 🧪 TEST ADMIN

### Checklist Testing Admin:

```
□ Login dengan kredensial admin ✓
□ Redirect ke /admin/dashboard ✓
□ Dashboard menampilkan statistik ✓
□ Bisa akses /admin/pemesanan ✓
□ Bisa lihat list pesanan ✓
□ Bisa edit pesanan ✓
□ Bisa update status (Konfirmasi, Proses, Kirim, Selesai, Batal) ✓
□ Bisa hapus pesanan ✓
□ Konfirmasi hapus muncul ✓
□ Alert success/error tampil ✓
□ Bisa akses /admin/produk ✓
□ Bisa export pesanan ✓
```

---

## 🔄 CREATE ADMIN USER

### Cara 1: Run Seeder (Recommended)

```bash
php artisan db:seed --class=AdminUserSeeder
```

**Output:**
```
✅ Admin user created: admin@epinggirpapas.com / admin123
✅ Test user created: user@test.com / user123
⚠️  JANGAN LUPA GANTI PASSWORD DI PRODUCTION!
```

### Cara 2: Manual via Tinker

```bash
php artisan tinker
```

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin E-Pinggirpapas',
    'email' => 'admin@epinggirpapas.com',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
    'phone' => '081234567890',
    'email_verified_at' => now(),
]);
```

### Cara 3: Manual via Database

**Langkah:**
1. Buka TablePlus
2. Buka tabel `users`
3. Insert new row:
   ```
   name: Admin E-Pinggirpapas
   email: admin@epinggirpapas.com
   password: $2y$12$[hash password "admin123"]
   role: admin
   phone: 081234567890
   email_verified_at: [current timestamp]
   ```

---

## ⚠️ KEAMANAN

### WAJIB Dilakukan di Production:

1. **Ganti Password Default**
   ```
   admin@epinggirpapas.com → password123 (buat password kuat!)
   ```

2. **Ganti Email Admin**
   ```
   admin@epinggirpapas.com → email-admin-real@domain.com
   ```

3. **Nonaktifkan Test User**
   ```
   Hapus atau disable: user@test.com
   ```

4. **Enable Email Verification**
   ```
   Aktifkan verifikasi email untuk semua user
   ```

5. **Setup 2FA (Optional)**
   ```
   Install package Laravel Fortify untuk 2FA
   ```

---

## 📝 NOTES

### Perbedaan Admin vs User:

| Feature | Admin | User |
|---------|-------|------|
| Dashboard | Admin Dashboard | User Dashboard |
| Lihat Pesanan | Semua pesanan | Pesanan sendiri |
| Edit Pesanan | ✅ Ya | ❌ Tidak |
| Hapus Pesanan | ✅ Ya | ❌ Tidak |
| Update Status | ✅ Ya | ❌ Tidak |
| Kelola Produk | ✅ Ya | ❌ Tidak |
| Export Data | ✅ Ya | ❌ Tidak |

---

## 🚀 QUICK START

**Untuk mulai sebagai admin:**

```bash
# 1. Buat admin user
php artisan db:seed --class=AdminUserSeeder

# 2. Buka browser
http://wisatalembung.test/login

# 3. Login
Email: admin@epinggirpapas.com
Password: admin123

# 4. Akses admin panel
http://wisatalembung.test/admin/dashboard

# 5. Kelola pesanan
http://wisatalembung.test/admin/pemesanan
```

---

**Dibuat oleh:** Cascade AI Assistant  
**Tanggal:** 12 November 2025  
**Project:** E-Pinggirpapas-Sumenep
