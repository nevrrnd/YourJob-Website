# YourJob - Website Lowongan Kerja

YourJob adalah aplikasi web portal lowongan kerja berbasis Laravel, Blade, MySQL, Tailwind CSS, dan Alpine.js. Aplikasi ini dibuat untuk menghubungkan pencari kerja dengan perusahaan melalui sistem lowongan, lamaran, bookmark, verifikasi perusahaan, dan dashboard sesuai role pengguna.

Project ini memiliki tiga role utama:
- Admin
- Employer atau pemberi kerja
- Seeker atau pencari kerja

## Fitur Utama

| Fitur | Admin | Employer | Seeker |
|---|---:|---:|---:|
| Dashboard sesuai role | Ya | Ya | Ya |
| Kelola user | Ya | Tidak | Tidak |
| Verifikasi perusahaan | Ya | Tidak | Tidak |
| CRUD kategori lowongan | Ya | Tidak | Tidak |
| Kelola pengaturan situs | Ya | Tidak | Tidak |
| Posting, edit, dan hapus lowongan | Tidak | Ya | Tidak |
| Lihat daftar pelamar | Tidak | Ya | Tidak |
| Update status lamaran | Tidak | Ya | Tidak |
| Cari dan filter lowongan | Ya | Ya | Ya |
| Lamar pekerjaan dengan upload CV PDF | Tidak | Tidak | Ya |
| Simpan/bookmark lowongan | Tidak | Tidak | Ya |
| Kelola profil pribadi/perusahaan | Tidak | Ya | Ya |
| Login manual | Ya | Ya | Ya |
| Login dengan Google | Ya | Ya | Ya |

## Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Blade
- Laravel Breeze
- Laravel Socialite
- Tailwind CSS
- Alpine.js
- Vite
- Railway untuk deployment
- GitHub untuk version control

## Struktur Database

Tabel utama yang digunakan:

- `users`
- `seeker_profiles`
- `company_profiles`
- `categories`
- `jobs`
- `applications`
- `saved_jobs`
- `settings`
- `sessions`
- `password_reset_tokens`

Relasi utama:

- User memiliki role `admin`, `employer`, atau `seeker`.
- Employer memiliki satu `company_profile`.
- Seeker memiliki satu `seeker_profile`.
- Employer dapat membuat banyak `jobs`.
- Job memiliki satu `category`.
- Seeker dapat mengirim banyak `applications`.
- Job dapat memiliki banyak `applications`.
- Seeker dapat menyimpan banyak job melalui tabel pivot `saved_jobs`.

## Setup Lokal dengan XAMPP

1. Aktifkan Apache dan MySQL dari XAMPP Control Panel.

2. Buat database MySQL:

   ```sql
   CREATE DATABASE yourjob;
   ```

3. Salin file environment:

   ```bash
   cp .env.example .env
   ```

4. Sesuaikan konfigurasi database di `.env`:

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

5. Install dependency:

   ```bash
   composer install
   npm install
   ```

6. Generate app key:

   ```bash
   php artisan key:generate
   ```

7. Jalankan migration dan seeder:

   ```bash
   php artisan migrate --seed
   ```

8. Buat storage link:

   ```bash
   php artisan storage:link
   ```

9. Build asset frontend:

   ```bash
   npm run build
   ```

10. Akses aplikasi:

   - Via XAMPP: `http://localhost/carikerja/public`
   - Via Laravel dev server:

     ```bash
     php artisan serve
     ```

     lalu buka `http://127.0.0.1:8000`

## Akun Default

Seeder menyediakan akun demo berikut:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@yourjob.com` | `admin123` |
| Employer | `employer@yourjob.com` | `password` |
| Seeker | `seeker@yourjob.com` | `password` |

Jika akun belum ada di database production, jalankan:

```bash
php artisan db:seed --force
```

Atau hanya admin:

```bash
php artisan db:seed --class=AdminSeeder --force
```

## Google Login

Project menggunakan Laravel Socialite untuk login Google. Tambahkan konfigurasi berikut ke `.env`:

```env
GOOGLE_CLIENT_ID=isi_client_id_google
GOOGLE_CLIENT_SECRET=isi_client_secret_google
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

Di Google Cloud Console, tambahkan Authorized Redirect URI:

```text
http://localhost/carikerja/public/auth/google/callback
```

Untuk Railway:

```text
https://yourjob-website-production.up.railway.app/auth/google/callback
```

## Deployment Railway

Project ini dapat dideploy ke Railway menggunakan GitHub.

Variable penting untuk service Laravel:

```env
APP_NAME=YourJob
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourjob-website-production.up.railway.app
LOG_CHANNEL=stderr

DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
```

Pastikan service MySQL Railway sudah dibuat di project yang sama.

Setelah deploy, migration dan seeder dapat dijalankan melalui Railway Console:

```bash
php artisan migrate --seed --force
```

## Alur Demo

1. User melakukan register sebagai seeker atau employer.
2. Employer melengkapi profil perusahaan.
3. Admin login dan memverifikasi perusahaan.
4. Employer membuat lowongan kerja.
5. Seeker mencari lowongan, menyimpan lowongan, dan melamar dengan CV PDF.
6. Employer melihat pelamar dan memperbarui status lamaran.
7. Seeker melihat perkembangan status lamaran di dashboard.
8. Admin dapat mengelola kategori, user, lowongan, perusahaan, dan pengaturan situs.

## Catatan Production

- Upload file seperti CV, avatar, logo perusahaan, dan logo situs disimpan di `storage/app/public`.
- Untuk Railway/demo, storage lokal bisa digunakan.
- Untuk production serius, sebaiknya gunakan cloud storage seperti S3 atau Cloudflare R2 agar file upload tidak hilang saat container restart atau redeploy.
- Cache dan session menggunakan driver `file`, sedangkan queue menggunakan `sync`.

## Status

Project sudah mencakup fitur utama untuk portal lowongan kerja dan sudah siap digunakan untuk portfolio atau demo UAS Manajemen Database.
