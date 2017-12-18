@extends('layouts.app')
@section('content')
    <a href="../../{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <a href="../seasons">Back to all {{ $series->title }} seasons</a><br>
    <h2>{{ $series->title }}</h2>
    <h3>Season {{ $season->season_number }}</h3>
    <a href="{{ $season->season_number }}/episodes">All Episodes</a><br>
    @foreach($episodes as $episode)
        <a href="{{ $season->season_number }}/episodes/{{ $episode->episode_number }}">Episodes {{ $episode->episode_number }}</a><br>
    @endforeach
@endsection