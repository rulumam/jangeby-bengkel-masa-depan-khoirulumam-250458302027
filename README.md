# Website JangeBy Bengkel Masa Depan

## Deskripsi Singkat
Website JangeBy Bengkel Masa Depan berbasis Laravel yang menyediakan fitur booking servis kendaraan, manajemen perbaikan, pembayaran, dan dashboard admin, dengan tampilan yang sporty dan sistem yang mudah agar mudah juga untuk di pahami oleh para admin bengkel.

## Fitur-Fitur 
- Hide and Show Password 
- Mengubah Status Perbaikan
- Melihat daftar Laporan Perbaikan
- Pencarian Perbaikan Berdasarkan 
- Menghapus Daftar Laporan Perbaikan 
- Diagram Perbaikan Dinamis 
- Card Status Dinamis
- Melihat Bukti Pembayaran
-  Menambah Laporan Perbaikan
- Melihat daftar Laporan Perbaikan
- Menghapus Daftar Laporan Perbaikan 
- Mengupload Bukti Pembayaran
- Preview Bukti Pembayaran

## Teknologi yang Digunakan 
- Laravel 12
- Livewire
- PHP 8.4
- MySQL
- TailwindCSS
- Vite

## Cara Instalasi 

1. Instalasi PHP packagenya dengan mengetik di terminal = composer install
2. lalu Install juga npmnya agar css nya dapat bekerja dengan baik dengan ketikan di terminal = npm install
3. Setup .env dengan cara copy file .env.example atau rename file tersebut menjadi .env
4. Selanjutnya membuat key yang ada di .env baru dengan mengetikan prompt ini di terminal = php artisan key:generate

## Cara Menjalankan Project 

1. Ketikan prompt berikut untuk migrate project dan masuk ke MySQL = php artisan migrate
2. Ketikan prompt ini di terminal untuk menjalankan project di server = php artisan serve
3. Ketikan prompt ini agar CSS di dalam project dapat berjalan lancar = npm run dev