@extends('layouts.app')
@section('content')
        <br>
        <span>Title</span>
        <a href="/movies/{{ $movie->id }}">{{ $movie->title }}</a>
        <span>{{ substr($movie->release_year, 0, 4) }}</span>
        <p>Plot: {{ $movie->plot_summary }}</p>
        <br>
        <!-- <p>Ratings: 
        @foreach($movie->ratings as $rating)
            {{ $rating->rating }}
        @endforeach
        </p> -->
        <br>
        <p>Genres: 
        @foreach($movie->genres as $genre)
            {{ $genre->genre_title }}
        @endforeach</p>
        <br>
        @foreach($movie->characters as $character)
            <br>
            @foreach ($character->actors as $actor)
                {{ $actor->firstname }} {{ $actor->lastname }} as {{ $character->character_name }}
                @break;
            @endforeach
            <br>
        @endforeach</p>
        <br><br>
@endsection