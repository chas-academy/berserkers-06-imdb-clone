@extends('layouts.app')
@section('content')
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people">Back to all people</a>
        <p>{{ $person->name }}</p>
        <p>Date of birth: {{ date('d F Y', strtotime($person->b_date)) }}</p>
        @if(isset($person->d_date))
            <p>Date of death: {{ date('d F Y', strtotime($person->d_date)) }}</p>
        @endif

        @if(!empty($person->bio))
            <p>Bio:<br>{{ $person->bio }}</p>
        @endif
        
        @if(isset($person->actorInTitles[0]))
            <article>
                <h2>Actor in titles:</h2>
                @foreach($person->actorInTitles as $title)
                    @foreach($movies as $movie)
                        @if($title->id == $movie->title_id)
                            <span>in </span><a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
                        @endif
                    @endforeach

                    @foreach($title->characters as $character)
                        @foreach($character->actor as $actor)
                            @if($actor->id == $person->id)
                                <span>as {{ $character->character_name }}</span>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </article>
        @endif
        
        @if(isset($person->directorOfTitles[0]))
            <article>
                <h2>Director of titles:</h2>
                @foreach($person->directorOfTitles as $title)
                    @foreach($movies as $movie)
                        @if($title->id == $movie->title_id)
                            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
                        @endif
                    @endforeach
                @endforeach
            </article>
        @endif
        
        @if(isset($person->producerOfTitles[0]))
            <article>
                <h2>Producer of titles:</h2>
                @foreach($person->producerOfTitles as $title)
                    @foreach($movies as $movie)
                        @if($title->id == $movie->title_id)
                            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
                        @endif
                    @endforeach
                @endforeach
            </article>
        @endif
        
        @if(isset($person->screenwriterOfTitles[0]))
            <article>
                <h2>Screenwriter of titles:</h2>
                @foreach($person->screenwriterOfTitles as $title)
                    @foreach($movies as $movie)
                        @if($title->id == $movie->title_id)
                            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
                        @endif
                    @endforeach
                @endforeach
            </article>
        @endif

        @if(isset($person->creatorOfTitles[0]))
            <article>
                <h2>Creator of titles:</h2>
                @foreach($person->creatorOfTitles as $title)
                    @foreach($movies as $movie)
                        @if($title->id == $movie->title_id)
                            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{ $movie->title_id }}">{{ $movie->title }}</a>
                        @endif
                    @endforeach
                @endforeach
            </article>
        @endif
@endsection