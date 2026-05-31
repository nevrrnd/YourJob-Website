# YourJob — Website Lowongan Kerja

Aplikasi web lowongan kerja berbasis **Laravel 11 + Blade + MySQL + Tailwind CSS** dengan
tiga peran pengguna: **Admin**, **Employer** (pemberi kerja), dan **Seeker** (pencari kerja).

## Fitur

| Fitur | Admin | Employer | Seeker |
|---|---|---|---|
| Dashboard global + kelola user | ✅ | ❌ | ❌ |
| Approve / verifikasi perusahaan | ✅ | ❌ | ❌ |
| CRUD kategori | ✅ | ❌ | ❌ |
| Posting & kelola lowongan | ❌ | ✅ | ❌ |
| Kelola lamaran masuk | ❌ | ✅ | ❌ |
| Lamar pekerjaan + upload CV | ❌ | ❌ | ✅ |
| Bookmark lowongan | ❌ | ❌ | ✅ |
| Lihat & cari lowongan | ✅ | ✅ | ✅ |

## Tech Stack
- Laravel 11, PHP 8.2+
- MySQL (XAMPP)
- Laravel Breeze (Blade) untuk autentikasi
- Tailwind CSS + Alpine.js (Vite)

## Setup (XAMPP)

1. Pastikan **Apache** dan **MySQL** aktif di XAMPP Control Panel.
2. Buat database (otomatis dibuat oleh migrasi jika sudah ada). Nama DB: `yourjob`.
3. Konfigurasi `.env` (sudah disetel):
   ```env
   APP_NAME=YourJob
   APP_URL=http://localhost/carikerja/public
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=yourjob
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Install dependency & build asset:
   ```bash
   composer install
   npm install && npm run build
   php artisan storage:link
   ```
5. Migrasi + seed data:
   ```bash
   php artisan migrate --seed
   ```
6. Akses aplikasi:
   - Via XAMPP Apache: `http://localhost/carikerja/public`
   - Atau via dev server: `php artisan serve` → `http://127.0.0.1:8000`

## Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | `admin@yourjob.com` | `admin123` |
| Employer (terverifikasi) | `employer@yourjob.com` | `password` |
| Seeker | `seeker@yourjob.com` | `password` |

## Alur Demo
1. Register seeker → Register employer.
2. Login admin → verifikasi perusahaan employer.
3. Employer login → posting lowongan.
4. Seeker login → cari lowongan, lamar (upload CV PDF), bookmark.
5. Employer → lihat pelamar, update status lamaran.
6. Seeker → lihat perubahan status di dashboard.

## Struktur Database (7 tabel)
`users`, `seeker_profiles`, `company_profiles`, `categories`, `jobs`, `applications`, `saved_jobs`.

## Catatan
- Session & cache menggunakan driver `file`, queue `sync` (tidak butuh tabel tambahan).
- Upload file (CV, logo, avatar) disimpan di `storage/app/public` dan diakses via `storage:link`.
