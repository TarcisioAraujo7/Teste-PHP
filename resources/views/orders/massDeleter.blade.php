@extends('layouts.main')

@section('title', 'Visualizar pedidos')
@section('content')

    <div class=viewer>

        <h1>Selecione os pedidos para serem excluidos!</h1><br>

        <div class=form_view>
            <form method="POST" action=/orders/deletar/mass>
            
            @csrf
            @method('DELETE')
            <br><h2>Lista de todos os pedidos:</h2>

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
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id_order }}</td>
                            <td>{{ $order->dt_order }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->id_product }}</td>
                            <td>{{ $order->id_client }}</td>
                            <td><input type="checkbox" id="id_{{$order->id_order}}" name="id_{{$order->id_order}}" value="{{$order->id_order}}"><td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><button type="submit" class="btn-delete">Deletar</button>

    </div>
@endsection
