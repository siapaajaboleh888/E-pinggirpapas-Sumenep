# ======================================
# 🧪 SIMPLE API TEST
# ======================================

$baseUrl = "http://wisatalembung.test/api"

Write-Host "`n🔐 Testing Admin Login..." -ForegroundColor Cyan

$loginBody = @{
    email = "admin@kugar.com"
    password = "admin123"
    device_name = "test"
} | ConvertTo-Json

try {
    $response = Invoke-RestMethod -Uri "$baseUrl/admin/login" -Method POST -Body $loginBody -ContentType "application/json"
    
    Write-Host "✅ Login Successful!" -ForegroundColor Green
    Write-Host "`nAdmin: $($response.data.user.name)" -ForegroundColor White
    Write-Host "Token: $($response.data.token.Substring(0,30))..." -ForegroundColor Yellow
    Write-Host "`nFull Token (copy this):" -ForegroundColor Cyan
    Write-Host "$($response.data.token)" -ForegroundColor Yellow
    
} catch {
    Write-Host "❌ Error: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "`nMake sure:" -ForegroundColor Yellow
    Write-Host "1. Laravel server is running (Herd should handle this)" -ForegroundColor White  
    Write-Host "2. Database is connected" -ForegroundColor White
    Write-Host "3. Admin user exists in database" -ForegroundColor White
}

Write-Host ""
