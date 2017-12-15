@extends('layouts.app')
@section('content')
    @foreach($people as $index => $person)
        <span>{{ $person->name }}</span>
        <br>
        <a href="/people/{{ $person->id }}">Bio... -></a>
        <br>
        <br>
    @endforeach
@endsection