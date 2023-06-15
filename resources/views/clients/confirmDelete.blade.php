@extends('layouts.main')

@section('title', 'Selecione o cliente para edição')
@section('content')
<div class=viewer>
        
    <h1>Confirme a exclusão do cliente!</h1><br>
        
    <div class=form_view>

        <br><h2>Cliente do ID:{{ $client->id_client }}</h2>

        <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>cpf</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>{{ $client->id_client }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->surname }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->cpf }}</td>
                    </tr>
                    
                </tbody>

        </table><br>

        <form method="POST" action="/clients/{{ $client->id_client }}">
            @csrf
            @method('DELETE')
            <div>
                <button type="submit" class="btn-delete">Confirmar exclusão</button>
            </div>

        </form>
    </div>

    
    

</div>
@endsection