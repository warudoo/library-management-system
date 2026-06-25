<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;

/*
|--------------------------------------------------------------------------
| SEEDER CATEGORY & ITEM
|--------------------------------------------------------------------------
|
| Contoh data awal supaya fitur transaksi bisa langsung dicoba.
| Bebas diganti namanya sesuai kebutuhan bisnis (buku, obat, produk, dll).
*/
class CategoryItemSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Novel' => ['Laskar Pelangi', 'Bumi Manusia'],
            'Komik' => ['Naruto Vol. 1', 'One Piece Vol. 1'],
            'Pemrograman' => ['Laravel Dasar', 'Belajar PHP'],
        ];

        foreach ($categories as $categoryName => $items) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($items as $itemName) {
                Item::create([
                    'category_id' => $category->id,
                    'name' => $itemName,
                    'description' => "Contoh data untuk {$itemName}.",
                    'stock' => 5,
                    'price' => 50000,
                ]);
            }
        }
    }
}
