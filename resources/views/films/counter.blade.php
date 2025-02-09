@extends('layouts.app')

@section('title', 'Contador de Películas')

@section('content')
    <div class="container text-center my-5">
        <h2 class="fw-bold text-primary" data-aos="zoom-in">Total de Películas en la Base de Datos</h2>
        <div class="card p-4 shadow-sm mt-4" data-aos="flip-left">
            <h3 class="fw-bold">{{ $count }}</h3>
        </div>
    </div>
@endsection
