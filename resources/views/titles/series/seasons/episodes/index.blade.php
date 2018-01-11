@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons">Back to all Season</a><br>
    <a href="../{{ $season->season_number }}">Back to Season {{ $season->season_number }}</a><br>
    <h2>{{ $series->title }}</h2>
    <h2>Season {{ $season->season_number }}</h2>
    @foreach($episodes as $episode)
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes/{{ $episode->episode_number }}">Episode {{ $episode->episode_number }}</a><br>
    @endforeach
@endsection