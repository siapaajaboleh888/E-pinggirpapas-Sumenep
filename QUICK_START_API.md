# 🚀 E-Pinggirpapas Admin API - Quick Start

> **Status:** ✅ READY FOR FLUTTER INTEGRATION  
> **Last Updated:** December 4, 2024

---

## 📋 Quick Overview

Backend API untuk Flutter Admin Panel **E-Pinggirpapas Sumenep** sudah **100% configured** dan ready to use!

### What's Included:

✅ Authentication (Sanctum)  
✅ User Management (CRUD + Search + Filter)  
✅ Product Management (CRUD + Image Upload)  
✅ Dashboard Statistics (Enhanced)  
✅ Orders Management  
✅ Virtual Tours Management  
✅ Content Management  
✅ CORS Configuration  

---

## 🎯 Quick Start (3 Steps)

### 1️⃣ Test Login API

```powershell
# Run this in PowerShell
cd C:\Users\LENOVO\Herd\wisatalembung
.\test-login.ps1
```

**Expected Output:**
```
✅ Login Successful!

Admin: Admin KUGAR
Token: 1|xxxxxxxxxxxxxxxxxxxxx...

Full Token (copy this):
1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

### 2️⃣ Copy Your Token

Save the token from step 1 - you'll need it for all API requests.

### 3️⃣ Test Other Endpoints

```powershell
# Set your token
$token = "YOUR_TOKEN_HERE"

# Test get users
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/users" -Headers @{Authorization="Bearer $token"}

# Test get products
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/products" -Headers @{Authorization="Bearer $token"}

# Test dashboard stats
Invoke-RestMethod -Uri "http://wisatalembung.test/api/admin/statistics" -Headers @{Authorization="Bearer $token"}
```

---

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| **BACKEND_API_TESTING_GUIDE.md** | Complete testing guide with all endpoints |
| **BACKEND_API_SETUP_SUMMARY.md** | Configuration overview & status |
| **test-login.ps1** | Quick login test |
| **test-admin-api.ps1** | Full automated test suite |

---

## 🔑 API Credentials

**Admin Login:**
- Email: `admin@kugar.com`
- Password: `admin123`
- Device Name: `flutter_admin_app` (or any string)

---

## 🌐 API Endpoints Summary

### Base URL
```
Local: http://wisatalembung.test/api
```

### Authentication
```
POST /api/admin/login          - Login (Public)
POST /api/admin/logout         - Logout (Protected)
GET  /api/admin/me             - Get admin profile (Protected)
```

### Users (Protected)
```
GET    /api/admin/users              - List users (search, filter, pagination)
GET    /api/admin/users/{id}         - Get user detail
POST   /api/admin/users              - Create user
PUT    /api/admin/users/{id}         - Update user
DELETE /api/admin/users/{id}         - Delete user
```

### Products (Protected)
```
GET    /api/admin/products           - List products
GET    /api/admin/products/{id}      - Get product detail
POST   /api/admin/products           - Create product
PUT    /api/admin/products/{id}      - Update product
DELETE /api/admin/products/{id}      - Delete product
POST   /api/admin/products/{id}/upload-image - Upload image
```

### Dashboard (Protected)
```
GET /api/admin/statistics      - Dashboard statistics
```

---

## 📊 Response Format

All responses follow this standard:

**Success:**
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... }
}
```

**Pagination:**
```json
{
  "success": true,
  "message": "Data retrieved",
  "data": [...],
  "current_page": 1,
  "last_page": 5,
  "per_page": 10,
  "total": 45
}
```

**Error:**
```json
{
  "success": false,
  "message": "Error message",
  "errors": { ... }
}
```

---

## 🔧 Configuration Status

| Component | Status |
|-----------|--------|
| Laravel | ✅ Installed |
| Sanctum | ✅ Configured |
| Database | ✅ Connected |
| CORS | ✅ Configured |
| Admin Middleware | ✅ Active |
| Routes | ✅ Defined |
| Controllers | ✅ Ready |

---

## 🧪 Testing

### Option 1: Simple Login Test
```powershell
.\test-login.ps1
```

### Option 2: Full Test Suite
```powershell
.\test-admin-api.ps1
```

### Option 3: Manual Testing
See `BACKEND_API_TESTING_GUIDE.md` for detailed examples.

---

## 🐛 Troubleshooting

### Server not running?
**Using Herd:** Server should auto-start when you access `wisatalembung.test`

**Manual start:**
```powershell
php artisan serve
# Then use: http://localhost:8000/api
```

### Database not connected?
```powershell
php artisan migrate:status
```

### Need to clear cache?
```powershell
php artisan config:clear
php artisan cache:clear
```

### Check logs?
```powershell
Get-Content storage\logs\laravel.log -Tail 50
```

---

## 📱 Flutter Integration

### 1. Configure Base URL in Flutter
```dart
class ApiConfig {
  static const String baseUrl = 'http://wisatalembung.test/api';
  // or 'http://10.0.2.2:8000/api' for Android emulator
}
```

### 2. Login Request Example
```dart
final response = await http.post(
  Uri.parse('${ApiConfig.baseUrl}/admin/login'),
  headers: {'Content-Type': 'application/json'},
  body: jsonEncode({
    'email': 'admin@kugar.com',
    'password': 'admin123',
    'device_name': 'flutter_admin_app',
  }),
);

final data = jsonDecode(response.body);
if (data['success']) {
  String token = data['data']['token'];
  // Save token for future requests
}
```

### 3. Authenticated Request Example
```dart
final response = await http.get(
  Uri.parse('${ApiConfig.baseUrl}/admin/users'),
  headers: {
    'Authorization': 'Bearer $token',
    'Accept': 'application/json',
  },
);
```

---

## ✨ What's New (Recent Improvements)

### Enhanced User Management:
- ✅ Search by name, email, phone
- ✅ Filter by role (user/admin/staff)
- ✅ Custom pagination (per_page parameter)
- ✅ Better response format

### Enhanced Dashboard Statistics:
- ✅ More detailed metrics (users, products, orders, revenue)
- ✅ Recent items (last 5 users & products)
- ✅ Product price statistics (avg, min, max)
- ✅ Formatted revenue (Rupiah format)
- ✅ Monthly revenue chart (last 6 months)
- ✅ Better error handling

---

## 📞 Need Help?

1. Check `BACKEND_API_TESTING_GUIDE.md` for detailed examples
2. Check `BACKEND_API_SETUP_SUMMARY.md` for configuration details
3. Check Laravel logs: `storage/logs/laravel.log`
4. Test with PowerShell scripts first before Flutter

---

## ✅ Checklist Before Flutter Development

- [ ] ✅ Backend API tested with `test-login.ps1`
- [ ] ✅ Got auth token successfully
- [ ] ✅ Tested at least 1 protected endpoint (users or products)
- [ ] ✅ CORS configured (should work from localhost:3001)
- [ ] ✅ Database connected and populated
- [ ] 🔲 Flutter app configured with correct base URL
- [ ] 🔲 Token management implemented in Flutter
- [ ] 🔲 API service layer created in Flutter

---

## 🎉 Ready to Build!

Your backend API is **fully configured** and **ready for Flutter integration**!

**Next Steps:**
1. ✅ Test API with PowerShell (DONE)
2. 🔲 Configure Flutter app
3. 🔲 Build admin UI
4. 🔲 Connect to API
5. 🔲 Test end-to-end

---

**Happy Coding! 🚀**

*Project: E-Pinggirpapas Sumenep*  
*Tech Stack: Laravel 10 + Sanctum + MySQL*  
*Frontend: Flutter Admin Panel*
