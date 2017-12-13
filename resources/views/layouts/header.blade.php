<?php
   // @extends('layouts.app')
?>    
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{asset('css/header.css')}}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="navbar-brand">
            <!--<a class="navbar-item" href="/">
            <img src="" alt="">
            </a>-->
            <div class="navbar-burger burger" data-target="Options">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <a class="navbar-item" id="testing" href="/">
            <img src="{{asset('images/logo.png')}}" alt="">
            </a>
            <a class="navbar-item" id="testing2" href="">
            <i class="fa fa-2x fa-user-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="navbar-menu" id="Options">
            <div class="navbar-start">
                <a class="nav-item" href="#">Home</a>
                <a class="nav-item" href="#">Movies</a>
                <a class="nav-item" href="#">TV</a>
                <a class="nav-item" href="#">Top 100</a>
                <a class="nav-item" href="#">Genre</a>
                <a class="nav-item" href="#">Log In</a>
            </div>
        </div>
    </nav>
</header>
<main>

</main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
