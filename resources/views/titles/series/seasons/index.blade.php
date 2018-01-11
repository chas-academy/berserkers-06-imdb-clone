@extends('layouts.app')
@section('content')
    <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <h2>{{ $series->title }}</h2>
    @foreach($seasons as $season)
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}">Season {{ $season->season_number }}</a><br>
    @endforeach
@endsection