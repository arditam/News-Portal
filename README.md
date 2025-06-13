
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
git clone https://github.com/RifqiArdian09/News-Portal.git
cd News-Portal
```
### 2. Copy file .env.example
```bash
copy .env.example .env
```

### 3. Setup database pada komputer anda, lalu masukkan kredensial-kredensialnya ke file .env.
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=news_portal
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install dependency
```bash
composer install
```
### 5. Generate application key
```bash
php artisan key:generate
```
### 6. Link storage untuk file upload
```bash
php artisan storage:link
```
### 7. Migrasi database
```bash
php artisan migrate
```
### 8. Jalankan aplikasi
```bash
php artisan serve
```

### 9. Buat akun admin untuk Filament
```bash
php artisan make:filament-user
```
### 10. Kalau gambar tidak muncul 
```bash
rd public\storage    
php artisan storage:link
```




