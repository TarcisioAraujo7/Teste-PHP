@extends('layouts.main')

@section('title', 'Visualizar pedidos')



@section('content')

    <div class=viewer>
        
        <h1>Consulta de Pedidos</h1><br>
            
        <div class=form_view>
            <form method="GET" action="/orders/exibir_order">
                @csrf

                <div>
                    <label for="id_order">ID do Pedido:</label>
                    <input type="text" id="id_order" name="id_order" required>

                    <button type="submit">Consultar</button>
                </div>

            </form>

            <form method="GET" action="/orders/exibir-todos">
                @csrf
                <h3> Filtre por: </h3><br>
                
                <div>
                    <label for="id_product">ID do produto:</label>
                    <input type="text" id="id_product" name="id_product" >

                </div><br>

                <div>
                    <label for="id_client">ID do cliente:</label>
                    <input type="text" id="id_client" name="id_client" >

                </div>
                
                <label for="status">Status:</label><br>
                <select id="status" name="status" multiple>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select><br>

                <br><div>
                    <button type="submit">Filtrar</button>
                </div>

            </form>
        </div>


        
        @if ($show_one)

            <br><h2>Pedido do ID:{{ $orders->id_order }}</h2>

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
                        <td>{{ $orders->id_order }}</td>
                        <td>{{ $orders->dt_order }}</td>
                        <td>{{ $orders->amount }}</td>
                        <td>{{ $orders->status }}</td>
                        <td>{{ $orders->id_product }}</td>
                        <td>{{ $orders->id_client }}</td>
                    </tr>
                    
                </tbody>
            </table>
        @endif

        @if ($show_all)
            @if (count($orders) === 0)
                <br><h3>Não foram encontrados pedidos!</h3>
            @else
            <br><h2>Lista dos pedidos:</h2>

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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total: {{count($orders)}}</h4>
            @endif
        @endif

    </div>
@endsection
