@extends('layouts.main')

@section('title', 'Selecione os clientes para edição')
@section('content')
<div class=viewer>
        
    <h1>Selecione os clientes para serem excluidos!</h1><br>
        
    <div class=form_view>
        <form method="POST" action=/clients/deletar/mass>
            @csrf
            @method('DELETE')
            <br><h2>Lista de todos os clientes:</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>excluir</th>
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
                            <td><input type="checkbox" id="id_{{$cliente->id_client}}" name="id_{{$cliente->id_client}}" value="{{$cliente->id_client}}"><td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><button type="submit" class="btn-delete">Deletar</button>

    </div>

    
    

</div>
@endsection