@extends('layouts.main')

@section('title', 'Produto')

@section('content')

    <h1>Produtos</h1>

    @if($search != '')
        <p>Estou procurando por {{ $search }}</p>
    @endif

@endsection