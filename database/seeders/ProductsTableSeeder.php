<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'TV',
                'gambar' => 'gambar1.jpg',
                'description' => 'Polytron HD',
                'price' => 2000000,
                'stock' => 50,
                'is_active' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'LAPTOP',
                'gambar' => 'gambar2.jpg',
                'description' => 'Lenovo',
                'price' => 15000000,
                'stock' => 30,
                'is_active' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IPHONE',
                'gambar' => 'gambar2.jpg',
                'description' => 'IPHONE 16 PRO MAX',
                'price' => 20000000,
                'stock' => 0,
                'is_active' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MONITOR',
                'gambar' => 'gambar2.jpg',
                'description' => 'LOGITECH',
                'price' => 2000000,
                'stock' => 0,
                'is_active' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
