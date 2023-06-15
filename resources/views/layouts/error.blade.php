@extends('layouts.main')

@section('title', "ERRO!")

@section('content')

    <div class=viewer>
        
        <h1>ERRO:</h1>
        @if(is_string($messages))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $messages }}</li>
                </ul>
            </div>
        @else
            @if($messages->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($messages->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endif
        <button onclick="goBack()">Voltar</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
@endsection