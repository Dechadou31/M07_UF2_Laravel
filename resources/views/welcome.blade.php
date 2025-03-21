@extends('layouts.app')

@section('title', 'Bienvenido a MovieApp')

@section('content')
    <div class="text-center" data-aos="zoom-in">
        <h2 class="my-4 fw-bold text-primary">Lista de Películas</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('oldFilms') }}">🎥 Pelis antiguas</a></li>
            <li class="list-group-item"><a href="{{ route('newFilms') }}">🔥 Pelis nuevas</a></li>
            <li class="list-group-item"><a href="{{ route('listFilms') }}">📺 Todas las Pelis</a></li>
            <li class="list-group-item"><a href="{{ route('countFilms') }}">📌 Contador de Pelis</a></li>
        </ul>
             <!-- Enlace a la lista de actores -->
             <h2 class="my-4 fw-bold text-primary">Lista de Actores</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('actors') }}">🎬 Ver todos los actores</a></li>
            <li class="list-group-item"><a href="{{ route('actors.count') }}">🔢 Contador de Actores</a></li>
        </ul>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card my-5 p-4 shadow-sm" data-aos="flip-left">
        <h3 class="fw-bold">Añadir Película</h3>
        <form action="{{ route('createFilm') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Año</label>
                <input type="number" class="form-control" name="year" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Género</label>
                <input type="text" class="form-control" name="genre" required>
            </div>
            <div class="mb-3">
                <label class="form-label">País</label>
                <input type="text" class="form-control" name="country" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Duración</label>
                <input type="number" class="form-control" name="duration" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen URL</label>
                <input type="text" class="form-control" name="img_url">
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>
@endsection
