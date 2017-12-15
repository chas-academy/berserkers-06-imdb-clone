@extends('layouts.app')
@section('content')
    @foreach($movies as $index => $movie)
        <a href="/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
        <span>{{ substr($movie->release_year, 0, 4) }}</span>
        <br>
        <p>
        @foreach($titles[$index]->genres as $genre)
            {{ $loop->first ? '' : ', ' }}
            {{ $genre->name }}
        @endforeach</p>
    @endforeach
@endsection