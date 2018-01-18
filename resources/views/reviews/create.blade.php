@extends('layouts.app')

@section('content')
    @if($title->movie)
        <h2>Creating review about "{{$title->movie->title}}"</h2>
    @elseif($title->series)
        <h2>Creating review about "{{$title->series->title}}"</h2>
    @endif
    
@endsection