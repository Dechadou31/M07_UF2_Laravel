@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actors as $actor)
                <tr>
                    <td>{{ $actor->id }}</td>
                    <td>{{ $actor->name }}</td>
                    <td>{{ $actor->birthdate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('actors') }}">Volver al listado general</a>
@endsection
