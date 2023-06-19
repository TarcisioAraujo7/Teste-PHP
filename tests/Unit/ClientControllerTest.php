<?php

namespace Tests\Feature;

use Illuminate\Http\Request;

use App\Http\Controllers\ClientController;
use App\Models\Client;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase; // Para redefinir o banco de dados após cada teste

    public function testIndex()
    {
        $response = $this->get('/clients/');

        $response->assertStatus(200)
            ->assertViewIs('clients.viewer');
    }

    public function testShow_allSemFiltros()
    {
        Client::factory(10)->create();

        $total = Client::all();

        $data = [
                    'like_name' => '',
                    'like_surname' => '',
                    'like_email' => '',
                ];

        $response = $this->get('/clients/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('clients.viewer')
            ->assertViewHas('clientes',$total);
    }
    
    public function testShow_allComFiltros()
    {

        
        $like_name = "a";
        $like_surname = "e";
        $like_email = "hotmail";

        $controller = new ClientController; 

        $total = $controller->return_filtragem($like_name,$like_surname,$like_email);

        $data = [
                    $like_name,
                    $like_surname,
                    $like_email,
                ];
            
        $response = $this->get('/clients/exibir-todos', $data);

        $response->assertStatus(200)
            ->assertViewIs('clients.viewer')
            ->assertViewHas('clientes',$total);
    }

    public function testStore()
    {
        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'cpf' => '12345678901',
            'email' => 'john.doe@example.com',
        ];

        $response = $this->post('/clients', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('clients', $data);
    }

    public function testUpdate()
    {
        $client = new Client();
        $client->name = 'John';
        $client->surname = 'Doe';
        $client->cpf = '12345678901';
        $client->email = 'john@example.com';
        $client->save();

        $request = new Request([
            'name' => 'Jane',
            'surname' => 'Smith',
            'cpf' => '98765432109',
            'email' => 'jane@example.com',
        ]);

        $clientController = new ClientController();
        $clientController->update($request, $client->id_client);

        $updatedClient = Client::find($client->id_client);
        $this->assertEquals('Jane', $updatedClient->name);
        $this->assertEquals('Smith', $updatedClient->surname);
        $this->assertEquals('98765432109', $updatedClient->cpf);
        $this->assertEquals('jane@example.com', $updatedClient->email);

        $client->delete();
    }

    public function testDestroy()
    {
        $client = Client::factory()->create();

        $response = $this->delete("/clients/{$client->id_client}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('clients', ['id_client' => $client->id_client]);
    }
}