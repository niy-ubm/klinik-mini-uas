# 🏥 Klinik Mini - Sistem Antrian Online

Aplikasi manajemen pendaftaran dan antrian klinik sederhana yang dibangun menggunakan **Laravel 11**, **Breeze (Blade)**, dan **Tailwind CSS**. Project ini dirancang untuk dijalankan di lingkungan lokal (LAN) maupun server dengan dukungan akses lintas perangkat.

## 🚀 Fitur Utama

- **Sistem Antrian Cerdas (User)**:
    - Pendaftaran pasien ke dokter spesifik dengan input keluhan singkat.
    - **Validasi Kuota**: Maksimal 20 pasien per dokter per hari.
    - **Proteksi Ganda**: Mencegah pendaftaran dua kali ke dokter yang sama di tanggal yang sama.
    - Nomor antrian otomatis dibuat berurutan per dokter setiap harinya.
- **Dashboard Petugas (Admin)**:
    - Monitor daftar antrian harian secara real-time.
    - **Fitur "Panggil Berikutnya"**: Mengubah status menjadi `CALLED` otomatis untuk nomor antrian terkecil yang masih `WAITING`.
    - **Live Refresh**: Dashboard admin otomatis update setiap 10 detik menggunakan AJAX Polling (Tanpa Reload Halaman).
- **Riwayat & Manajemen Status**: 
    - Pantau status antrian: `WAITING`, `CALLED`, `DONE`, `CANCELED`.
    - Pasien dapat membatalkan antrian mandiri selama status masih `WAITING`.
- **Responsive UI**: Tampilan modern dan ramah perangkat seluler (Mobile Friendly) menggunakan Tailwind CSS.

## 🛠️ Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Database**: MariaDB / MySQL
- **Frontend**: Tailwind CSS & Alpine.js (Laravel Breeze)
- **Dev Server**: Vite (Configured for Dynamic LAN Access)
- **Process Manager**: PM2 (Untuk background process di Termux/Server)

## 📋 Prasyarat

Sebelum menjalankan project, pastikan perangkat Anda sudah terinstall:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MariaDB / MySQL server

## ⚙️ Instalasi di Perangkat Baru (PC/Server/Termux)

Jika Anda meng-clone project ini, lakukan langkah-langkah berikut:

1. **Clone Repository**:
   ```bash
   https://github.com/niy-ubm/klinik-mini-uas.git
   cd klinik-mini-uas

2. **Install Dependencies**:
   ```bash
   composer install
   npm install

3. **Setup Environment: Salin template .env, generate key aplikasi, dan sesuaikan konfigurasi database di file .env yang baru dibuat.**:
   ```bash
   cp .env.example .env
   php artisan key:generate

4. **Migrasi & Seeding: Siapkan database kosong di MariaDB, lalu jalankan perintah berikut untuk membuat tabel dan mengisi data awal (Poli & Dokter)**:
   ```bash
   php artisan migrate --seed

5. **Build Aset Frontend**:
   ```bash
   npm run build



## Menjalankan Aplikasi

**Mode Development**
* Jalankan server Laravel dan Vite secara bersamaan:
   ```bash
   php artisan serve --host 0.0.0.0
   npm run dev -- --host

**Mode Produksi (Background dengan PM2)**
* Gunakan file ekosistem agar aplikasi tetap berjalan meski terminal ditutup
   ```bash
   pm2 start ecosystem.config.cjs

**Akun Default (Seeder)**
* Admin: admin@klinik.com | Password: password
* User: (Silakan melakukan registrasi manual melalui halaman Register)
