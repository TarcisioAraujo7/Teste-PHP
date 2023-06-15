@extends('layouts.main')

@section('title', 'Editando dados do cliente ID:' . $client->id_client)

@section('content')

<div class="viewer">

    <h1>Editando o cliente: {{$client->name}}</h1><br>
    <form  method="POST" action="/clients/{{$client->id_client}}">
        
        @csrf
        @method('PUT')

            <label for="title">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do cliente" value="{{$client->name}}" >
        

            <label for="title">Sobrenome:</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Sobrenome do cliente" value="{{$client->surname}}">

            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do cliente" title="Digite um CPF válido no formato XXXXXXXXXXX" value="{{$client->cpf}}">      

            <label for="title">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email do cliente"value="{{$client->email}} "><br>

        <input type="submit" value="Editar cliente">

    </form>

</div>

@endsection