@extends('layouts.main')

@section('title', 'Selecione o pedido para edição')
@section('content')
<div class=viewer>
        
    <h1>Confirme a exclusão do pedido!</h1><br>
        
    <div class=form_view>

        <br><h2>Pedido do ID:{{ $order->id_order }}</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data do pedido</th>
                    <th>Quantidade</th>
                    <th>Status</th>
                    <th>Id produto</th>
                    <th>Id cliente</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->dt_order }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->id_product }}</td>
                    <td>{{ $order->id_client }}</td>
                </tr>
                
            </tbody>
        </table><br>

        <form method="POST" action="/orders/{{ $order->id_order }}">
            @csrf
            @method('DELETE')
            <div>
                <button type="submit" class="btn-delete">Confirmar exclusão</button>
            </div>

        </form>
    </div>

</div>
@endsection