<?php

namespace Database\Seeders;

use App\Models\client as ModelsClient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Client::factory(10)->create();


        // ModelsClient::create([
        //     'name' => 'Pedro',
        //     'surname' => 'Henrique',
        //     'cpf' => '11111111111',
        //     'email' => 'ph@gmail.com'
        // ]);

        // ModelsClient::create([
        //     'name' => 'Maria',
        //     'surname' => 'Julia',
        //     'cpf' => '22222222222',
        //     'email' => 'mj@gmail.com'
        // ]);

        // ModelsClient::create([
        //     'name' => 'Peter',
        //     'surname' => 'Parker',
        //     'cpf' => '33333333333',
        //     'email' => 'pp@gmail.com'
        // ]);

        // ModelsClient::create([
        //     'name' => 'Mary',
        //     'surname' => 'Jane',
        //     'cpf' => '4444444444',
        //     'email' => 'maryj@gmail.com'
        // ]);
    }
}
