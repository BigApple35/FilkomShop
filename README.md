# Filkom Shop Project
Aplikasi ini merupakan aplikasi berbasis Laravel yang digunakan untuk melakukan jual beli online. Aplikasi ini memiliki fitur Authentikasi 3 Role, Transaksi, Cart, Manajement Product dan Dashboard.

# Feature
Authentication (Roles : Admin, Customer, Seller)
- Login
- Register
- Logout
- Edit Profile

Seller
- CRUD for item
- Dashboard
- Incoming Orders

Customer
- Storefront
- Shopping Cart
- Check out & History
- View Item
- View Store
- Bookmark
- Cancel Order

Admin
- Manage User
- Manage Item
- Manage Categories
- Dashboard


# Laravel Project Setup & Run Guide

## Prerequisites

Make sure the following are installed on your machine:

* PHP 8.1 or higher
* Composer
* MySQL / MariaDB
* Node.js and NPM (for frontend assets)

Check versions:

```bash
php -v
composer -V
node -v
npm -v
```

---

## 1. Clone the Project

```bash
git clone <repository-url>
cd <project-folder>
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Create Environment File

Copy the example environment file:

```bash
cp .env.example .env
```

For Windows:

```bash
copy .env.example .env
```

---

## 4. Configure Database

Open `.env` and update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Create the database in MySQL before continuing.

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Run Database Migrations

```bash
php artisan migrate
```

---

## 7. Seed Initial Data (Optional)

```bash
php artisan db:seed
```

Or run a specific seeder:

```bash
php artisan db:seed --class=UserSeeder
```

---

## 8. Install Frontend Dependencies

```bash
npm install
```

---

## 9. Build Frontend Assets

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

---

## 10. Start the Laravel Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## Useful Commands

### Clear Cache

```bash
php artisan optimize:clear
```

### Refresh Database

```bash
php artisan migrate:fresh --seed
```

### View Routes

```bash
php artisan route:list
```

### Check Application Status

```bash
php artisan about
```

---

## Default User Accounts

| Role     | Email                                               | Password |
| -------- | --------------------------------------------------- | -------- |
| Admin    | [admin@example.com](mailto:admin@example.com)       | password |
| Seller   | [seller@example.com](mailto:seller@example.com)     | password |
| Customer | [customer@example.com](mailto:customer@example.com) | password |

> Change default passwords before deploying to production.
