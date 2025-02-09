@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>

    @if(empty($films))
        <p class="text-danger">No se ha encontrado ninguna película</p>
    @else
        <div align="center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @foreach($films[0] ?? [] as $key => $value)
                            <th>{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($films as $film)
                        <tr>
                            <td>{{ $film['name'] }}</td>
                            <td>{{ $film['year'] }}</td>
                            <td>{{ $film['genre'] }}</td>
                            <td><img src="{{ $film['img_url'] }}" style="width: 100px; height: 120px;"></td>
                            <td>{{ $film['country'] }}</td>
                            <td>{{ $film['duration'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
