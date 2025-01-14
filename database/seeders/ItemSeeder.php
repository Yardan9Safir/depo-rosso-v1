<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('items')->truncate();

        // Contoh data dummy
        $items = [
            [
                'name' => 'Air Galon Cleo',
                'photo_item' => 'ashiap',
                'description' => 'Galon berisi Air Cleo',
                'price' => 35000,
                'quantity' => 5
            ],
            [
                'name' => 'Air Galon Aqua',
                'photo_item' => 'ashiap',
                'description' => 'Galon Berisi Air Aqua',
                'price' => 18000,
                'quantity' => 5
            ],
            [
                'name' => 'Air Galon Club',
                'photo_item' => 'ashiap',
                'description' => 'Galon Berisi Air Club',
                'price' => 1600,
                'quantity' => 15
            ],
            [
                'name' => 'Air isi Ulang',
                'photo_item' => 'ashiap',
                'description' => 'Galon Berisi Air Hasil Filtrasi',
                'price' => 5000,
                'quantity' => 10
            ],
            [
                'name' => 'Aqua Gelas',
                'photo_item' => 'ashiap',
                'description' => 'Air Aqua dalam kemasan gelas',
                'price' => 3000,
                'quantity' => 20
            ],
            [
                'name' => 'Club Gelas',
                'photo_item' => 'ashiap',
                'description' => 'Air Club dalam kemasan gelas',
                'price' => 2000,
                'quantity' => 25
            ],
            [
                'name' => 'Aqua Botol',
                'photo_item' => 'ashiap',
                'description' => 'Air Aqua dalam kemasan botol',
                'price' => 4000,
                'quantity' => 30
            ]

        ];

        // Masukkan data ke tabel items
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
