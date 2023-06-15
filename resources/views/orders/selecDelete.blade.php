@extends('layouts.main')

@section('title', 'Selecione o pedido para edição')
@section('content')
<div class=viewer>
        
    <h1>Selecione o pedido para ser excluido!</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/orders/deletar/confirma>
            @csrf
            <div>
                <label for="id_order">ID do Pedido:</label>
                <input type="text" id="id_order" name="id_order" required>

                <button type="submit">EXCLUIR</button>
            </div>
        </form>
    </div>

    <div class=form_view>
        <form method="GET" action=/orders/deletar/mass>
                    @csrf
                    <br><br><div>
                        <button type="submit">EXCLUIR EM MASSA</button>
                    </div>
    </div>
    
    

</div>
@endsection