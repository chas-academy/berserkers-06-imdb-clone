@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <h2>{{ $series->title }}</h2>
    <h3>Season {{ $season->season_number }}</h3>
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes">All Episodes</a><br>
    @foreach($episodes as $episode)
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes/{{ $episode->episode_number }}">Episodes {{ $episode->episode_number }}</a><br>
        <form method="POST" action="/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes/{{$episode->episode_number}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input name="title_id" value="{{$episode->title_id}}" type="hidden">
            <button type="submit">Delete</button>
        </form>
        <form method="GET" action="/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}/episodes/{{$episode->episode_number}}/edit">
            {{ csrf_field() }}
            <input name="title_id" value="{{$episode->title_id}}" type="hidden">
            <button type="submit">Edit</button>
        </form>
    @endforeach
@endsection