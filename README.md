# 📚 Library/Inventory Management System

Aplikasi CRUD sederhana berbasis **Laravel 13** untuk mengelola data **Kategori**, **Item**, **User**, dan **Transaksi** (peminjaman/penjualan). Dibuat generic supaya mudah dikustomisasi untuk berbagai kebutuhan: perpustakaan, apotek, toko, atau inventory gudang.

---

## ✨ Fitur

- **Autentikasi** lengkap (login, register, reset password) — bawaan Laravel Breeze.
- **Role-based access**: `admin` (akses penuh CRUD) dan `user` (akses terbatas).
- **CRUD Kategori & Item**, termasuk upload gambar item.
- **Modul Transaksi** generik:
  - Tipe `borrow` (pinjam) — stok otomatis berkurang saat dibuat, dan **kembali** saat status diubah jadi `returned`.
  - Tipe `sale` (jual/beli) — stok berkurang permanen.
  - User biasa bisa membuat & menyelesaikan transaksi miliknya sendiri.
  - Admin bisa melihat semua transaksi dan membatalkannya.
- **Dashboard** ringkasan: total kategori, item, stok, dan status transaksi (termasuk peringatan keterlambatan).
- Tampilan **Tailwind CSS** modern & konsisten di semua halaman (termasuk sidebar responsif).

---

## 🚀 Cara Install

```bash
composer install
cp .env.example .env
php artisan key:generate

# Buat database SQLite (default) — atau ganti DB_CONNECTION di .env jika pakai MySQL
touch database/database.sqlite

php artisan migrate --seed
php artisan storage:link   # wajib, agar gambar item bisa tampil

npm install
npm run build               # atau: npm run dev (untuk mode development)

php artisan serve
```

Buka `http://localhost:8000`.

### 🔑 Akun demo (dari seeder)

| Role  | Email             | Password   |
|-------|--------------------|-----------|
| Admin | admin@gmail.com    | password  |
| User  | user@gmail.com     | password  |

---

## 🗂️ Struktur Penting

```
app/
  Models/
    Category.php       -> Kategori (1 kategori punya banyak item)
    Item.php            -> Barang/produk (generic)
    Transaction.php      -> Peminjaman / penjualan item
    User.php             -> Akun + role (admin/user)
  Http/
    Controllers/
      CategoryController.php
      ItemController.php
      TransactionController.php
      UserController.php
      DashboardController.php
    Middleware/
      AdminMiddleware.php -> Membatasi route khusus admin

resources/views/
  layouts/app.blade.php   -> Layout utama (sidebar + topbar), pakai Tailwind
  components/             -> Komponen UI reusable (badge, card, tombol, dll)
  items/, categories/, users/, transactions/ -> Halaman CRUD masing-masing modul
```

---

## 🔧 Cara Mengganti "Tema" Aplikasi

Karena `Item` & `Category` dibuat generic, kamu tinggal mengganti **label** di view tanpa mengubah struktur database. Contoh:

| Konteks         | Category jadi      | Item jadi     | Transaction jadi      |
|------------------|---------------------|----------------|--------------------------|
| Perpustakaan     | Jenis Buku          | Buku           | Peminjaman               |
| Apotek           | Jenis Obat          | Obat           | Penjualan                |
| Toko/Inventory   | Kategori Produk     | Produk         | Penjualan/Stock Out      |

Cukup ubah teks label di file-file `resources/views/items/*.blade.php`, `categories/*.blade.php`, dan `transactions/*.blade.php` — logic dan database-nya tidak perlu diubah sama sekali.

---

## 💡 Tips Pengembangan Lanjutan

- Tambah validasi atau field baru di `Transaction` (mis. metode pembayaran) lewat migration baru.
- Tambah fitur cetak struk/invoice dengan package `barryvdh/laravel-dompdf`.
- Tambah notifikasi email saat jatuh tempo peminjaman lewat Laravel Notification + Scheduler.
- Untuk grafik dashboard yang lebih kaya, bisa integrasikan Chart.js di halaman `dashboard.blade.php`.
