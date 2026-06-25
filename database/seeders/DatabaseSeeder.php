<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/*
|--------------------------------------------------------------------------
| DATABASE SEEDER
|--------------------------------------------------------------------------
|
| Titik masuk semua seeder. Jalankan dengan: php artisan db:seed
*/
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
{


    $this->call([

        PerpustakaanSeeder::class

    ]);


}
}
