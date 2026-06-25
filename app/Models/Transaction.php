<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| MODEL TRANSACTION
|--------------------------------------------------------------------------
|
| Mewakili satu transaksi peminjaman ATAU pembelian item.
| Lihat migration create_transactions_table untuk detail tiap kolom.
*/
class Transaction extends Model
{
    // Kolom yang boleh diisi lewat create()/update()
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'type',
        'status',
        'total_price',
        'transaction_date',
        'due_date',
        'completed_date',
        'notes',
    ];

    // Auto-cast supaya bisa dipakai langsung sebagai object Carbon
    protected $casts = [
        'transaction_date' => 'date',
        'due_date' => 'date',
        'completed_date' => 'date',
    ];

    // Transaksi ini milik satu user (peminjam/pembeli)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Transaksi ini berhubungan ke satu item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Helper: cek apakah transaksi ini tipe peminjaman
    public function isBorrow(): bool
    {
        return $this->type === 'borrow';
    }

    // Helper: cek apakah peminjaman sudah lewat jatuh tempo dan belum dikembalikan
    public function isOverdue(): bool
    {
        return $this->isBorrow()
            && $this->status === 'active'
            && $this->due_date
            && $this->due_date->isPast();
    }

    // Helper: warna badge status, dipakai di view supaya konsisten
    public function statusColor(): string
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-700 ring-amber-600/20',
            'active' => 'bg-blue-100 text-blue-700 ring-blue-600/20',
            'returned', 'completed' => 'bg-emerald-100 text-emerald-700 ring-emerald-600/20',
            'cancelled' => 'bg-red-100 text-red-700 ring-red-600/20',
            default => 'bg-gray-100 text-gray-700 ring-gray-600/20',
        };
    }
}
