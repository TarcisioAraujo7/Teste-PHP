@extends('layouts.main')

@section('title', $title)

@section('content')

    <div class=viewer>
        <h1>{{$title}}</h1>
        <p>{{ $messages }}</p>

        <button onclick="goBack()">Voltar</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>
@endsection