<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/script.js"></script>

    </head>
    <body>
        <h1>Algum Título</h1>
        <img src="img/banner.jpg" alt="banner">
        @if(10 > 5)
            <p>A condição é verdadeira</p>
        @endif

        <p>{{ $name }}</p>

        @if($name == "Pedro")
            <p>O nome é Pedro</p>
        @elseif($name == "Matheus")
            <p>O nome é {{ $name }} e sua idade é {{ $age }}</p>
            <p>Essa é um nova linha</p>
        @else
            <p>O nome é outro: {{ $name }}</p>
        @endif
        @for($i = 0; $i < count($arr); $i++)
            <p>{{ $arr[$i] }} - {{ $i }}</p>
        @endfor

        @php
            $name = 'João';
            // hidden notes?
            echo $name;
        @endphp

        {{-- Este é o comentário do Blade --}}

        @foreach($names as $name)
            <p>{{ $loop->index }} -> {{ $name }}</p>
        @endforeach
    </body>
</html>
