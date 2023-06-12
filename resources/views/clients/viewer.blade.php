@extends('layouts.main')

@section('title', 'Visualizar clientes')



@section('content')

    <div class=viewer>
    <h1>Consulta de Clientes</h1>
        
    <div class=form_view>
        <form method="POST" action="{{ route('clients.consult') }}">
            @csrf

            <div>
                <label for="id_client">ID do Cliente:</label>
                <input type="text" id="id_client" name="id_client" required>

                <button type="submit">Consultar</button>
            </div>

            

        </form>
    
        <form method="POST" action="{{ route('clients.show_all') }}">
            @csrf
            <div>
                <button type="submit">Exibir Todos</button>
            </div>
        </form>
    </div>

    
    @if ($show_all)

        <h2>Lista de Todos os Clientes:</h2>

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
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id_client }}</td>
                        <td>{{ $cliente->name }}</td>
                        <td>{{ $cliente->surname }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->cpf }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    @endif

    </div>
@endsection
