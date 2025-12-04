# 🎯 PROMPT UNTUK FLUTTER FRONTEND DEVELOPER

> **Copy prompt di bawah ini dan paste ke AI assistant di project Flutter Anda!**

---

## 📋 COPY PROMPT INI ↓↓↓

```markdown
# 🚀 BACKEND API ADMIN - READY FOR INTEGRATION

Saya perlu mengintegrasikan Flutter Admin Panel dengan Backend API Laravel yang sudah **100% SELESAI dan TESTED**.

## 📊 PROJECT CONTEXT

**Backend:** Laravel 10 + Sanctum (Token-based Authentication)  
**Database:** MySQL (wisatalembung)  
**Base URL:** `http://wisatalembung.test/api` atau `http://10.0.2.2:8000/api` (untuk Android emulator)  
**Authentication:** Sanctum Bearer Token  
**CORS:** Already configured untuk localhost

## 🔐 ADMIN CREDENTIALS

- **Email:** `admin@kugar.com`
- **Password:** `admin123`
- **Device Name:** `flutter_admin_app`

## 📡 API ENDPOINTS AVAILABLE

### 1. AUTHENTICATION (Public & Protected)

#### Login (Public)
```
POST /api/admin/login
Content-Type: application/json

Body:
{
  "email": "admin@kugar.com",
  "password": "admin123",
  "device_name": "flutter_admin_app"
}

Response (200):
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin KUGAR",
      "email": "admin@kugar.com",
      "role": "admin"
    },
    "token": "1|xxxxxxxxxxxxxxxxxxxxx"
  }
}
```

#### Get Profile (Protected)
```
GET /api/admin/me
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "Admin KUGAR",
      "email": "admin@kugar.com",
      "role": "admin"
    }
  }
}
```

#### Logout (Protected)
```
POST /api/admin/logout
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

### 2. USER MANAGEMENT (Protected - CRUD + Search + Filter)

#### Get All Users
```
GET /api/admin/users
Authorization: Bearer {token}

Query Parameters (all optional):
- per_page: number (default: 10) - Items per page
- page: number (default: 1) - Page number
- search: string - Search by name, email, or phone
- role: string - Filter by role (user|admin|staff)

Examples:
- GET /api/admin/users
- GET /api/admin/users?per_page=20
- GET /api/admin/users?search=john
- GET /api/admin/users?role=user
- GET /api/admin/users?search=admin&role=admin&per_page=5

Response (200):
{
  "success": true,
  "message": "Users retrieved successfully",
  "data": [
    {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "08123456789",
      "role": "user",
      "created_at": "2024-12-04T10:00:00.000000Z"
    }
  ],
  "current_page": 1,
  "last_page": 5,
  "per_page": 10,
  "total": 45
}
```

#### Get User Detail
```
GET /api/admin/users/{id}
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "data": {
    "id": 2,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "08123456789",
    "role": "user",
    "created_at": "2024-12-04T10:00:00.000000Z"
  }
}
```

#### Create User
```
POST /api/admin/users
Authorization: Bearer {token}
Content-Type: application/json

Body:
{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "user"
}

Response (201):
{
  "success": true,
  "message": "User berhasil dibuat",
  "data": {
    "id": 3,
    "name": "Jane Smith",
    "email": "jane@example.com",
    "role": "user"
  }
}
```

#### Update User
```
PUT /api/admin/users/{id}
Authorization: Bearer {token}
Content-Type: application/json

Body (all fields optional):
{
  "name": "Jane Doe",
  "email": "jane.doe@example.com",
  "password": "newpassword123",
  "password_confirmation": "newpassword123",
  "role": "staff"
}

Response (200):
{
  "success": true,
  "message": "User berhasil diupdate",
  "data": {
    "id": 3,
    "name": "Jane Doe",
    "email": "jane.doe@example.com",
    "role": "staff"
  }
}
```

#### Delete User
```
DELETE /api/admin/users/{id}
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "message": "User berhasil dihapus"
}
```

---

### 3. PRODUCT MANAGEMENT (Protected - CRUD + Image Upload)

**Note:** Products are stored in `kuliners` table

#### Get All Products
```
GET /api/admin/products
Authorization: Bearer {token}

Query Parameters (optional):
- per_page: number (default: 15)
- search: string - Search by title or text

Response (200):
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "title": "Garam Premium",
        "text": "Garam berkualitas tinggi",
        "price": 15000,
        "image": "garam-premium.jpg",
        "alamat": "Sumenep",
        "nomor_hp": "08123456789",
        "created_at": "2024-12-04T10:00:00.000000Z",
        "image_url": "http://wisatalembung.test/storage/kuliners/garam-premium.jpg"
      }
    ],
    "per_page": 15,
    "total": 10,
    "last_page": 1
  }
}
```

#### Get Product Detail
```
GET /api/admin/products/{id}
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Garam Premium",
    "text": "Garam berkualitas tinggi",
    "price": 15000,
    "image": "garam-premium.jpg",
    "alamat": "Sumenep",
    "nomor_hp": "08123456789",
    "image_url": "..."
  }
}
```

#### Create Product
```
POST /api/admin/products
Authorization: Bearer {token}
Content-Type: application/json

Body:
{
  "title": "Garam Laut Premium",
  "text": "Garam laut berkualitas tinggi dari petambak lokal",
  "price": 20000,
  "alamat": "Sumenep, Madura",
  "nomor_hp": "08123456789"
}

Response (201):
{
  "success": true,
  "message": "Produk berhasil dibuat",
  "data": {
    "id": 2,
    "title": "Garam Laut Premium",
    "price": 20000,
    ...
  }
}
```

#### Update Product
```
PUT /api/admin/products/{id}
Authorization: Bearer {token}
Content-Type: application/json

Body (all fields optional):
{
  "title": "Garam Laut Super Premium",
  "price": 25000
}

Response (200):
{
  "success": true,
  "message": "Produk berhasil diupdate",
  "data": {...}
}
```

#### Delete Product
```
DELETE /api/admin/products/{id}
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "message": "Produk berhasil dihapus"
}
```

#### Upload Product Image
```
POST /api/admin/products/{id}/upload-image
Authorization: Bearer {token}
Content-Type: multipart/form-data

Body:
- image: File (jpeg, jpg, png, webp, max: 2MB)

Response (200):
{
  "success": true,
  "message": "Gambar berhasil diupload",
  "data": {
    "image": "filename.jpg",
    "image_url": "http://wisatalembung.test/storage/kuliners/filename.jpg"
  }
}
```

---

### 4. DASHBOARD STATISTICS (Protected - Enhanced)

```
GET /api/admin/statistics
Authorization: Bearer {token}

Response (200):
{
  "success": true,
  "message": "Dashboard statistics retrieved successfully",
  "data": {
    "users": {
      "total": 45,
      "admins": 2,
      "recent": [
        {
          "id": 5,
          "name": "Recent User",
          "email": "user@example.com",
          "created_at": "..."
        }
      ]
    },
    "products": {
      "total": 25,
      "average_price": 18500,
      "min_price": 10000,
      "max_price": 50000,
      "recent": [
        {
          "id": 10,
          "nama": "Recent Product",
          "harga": 15000,
          "created_at": "..."
        }
      ]
    },
    "orders": {
      "total": 120,
      "pending": 5,
      "processing": 10,
      "completed": 100,
      "cancelled": 5
    },
    "revenue": {
      "this_month": 5000000,
      "total": 25000000,
      "formatted_this_month": "Rp 5.000.000",
      "formatted_total": "Rp 25.000.000"
    },
    "virtual_tours": {
      "total": 8
    },
    "charts": {
      "monthly_revenue": [
        {
          "month": "Nov 2024",
          "revenue": 3500000,
          "orders": 45
        },
        {
          "month": "Dec 2024",
          "revenue": 5000000,
          "orders": 60
        }
      ]
    }
  }
}
```

---

## 🔒 ERROR RESPONSES

### 401 Unauthorized
```json
{
  "success": false,
  "message": "Unauthenticated. Silakan login terlebih dahulu."
}
```

### 403 Forbidden
```json
{
  "success": false,
  "message": "Akses ditolak. Hanya admin yang dapat mengakses endpoint ini."
}
```

### 422 Validation Error
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password field is required."]
  }
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Resource not found"
}
```

---

## 📦 REQUIREMENTS UNTUK FLUTTER

Saya butuh implementasi lengkap untuk:

### 1. API Service Layer

Buat service layer dengan struktur:
- `lib/services/api_service.dart` - Base API configuration
- `lib/services/auth_service.dart` - Authentication endpoints
- `lib/services/user_service.dart` - User management endpoints
- `lib/services/product_service.dart` - Product management endpoints
- `lib/services/dashboard_service.dart` - Dashboard statistics

### 2. Models

Buat models untuk:
- `User` (id, name, email, phone, role, createdAt)
- `Product` (id, title, text, price, image, alamat, nomorHp, imageUrl)
- `DashboardStats` (users, products, orders, revenue, charts)
- `ApiResponse<T>` (success, message, data)
- `PaginatedResponse<T>` (success, message, data, currentPage, lastPage, perPage, total)

### 3. State Management

Implementasi state management (pilih salah satu):
- Provider (recommended)
- Riverpod
- Bloc
- GetX

Untuk mengelola:
- Authentication state (token, user)
- Loading states
- Error handling
- Data caching

### 4. Authentication Flow

Implementasi:
- Login screen dengan form email & password
- Save token ke secure storage (flutter_secure_storage)
- Auto-attach token ke semua API requests
- Token refresh/validation
- Logout functionality
- Redirect ke login jika 401

### 5. Admin Dashboard

Buat dashboard dengan:
- Summary cards (total users, products, orders, revenue)
- Charts (monthly revenue - menggunakan fl_chart atau charts_flutter)
- Recent users list (last 5)
- Recent products list (last 5)
- Quick actions

### 6. User Management Screen

Fitur:
- User list dengan pagination
- Search bar (search by name/email/phone)
- Filter dropdown (by role: all/user/admin/staff)
- Create user dialog/form
- Edit user dialog/form
- Delete user confirmation
- Pull-to-refresh
- Infinite scroll atau load more

### 7. Product Management Screen

Fitur:
- Product list dengan pagination
- Search functionality
- Create product form
- Edit product form
- Delete product confirmation
- Image picker & upload (image_picker package)
- Image preview
- Pull-to-refresh

### 8. Error Handling & Loading States

Implementasi:
- Loading indicators untuk setiap action
- Error snackbars/dialogs
- Network error handling
- Validation error display
- Retry mechanism

### 9. UI/UX Requirements

- Material Design 3 atau custom theme
- Responsive layout (support tablet & mobile)
- Dark mode support
- Smooth animations
- Empty states
- Loading skeletons

### 10. Additional Features

- Logout confirmation dialog
- Profile screen (show admin profile)
- Settings screen (optional)
- About screen (optional)

---

## 🛠️ PACKAGES YANG DISARANKAN

```yaml
dependencies:
  flutter:
    sdk: flutter
  
  # HTTP & API
  http: ^1.1.0
  dio: ^5.4.0  # Alternative (lebih powerful)
  
  # State Management
  provider: ^6.1.1  # Recommended
  # atau riverpod: ^2.4.9
  # atau flutter_bloc: ^8.1.3
  
  # Secure Storage
  flutter_secure_storage: ^9.0.0
  
  # UI Components
  flutter_svg: ^2.0.9
  cached_network_image: ^3.3.0
  
  # Forms & Validation
  flutter_form_builder: ^9.1.1
  
  # Image Picker
  image_picker: ^1.0.5
  
  # Charts
  fl_chart: ^0.65.0
  
  # Loading & Animations
  shimmer: ^3.0.0
  lottie: ^2.7.0
  
  # Date & Time
  intl: ^0.18.1
```

---

## 📋 IMPLEMENTATION CHECKLIST

Tolong implementasikan dengan urutan berikut:

### Phase 1: Setup & Authentication
- [ ] Setup project structure (folders: lib/services, lib/models, lib/screens, lib/widgets)
- [ ] Create API configuration (base URL, headers)
- [ ] Create ApiService base class
- [ ] Create AuthService
- [ ] Create User model
- [ ] Create ApiResponse & PaginatedResponse models
- [ ] Implement login functionality
- [ ] Implement token storage (flutter_secure_storage)
- [ ] Create login screen UI
- [ ] Test authentication flow

### Phase 2: Dashboard
- [ ] Create DashboardService
- [ ] Create DashboardStats model
- [ ] Create dashboard screen UI
- [ ] Implement statistics fetching
- [ ] Create summary cards
- [ ] Implement charts (monthly revenue)
- [ ] Test dashboard

### Phase 3: User Management
- [ ] Create UserService (CRUD + search + filter)
- [ ] Create user list screen
- [ ] Implement pagination
- [ ] Implement search functionality
- [ ] Implement role filter
- [ ] Create user form (create/edit)
- [ ] Implement delete functionality
- [ ] Test all CRUD operations

### Phase 4: Product Management
- [ ] Create ProductService
- [ ] Create Product model
- [ ] Create product list screen
- [ ] Implement pagination & search
- [ ] Create product form
- [ ] Implement image picker
- [ ] Implement image upload
- [ ] Test all CRUD operations

### Phase 5: Polish & Testing
- [ ] Add error handling
- [ ] Add loading states
- [ ] Implement pull-to-refresh
- [ ] Add empty states
- [ ] Test all features end-to-end
- [ ] Fix bugs
- [ ] Optimize performance

---

## 🎯 EXPECTED OUTPUT

Setelah selesai, saya expect:

1. **Fully functional Flutter Admin Panel** yang bisa:
   - Login/Logout
   - View dashboard dengan stats & charts
   - Manage users (CRUD, search, filter)
   - Manage products (CRUD, search, image upload)
   - Handle errors gracefully
   - Show loading states

2. **Clean code dengan:**
   - Proper folder structure
   - Reusable widgets
   - Proper error handling
   - Comments on complex logic
   - Type-safe code

3. **Responsive UI** yang works di:
   - Android phones
   - iOS (if possible)
   - Tablets
   - Different screen sizes

---

## 💡 IMPORTANT NOTES

1. **Base URL untuk Android Emulator:** Gunakan `http://10.0.2.2:8000/api` instead of `localhost`
2. **Token Management:** Always include `Authorization: Bearer {token}` header untuk protected endpoints
3. **Response Format:** All API responses have consistent format dengan `success`, `message`, `data` fields
4. **Pagination:** Gunakan `current_page`, `last_page`, `per_page`, `total` dari response
5. **Error Handling:** Check `success` field, jika false tampilkan `message` ke user
6. **Image URLs:** Backend returns full image URL di `image_url` field
7. **CORS:** Already configured di backend, no issues dari Flutter

---

## 📞 BACKEND CONTACT

Jika ada masalah dengan API:
1. Check response status code
2. Check response body (ada error message)
3. Verify token masih valid (test dengan login ulang)
4. Check network connectivity

Backend sudah tested dan working 100%, jadi kemungkinan besar issue di Flutter side.

---

## ✅ SUMMARY

- ✅ Backend API 100% READY
- ✅ All endpoints TESTED
- ✅ CORS configured
- ✅ Documentation complete
- ✅ Consistent response format
- ✅ Enhanced features (search, filter, pagination, charts)

**Your turn:** Implement Flutter Admin Panel dengan semua fitur di atas!

Let's build an amazing admin panel! 🚀
```

---

## 📝 CARA MENGGUNAKAN

1. **Copy semua text di atas** (dari "# 🚀 BACKEND API ADMIN" sampai akhir)
2. **Buka AI assistant di Flutter project** (Cline, Cursor, Copilot, dll)
3. **Paste prompt tersebut**
4. **AI akan:**
   - Setup project structure
   - Create models
   - Create services
   - Create UI screens
   - Implement all features

---

## 🎯 ALTERNATIVE: Prompt Singkat

Jika AI assistant kewalahan dengan prompt panjang, gunakan prompt bertahap:

### **Prompt 1: Setup & Auth**
```
Backend API admin sudah ready. Base URL: http://wisatalembung.test/api

Tolong setup:
1. Project structure (lib/services, lib/models, lib/screens)
2. ApiService dengan base URL dan error handling
3. AuthService untuk login/logout
4. User model
5. ApiResponse model
6. Login screen

Login endpoint: POST /api/admin/login
Body: { "email": "admin@kugar.com", "password": "admin123", "device_name": "flutter_admin_app" }
Response: { "success": true, "data": { "user": {...}, "token": "..." } }

Gunakan flutter_secure_storage untuk save token.
```

### **Prompt 2: Dashboard**
```
Lanjutkan dengan dashboard:
1. DashboardService
2. DashboardStats model
3. Dashboard screen dengan summary cards
4. Fetch statistics dari GET /api/admin/statistics

Response format: { "success": true, "data": { "users": {...}, "products": {...}, "revenue": {...}, "charts": {...} } }

Tampilkan: total users, products, revenue, dan chart monthly revenue.
```

### **Prompt 3: User Management**
```
Implement user management:
1. UserService dengan CRUD + search + filter
2. User list screen dengan pagination
3. Search bar & role filter dropdown
4. Create/Edit user form
5. Delete confirmation

Endpoints:
- GET /api/admin/users?search=x&role=user&per_page=10
- POST /api/admin/users
- PUT /api/admin/users/{id}
- DELETE /api/admin/users/{id}

Response: { "success": true, "data": [...], "current_page": 1, "total": 45 }
```

### **Prompt 4: Product Management**
```
Implement product management:
1. ProductService
2. Product model
3. Product list screen
4. Create/Edit product form dengan image picker
5. Image upload

Endpoints:
- GET /api/admin/products
- POST /api/admin/products
- PUT /api/admin/products/{id}
- DELETE /api/admin/products/{id}
- POST /api/admin/products/{id}/upload-image (multipart/form-data)
```

---

**Pilih salah satu approach:**
- ✅ **Full Prompt:** Untuk AI yang powerful (GPT-4, Claude)
- ✅ **Bertahap:** Untuk step-by-step implementation

Happy coding! 🚀
