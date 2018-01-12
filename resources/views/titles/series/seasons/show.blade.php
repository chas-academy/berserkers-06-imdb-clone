@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons">Back to all {{ $series->title }} seasons</a><br>
    <h2>{{ $series->title }}</h2>
    <h3>Season {{ $season->season_number }}</h3>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes">All Episodes</a><br>
    @foreach($episodes as $episode)
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes/{{ $episode->episode_number }}">Episodes {{ $episode->episode_number }}</a><br>
    @endforeach
@endsection