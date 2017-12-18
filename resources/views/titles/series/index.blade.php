@extends('layouts.app')
@section('content')
    @foreach($series as $index => $serie)
        <a href="series/{{ $serie->title_id }}">{{ $serie->title }}</a>
        <span>{{ substr($serie->release_year, 0, 4) }}</span><br>
        <img src="{{ $titles[$index]->photos[0]->photo_path }}" alt="poster" width="200">
        <br>
        <p>
        @foreach($titles[$index]->genres as $genre)
            {{ $loop->first ? '' : ', ' }}
            {{ $genre->name }}
        @endforeach</p>
    @endforeach
@endsection