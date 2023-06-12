<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client as client;
use App\Models\Product as product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientIds = Client::pluck('id_client')->toArray();
        $productIds = Product::pluck('id_product')->toArray();

        return [
            'dt_order' => fake()->dateTimeBetween('-1 year', 'now'),
            'amount' => fake()->numberBetween(1, 15),
            'status' => fake()->randomElement(['Pending', 'Completed', 'Cancelled']),
            'id_client' => fake()->randomElement($clientIds),
            'id_product' => fake()->randomElement($productIds),
        ];
    }
}
