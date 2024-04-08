@extends('layouts.main')

@section('title', 'HDC events')

@section('content')

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

@endsection