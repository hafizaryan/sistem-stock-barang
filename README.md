# Sistem Stock Barang

Aplikasi manajemen stok barang (inventaris) berbasis web dengan PHP native dan MySQL. Aplikasi ini mengelola data barang, barang masuk, barang keluar, purchase order (PO), serta pengguna, lengkap dengan fitur ekspor laporan.

## Fitur

- Login pengguna dengan verifikasi Google reCAPTCHA dan level akses pengguna
- Dashboard ringkasan stok
- Kelola data barang: tambah (termasuk unggah foto barang dan tanggal kadaluwarsa), ubah, hapus, dan pantau sisa stok
- Barang masuk: pencatatan barang masuk yang otomatis menambah stok
- Barang keluar: pencatatan barang keluar yang otomatis mengurangi stok
- Purchase Order (PO): kelola data PO barang
- Kelola user: tambah dan ubah pengguna beserta levelnya
- Landing page publik
- Cetak dan ekspor laporan stok, barang masuk, barang keluar, dan PO ke Excel serta PDF (mPDF)
- Logout

## Teknologi

- PHP native dengan ekstensi MySQLi
- MySQL / MariaDB (nama basis data: `stokbarang`)
- Bootstrap 4 dan jQuery (CDN), Font Awesome, tema SB Admin
- mPDF (`mpdf/mpdf` melalui Composer) untuk membuat PDF
- Google reCAPTCHA v2 pada formulir login

## Struktur Proyek

```
sistem-stock-barang/
├── assets/           # Aset pendukung
├── css/              # Berkas gaya tema
├── js/               # Berkas JavaScript tema
├── img/              # Foto barang yang diunggah
├── database/
│   └── stokbarang.sql   # Dump basis data
├── vendor/           # Dependensi Composer (mPDF)
├── function.php      # Koneksi basis data dan seluruh proses CRUD
├── login.php         # Halaman dan proses login (dengan reCAPTCHA)
├── logout.php
├── landing_page.php  # Halaman depan publik
├── index.php         # Dashboard
├── stock.php         # Data stok barang
├── masuk.php         # Data barang masuk
├── keluar.php        # Data barang keluar
├── PO.php            # Data purchase order
├── keluser.php       # Kelola pengguna
├── menu.php          # Menu navigasi
├── export.php, export masuk.php, export keluar.php, export po.php  # Ekspor Excel
├── cetak.php, generate_pdf.php   # Cetak laporan dan PDF
├── composer.json
└── composer.lock
```

## Cara Menjalankan

Prasyarat: server lokal PHP dan MySQL (XAMPP/Laragon), Composer, dan kunci situs reCAPTCHA sendiri.

1. Clone repositori ini ke folder web server (misalnya `htdocs/stokbarang`).
2. Buat basis data bernama `stokbarang`, lalu impor `database/stokbarang.sql`:

   ```bash
   mysql -u root -p stokbarang < database/stokbarang.sql
   ```

3. Instal dependensi PDF:

   ```bash
   composer install
   ```

4. Sesuaikan koneksi basis data pada `function.php` (bawaan: host `localhost`, user `root`, tanpa password, basis data `stokbarang`).
5. Ganti site key dan secret key reCAPTCHA pada `login.php` dengan kunci milik Anda sendiri dari Google reCAPTCHA.
6. Jalankan Apache dan MySQL, lalu buka `http://localhost/stokbarang/landing_page.php` dan masuk lewat `login.php` menggunakan akun yang ada pada tabel `login` di basis data hasil impor.
