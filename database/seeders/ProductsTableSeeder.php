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
                'name' => 'Product 1',
                'gambar' => 'gambar1.jpg',
                'description' => 'Description of Product 1',
                'price' => 100,
                'stock' => 50,
                'is_active' => 'active',
            ],
            [
                'name' => 'Product 2',
                'gambar' => 'gambar2.jpg',
                'description' => 'Description of Product 2',
                'price' => 200,
                'stock' => 30,
                'is_active' => 'active',
            ]
        ]);
    }
}
