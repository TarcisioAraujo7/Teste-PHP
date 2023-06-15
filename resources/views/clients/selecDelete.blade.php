@extends('layouts.main')

@section('title', 'Selecione o cliente para remoção')
@section('content')
<div class=viewer>
        
    <h1>Selecione o cliente para ser excluido!</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/clients/deletar/confirma>
            @csrf
            <div>
                <label for="id_client">ID do Cliente:</label>
                <input type="text" id="id_client" name="id_client" >

                <button type="submit">EXCLUIR</button>
            </div>
        </form>
        
            
    </div>

    <div class=form_view>
        <form method="GET" action=/clients/deletar/mass>
                    @csrf
                    <br><br><div>
                        <button type="submit">EXCLUIR EM MASSA</button>
                    </div>
    </div>
    

</div>
@endsection