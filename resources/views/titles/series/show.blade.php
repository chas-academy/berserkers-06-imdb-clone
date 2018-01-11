@extends('layouts.app')
@section('content')
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/series">Back to all series</a>
        <p>{{ $series->title }}</p>
        <time datetime="{{ $series->release_year }}">{{ date('d F Y', strtotime($series->release_year)) }}</time><br>
        @foreach($title->photos as $photo)
            @if($photo->width == 500 && $photo->photo_type == "poster")
                <img src="{{ $photo->photo_path }}" alt="poster" width="300">
                @break
            @endif
            @if($loop->last)
                <img src="{{ $photo->photo_path }}" alt="poster" width="300">
            @endif
        @endforeach
        <br>
        @foreach($title->photos as $photo)
            @if($photo->width == 1280 && $photo->photo_type == "backdrop")
                <img src="{{ $photo->photo_path }}" alt="poster">
                @break
            @endif
            @if($loop->last)
                <img src="{{ $photo->photo_path }}" alt="poster">
            @endif
        @endforeach

        <p>{{ $series->plot_summary }}</p>
        <br>
        <p>Genres: 
        @foreach($title->genres as $genre)
            {{ $loop->first ? '' : ', ' }}
            {{ $genre->name }}
        @endforeach</p>
        <p>Rating: 
        <?php
            $ratingSummary = 0;
            $i = 0;
            foreach ($title->ratings as $rating) {
                $ratingSummary = $ratingSummary + $rating->rating;
                $i++;
            }
            if ($i == 0) {
                echo "-";
            } else {
                $ratingSummary = $ratingSummary / $i;
                echo $ratingSummary;
            }
        ?>
        </p>
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons">All Seasons</a><br>
        @foreach($seasons as $season)
            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}">Season {{ $season->season_number }}</a><br>
        @endforeach
        <article>
            <h3>Directors:</h3>
            @if(isset($title->directors[0]))
                @foreach($title->directors as $director)
                    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a><br>
                @endforeach
            @else
                <span>-</span>
            @endif
        </article>

        <article>
            <h3>Producers:</h3>
            @if(isset($title->producers[0]))
                @foreach($title->producers as $producer)
                    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $producer->id }}">{{ $producer->name }}</a><br>
                @endforeach
            @else
                <span>-</span>
            @endif
            
        </article>

        <article>
            <h3>Screenwriters:</h3>
            @if(isset($title->screenwriters[0]))
                @foreach($title->screenwriters as $screenwriter)
                    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a><br>
                @endforeach
            @else
                <span>-</span>
            @endif
            
        </article>

        <article>
            <h3>Actors:</h3>
            @if(isset($title->characters[0]))
                @foreach($title->characters as $character)
                    <table>
                    @foreach ($character->actor as $actor)
                        <tr>
                            <td style="width: 200px"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $actor->id }}">{{ $actor->name }}</a></td>
                            <td style="width: 30px">as</td>
                            <td>{{ $character->character_name }}</td>
                        </tr>
                    @endforeach
                    </table>
                @endforeach
            @else
                <span>-</span>
            @endif
            
        </article>
        
        @if(Auth::check())
            <a href="http://{{ $_SERVER['HTTP_HOST'] }}/reviews/create">Create a review</a>
        @endif
@endsection