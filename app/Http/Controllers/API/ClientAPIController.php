<?php

namespace App\Http\Controllers\API;

use App\Models\Client;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAPIController extends Controller
{
    public function index() {

        $clientes = Client::all(); 

        return response()->json($clientes);
        
    }

    public function show($client_id){
        $client = Client::find($client_id);

        if ($client) {
            return response()->json($client);
        } else {
            return response()->json(['message'=>"cliente não encontrado"], 404);
        }

    }

    public function consult(Request $request)
    {
        $id_client = $request->input('id_client');
        $clientes = [];

        if ($id_client) {
            $client = Client::find($id_client);

            if ($client) {
                $clientes[] = $client;
            }
        }

        $show_all = false;

        return view('clients.viewer', compact('show_all', 'clientes'));

    }

    public function show_all()
    {
        $show_all = true;
        $clientes = Client::all();

        return view('clients.viewer', compact('show_all', 'clientes'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20|regex:/^[^0-9]+$/|alpha_dash',
            'surname' => 'required|max:20|regex:/^[^0-9]+$/|alpha_dash',
            'cpf' => 'required|regex:/^[0-9]+$/|size:11|unique:clients',
            'email' => 'email|unique:clients',
        ], ClientAPIController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $client = new Client();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->cpf = $request->cpf;
        $client->email = $request->email;

        $client->save();

        return response()->json($client, 201);
    }

    public function update(Request $request, $client_id){
        $client = Client::find($client_id);

        if (!$client) {
            return response()->json(['message'=>"cliente não encontrado"], 404);
        } 

        $validator = Validator::make($request->all(),[
            'name' => 'max:20|regex:/^[^0-9]+$/|alpha_dash',
            'surname' => 'max:20|regex:/^[^0-9]+$/|alpha_dash',
            'cpf' => 'regex:/^[0-9]+$/|size:11|unique:clients',
            'email' => 'email|unique:clients',
        ], ClientAPIController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $client->update($request->all());

        return response()->json($client,201);

    }

    public function destroy($client_id){
        $client = Client::find($client_id);

        if (!$client) {
            return response()->json(['message'=>"cliente não encontrado"], 404);
        } 

        $client->delete();

        return response()->json(['message'=>"cliente deletado com sucesso"],201);

    }

    public function messages()
    {
        return [
            'name.required' => "O campo 'name' é obrigatório.",
            'name.max' => 'O campo name não pode exceder 20 caracteres.',
            'name.regex' => 'O campo name não deve conter numeros.',
            'name.alpha_dash' => 'O campo name deve conter apenas letras.',
            'surname.required' => "O campo 'surname' é obrigatório.",
            'surname.max' => 'O campo surname não pode exceder 20 caracteres.',
            'surname.regex' => 'O campo surname não deve conter numeros.',
            'surname.alpha_dash' => 'O campo surname deve conter apenas letras.',
            'cpf.required' => "O campo 'cpf' é obrigatório.",
            'cpf.regex' => 'O campo CPF deve conter apenas números.',
            'cpf.size' => 'O campo CPF deve conter 11 caracteres.',
            'cpf.unique' => 'O CPF informado já está cadastrado.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.unique' => 'O email informado já está cadastrado.',
        ];

    }

}
