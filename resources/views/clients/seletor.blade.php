@extends('layouts.main')

@section('title', 'Selecione o cliente para edição')
@section('content')
<div class=viewer>
        
    <h1>Selecione o cliente para alteração</h1><br>
        
    <div class=form_view>
        <form method="GET" action=/clients/atualizar/form>
            @csrf
            <div>
                <label for="id_client">ID do Cliente:</label>
                <input type="text" id="id_client" name="id_client" required>

                <button type="submit">Consultar</button>
            </div>
    </div>

    
    

</div>
@endsection