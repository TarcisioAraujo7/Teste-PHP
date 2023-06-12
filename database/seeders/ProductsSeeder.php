<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Product::factory(10)->create();

        // Product::create([
        //     'name_product' => 'Action Camera',
        //     'unitary_value' => 449.90,
        //     'bar_code' => '1234567890'
        // ]);

        // Product::create([
        //     'name_product' => 'Smart TV LED',
        //     'unitary_value' => 1390.00,
        //     'bar_code' => '0123456789'
        // ]);

        // Product::create([
        //     'name_product' => 'Basic Keyboard',
        //     'unitary_value' => 79.90,
        //     'bar_code' => '9012345678'
        // ]);
    }
}
