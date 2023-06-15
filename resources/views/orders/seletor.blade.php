@extends('layouts.main')

@section('title', 'Selecione o pedido para edição')
@section('content')
<div class=viewer>
        
    <h1>Selecione o pedido para alteração</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/orders/atualizar/form>
            @csrf
            <div>
                <label for="id_order">ID do Pedido:</label>
                <input type="text" id="id_order" name="id_order" required>

                <button type="submit">Consultar</button>
            </div>
    </div>    

</div>
@endsection