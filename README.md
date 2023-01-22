## Sistem Inventory Barang

Sistem inventory barang adalah aplikasi berbasis web 
untuk manajemen barang, stok , keluar-masuk barang suatu toko atau gudang.

## Instalasi & Setup

- `composer install` untuk medownload package composer.
- buat database `inventory`, lalu import file database `inventory.sql` ke database anda.
- jika anda ingin menggunakan cli / terminal , gunakan migration `php spark migrate`.
- disarakan `php spark db:seed` untuk seeding tabel `users` , `role` , `bulan_statis`.

## Catatan

tabel `bulan_statis` wajib ada pada aplikasi , alasan nya karena
tabel tersebut digunakan untuk monitoring keluar masuk barang per-bulan.

## Username & Password dari seeding

# admin
- admin
- admin

# petugas
- sensei
- petugas