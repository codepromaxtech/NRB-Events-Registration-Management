# NRB Global Convention - Production Deployment Guide

## Production Optimization Completed ✅

The following optimizations have been applied:

### 1. Frontend Assets Built for Production
- Vite production build completed
- Assets minified and optimized
- CSS: 56.13 kB (gzip: 9.20 kB)
- JS: 81.83 kB (gzip: 30.58 kB)
- Build artifacts in `public/build/`

### 2. Laravel Caching Applied
- ✅ Configuration cached (`php artisan config:cache`)
- ✅ Routes cached (`php artisan route:cache`)
- ✅ Views cached (`php artisan view:cache`)
- ✅ Full optimization applied (`php artisan optimize`)

## Production Checklist

Before deploying to production, ensure:

### Environment Configuration
Update `.env` file with production settings:

```env
APP_NAME="NRB Global Convention 2025"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=nrb_production
DB_USERNAME=your-db-user
DB_PASSWORD=strong-password-here

# Mail (Production SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@nrbworld.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Security Steps

1. **Change Default Passwords:**
   ```bash
   php artisan tinker
   ```
   ```php
   $admin = User::where('email', 'admin@example.com')->first();
   $admin->password = Hash::make('new-secure-password');
   $admin->save();
   
   $superAdmin = User::where('email', 'superadmin@example.com')->first();
   $superAdmin->password = Hash::make('another-secure-password');
   $superAdmin->save();
   ```

2. **Set Secure Permissions:**
   ```bash
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

3. **Enable HTTPS:**
   - Configure SSL certificate
   - Update APP_URL to https://
   - Force HTTPS in production

### Running in Production

#### Option 1: Using PHP Artisan Serve (Development/Testing)
**Note:** Not recommended for production, but works for testing:
```bash
php artisan serve --host=0.0.0.0 --port=8080 --env=production
```

#### Option 2: Apache Configuration
Create Apache virtual host:
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/NRB/public

    <Directory /path/to/NRB/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/nrb_error.log
    CustomLog ${APACHE_LOG_DIR}/nrb_access.log combined
</VirtualHost>
```

Enable Apache modules:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Option 3: Nginx Configuration
Create Nginx server block:
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/NRB/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Performance Optimization

1. **Enable OPcache** (in `php.ini`):
   ```ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=10000
   opcache.validate_timestamps=0
   ```

2. **Queue Workers** (for email processing):
   ```bash
   php artisan queue:work --daemon
   ```

3. **Scheduled Tasks** (add to crontab):
   ```cron
   * * * * * cd /path/to/NRB && php artisan schedule:run >> /dev/null 2>&1
   ```

### Monitoring

- Monitor Laravel logs: `storage/logs/laravel.log`
- Set up error tracking (Sentry, Bugsnag, etc.)
- Monitor server resources (CPU, memory, disk)

### Updating Production

When making changes:
```bash
# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Run migrations
php artisan migrate --force

# Clear and rebuild caches
php artisan optimize:clear
php artisan optimize
```

## Current Development Server

The development server is still running on:
- **URL:** http://192.168.32.128:8080
- **Status:** Development mode
- **Caches:** Production caches applied

To restart with production served locally:
```bash
php artisan serve --host=0.0.0.0 --port=8080
```

## Default Admin Credentials

**⚠️ CHANGE THESE IMMEDIATELY IN PRODUCTION!**

- Admin: `admin@example.com` / `password`
- Super Admin: `superadmin@example.com` / `password`

## Support

For deployment issues:
- Check `storage/logs/laravel.log`
- Run `php artisan optimize:clear` if caching issues occur
- Verify file permissions on storage and bootstrap/cache
