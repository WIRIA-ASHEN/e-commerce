<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 2, // Assuming Customer User has ID 2
                'total' => 300.00,
                'status' => 'pending',
            ],
            [
                'user_id' => 2,
                'total' => 200.00,
                'status' => 'paid',
            ]
        ]);
    }
}
