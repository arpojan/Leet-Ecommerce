# Leet E-Commerce

Leet E-Commerce adalah sebuah platform toko online (e-commerce) komprehensif yang dibangun menggunakan framework **Laravel** dan didesain secara profesional dengan **Bootstrap 5**. Aplikasi ini menyediakan dua sisi antarmuka: antarmuka pelanggan untuk pengalaman belanja yang intuitif, serta panel admin yang tangguh untuk memanajemen seluruh operasional toko.

---

## Fitur Utama

### Untuk Pelanggan (Customer)
* **Katalog & Detail Produk:** Menjelajahi daftar produk dan melihat detail produk secara spesifik (termasuk galeri foto, deskripsi, harga, dan varian ukuran).
* **Keranjang Belanja (Cart):** Menambahkan produk ke keranjang belanja dengan integrasi kuantitas (jumlah) dan pilihan varian secara mudah.
* **Proses Checkout & Pembayaran:** Sistem checkout (pembayaran) mandiri di mana pelanggan dapat mengunggah (upload) struk / bukti transfer pembayaran.
* **Manajemen Profil:** Halaman profil pelanggan yang modern untuk melacak riwayat pesanan (status pesanan) dan informasi diri.

### Untuk Administrator (Admin Panel)
* **Dashboard Profesional:** Antarmuka admin dengan tata letak *sidebar* yang modern, ringkas, dan responsif (menggunakan Bootstrap Icons dan SweetAlert).
* **Manajemen Produk (CRUD):** 
  * Menambah produk baru lengkap dengan spesifikasi kategori dan harga.
  * Dukungan *upload* hingga 4 foto produk sekaligus.
  * Manajemen stok tingkat lanjut berdasarkan varian (Misal: ukuran S, M, L, XL).
  * Mengubah detail atau menghapus produk yang sudah ada.
* **Manajemen Transaksi (Order Management):**
  * Tinjauan semua pesanan masuk.
  * Memverifikasi bukti pembayaran yang diunggah pelanggan (fitur lihat bukti melalui *Modal*).
  * Menyetujui atau menolak transaksi.
  * Mengubah status pesanan secara real-time (Misal: "Sedang Disiapkan", "Dikirim", "Selesai").
  * Ringkasan tagihan *(invoice)* untuk detail pesanan per pelanggan.

---

## Teknologi yang Digunakan
* **Backend:** PHP 8.x / Laravel 10 (atau lebih baru)
* **Frontend:** HTML5, CSS3, JavaScript, Blade Templating Engine
* **UI/UX Framework:** Bootstrap 5 (menggunakan *Cards*, *Modals*, *Forms*, *Grid* untuk UI yang responsif)
* **Database:** MySQL / MariaDB

---

## Instalasi & Cara Menjalankan Aplikasi

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi Leet E-Commerce di mesin lokal Anda:

1. **Clone repository ini**
   ```bash
   git clone https://github.com/arpojan/Leet-Ecommerce.git
   cd Leet-Ecommerce
   ```

2. **Instal dependensi Composer**
   ```bash
   composer install
   ```

3. **Salin file Environment (.env)**
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi Database**
   Buka file `.env` dan atur detail koneksi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=leet_ecommerce
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi dan Seed Database**
   Perintah ini akan membuat tabel di database Anda beserta data *dummy* awal (seperti akun Admin dan Produk).
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Tautkan Storage (Storage Link)**
   Langkah ini wajib dilakukan agar gambar produk dan bukti pembayaran bisa diakses dari folder publik.
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Aplikasi Server**
   ```bash
   php artisan serve
   ```
   Aplikasi Anda kini berjalan dan dapat diakses di `http://127.0.0.1:8000`.

---

## Kredensial Default

Setelah Anda melakukan `migrate:fresh --seed`, Anda dapat mencoba masuk ke aplikasi menggunakan akun bawaan (dummy):

* **Akun Admin:**
  * **Email:** `admin@example.com`
  * **Password:** `password`
* **Akun Pelanggan (User):**
  * **Email:** `test@example.com`
  * **Password:** `password`

---

## Tangkapan Layar (Screenshots)
*(Anda dapat menambahkan gambar screenshot aplikasi di folder assets/ dan menautkannya di sini)*
- Beranda / Landing Page
- Katalog & Detail Produk
- Dashboard Admin
- Manajemen Pesanan & Nota (Invoice)

---

Dibuat dengan ❤️ untuk **Leet E-Commerce**.
