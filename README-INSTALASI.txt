KOSTSERVICE PRO — WEBSITE DINAMIS PHP & MYSQL

FITUR
- Halaman terpisah: Beranda, Layanan, Harga, Tentang Kami, Kontak.
- Formulir pemesanan menyimpan data ke database.
- Data pelanggan otomatis dibuat/diperbarui berdasarkan nomor WhatsApp.
- Kode pesanan unik untuk setiap pemesanan.
- Halaman cek status pesanan untuk pelanggan.
- Login admin dengan password hash.
- Dashboard ringkasan, daftar pesanan, data pelanggan.
- Admin dapat mengubah status: Menunggu Konfirmasi, Dikonfirmasi, Sedang Dikerjakan, Selesai, Dibatalkan.

PERSYARATAN
- XAMPP (Apache + MySQL) atau server PHP 8.1+ dan MySQL/MariaDB.
- Ekstensi PDO MySQL aktif.

CARA INSTALASI DI XAMPP
1. Ekstrak folder KostService-Pro ke C:\xampp\htdocs\
2. Jalankan Apache dan MySQL dari XAMPP Control Panel.
3. Buka http://localhost/KostService-Pro/install.php
4. Buat username dan password admin (password minimal 10 karakter).
5. Setelah sukses, hapus file install.php dari folder project.
6. Buka http://localhost/KostService-Pro/ untuk website pelanggan.
7. Login admin melalui http://localhost/KostService-Pro/admin/login.php

KONFIGURASI DATABASE
Secara default:
DB_HOST=localhost
DB_NAME=kostservice
DB_USER=root
DB_PASS=

Jika MySQL Anda memakai password, edit DB_PASS di config.php.
Install.php membuat database dan tabel secara otomatis.

PENTING
- Jangan gunakan konfigurasi root tanpa password pada server publik/hosting.
- Gunakan HTTPS dan password admin yang kuat jika dipublikasikan.
- Nomor WhatsApp bisnis diatur pada fungsi wa_link() di config.php: 6282114933545.
- Website ini belum terhubung ke payment gateway; pembayaran dan konfirmasi harga masih ditangani admin.
- Sebelum online, upload seluruh folder ke hosting yang mendukung PHP + MySQL dan sesuaikan config.php.
