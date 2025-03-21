@extends('layouts.app')

@section('content')
    <h1 class="my-4 text-primary">Contador de Actores</h1>
    <div class="card p-4 shadow-sm">
        <h2 class="fw-bold">Total de actores registrados:</h2>
        <p class="display-4 text-center text-success">{{ $actorCount }}</p>
    </div>
    <a href="{{ route('actors') }}" class="btn btn-primary mt-3">Volver a la lista de actores</a>
@endsection
