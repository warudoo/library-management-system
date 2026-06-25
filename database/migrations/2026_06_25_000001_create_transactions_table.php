<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| TABEL TRANSACTIONS
|--------------------------------------------------------------------------
|
| Tabel general untuk mencatat "keluar masuknya" item.
| Bisa dipakai sebagai:
| - Peminjaman buku (perpustakaan): type = 'borrow', ada due_date
| - Penjualan barang (toko/apotek):  type = 'sale',   stok tidak balik
|
| Field "type" inilah yang membuat modul ini fleksibel/general,
| jadi tinggal diubah labelnya saja sesuai kebutuhan bisnis.
*/
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Siapa yang melakukan transaksi (peminjam / pembeli)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Item apa yang ditransaksikan
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();

            // Jumlah yang dipinjam/dibeli
            $table->integer('quantity')->default(1);

            // Tipe transaksi: borrow (pinjam) atau sale (jual/beli)
            // Menentukan apakah stok akan kembali saat selesai atau tidak
            $table->enum('type', ['borrow', 'sale'])->default('borrow');

            // Status alur transaksi
            // pending   = menunggu konfirmasi admin
            // active    = sedang berjalan (dipinjam / sudah dibeli)
            // returned  = item sudah dikembalikan (khusus borrow)
            // completed = transaksi selesai (khusus sale)
            // cancelled = dibatalkan
            $table->enum('status', [
                'pending', 'active', 'returned', 'completed', 'cancelled',
            ])->default('pending');

            // Total harga saat transaksi (quantity x harga saat itu)
            $table->integer('total_price')->default(0);

            // Tanggal transaksi dibuat (boleh beda dgn created_at jika perlu)
            $table->date('transaction_date');

            // Batas waktu pengembalian, hanya relevan untuk type = borrow
            $table->date('due_date')->nullable();

            // Tanggal aktual saat item dikembalikan / transaksi selesai
            $table->date('completed_date')->nullable();

            // Catatan tambahan, bebas diisi admin/user
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
