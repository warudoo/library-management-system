<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| SEEDER USER
|--------------------------------------------------------------------------
|
| Membuat 2 akun contoh supaya bisa langsung dicoba setelah migrate:
| - admin@gmail.com (role admin, akses penuh)
| - user@gmail.com  (role user, akses terbatas)
| Password keduanya: "password"
*/
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'rudo@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Demo',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
