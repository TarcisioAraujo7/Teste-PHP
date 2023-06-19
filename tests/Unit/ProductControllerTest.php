<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase; // Para redefinir o banco de dados após cada teste

    public function testIndex()
    {
        $response = $this->get('/products/');

        $response->assertStatus(200)
            ->assertViewIs('products.viewer');
    }

    public function testShow_allSemFiltros()
    {
        Product::factory(10)->create();

        $total = Product::all();

        $data = [
                    'like_name' => '',
                    'minPrice' => '',
                    'maxPrice' => '',
                ];

        $response = $this->get('/products/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('products.viewer')
            ->assertViewHas('products',$total);
    }

    public function testShow_allComFiltros()
    {   

        $like_name = "a";
        $min_price = 50;
        $max_price = 200;

        $controller = new ProductController(); 

        $total = $controller->return_filtragem($like_name,$min_price,$max_price);

        $data = [
                    $like_name,
                    $min_price,
                    $max_price,
                ];
            
        $response = $this->get('/products/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('products.viewer')
            ->assertViewHas('products',$total);
    }

    public function testStore()
    {
        $data = [
            'name_product' => 'Queijo',
            'unitary_value' => 10,
            'bar_code' => '1234567801'
        ];

        $response = $this->post('/products', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', $data);
    }

    public function testUpdate()
    {
        
        $product = new Product();
        $product->name_product = 'Sabonete';
        $product->unitary_value = 7.50;
        $product->bar_code = '1234567890';
        
        $product->save();

        $request = new Request([
            'name_product' => 'Sabonete Liquido',
            'unitary_value' => 14,
            'bar_code' => '9876543209',
        ]);

        $productController = new ProductController();
        $productController->update($request, $product->id_product);

        $updatedProduct = Product::find($product->id_product);
        $this->assertEquals('Sabonete Liquido', $updatedProduct->name_product);
        $this->assertEquals(14, $updatedProduct->unitary_value);
        $this->assertEquals('9876543209', $updatedProduct->bar_code);

        $product->delete();
    }

    public function testDestroy()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/products/{$product->id_product}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('products', ['id_product' => $product->id_product]);
    }
}
