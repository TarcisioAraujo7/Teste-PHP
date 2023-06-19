<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;

use App\Models\Order;
use App\Models\Product;
use App\Models\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase; // Para redefinir o banco de dados após cada teste

    public function testIndex()
    {
        $response = $this->get('/orders/');

        $response->assertStatus(200)
            ->assertViewIs('orders.viewer');
    }

    public function testShow_allSemFiltros()
    {
        Product::factory(5)->create();
        Client::factory(5)->create();

        Order::factory(10)->create();

        $total = Order::all();

        $data = [
                    'id_client' => '',
                    'id_product' => '',
                    'status' => '',
                ];

        $response = $this->get('/orders/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('orders.viewer')
            ->assertViewHas('orders',$total);
    }

    public function testShow_allComFiltros()
    {

        $id_client = 1;
        $id_product = 2;
        $status = "Pending";

        $controller = new OrderController(); 

        $total = $controller->return_filtragem($id_client,$id_product,$status);

        $data = [
                    $id_client,
                    $id_product,
                    $status,
                ];
            
        $response = $this->get('/orders/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('orders.viewer')
            ->assertViewHas('orders',$total);
    }

    public function testStore()
    {
        $client = Client::factory()->create();

        $product = Product::factory()->create();
 
        $request = new Request([
            'dt_order' => '2023-06-18 10:00',
            'amount' => 100,
            'status' => 'Pending',
            'id_product' => $product->id_product,
            'id_client' => $client->id_client
        ]);
         
        $controller = new OrderController();
 
        $response = $controller->store($request);
 
        $this->assertEquals('Sucesso!', $response->title);
        $this->assertEquals('Pedido adicionado com sucesso!', $response->messages);
 
        $this->assertDatabaseHas('orders', [
            'dt_order' => '2023-06-18 10:00',
            'amount' => 100,
            'status' => 'Pending',
            'id_product' => $product->id_product,
            'id_client' => $client->id_client
        ]);
    }

    public function testUpdate()
    {
        
        $client = Client::factory()->create();

        $product = Product::factory()->create();
 
        $order = new Order();
        $order->dt_order = '2023-06-18 10:00';
        $order->amount = 20;
        $order->status = 'Completed';
        $order->id_product = $product->id_product;
        $order->id_client = $client->id_client;
        $order->save(); 

        $request = new Request([
            'dt_order' => '2023-01-29 10:00',
            'amount' => 1,
            'status' => 'Pending'
        ]);

        $controller = new OrderController();
        $response = $controller->update($request, $order->id_order);

        $this->assertEquals('Sucesso', $response->title);
        $this->assertEquals('Pedido alterado com sucesso!', $response->messages);

        $this->assertDatabaseHas('orders', [
            'dt_order' => '2023-01-29 10:00',
            'amount' => 1,
            'status' => 'Pending',
            'id_product' => $order->id_product,
            'id_client' => $order->id_client
        ]);

    }

    public function testDestroy()
    {
        Product::factory()->create();
        Client::factory()->create();
        $order = Order::factory()->create();

        $response = $this->delete("/orders/{$order->id_order}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('orders', ['id_order' => $order->id_order]);
    }

}
