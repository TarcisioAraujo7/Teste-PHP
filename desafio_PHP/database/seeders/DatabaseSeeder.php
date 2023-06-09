<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\client;
use App\Models\order;
use App\Models\product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
        ClientsSeeder::class,
        ProductsSeeder::class,
        OrdersSeeder::class,
       ]);
    }
}
