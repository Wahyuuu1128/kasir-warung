<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Kasir Warung

Aplikasi kasir digital berbasis web yang dikembangkan menggunakan Laravel dengan antarmuka modern, responsif, dan interaktif.
Project ini dibuat untuk membantu proses transaksi penjualan pada warung atau toko kecil dengan sistem pengelolaan produk dan transaksi yang lebih efisien.

---

## Tentang Project

Kasir Warung merupakan aplikasi Point of Sale (POS) sederhana yang menyediakan fitur manajemen produk, kategori, transaksi kasir, hingga cetak struk dalam format PDF.

Aplikasi ini dirancang menggunakan Laravel sebagai backend, Tailwind CSS untuk tampilan antarmuka, serta Alpine JS untuk meningkatkan interaktivitas pada halaman kasir dan transaksi.

---

## Fitur Utama

### Manajemen Produk

* Menambahkan produk baru
* Mengedit data produk
* Menghapus produk
* Upload gambar produk
* Menampilkan daftar produk

### Manajemen Kategori

* Menambahkan kategori produk
* Mengedit kategori
* Menghapus kategori

### Sistem Kasir

* Halaman transaksi kasir
* Keranjang belanja
* Perhitungan total otomatis
* Perhitungan kembalian otomatis
* Input jumlah pembayaran
* Penyimpanan data transaksi

### Struk PDF

* Generate struk transaksi
* Export struk ke format PDF
* Tampilan struk sederhana dan rapi

### Tampilan

* Responsive design
* UI modern menggunakan Tailwind CSS
* Interaktif menggunakan Alpine JS
* Layout dashboard sederhana dan nyaman digunakan

---

## Teknologi yang Digunakan

| Teknologi      | Keterangan              |
| -------------- | ----------------------- |
| Laravel        | Backend Framework       |
| Tailwind CSS   | Styling UI              |
| Alpine JS      | Interaktivitas Frontend |
| MySQL          | Database                |
| Vite           | Asset Bundler           |
| Blade Template | Template Engine Laravel |

---

## Struktur Halaman

### Produk

```text id="ev84wb"
resources/views/products
```

### Kategori

```text id="6vny5d"
resources/views/categories
```

### Kasir / POS

```text id="pp4yuv"
resources/views/pos
```

### Dashboard

```text id="y8u5vv"
resources/views/dashboard.blade.php
```

---

## Instalasi Project

### Clone Repository

```bash id="c1cijg"
git clone https://github.com/Wahyuuu1128/kasir-warung.git
```

### Masuk ke Folder Project

```bash id="pt7j2z"
cd kasir-warung
```

### Install Dependency Backend

```bash id="m5mif0"
composer install
```

### Install Dependency Frontend

```bash id="7lzg7i"
npm install
```

### Copy File Environment

```bash id="jv1nlg"
cp .env.example .env
```

### Generate Application Key

```bash id="lv1rga"
php artisan key:generate
```

### Konfigurasi Database

Atur database pada file `.env`

```env id="n4kefm"
DB_DATABASE=kasir_warung
DB_USERNAME=root
DB_PASSWORD=
```

### Jalankan Migration

```bash id="hprj71"
php artisan migrate
```

### Menjalankan Project

```bash id="h9g5to"
php artisan serve
```

### Menjalankan Vite

```bash id="1pfot7"
npm run dev
```

---

## Tampilan Aplikasi

Berikut beberapa tampilan utama pada aplikasi:

* Dashboard
* Manajemen Produk
* Manajemen Kategori
* Halaman Kasir
* Cetak Struk PDF

> Screenshot aplikasi dapat ditambahkan pada repository ini.

---

## Responsive Design

Aplikasi telah dioptimalkan untuk berbagai ukuran layar:

* Desktop
* Tablet
* Mobile

---

## Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan lebih lanjut:

* User tLogin
* Role Admin dan Kasir
* Laporan Penjualan
* Grafik Statistik
* Scan Barcode
* Cetak Thermal Printer
* Export Excel
* Export PDF

---

## Developer

Dikembangkan oleh:

**Wahyu Rahmat Ilahi**

