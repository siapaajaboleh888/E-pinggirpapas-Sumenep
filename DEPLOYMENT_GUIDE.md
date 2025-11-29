# Panduan Integrasi GitHub dengan hPanel

## File yang Telah Dibuat

### 1. `.cpanel.yml`
File konfigurasi untuk auto-deployment di hPanel. **PENTING: Edit USERNAME_CPANEL**

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/USERNAME_CPANEL/public_html/kugar/
    - /bin/cp -R * $DEPLOYPATH
    - cd $DEPLOYPATH && composer install --no-dev --optimize-autoloader
    - cd $DEPLOYPATH && php artisan config:clear
    - cd $DEPLOYPATH && php artisan config:cache
    - cd $DEPLOYPATH && php artisan route:clear
    - cd $DEPLOYPATH && php artisan route:cache
    - cd $DEPLOYPATH && php artisan view:clear
    - cd $DEPLOYPATH && php artisan view:cache
    - cd $DEPLOYPATH && php artisan migrate --force
    - cd $DEPLOYPATH && php artisan storage:link
```

### 2. `.env.production.example`
Template environment untuk production. Copy ke hosting sebagai `.env`

## Langkah-langkah Setup

### Langkah 1: Edit .cpanel.yml
Ganti `USERNAME_CPANEL` dengan username hPanel Anda:
```bash
# Contoh: jika username hPanel Anda adalah "user123"
export DEPLOYPATH=/home/user123/public_html/kugar/
```

### Langkah 2: Push ke GitHub
```bash
git add .cpanel.yml .env.production.example DEPLOYMENT_GUIDE.md
git commit -m "Add deployment configuration for hPanel"
git push origin main
```

### Langkah 3: Setup di hPanel
1. Login ke hPanel
2. Navigasi ke **Git Version Control**
3. Klik **Create**
4. Isi form:
   - **Clone URL**: `https://github.com/siapaajaboleh888/E-pinggirpapas-Sumenep.git`
   - **Repository Path**: `/home/USERNAME_CPANEL/kugar-git`
   - **Branch**: `main`
5. Klik **Create**

### Langkah 4: Setup Webhook
1. Setelah repository ter-clone, klik **Manage**
2. Pilih tab **Pull or Deploy**
3. Aktifkan **Auto Deployment**
4. Copy **Webhook URL** yang diberikan
5. Di GitHub:
   - Repository → Settings → Webhooks
   - Add webhook dengan URL dari hPanel
   - Content type: `application/json`
   - Pilih "Just the `push`" event

### Langkah 5: Environment Setup
1. Di hPanel File Manager, buka folder `kugar-git`
2. Copy `.env.production.example` ke `.env`
3. Edit `.env` dengan data hosting:
   - Database name, username, password
   - Mail configuration
   - URL: `https://kugar.e-pinggirpapas-sumenep.com`

### Langkah 6: Deploy Pertama
1. Di Git Version Control hPanel
2. Klik **Update from Remote**
3. Klik **Deploy HEAD Commit**

## Proses Auto-Deployment

Setiap kali Anda push ke GitHub:
1. Webhook akan memicu hPanel
2. hPanel pull changes terbaru
3. Jalankan tasks di `.cpanel.yml`:
   - Copy file ke `public_html/kugar/`
   - Install dependencies
   - Cache configuration & routes
   - Run migrations
   - Create storage link

## Troubleshooting

### Error Permission
Jika ada error permission, jalankan di hPanel Terminal:
```bash
chmod -R 755 public_html/kugar/
chmod -R 777 storage bootstrap/cache
```

### Error Composer
Jika composer gagal, pastikan PHP versi compatible dan memory cukup:
```bash
cd public_html/kugar/
php -v
composer install --no-dev --optimize-autoloader
```

### Error Database
Pastikan `.env` sudah benar dan database sudah dibuat di hosting.

## Keuntungan Setup Ini

✅ **Version Control**: Setiap perubahan tercatat di GitHub
✅ **Auto-Deployment**: Push langsung live tanpa manual upload
✅ **Backup**: GitHub sebagai backup code
✅ **Team Collaboration**: Bekerja tim lebih mudah
✅ **Rollback**: Mudah kembali ke versi sebelumnya

## Catatan Penting

- **USERNAME_CPANEL**: Harus diganti dengan username hPanel yang sebenarnya
- **Database**: Database harus dibuat manual di hosting sebelum deploy
- **Storage**: Pastikan folder `storage` writable
- **Testing**: Test di development dulu sebelum push ke main branch
