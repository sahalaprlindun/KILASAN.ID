# Backend Laravel KILASAN

Backend ini menampung:

- Form pengaduan user ke tabel `complaints`.
- Lampiran bukti ke tabel `complaint_attachments` dan storage `storage/app/public`.
- Login admin dan superadmin ke tabel `users`.
- Dashboard admin, data pengaduan, update status, hapus laporan.
- Manajemen petugas dan feedback khusus `superadmin`.

## Cara Menjalankan

1. Install Composer dan pastikan PHP XAMPP bisa dipanggil dari terminal.
2. Buat database MySQL bernama `kilasan` lewat phpMyAdmin, atau import `database/kilasan_schema.sql`.
3. Salin `.env.example` menjadi `.env`, lalu sesuaikan `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.
4. Jalankan:

```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

5. Akses aplikasi dari folder `public`, contoh:

```text
http://localhost/pengmas/KILASAN/public
```

## Akun Awal

- Superadmin: `superadmin` / `super123`
- Admin: `admin` / `admin123`

## Hak Akses

- `admin`: melihat dashboard, melihat pengaduan, update status laporan.
- `superadmin`: semua akses admin, plus kelola petugas dan lihat feedback.
