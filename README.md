<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🚀 Laravel 12 Project

Ini adalah proyek berbasis Laravel 12. Dokumen ini menjelaskan langkah-langkah untuk setup dan menjalankan aplikasi secara lokal.

## 🧾 Requirement

Sebelum memulai, pastikan sistem Anda memiliki:

- PHP >= 8.2
- Composer
- MySQL / PostgreSQL / SQLite
- Node.js & NPM

## ⚙️ Langkah Setup

### 1. Clone Repository

```bash
git clone https://github.com/ihsanfirdaus/laravel_ihsanfirdaus.git
cd laravel_ihsanfirdaus
```
### 2. Install Dependency PHP

```bash
composer install
```
### 3. Salin File Environment

```bash
cp .env.example .env
```
Lalu ubah konfigurasi seperti
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Generate Application Key

```bash
php artisan key:generate
```
### 5. Jalankan Migrasi dan Seeder

```bash
php artisan migrate --seed
```
### 6. Install NPM

```bash
npm install
npm run dev
```
### 7. Jalankan Server

```bash
php artisan serve
```
