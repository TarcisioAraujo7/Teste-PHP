<?php

namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $clientes = Client::all(); 

        $show_all = false;
        $show_one = false;

        return view('clients.viewer', compact('show_all','show_one','clientes'));
    }

    public function show_all(Request $request): View 
    {
        $like_name = $request->like_name;
        $like_surname = $request->like_surname;
        $like_email = $request->like_email;

        $clientes = ClientController::return_filtragem($like_name, $like_surname, $like_email);

        $show_all = true;
        $show_one = false;

        return view('clients.viewer', compact('show_all','show_one','clientes'));
    }

    public function show(Request $request)
    {
        $id_client = $request->input('id_client');
        $clientes = Client::find($id_client);

        if (!$clientes) {
            $messages = "Error! Não foi encontrado cliente com esse ID.";
            return view('layouts.error', compact('messages'));
        }

        $show_all = false;
        $show_one = true;

        return view('clients.viewer', compact('show_all', 'show_one', 'clientes'));
    }

    public function form_post() 
    {
        return view('clients.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:20|regex:/^[^0-9]+$/|alpha_dash',
            'surname' => 'required|max:20|regex:/^[^0-9]+$/|alpha_dash',
            'cpf' => 'required|regex:/^[0-9]+$/|size:11|unique:clients',
            'email' => 'nullable|email|unique:clients',
        ], ClientController::messages());
        
        if ($validator->fails()) {
            return ClientController::return_erro($validator->errors());
        }

        $client = new Client();
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->cpf = $request->cpf;
        $client->email = $request->email;

        $client->save();

        $title = "Sucesso!";
        $messages = "Cliente adicionado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }

    public function selec_put()
    {
        return view('clients.seletor');
    }

    public function form_put(Request $request)
    {
        $client = Client::find($request->input('id_client'));

        if (!$client) {
            return ClientController::return_erro("Cliente não encontrado com o ID informado");
        }

        return view('clients.updater',compact('client'));
    }

    public function update(Request $request, $id_client)
    {
        $client = Client::find($id_client);

        if (!$client) {
            return ClientController::return_erro("Cliente não encontrado com o ID informado");
        } 


        $validator = Validator::make($request->all(),[
            'name' => 'max:20|regex:/^[^0-9]+$/|alpha_dash',
            'surname' => 'max:20|regex:/^[^0-9]+$/|alpha_dash',
            'cpf' => 'regex:/^[0-9]+$/|size:11',
            'email' => 'nullable',
        ], ClientController::messages());
        
        $validator->sometimes('cpf', 'unique:clients', function ($input) use ($client) {
            return $input->cpf != $client->cpf;
        });
        
        $validator->sometimes('email', 'unique:clients', function ($input) use ($client) {
            return $input->email != $client->email;
        });
        
        if ($validator->fails()) {
            return ClientController::return_erro($validator->errors());
        }

        $client->update($request->all());

        $title = "Sucesso";
        $messages = "Cliente alterado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }

    public function selec_del()
    {
        return view('clients.selecDelete');
    }

    public function selec_massdel()
    {
        $clientes = Client::all();

        return view('clients.massDeleter', compact('clientes'));
    }

    public function massdel(Request $request)
    {
        foreach ($request->all() as $key => $value) {

            if ($key == '_token' ||$key == '_method'  ) {
                continue;
                
            } else {

                try {
                    Client::destroy($value);
                } catch (\Illuminate\Database\QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if ($errorCode == 1451) {
                        return ClientController::return_erro("Não é possível excluir o cliente de id {$value} devido a registros dependentes em outras tabelas.");
                    } else {
                        return ClientController::return_erro("Ocorreu um erro ao excluir o cliente.");
                    }
                }

            }
        }
        
        $title = "Sucesso!";
        $messages = "Todos clientes foram deletados com sucesso!";
        return view('layouts.message', compact('title','messages')); 
    }


    public function confirm_destroy(Request $request)
    {
        $client = Client::find($request->input('id_client'));

        if (!$client) {
            return ClientController::return_erro("Cliente não encontrado com o ID informado");
        }

        return view('clients.confirmDelete',compact('client'));
    }

    public function destroy($client_id)
    {
        $client = Client::find($client_id);

        if (!$client) {
            return ClientController::return_erro("Cliente não encontrado com o ID informado");
        } 

        try {
            $client->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return ClientController::return_erro("Não é possível excluir o cliente devido a registros dependentes em outras tabelas.");
            } else {
                return ClientController::return_erro("Ocorreu um erro ao excluir o cliente.");
            }
        }
        
        $title = "Sucesso!";
        $messages = "Cliente deletado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }


    /** 
     * Função para filtragem, reduzindo os resultados das buscas de acordo com as entradas dadas.
     * 
     * @var string $like_name
     * @var string $like_surname
     * @var string $like_email
       */
    public function return_filtragem($like_name, $like_surname, $like_email)
    {
        $query = Client::query();

        if ($like_name) {
            $query->where('name', 'LIKE', '%' . $like_name . '%');
        }

        if ($like_surname) {
            $query->where('surname', 'LIKE', '%' . $like_surname . '%');
        }

        if ($like_email) {
            $query->where('email', 'LIKE', '%' . $like_email . '%');
        }

        // Verifica se nenhuma condição de filtragem foi especificada
        if (!$like_name && !$like_surname && !$like_email) {
            $clientes = Client::all();
        } else {
            $clientes = $query->get();
        }

        return $clientes;
    }

    public function return_erro($messages)
    {
        return view('layouts.error', compact('messages'));
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
