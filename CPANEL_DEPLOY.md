# cPanel Deployment Guide

This guide explains how to deploy the NRB Global Convention application to a shared cPanel hosting environment without using the terminal.

## Files Provided
1. **`nrb_project.zip`**: Contains the entire application code, dependencies, and built assets.
2. **`nrb_backup.sql`**: Database backup (exported from SQLite).
3. **`database/database.sqlite`**: The actual SQLite database file (included in the zip).

## Option 1: The Easiest Way (Continue using SQLite)
Since the application is currently running on SQLite, the easiest way to deploy is to keep using it. You don't need to set up a MySQL database!

1. **Upload Files:**
   - Go to cPanel **File Manager**.
   - Create a folder named `nrb_app` in your home directory (e.g., `/home/youruser/nrb_app`).
   - Upload `nrb_project.zip` to this folder and **Extract** it.

2. **Setup Public Folder:**
   - Move the contents of `nrb_app/public` to your `public_html` folder.
   - Edit `public_html/index.php`:
     Change:
     ```php
     require __DIR__.'/../vendor/autoload.php';
     $app = require_once __DIR__.'/../bootstrap/app.php';
     ```
     To:
     ```php
     require __DIR__.'/../nrb_app/vendor/autoload.php';
     $app = require_once __DIR__.'/../nrb_app/bootstrap/app.php';
     ```

3. **Configure Environment:**
   - Edit `nrb_app/.env` file:
     ```env
     APP_NAME="NRB Global Convention 2025"
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://yourdomain.com
     
     DB_CONNECTION=sqlite
     # Use the ABSOLUTE path to the database file
     DB_DATABASE=/home/youruser/nrb_app/database/database.sqlite
     ```

4. **Permissions:**
   - Ensure `nrb_app/storage` and `nrb_app/database` folders have write permissions (755 or 775).

## Option 2: Using MySQL (If you prefer)

1. **Create Database:**
   - Go to cPanel **MySQL Database Wizard**.
   - Create a database (e.g., `youruser_nrb`).
   - Create a user and password, and assign full privileges to the database.

2. **Import Data:**
   - Go to **phpMyAdmin**.
   - Select your new database.
   - Click **Import** and upload `nrb_backup.sql`.
   - *Note: Since this dump is from SQLite, if you encounter errors, it might be easier to stick with Option 1.*

3. **Configure Environment:**
   - Edit `nrb_app/.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=youruser_nrb
     DB_USERNAME=youruser_dbuser
     DB_PASSWORD=yourpassword
     ```

## Troubleshooting

- **500 Error:** Check `nrb_app/storage/logs/laravel.log` for details.
- **Permission Denied:** Ensure `storage` and `bootstrap/cache` are writable.
- **Images not showing:** Ensure the `storage` link exists. In cPanel, you might need to manually create a symlink from `nrb_app/storage/app/public` to `public_html/storage`.
  - You can do this via a Cron Job command: `ln -s /home/youruser/nrb_app/storage/app/public /home/youruser/public_html/storage` (Run once then delete).
