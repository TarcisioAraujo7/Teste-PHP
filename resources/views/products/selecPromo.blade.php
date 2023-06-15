@extends('layouts.main')

@section('title', 'Selecione o produto para aplicar desconto')
@section('content')
<div class=viewer>
        
    <h1>Selecione o produto para aplicar desconto!</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/products/promo/confirma>
            @csrf
            <div>
                <label for="id_product">ID do produto:</label>
                <input type="text" id="id_product" name="id_product" required>

                <button type="submit">SELECIONAR</button>
            </div>
    </div>

    
    

</div>
@endsection