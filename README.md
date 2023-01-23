## Sistem Inventory Barang

Sistem inventory barang adalah aplikasi manajemen barang,
stok, keluar-masuk barang suatu toko atau gudang.

## Instalasi & Setup

- `composer install` untuk medownload package composer.
- buat database `inventory`, lalu import file database `inventory.sql` ke database anda.
- jika anda ingin menggunakan cli / terminal , gunakan migration `php spark migrate`.
- `php spark db:seed` untuk seeding tabel `users` , `role` , `bulan_statis` (jika semua tabel kosong).

## Username & Password dari seeding

# admin
- admin
- admin

# petugas
- sensei
- petugas

## Features

- Dashboard : Summary atau Penjumlahan data-data dan Statistik.
- Manajemen Pengguna : (Tambah , Edit , Hapus).
- Manajemen Supplier : (Tambah , Edit , Hapus).
- Manajemen Customer : (Tambah , Edit , Hapus).
- Manajemen Rak : (Tambah , Edit , Hapus).
- Manajemen Jenis Barang : (Tambah , Edit , Hapus).
- Manajemen Satuan Barang : (Tambah , Edit , Hapus).

## Transaksi

- Stok Barang : (Tambah , Edit , Hapus).
- Barang Masuk : (Tambah , Detail, Hapus).
- Barang Keluar : (Tambah , Detail, Hapus).

## Laporan Pdf & Manajemen Settings

- Laporan Stok Barang.
- Laporan Barang Masuk.
- Laporan Barang Keluar.
- Profil Pengguna.
- Data list bulan (mengatur penggunaan nama-nama bulan).

## Catatan

- tabel `bulan_statis` wajib ada pada aplikasi.
- tabel `bulan_statis` digunakan untuk monitoring keluar masuk barang per-bulan.
- nama-nama bulan bisa diatur di halaman 'Manajemen Settings'.