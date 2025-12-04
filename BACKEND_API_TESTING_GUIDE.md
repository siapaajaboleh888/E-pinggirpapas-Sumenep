# 🚀 BACKEND API - COMPLETE TESTING GUIDE

## 📋 Table of Contents
1. [Setup & Configuration](#setup--configuration)
2. [Authentication Testing](#authentication-testing)
3. [User Management Testing](#user-management-testing)
4. [Product Management Testing](#product-management-testing)
5. [Dashboard Statistics Testing](#dashboard-statistics-testing)
6. [Troubleshooting](#troubleshooting)

---

## 🔧 Setup & Configuration

### Prerequisites
✅ Laravel installed with Sanctum  
✅ Database configured (MySQL via TablePlus)  
✅ Admin user exists in `users` table:
- Email: `admin@kugar.com`
- Password: `admin123`
- Role: `admin`

### Base URL
```
Local: http://wisatalembung.test/api
or: http://localhost:8000/api
```

### CORS Configuration
Already configured to allow:
- `http://localhost:3000`
- `http://localhost:3001` (proxy server)
- All origins (`*`)

---

## 🔐 1. Authentication Testing

### 1.1. Admin Login

**Endpoint:** `POST /api/admin/login`

**Request Body:**
```json
{
  "email": "admin@kugar.com",
  "password": "admin123",
  "device_name": "flutter_admin_app"
}
```

**PowerShell Command:**
```powershell
$body = @{
    email = "admin@kugar.com"
    password = "admin123"
    device_name = "flutter_admin_app"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/login" -Method POST -Body $body -ContentType "application/json"
```

**cURL (Windows):**
```cmd
curl -X POST http://wisatalembung.test/api/admin/login ^
  -H "Content-Type: application/json" ^
  -d "{\"email\":\"admin@kugar.com\",\"password\":\"admin123\",\"device_name\":\"flutter_admin_app\"}"
```

**Expected Response:**
```json
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
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxx"
  }
}
```

**⚠️ IMPORTANT:** Copy the `token` value for next requests!

---

### 1.2. Get Admin Profile

**Endpoint:** `GET /api/admin/me`

**Headers:**
- `Authorization: Bearer {YOUR_TOKEN}`

**PowerShell:**
```powershell
$token = "1|xxxxxxxxxxxxxxxxxxxxxxxxxxx"  # Replace with your token
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/me" -Headers @{Authorization="Bearer $token"}
```

**cURL:**
```cmd
curl -X GET http://wisatalembung.test/api/admin/me ^
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

**Expected Response:**
```json
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

---

### 1.3. Admin Logout

**Endpoint:** `POST /api/admin/logout`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN_HERE"
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/logout" -Method POST -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

## 👥 2. User Management Testing

> 🔑 **All requests below require Authorization header with admin token**

### 2.1. Get All Users (with Pagination & Search)

**Endpoint:** `GET /api/admin/users`

**Query Parameters:**
- `per_page` (optional): Number of items per page (default: 10)
- `search` (optional): Search by name, email, or phone
- `role` (optional): Filter by role (user, admin, staff)
- `page` (optional): Page number

**Examples:**

**Get all users (paginated):**
```powershell
$token = "YOUR_TOKEN"
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users" -Headers @{Authorization="Bearer $token"}
```

**Search users:**
```powershell
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users?search=john" -Headers @{Authorization="Bearer $token"}
```

**Filter by role:**
```powershell
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users?role=user" -Headers @{Authorization="Bearer $token"}
```

**Custom pagination:**
```powershell
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users?per_page=20&page=2" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
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

---

### 2.2. Get User Detail

**Endpoint:** `GET /api/admin/users/{id}`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$userId = 2
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users/$userId" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
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

---

### 2.3. Create New User

**Endpoint:** `POST /api/admin/users`

**Request Body:**
```json
{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "user"
}
```

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$body = @{
    name = "Jane Smith"
    email = "jane@example.com"
    password = "password123"
    password_confirmation = "password123"
    role = "user"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users" -Method POST -Body $body -ContentType "application/json" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "User berhasil dibuat",
  "data": {
    "id": 3,
    "name": "Jane Smith",
    "email": "jane@example.com",
    "role": "user",
    "created_at": "2024-12-04T11:00:00.000000Z"
  }
}
```

---

### 2.4. Update User

**Endpoint:** `PUT /api/admin/users/{id}`

**Request Body (all fields optional):**
```json
{
  "name": "Jane Doe",
  "email": "jane.doe@example.com",
  "password": "newpassword123",
  "password_confirmation": "newpassword123",
  "role": "staff"
}
```

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$userId = 3
$body = @{
    name = "Jane Doe"
    role = "staff"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users/$userId" -Method PUT -Body $body -ContentType "application/json" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
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

---

### 2.5. Delete User

**Endpoint:** `DELETE /api/admin/users/{id}`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$userId = 3
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users/$userId" -Method DELETE -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "User berhasil dihapus"
}
```

---

## 📦 3. Product Management Testing

> Products are stored in `kuliners` table

### 3.1. Get All Products

**Endpoint:** `GET /api/admin/products`

**Query Parameters:**
- `per_page` (optional): Items per page (default: 15)
- `search` (optional): Search by title or text

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products" -Headers @{Authorization="Bearer $token"}
```

**With search:**
```powershell
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products?search=garam" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
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
        "created_at": "2024-12-04T10:00:00.000000Z"
      }
    ],
    "per_page": 15,
    "total": 10
  }
}
```

---

### 3.2. Get Product Detail

**Endpoint:** `GET /api/admin/products/{id}`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$productId = 1
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products/$productId" -Headers @{Authorization="Bearer $token"}
```

---

### 3.3. Create New Product

**Endpoint:** `POST /api/admin/products`

**Request Body:**
```json
{
  "title": "Garam Laut Premium",
  "text": "Garam laut berkualitas tinggi dari petambak lokal",
  "price": 20000,
  "alamat": "Sumenep, Madura",
  "nomor_hp": "08123456789"
}
```

**PowerShell (without image):**
```powershell
$token = "YOUR_TOKEN"
$body = @{
    title = "Garam Laut Premium"
    text = "Garam laut berkualitas tinggi"
    price = 20000
    alamat = "Sumenep, Madura"
    nomor_hp = "08123456789"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products" -Method POST -Body $body -ContentType "application/json" -Headers @{Authorization="Bearer $token"}
```

**PowerShell (with image - multipart/form-data):**
```powershell
$token = "YOUR_TOKEN"
$imagePath = "C:\path\to\image.jpg"

# Create multipart form
$boundary = [System.Guid]::NewGuid().ToString()
$headers = @{
    Authorization = "Bearer $token"
    "Content-Type" = "multipart/form-data; boundary=$boundary"
}

# Build form data (simplified - use Postman for easier file upload)
```

**Expected Response:**
```json
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

---

### 3.4. Update Product

**Endpoint:** `PUT /api/admin/products/{id}`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$productId = 2
$body = @{
    title = "Garam Laut Super Premium"
    price = 25000
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products/$productId" -Method PUT -Body $body -ContentType "application/json" -Headers @{Authorization="Bearer $token"}
```

---

### 3.5. Delete Product

**Endpoint:** `DELETE /api/admin/products/{id}`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
$productId = 2
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products/$productId" -Method DELETE -Headers @{Authorization="Bearer $token"}
```

---

## 📊 4. Dashboard Statistics Testing

**Endpoint:** `GET /api/admin/statistics`

**PowerShell:**
```powershell
$token = "YOUR_TOKEN"
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/statistics" -Headers @{Authorization="Bearer $token"}
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Dashboard statistics retrieved successfully",
  "data": {
    "users": {
      "total": 45,
      "admins": 2,
      "recent": [...]
    },
    "products": {
      "total": 25,
      "average_price": 18500,
      "min_price": 10000,
      "max_price": 50000,
      "recent": [...]
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

## 🔍 5. Troubleshooting

### Common Errors

#### 1. **401 Unauthorized**
```json
{
  "success": false,
  "message": "Unauthenticated. Silakan login terlebih dahulu."
}
```
**Solution:** Check if you're sending the Authorization header with valid token.

---

#### 2. **403 Forbidden**
```json
{
  "success": false,
  "message": "Akses ditolak. Hanya admin yang dapat mengakses endpoint ini."
}
```
**Solution:** Make sure logged-in user has `role = 'admin'`.

---

#### 3. **422 Validation Error**
```json
{
  "success": false,
  "message": "Validasi gagal",
  "errors": {
    "email": ["The email has already been taken."]
  }
}
```
**Solution:** Check request body and fix validation errors.

---

#### 4. **CORS Error** (from Flutter/frontend)
```
Access to fetch at '...' from origin 'http://localhost:3001' has been blocked by CORS policy
```
**Solution:** Ensure CORS is configured in `config/cors.php`:
```php
'allowed_origins' => ['*'],
```

---

### Check Database Connection

**PowerShell:**
```powershell
cd C:\Users\LENOVO\Herd\wisatalembung
php artisan migrate:status
```

---

### Clear Cache

If you make changes to config files:
```powershell
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

### Check Laravel Logs

If something goes wrong:
```powershell
Get-Content C:\Users\LENOVO\Herd\wisatalembung\storage\logs\laravel.log -Tail 50
```

---

## 📝 Quick Test Script

Save this as `test-api.ps1`:

```powershell
# === ADMIN API TEST SCRIPT ===

$baseUrl = "http://wisatalembung.test/api"

# 1. Login
Write-Host "🔐 Testing Admin Login..." -ForegroundColor Cyan
$loginBody = @{
    email = "admin@kugar.com"
    password = "admin123"
    device_name = "test_script"
} | ConvertTo-Json

$loginResponse = Invoke-RestMethod -Uri "$baseUrl/admin/login" -Method POST -Body $loginBody -ContentType "application/json"
$token = $loginResponse.data.token

Write-Host "✅ Login Success! Token: $($token.Substring(0,20))..." -ForegroundColor Green

# 2. Get Profile
Write-Host "`n👤 Testing Get Profile..." -ForegroundColor Cyan
$profile = Invoke-RestMethod -Uri "$baseUrl/admin/me" -Headers @{Authorization="Bearer $token"}
Write-Host "✅ Profile: $($profile.data.user.name)" -ForegroundColor Green

# 3. Get Users
Write-Host "`n👥 Testing Get Users..." -ForegroundColor Cyan
$users = Invoke-RestMethod -Uri "$baseUrl/admin/users" -Headers @{Authorization="Bearer $token"}
Write-Host "✅ Total Users: $($users.total)" -ForegroundColor Green

# 4. Get Products
Write-Host "`n📦 Testing Get Products..." -ForegroundColor Cyan
$products = Invoke-RestMethod -Uri "$baseUrl/admin/products" -Headers @{Authorization="Bearer $token"}
Write-Host "✅ Total Products: $($products.data.total)" -ForegroundColor Green

# 5. Get Statistics
Write-Host "`n📊 Testing Dashboard Statistics..." -ForegroundColor Cyan
$stats = Invoke-RestMethod -Uri "$baseUrl/admin/statistics" -Headers @{Authorization="Bearer $token"}
Write-Host "✅ Stats - Users: $($stats.data.users.total) | Products: $($stats.data.products.total)" -ForegroundColor Green

Write-Host "`n🎉 All tests completed successfully!" -ForegroundColor Green
```

**Run the script:**
```powershell
cd C:\Users\LENOVO\Herd\wisatalembung
.\test-api.ps1
```

---

## ✅ Checklist

Before testing with Flutter app:

- [ ] Database connected (check with TablePlus)
- [ ] Admin user exists in `users` table
- [ ] Laravel server running (`php artisan serve` or Herd)
- [ ] Can login via API (returns token)
- [ ] Can access protected endpoints with token
- [ ] CORS configured for Flutter app origin
- [ ] All endpoints return proper JSON format

---

## 🎯 Next Steps

1. ✅ Test all endpoints using this guide
2. ✅ Note your auth token
3. ✅ Configure Flutter app to use this token
4. ✅ Test from Flutter app
5. ✅ Debug if needed using Laravel logs

---

**Happy Testing! 🚀**
