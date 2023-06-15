@extends('layouts.main')

@section('title', 'Editando dados do produto ID:' . $product->id_product)

@section('content')

<div class="viewer">

    <h1>Editando o produto: {{$product->name_product}}</h1><br>
    <form  method="POST" action="/products/{{$product->id_product}}">
        
        @csrf
        @method('PUT')

            <label for="title">Nome do produto:</label>
            <input type="text" class="form-control" id="name_product" name="name_product" placeholder="Nome do produto" value="{{$product->name_product}}" >
        
            <label for="title">Valor unitário:</label>
            <input type="number" min="0" step="0.01" class="form-control" id="unitary_value" name="unitary_value" placeholder="Valor unitário" value="{{$product->unitary_value}}">
            

            <label for="title">Codigo de barras:</label>
            <input type="text" class="form-control" id="bar_code" name="bar_code" placeholder="Codigo de barras do produto" title="Digite um codigo válido no formato XXXXXXXXXX" value="{{$product->bar_code}}">      

        <br><input type="submit" value="Editar produto">

    </form>

</div>

@endsection