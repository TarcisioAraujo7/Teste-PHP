@extends('layouts.main')

@section('title', 'Cadastro de produtos')

@section('content')

<div class="viewer">

    <h1>Cadastro de produtos</h1><br>
    <form  method="POST" action="/products">

            @csrf
            <label for="title">Nome:</label>
            <input type="text" class="form-control" id="name_product" name="name_product" placeholder="Nome do produto" required>

            <label for="title">Valor unitário:</label>
            <input type="number" min="0" step="0.01" class="form-control" id="unitary_value" name="unitary_value" placeholder="Valor unitário" required>

            <label for="title">Codigo de barras:</label>
            <input type="text" class="form-control" id="bar_code" name="bar_code" placeholder="Codigo de barras do produto" title="Digite um codigo válido no formato XXXXXXXXXX" required>      

            <br><input type="submit" value="Cadastrar produto">

    </form>

</div>

@endsection