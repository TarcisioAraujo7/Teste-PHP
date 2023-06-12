<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Order::factory(10)->create();


        // Order::create([
        //     'dt_order' => Carbon::parse('2023-06-09 10:30:00'),
        //     'amount' => 2,
        //     'status' => 'Pago',
        //     'id_product' => 3,
        //     'id_client' => 2
        // ]);

        // Order::create([
        //     'dt_order' => Carbon::parse('2023-06-07 17:34:00'),
        //     'amount' => 1,
        //     'status' => 'Cancelado',
        //     'id_product' => 1,
        //     'id_client' => 1
        // ]);

        // Order::create([
        //     'dt_order' => Carbon::parse('2023-06-09 16:57:35'),
        //     'amount' => 1,
        //     'status' => 'Em Aberto',
        //     'id_product' => 2,
        //     'id_client' => 4
        // ]);

        // Order::create([
        //     'dt_order' => Carbon::parse('2023-06-08 11:02:43'),
        //     'amount' => 2,
        //     'status' => 'Pago',
        //     'id_product' => 1,
        //     'id_client' => 4
        // ]);

        
    }
}
