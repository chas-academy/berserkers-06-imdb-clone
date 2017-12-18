@extends('layouts.app')
@section('content')
    <a href="../../../../{{ $series->title_id }}">Back to {{ $series->title }}</a><br>
    <a href="../../../seasons">Back to all {{ $series->title }} seasons</a><br>
    <a href="../../{{ $season->season_number }}">Back to Season {{ $season->season_number }}</a><br>
    <a href="../episodes">Back to all {{ $series->title }} episodes</a><br>
    <h2>{{ $series->title }}</h2>
    <h3>Season {{ $season->season_number }}</h3>
    <h3>Episode {{ $episode->episode_number }}</h3>
@endsection