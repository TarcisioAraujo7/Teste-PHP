@extends('layouts.main')

@section('title', 'Cadastro de clientes')

@section('content')

<div id="client-creat-container" class="col-md-6 off">
    <h1>Cadastro de clientes</h1>
    <form action="/addclient" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome do cliente">
        </div>

        <div class="form-group">
            <label for="title">Sobrenome:</label>
            <input type="text" class="form-control" id="surname" name="surname" placeholder="Sobrenome do cliente">
        </div>

        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF do cliente" title="Digite um CPF válido no formato XXXXXXXXXXX" required>      
        </div>

        <div class="form-group">
            <label for="title">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email do cliente">
        </div>

        <input type="submit" class="btn btm-primary" value="Cadastrar cliente">

    </form>

</div>

@endsection