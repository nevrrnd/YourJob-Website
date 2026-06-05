-- =========================================================
-- QUERY SQL UAS - YOURJOB
-- Website Lowongan Kerja Berbasis Laravel dan MySQL
-- =========================================================

-- 1. Membuat database
CREATE DATABASE IF NOT EXISTS yourjob;
USE yourjob;

-- 2. Struktur tabel utama

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employer', 'seeker') NOT NULL DEFAULT 'seeker',
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    google_id VARCHAR(255) NULL,
    avatar VARCHAR(255) NULL,
    language VARCHAR(10) NULL,
    timezone VARCHAR(100) NULL,
    email_notifications BOOLEAN NOT NULL DEFAULT TRUE,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    icon VARCHAR(50) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE seeker_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    phone VARCHAR(50) NULL,
    city VARCHAR(255) NULL,
    bio TEXT NULL,
    skills JSON NULL,
    cv_file VARCHAR(255) NULL,
    avatar VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_seeker_profiles_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE company_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    company_name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    logo VARCHAR(255) NULL,
    industry VARCHAR(255) NULL,
    city VARCHAR(255) NULL,
    description TEXT NULL,
    is_verified BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_company_profiles_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employer_id BIGINT UNSIGNED NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    requirements TEXT NOT NULL,
    benefits TEXT NULL,
    type ENUM('full_time', 'part_time', 'freelance', 'internship', 'contract') NOT NULL,
    location_type ENUM('onsite', 'remote', 'hybrid') NOT NULL,
    city VARCHAR(255) NULL,
    salary_min VARCHAR(255) NULL,
    salary_max VARCHAR(255) NULL,
    salary_visible BOOLEAN NOT NULL DEFAULT TRUE,
    experience ENUM('fresh_graduate', '1-2', '2-5', '5+') NOT NULL,
    status ENUM('active', 'closed', 'draft') NOT NULL DEFAULT 'active',
    deadline DATE NULL,
    view_count INT UNSIGNED NOT NULL DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_jobs_employer
        FOREIGN KEY (employer_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_jobs_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE CASCADE
);

CREATE TABLE applications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    job_id BIGINT UNSIGNED NOT NULL,
    seeker_id BIGINT UNSIGNED NOT NULL,
    cv_file VARCHAR(255) NOT NULL,
    cover_letter TEXT NULL,
    status ENUM('pending', 'reviewed', 'interview', 'accepted', 'rejected') NOT NULL DEFAULT 'pending',
    employer_note TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_applications_job
        FOREIGN KEY (job_id) REFERENCES jobs(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_applications_seeker
        FOREIGN KEY (seeker_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT unique_application
        UNIQUE (job_id, seeker_id)
);

CREATE TABLE saved_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    job_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_saved_jobs_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_saved_jobs_job
        FOREIGN KEY (job_id) REFERENCES jobs(id)
        ON DELETE CASCADE,
    CONSTRAINT unique_saved_job
        UNIQUE (user_id, job_id)
);

CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(255) NOT NULL UNIQUE,
    value TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =========================================================
-- 3. Contoh INSERT data awal
-- =========================================================

INSERT INTO users (name, email, password, role, is_active, created_at, updated_at)
VALUES
('Administrator', 'admin@yourjob.com', 'password_hash_admin', 'admin', TRUE, NOW(), NOW()),
('PT Maju Teknologi', 'employer@yourjob.com', 'password_hash_employer', 'employer', TRUE, NOW(), NOW()),
('Budi Santoso', 'seeker@yourjob.com', 'password_hash_seeker', 'seeker', TRUE, NOW(), NOW());

INSERT INTO categories (name, slug, icon, created_at, updated_at)
VALUES
('Teknologi IT', 'teknologi-it', '💻', NOW(), NOW()),
('Desain Kreatif', 'desain-kreatif', '🎨', NOW(), NOW());

INSERT INTO company_profiles (user_id, company_name, slug, industry, city, description, is_verified, created_at, updated_at)
VALUES
(2, 'PT Maju Teknologi', 'pt-maju-teknologi', 'Teknologi Informasi', 'Jakarta',
 'Perusahaan teknologi yang berfokus pada produk digital.', TRUE, NOW(), NOW());

INSERT INTO seeker_profiles (user_id, phone, city, bio, skills, created_at, updated_at)
VALUES
(3, '081234567890', 'Bandung', 'Fresh graduate bidang teknologi.',
 JSON_ARRAY('PHP', 'Laravel', 'MySQL'), NOW(), NOW());

INSERT INTO jobs (
    employer_id, category_id, title, slug, description, requirements,
    type, location_type, city, salary_min, salary_max, salary_visible,
    experience, status, created_at, updated_at
)
VALUES
(2, 1, 'Backend Developer Laravel', 'backend-developer-laravel',
 'Membangun dan memelihara REST API menggunakan Laravel.',
 'Menguasai PHP, Laravel, REST API, dan MySQL.',
 'full_time', 'hybrid', 'Jakarta', '8000000', '15000000', TRUE,
 '1-2', 'active', NOW(), NOW());

-- =========================================================
-- 4. Contoh query SELECT untuk demo
-- =========================================================

-- Menampilkan semua lowongan aktif beserta nama perusahaan dan kategori
SELECT
    jobs.id,
    jobs.title,
    company_profiles.company_name,
    categories.name AS category_name,
    jobs.city,
    jobs.type,
    jobs.location_type,
    jobs.status
FROM jobs
JOIN users ON users.id = jobs.employer_id
JOIN company_profiles ON company_profiles.user_id = users.id
JOIN categories ON categories.id = jobs.category_id
WHERE jobs.status = 'active';

-- Mencari lowongan berdasarkan keyword judul atau kota
SELECT *
FROM jobs
WHERE status = 'active'
  AND (title LIKE '%Laravel%' OR city LIKE '%Jakarta%');

-- Menampilkan daftar pelamar untuk satu lowongan
SELECT
    applications.id,
    jobs.title AS job_title,
    users.name AS seeker_name,
    users.email AS seeker_email,
    applications.status,
    applications.cover_letter,
    applications.created_at
FROM applications
JOIN jobs ON jobs.id = applications.job_id
JOIN users ON users.id = applications.seeker_id
WHERE jobs.id = 1;

-- Menampilkan riwayat lamaran milik seeker tertentu
SELECT
    applications.id,
    jobs.title,
    company_profiles.company_name,
    applications.status,
    applications.employer_note,
    applications.created_at
FROM applications
JOIN jobs ON jobs.id = applications.job_id
JOIN company_profiles ON company_profiles.user_id = jobs.employer_id
WHERE applications.seeker_id = 3
ORDER BY applications.created_at DESC;

-- Menampilkan lowongan yang disimpan oleh seeker
SELECT
    saved_jobs.id,
    users.name AS seeker_name,
    jobs.title AS job_title,
    saved_jobs.created_at
FROM saved_jobs
JOIN users ON users.id = saved_jobs.user_id
JOIN jobs ON jobs.id = saved_jobs.job_id
WHERE saved_jobs.user_id = 3;

-- Menampilkan statistik jumlah lowongan per kategori
SELECT
    categories.name AS category_name,
    COUNT(jobs.id) AS total_jobs
FROM categories
LEFT JOIN jobs ON jobs.category_id = categories.id
GROUP BY categories.id, categories.name
ORDER BY total_jobs DESC;

-- Menampilkan perusahaan yang belum diverifikasi
SELECT
    company_profiles.id,
    company_profiles.company_name,
    users.email,
    company_profiles.city,
    company_profiles.is_verified
FROM company_profiles
JOIN users ON users.id = company_profiles.user_id
WHERE company_profiles.is_verified = FALSE;

-- =========================================================
-- 5. Contoh UPDATE
-- =========================================================

-- Admin memverifikasi perusahaan
UPDATE company_profiles
SET is_verified = TRUE,
    updated_at = NOW()
WHERE id = 1;

-- Employer mengubah status lamaran
UPDATE applications
SET status = 'interview',
    employer_note = 'Kandidat masuk tahap interview.',
    updated_at = NOW()
WHERE id = 1;

-- Employer menutup lowongan
UPDATE jobs
SET status = 'closed',
    updated_at = NOW()
WHERE id = 1;

-- =========================================================
-- 6. Contoh DELETE
-- =========================================================

-- Menghapus bookmark lowongan
DELETE FROM saved_jobs
WHERE user_id = 3
  AND job_id = 1;

-- Admin menghapus kategori yang tidak digunakan
DELETE FROM categories
WHERE id = 2;

-- =========================================================
-- 7. Contoh query laporan untuk UAS
-- =========================================================

-- Laporan jumlah user berdasarkan role
SELECT
    role,
    COUNT(*) AS total_user
FROM users
GROUP BY role;

-- Laporan jumlah lamaran berdasarkan status
SELECT
    status,
    COUNT(*) AS total_lamaran
FROM applications
GROUP BY status;

-- Laporan lowongan paling banyak dilamar
SELECT
    jobs.title,
    company_profiles.company_name,
    COUNT(applications.id) AS total_pelamar
FROM jobs
JOIN company_profiles ON company_profiles.user_id = jobs.employer_id
LEFT JOIN applications ON applications.job_id = jobs.id
GROUP BY jobs.id, jobs.title, company_profiles.company_name
ORDER BY total_pelamar DESC;
