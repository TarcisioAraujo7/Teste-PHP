@extends('layouts.main')

@section('title', 'Visualizar clientes')



@section('content')

    <div class=viewer>
        
        <h1>Consulta de Clientes</h1><br>
            
        <div class=form_view>
            <form method="POST" action="/clients/exibir_client">
                @csrf

                <div>
                    <label for="id_client">ID do Cliente:</label>
                    <input type="text" id="id_client" name="id_client" required>

                    <button type="submit">Consultar</button>
                </div>

                

            </form>
        
            <form method="POST" action="{{ route('clients.show_all') }}">
                @csrf
                <h3> Filtre por: </h3><br>
                
                <div>
                    <label for="like_name">Nome:</label>
                    <input type="text" id="like_name" name="like_name" placeholder="Ex: Pedr" >

                </div><br>
                <div>
                    <label for="like_surname">Sobrenome:</label>
                    <input type="text" id="like_surname" name="like_surname" placeholder="Ex: Parker">

                </div><br>
                <div>
                    <label for="like_email">Email:</label>
                    <input type="text" id="like_email" name="like_email" placeholder="Ex: gmail" >

                </div><br>
                <div>
                    <button type="submit">Filtrar</button>
                </div>
            </form>
        </div>

        @if ($show_one)

            <br><h2>Cliente do ID:{{ $clientes->id_client }}</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>cpf</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>{{ $clientes->id_client }}</td>
                        <td>{{ $clientes->name }}</td>
                        <td>{{ $clientes->surname }}</td>
                        <td>{{ $clientes->email }}</td>
                        <td>{{ $clientes->cpf }}</td>
                    </tr>
                    
                </tbody>
            </table>
        @endif

        @if ($show_all)
            @if (count($clientes) === 0)
                <br><h3>Não foram encontrados clientes!</h3>
            @else

            <br><h2>Lista dos clientes:</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
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
            </table><br>
            <h4>Total: {{count($clientes)}}</h4>
            @endif
        @endif

    </div>
@endsection
