@extends('layouts.app')
@section('content')
    @foreach($movies as $movie)
        <a href="/movies/{{ $movie->id }}">{{ $movie->title }}</a>
        <span>{{ substr($movie->release_year, 0, 4) }}</span>
        <br>
        <p>Genres: 
        @foreach($movie->genres as $genre)
            {{ $genre->genre_title }}
        @endforeach</p>
    @endforeach
@endsection