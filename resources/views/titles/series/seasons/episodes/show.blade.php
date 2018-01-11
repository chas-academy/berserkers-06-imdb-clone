@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons">Back to all {{ $series->title }} seasons</a><br>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}">Back to Season {{ $season->season_number }}</a><br>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes">Back to all {{ $series->title }} episodes</a><br>
    <h2>{{ $series->title }}</h2>
    <h3>Season {{ $season->season_number }}</h3>
    <h3>Episode {{ $episode->episode_number }}</h3>
@endsection