CREATE DATABASE IF NOT EXISTS kilasan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kilasan;

CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  name VARCHAR(255) NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('superadmin', 'admin') NOT NULL DEFAULT 'admin',
  last_login_at TIMESTAMP NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE complaints (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ticket_number VARCHAR(255) NOT NULL UNIQUE,
  reported_at DATE NOT NULL,
  nama VARCHAR(255) NULL,
  kontak VARCHAR(255) NOT NULL,
  wilayah TEXT NOT NULL,
  jenis_kelamin VARCHAR(255) NOT NULL,
  usia VARCHAR(255) NOT NULL,
  tingkat_khawatir VARCHAR(255) NOT NULL,
  kategori VARCHAR(255) NULL,
  jenis_pelapor VARCHAR(255) NULL,
  tempat_kejadian VARCHAR(255) NULL,
  waktu_kejadian VARCHAR(255) NULL,
  pelaku VARCHAR(255) NULL,
  kronologi TEXT NULL,
  saran TEXT NULL,
  status ENUM('Belum Diproses', 'Sedang Diproses', 'Selesai', 'Ditolak') NOT NULL DEFAULT 'Belum Diproses',
  handled_by BIGINT UNSIGNED NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT complaints_handled_by_foreign FOREIGN KEY (handled_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE complaint_attachments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  complaint_id BIGINT UNSIGNED NOT NULL,
  original_name VARCHAR(255) NOT NULL,
  path VARCHAR(255) NOT NULL,
  mime_type VARCHAR(255) NULL,
  size BIGINT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT complaint_attachments_complaint_id_foreign FOREIGN KEY (complaint_id) REFERENCES complaints(id) ON DELETE CASCADE
);

CREATE TABLE feedback (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL,
  email VARCHAR(255) NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
