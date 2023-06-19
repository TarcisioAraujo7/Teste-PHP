@extends('layouts.main')

@section('title', 'Visualizar produtos')



@section('content')

    <div class=viewer>
        
        <h1>Consulta de Produtos</h1><br>
            
        <div class=form_view>

            <form method="GET" action="/products/exibir_product">
                @csrf
                <div>
                    <label for="id_product">ID do Produto:</label>
                    <input type="text" id="id_product" name="id_product" required>

                    <button type="submit">Consultar</button>
                </div>
            </form>
        
            <form method="GET" action="{{ route('products.show_all') }}">
                @csrf
                <h3> Filtre por: </h3><br>
                
                <div>
                    <label for="like_name">Nome:</label>
                    <input type="text" id="like_name" name="like_name" placeholder="Ex: sab" >

                </div><br>

                <div>
                    <label for="minPrice">Preço mínimo:</label>
                    <input type="number" name="minPrice" id="minPrice" step="0.01">
                </div>
                <div>
                    <label for="maxPrice">Preço máximo:</label>
                    <input type="number" name="maxPrice" id="maxPrice" step="0.01">
                </div><br>

                <div>
                    <button type="submit">Filtrar</button>
                </div>
            </form>

        </div>

        @if ($show_one)

            <br><h2>Produto do ID:{{ $products->id_product }}</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor Unitário</th>
                        <th>Codigo de barras</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>{{ $products->id_product }}</td>
                        <td>{{ $products->name_product }}</td>
                        <td>{{ $products->unitary_value }}</td>
                        <td>{{ $products->bar_code }}</td>
                    </tr>
                    
                </tbody>
            </table>
        @endif

        @if ($show_all)
            @if (count($products) === 0)
                <br><h3>Não foram encontrados produtos!</h3>
            @else
            <br><h2>Lista dos produtos:</h2>

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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h4>Total: {{count($products)}}</h4>
            @endif
        @endif

    </div>
@endsection
