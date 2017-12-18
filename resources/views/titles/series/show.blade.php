@extends('layouts.app')
@section('content')
        <a href="../series">Back to all series</a>
        <p>{{ $series->title }}</p>
        <time datetime="{{ $series->release_year }}">{{ date('d F Y', strtotime($series->release_year)) }}</time><br>
        <img src="{{ $title->photos[0]->photo_path }}" alt="poster" width="300">
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
        <a href="{{ $series->title_id }}/seasons">All Seasons</a><br>
        @foreach($seasons as $season)
            <a href="{{ $series->title_id }}/seasons/{{ $season->season_number }}">Season {{ $season->season_number }}</a><br>
        @endforeach
        <article>
            <h3>Directors:</h3>
            @if(isset($title->directors[0]))
                @foreach($title->directors as $director)
                    <a href="../../people/{{ $director->id }}">{{ $director->name }}</a><br>
                @endforeach
            @else
                <span>-</span>
            @endif
        </article>

        <article>
            <h3>Producers:</h3>
            @if(isset($title->producers[0]))
                @foreach($title->producers as $producer)
                    <a href="../../people/{{ $producer->id }}">{{ $producer->name }}</a><br>
                @endforeach
            @else
                <span>-</span>
            @endif
            
        </article>

        <article>
            <h3>Screenwriters:</h3>
            @if(isset($title->screenwriters[0]))
                @foreach($title->screenwriters as $screenwriter)
                    <a href="../../people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a><br>
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
                            <td style="width: 200px"><a href="../../people/{{ $actor->id }}">{{ $actor->name }}</a></td>
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
            <a href="../../reviews/create">Create a review</a>
        @endif
@endsection