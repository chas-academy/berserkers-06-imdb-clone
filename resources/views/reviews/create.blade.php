@extends('layouts.app')

@section('content')
    <h2>Creating review about "{{$title->title}}"</h2>
    <h1>ID: {{$title->title_id}} (test)</h1>
    <form method="post" action="{{ route('reviews.store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <input type="text" placeholder="Your heading"><br>
        <textarea name="" id="" cols="30" rows="10"></textarea>
    </form>
@endsection