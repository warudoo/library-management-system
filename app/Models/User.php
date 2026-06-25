<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
|--------------------------------------------------------------------------
| MODEL USER
|--------------------------------------------------------------------------
|
| Data user login. Field "role" menentukan hak akses:
| - admin -> akses penuh semua CRUD & kelola transaksi
| - user  -> hanya bisa lihat data & membuat transaksi miliknya sendiri
*/
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])] // jangan tampil saat data di-serialize
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Casting otomatis: password di-hash, email_verified_at jadi objek tanggal
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper cepat untuk cek role admin, dipakai di view/middleware
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Satu user bisa punya banyak transaksi (riwayat pinjam/beli miliknya)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
