@extends('layouts.main')

@section('title', 'Editando dados do pedido ID:' . $order->id_order)

@section('content')

<div class="viewer">

    <h1>Editando o pedido com ID: {{$order->id_order}}</h1><br>
    <form  method="POST" action="/orders/{{$order->id_order}}">
        
        @csrf
        @method('PUT')

            <label for="title">Data e hora do pedido:</label>
            <input type="datetime-local" class="form-control" id="dt_order" name="dt_order" placeholder="Data e hora do pedido" value="{{ str_replace(' ', 'T', $order->dt_order)}}" required>

            <label for="title">Quantidade de itens:</label>
            <input type="number" min="1" step="1" class="form-control" id="amount" name="amount" placeholder="Quantidade" value="{{$order->amount}}" required>

            <label for="status">Status:</label><br>
                <select id="status" name="status" multiple>
                    <option value="Cancelled">Cancelado</option>
                    <option value="Pending">Em aberto</option>
                    <option value="Completed">Completo</option>
                </select>

            <br><label for="title">Id cliente:</label>
            <input type="number" min="1" step="1" class="form-control" id="id_client" name="id_client" placeholder="Id cliente" value="{{$order->id_client}}" required>

            <label for="title">Id produto:</label>
            <input type="number" min="1" step="1" class="form-control" id="id_product" name="id_product" placeholder="Id produto" value="{{$order->id_product}}" required>
            <br>

        <input type="submit" value="Editar cliente">

    </form>

</div>

@endsection