@extends('layouts.main')

@section('title', 'Selecione o produto para deletar')
@section('content')
<div class=viewer>
        
    <h1>Selecione o produto para ser excluido!</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/products/deletar/confirma>
            @csrf
            <div>
                <label for="id_product">ID do produto:</label>
                <input type="text" id="id_product" name="id_product" required>

                <button type="submit">EXCLUIR</button>
            </div>
        </form>
    </div>

    <div class=form_view>
        <form method="GET" action=/products/deletar/mass>
                    @csrf
                    <br><br><div>
                        <button type="submit">EXCLUIR EM MASSA</button>
                    </div>
    </div>
    

</div>
@endsection