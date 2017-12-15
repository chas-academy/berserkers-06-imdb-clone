@extends('layouts.app')
@section('content')
        <a href="../movies">Back to all movies</a>
        <p>{{ $movie->title }}</p>
        <time datetime="{{ $movie->release_year }}">{{ date('d F Y', strtotime($movie->release_year)) }}</time>
        <p>{{ $movie->plot_summary }}</p>
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
        <article>
            <h3>Directors:</h3>
        @foreach($title->directors as $director)
            <a href="../people/{{ $director->id }}">{{ $director->name }}</a><br>
        @endforeach</article>
        <article>
            <h3>Producers:</h3>
        @foreach($title->producers as $producer)
            <a href="../people/{{ $producer->id }}">{{ $producer->name }}</a><br>
        @endforeach</article>
        <article>
            <h3>Screenwriters:</h3>
        @foreach($title->screenwriters as $screenwriter)
            <a href="../people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a><br>
        @endforeach</article>
        <article>
            <h3>Actors:</h3>
        @foreach($title->characters as $character)
            <table>
            @foreach ($character->actor as $actor)
                <tr>
                    <td style="width: 200px"><a href="../people/{{ $actor->id }}">{{ $actor->name }}</a></td>
                    <td style="width: 30px">as</td>
                    <td>{{ $character->character_name }}</td>
                </tr>
            @endforeach
            </table>
        @endforeach</article>
@endsection