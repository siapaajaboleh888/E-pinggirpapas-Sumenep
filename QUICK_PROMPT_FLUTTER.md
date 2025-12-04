# 📱 QUICK PROMPT - FLUTTER INTEGRATION

> **Copy-paste prompt ini ke AI assistant Flutter project Anda!**

---

```
Hi! Backend Admin API sudah 100% ready. Tolong integrate dengan Flutter Admin Panel.

## 🔐 CREDENTIALS
Email: admin@kugar.com
Password: admin123
Base URL: http://wisatalembung.test/api (atau http://10.0.2.2:8000/api untuk emulator)

## 📡 API ENDPOINTS

### Auth (Sanctum Token)
- POST /api/admin/login → { email, password, device_name } → Returns { user, token }
- POST /api/admin/logout → Hapus token
- GET /api/admin/me → Get profile

### Users (CRUD + Search + Filter) [PROTECTED]
- GET /api/admin/users?search=x&role=user&per_page=10 → Pagination response
- GET /api/admin/users/{id}
- POST /api/admin/users → { name, email, password, password_confirmation, role }
- PUT /api/admin/users/{id}
- DELETE /api/admin/users/{id}

### Products (CRUD + Image) [PROTECTED]
- GET /api/admin/products?search=x&per_page=15
- GET /api/admin/products/{id}
- POST /api/admin/products → { title, text, price, alamat, nomor_hp }
- PUT /api/admin/products/{id}
- DELETE /api/admin/products/{id}
- POST /api/admin/products/{id}/upload-image → multipart/form-data

### Dashboard [PROTECTED]
- GET /api/admin/statistics → Returns comprehensive stats (users, products, orders, revenue, charts)

## 📦 RESPONSE FORMAT
All responses:
```json
{
  "success": true,
  "message": "...",
  "data": {...}
}
```

Pagination:
```json
{
  "success": true,
  "data": [...],
  "current_page": 1,
  "last_page": 5,
  "per_page": 10,
  "total": 45
}
```

## ✅ REQUIREMENTS

Tolong buat Flutter Admin Panel dengan:

1. **Services:**
   - ApiService (base config)
   - AuthService (login/logout)
   - UserService (CRUD + search + filter)
   - ProductService (CRUD + image upload)
   - DashboardService (stats)

2. **Models:**
   - User (id, name, email, phone, role, createdAt)
   - Product (id, title, text, price, image, imageUrl)
   - DashboardStats (users, products, orders, revenue, charts)
   - ApiResponse<T>
   - PaginatedResponse<T>

3. **Screens:**
   - Login screen
   - Dashboard (stats cards + revenue chart)
   - User management (list, create, edit, delete, search, filter)
   - Product management (list, create, edit, delete, search, image upload)

4. **Features:**
   - Token storage (flutter_secure_storage)
   - Auto-attach Bearer token ke headers
   - Pagination dengan load more atau infinite scroll
   - Search functionality
   - Filter by role (users)
   - Image picker & upload (products)
   - Error handling & loading states
   - Pull-to-refresh
   - Logout confirmation

5. **Packages:**
   - http atau dio
   - provider atau riverpod (state management)
   - flutter_secure_storage
   - image_picker
   - fl_chart (untuk revenue chart)
   - cached_network_image

## 📋 AUTH FLOW
1. Login → Save token
2. All requests → Add: Authorization: Bearer {token}
3. 401 error → Redirect to login
4. Logout → Delete token

## 🎯 IMPLEMENTATION ORDER
1. Setup project structure & ApiService
2. Authentication (login screen, token storage)
3. Dashboard (stats & charts)
4. User management (CRUD + search + filter)
5. Product management (CRUD + image upload)
6. Error handling & polish

## 💡 NOTES
- Gunakan http://10.0.2.2:8000/api untuk Android emulator
- Semua protected endpoints butuh: Authorization: Bearer {token}
- Check field "success" di response untuk handle errors
- Backend sudah tested 100%, siap pakai!

Build a beautiful & functional admin panel! 🚀
```

---

## 🎯 CARA PAKAI

1. Copy text di atas (dalam kotak code block)
2. Paste ke AI assistant di Flutter project
3. AI akan setup semua yang diperlukan
4. Done! ✅

---

**Good luck with Flutter development! 🚀**
