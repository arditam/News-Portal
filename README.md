
# 📰 News Portal

Portal berita berbasis Laravel 12 yang modern, ringan, dan responsif, menggunakan Tailwind CSS dan Filament Admin Panel.



## 🛠️ Tech Stack
- Laravel 12
- Tailwind CSS
- Filament
- MySQL

## 📋 Prerequisites
Pastikan sudah terinstal di sistem kamu:
- PHP ^8.2
- Composer ^2.2
- MySQL
## ⚙️ Setup Guide

### 1. Clone project
```bash
git clone https://github.com/arditam/News-Portal.git
cd News-Portal
```

### 2. Setup database pada komputer anda, lalu masukkan kredensial-kredensialnya ke file .env.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_portal
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Install dependency
```bash
composer install
```
### 4. Generate application key
```bash
php artisan key:generate
```
### 5. Link storage untuk file upload
```bash
php artisan storage:link
```
### 6. Migrasi database
```bash
php artisan migrate
```
### 7. Jalankan aplikasi
```bash
php artisan serve
```

### 8. Buat akun admin untuk Filament
```bash
php artisan make:filament-user
```



