@extends('layouts.main')

@section('title', 'Confirme a exclusão')
@section('content')
<div class=viewer>
        
    <h1>Confirme a exclusão do produto!</h1><br>
        
    <div class=form_view>

        <br><h2>Produto do ID:{{ $product->id_product }}</h2>

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
                        <td>{{ $product->id_product }}</td>
                        <td>{{ $product->name_product }}</td>
                        <td>R${{ $product->unitary_value }}</td>
                        <td>{{ $product->bar_code }}</td>
                    </tr>
                    
                </tbody>

        </table><br>

        <form method="POST" action="/products/{{ $product->id_product }}">
            @csrf
            @method('DELETE')
            <div>
                <button type="submit" class="btn-delete">Confirmar exclusão</button>
            </div>

        </form>
    </div>

    
    

</div>
@endsection