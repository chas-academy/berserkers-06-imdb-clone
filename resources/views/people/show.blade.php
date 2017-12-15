@extends('layouts.app')
@section('content')
        <a href="../people">Back</a>
        <p>{{ $person->name }}</p>
        <p>Date of birth: {{ date('d F Y', strtotime($person->b_date)) }}</p>
        @if (isset($person->d_date))
            <p>Date of death: {{ date('d F Y', strtotime($person->d_date)) }}</p>
        @endif
        <p>Bio:<br>{{ $person->bio }}</p>
        
@endsection