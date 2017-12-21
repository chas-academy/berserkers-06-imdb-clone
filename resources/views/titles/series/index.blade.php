@extends('layouts.app')
@section('content')
    @foreach($series as $index => $serie)
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $serie->title_id }}">{{ $serie->title }}</a>
        <span>{{ substr($serie->release_year, 0, 4) }}</span><br>
        
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