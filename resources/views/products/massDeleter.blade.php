@extends('layouts.main')

@section('title', 'Visualizar produtos')
@section('content')

    <div class=viewer>

        <h1>Selecione os produtos para serem excluidos!</h1><br>

        <div class=form_view>
            <form method="POST" action=/products/deletar/mass>
            
            @csrf
            @method('DELETE')
            <br><h2>Lista de todos os produtos:</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Valor Unitário</th>
                        <th>Codigo de barras</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id_product }}</td>
                            <td>{{ $product->name_product }}</td>
                            <td>R${{ $product->unitary_value }}</td>
                            <td>{{ $product->bar_code }}</td>
                            <td><input type="checkbox" id="id_{{$product->id_product}}" name="id_{{$product->id_product}}" value="{{$product->id_product}}"><td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><button type="submit" class="btn-delete">Deletar</button>

    </div>
@endsection
