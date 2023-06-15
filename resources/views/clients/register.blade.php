@extends('layouts.main')

@section('title', 'Cadastro de clientes')

@section('content')

<div class="viewer">

    <h1>Cadastro de clientes</h1><br>
    <form  method="POST" action="/clients">

            @csrf
            <label for="title">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do cliente" required>

            <label for="title">Sobrenome:</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Sobrenome do cliente" required>

            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do cliente" title="Digite um CPF válido no formato XXXXXXXXXXX" required>      

            <label for="title">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email do cliente"><br>

        <input type="submit" value="Cadastrar cliente">

    </form>

</div>

@endsection