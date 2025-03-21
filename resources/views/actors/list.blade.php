@extends('layouts.app')

@section('content')
    <h1>Lista de Actores</h1>

    <form action="{{ route('actors.listByDecade') }}" method="GET">
        <label for="yearInput">Seleccione una década:</label>
        <select id="yearInput" name="year" required>
            <option value="1980" {{ old('year') == 1980 ? 'selected' : '' }}>1980</option>
            <option value="1990" {{ old('year') == 1990 ? 'selected' : '' }}>1990</option>
            <option value="2000" {{ old('year') == 2000 ? 'selected' : '' }}>2000</option>
            <option value="2010" {{ old('year') == 2010 ? 'selected' : '' }}>2010</option>
            <option value="2020" {{ old('year') == 2020 ? 'selected' : '' }}>2020</option>
        </select>
        <button type="submit">Buscar</button>
    </form>

    @if($actors->isEmpty())
        <p class="text-danger">No se ha encontrado ningún actor</p>
    @else
        <div align="center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>País</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actors as $actor)
                        <tr>
                            <td>{{ $actor->name }}</td>
                            <td>{{ $actor->surname }}</td>
                            <td>{{ $actor->birthdate }}</td>
                            <td>{{ $actor->country }}</td>
                            <td><img src="{{ $actor->img_url }}" style="width: 100px; height: 120px;"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
