@extends('layouts.main')

@section('title', 'Selecione o produto para edição')
@section('content')
<div class=viewer>
        
    <h1>Selecione o produto para alteração</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/products/atualizar/form>
            @csrf
            <div>
                <label for="id_product">ID do Produto:</label>
                <input type="text" id="id_product" name="id_product" required>

                <button type="submit">Consultar</button>
            </div>
    </div>

    
    

</div>
@endsection