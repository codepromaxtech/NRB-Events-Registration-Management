# NRB Global Convention 2025 - Registration System

A comprehensive event registration management system built with Laravel for the NRB Global Convention 2025. This application enables users to register for the convention, submit their details, upload required documents, and receive digital visiting cards upon approval.

## Features

- **User Registration & Authentication** - Secure user registration and login system
- **Event Registration Form** - Comprehensive registration form with:
  - Personal information (name, email, phone, photo)
  - Professional details (organization, designation, business type)
  - Contact information (address, city, state, zip code)
  - Document uploads (photo, payment proof, digital signature)
  - Payment information (BDT ৳15,000 / USD $200)
- **Admin Dashboard** - Tabbed interface for managing registrations:
  - Pending registrations review
  - Approve or reject applications
  - View payment proofs and documents
- **User Management** - Admin interface to manage users and roles
- **Digital Visiting Cards** - Automatically generated PDF visiting cards sent via email upon approval
- **Role-Based Access Control** - Three user roles:
  - **User (Register)** - Can submit registration
  - **Admin** - Can approve/reject registrations and view users
  - **Super Admin** - Full access including user management
- **Responsive Design** - Mobile-friendly interface with modern dark green theme
- **Email Notifications** - Automated emails with visiting card attachments

## System Requirements

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL 5.7+ or MariaDB 10.3+
- Web server (Apache/Nginx)

## Installation

### 1. Clone the Repository

```bash
git clone <repository-url>
cd NRB
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the following configuration in `.env`:

```env
APP_NAME="NRB Global Convention 2025"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nrb_registration
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@nrbworld.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

Create a MySQL database named `nrb_registration` (or your chosen name from `.env`).

### 6. Run Migrations & Seeders

```bash
php artisan migrate --seed
```

This will:
- Create all necessary database tables
- Create default roles (register, admin, super_admin)
- Create default admin users (see credentials below)

### 7. Create Storage Symlink

```bash
php artisan storage:link
```

### 8. Build Frontend Assets

```bash
npm run build
```

For development with hot reloading:
```bash
npm run dev
```

### 9. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Admin Credentials

The system comes with two pre-configured admin accounts:

### Admin Account
- **Email:** `admin@example.com`
- **Password:** `password`
- **Role:** Admin
- **Permissions:** Can approve/reject registrations, view users

### Super Admin Account
- **Email:** `superadmin@example.com`
- **Password:** `password`
- **Role:** Super Admin
- **Permissions:** Full access - manage users, assign roles, delete users

> **⚠️ IMPORTANT:** Change these default passwords immediately in production!

## Usage Guide

### For Participants (Users)

1. **Register an Account**
   - Go to the landing page
   - Click "Register Now"
   - Create your account with email and password

2. **Submit Registration**
   - Log in to your account
   - Navigate to Dashboard
   - Click "Start Registration"
   - Fill in all required fields:
     - Upload passport-size photo
     - Enter passport/NID number, nationality, country
     - Provide phone, organization, designation
     - Enter business type and website
     - Provide complete address
     - Upload payment proof (bank transfer receipt)
     - Upload digital signature
   - Submit the form

3. **Track Status**
   - View registration status on dashboard
   - Receive email notification upon approval
   - Download visiting card from email

### For Admins

1. **Login**
   - Use admin credentials to log in
   - Access admin dashboard from navigation

2. **Manage Registrations**
   - View **Pending** tab for new registrations
   - Click "View Details" to review application
   - Check payment proof and documents
   - **Approve** or **Reject** with optional notes
   - Approved users receive visiting card via email

3. **Manage Users** (Admin/Super Admin)
   - Click "Manage Users" in navigation
   - View all registered users
   - See user roles and registration status
   - **Super Admin only:**
     - Change user roles via dropdown
     - Delete users (cannot delete yourself)

## Project Structure

```
NRB/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php          # Registration approval
│   │   ├── RegistrationController.php   # Registration form
│   │   └── UserController.php           # User management
│   ├── Mail/
│   │   └── VisitingCardMail.php        # Email with visiting card
│   └── Models/
│       ├── User.php
│       └── Registration.php
├── database/
│   ├── migrations/                      # Database schema
│   └── seeders/
│       ├── RoleSeeder.php              # Creates roles and admins
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/                      # Admin dashboard
│   │   ├── registration/               # Registration form
│   │   ├── users/                      # User management
│   │   ├── dashboard.blade.php         # User dashboard
│   │   └── welcome.blade.php           # Landing page
│   └── css/
│       └── app.css                     # Tailwind CSS
└── public/
    ├── images/
    │   └── logo.png                    # NRB Logo
    └── storage/                        # Uploaded files (symlink)
```

## Payment Information

### Bangladesh Residents
- **Amount:** ৳15,000 BDT
- **Bank:** Islami Bank Bangladesh Ltd
- **Branch:** Gulshan Branch
- **Account Name:** NRB World
- **Account Number:** 20502510200123456
- **Routing Number:** 125260345

### International Participants
- **Amount:** $200 USD
- **Bank:** Islami Bank Bangladesh Ltd
- **Branch:** Gulshan Branch
- **Account Name:** NRB World
- **Account Number:** 20502510200234567
- **SWIFT Code:** IBBLBDDH
- **Routing Number:** 125260345

## Troubleshooting

### Views Not Updating
Clear view cache:
```bash
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

### Permission Errors
Ensure storage and bootstrap/cache are writable:
```bash
chmod -R 775 storage bootstrap/cache
```

### Email Not Sending
- Check `.env` mail configuration
- Use [Mailtrap](https://mailtrap.io) for testing
- Verify SMTP credentials

### File Upload Issues
- Check `php.ini` settings:
  - `upload_max_filesize = 10M`
  - `post_max_size = 10M`
- Ensure storage folder is writable

## Security Notes

1. **Change Default Passwords** - Update admin passwords immediately
2. **Environment File** - Never commit `.env` to version control
3. **HTTPS in Production** - Always use SSL certificates
4. **Database Backups** - Regular backups of user data
5. **File Validation** - System validates uploaded files (images, PDFs)

## Technologies Used

- **Laravel 11** - PHP framework
- **Laravel Breeze** - Authentication scaffolding
- **Spatie Laravel Permission** - Role and permission management
- **Tailwind CSS** - Utility-first CSS framework
- **DomPDF** - PDF generation for visiting cards
- **MySQL** - Database

## License

This project is proprietary software for NRB Global Convention 2025.

## Support

For technical support or questions:
- Email: support@nrbworld.com
- Event Date: October 15-17, 2025
- Location: Javits Center, New York

---

**© 2025 NRB World. All rights reserved.**
