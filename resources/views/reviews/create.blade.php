@extends('layouts.app')

@section('content')
    @if($title->movie)
    <h2>Creating review about "{{$title->movie->title}}"</h2>
    @elseif($title->series)
    <h2>Creating review about "{{$title->series->title}}"</h2>
    @else
        @php
            header('location: /');
        @endphp
        if not a serie or movie - redirect back somehow pls be done
    @endif
    <form method="post" action="{{ route('reviews.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <input type="text" placeholder="Your heading"><br>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </form>
@endsection