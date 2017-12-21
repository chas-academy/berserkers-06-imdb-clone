@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles">All titles</a><br>
    @foreach($movies as $index => $movie)
        <a href="movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
        <span>{{ substr($movie->release_year, 0, 4) }}</span><br>
        
        @foreach($titles[$index]->photos as $photo)
            @if($photo->width == 500 && $photo->photo_type == "poster")
                <img src="{{ $photo->photo_path }}" alt="poster" width="300">
                @break
            @endif
            @if($loop->last)
                <img src="{{ $photo->photo_path }}" alt="poster" width="300">
            @endif
        @endforeach

        <br>
        <p>
        @foreach($titles[$index]->genres as $genre)
            {{ $loop->first ? '' : ', ' }}
            {{ $genre->name }}
        @endforeach</p>
    @endforeach
@endsection