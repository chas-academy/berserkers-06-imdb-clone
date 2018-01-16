@extends('layouts.app')

@section('content')
    @if($title->movie)
        <h2>Creating review about "{{$title->movie->title}}"</h2>
    @elseif($title->series)
        <h2>Creating review about "{{$title->series->title}}"</h2>
    @endif
    <form method="post" action="{{ route('reviews.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="title_id" value="{{ $title->id }}">

        <input type="text" name="title" placeholder="Your heading"><br>
        <textarea name="body" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="CREATE">
    </form>
@endsection