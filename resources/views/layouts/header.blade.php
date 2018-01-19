@php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    $routeName = Route::currentRouteName();
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @if (isset($routeName))
    <link href="{{ asset('css/' . $routeName . '.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Berzerker Movies') }}</title>
    
   </head>
   
   <body>
      <header>
         <!-- Burger logo -->
         <div class="is-hidden-desktop">
            <nav class="navbar is-fixed-top" id="mobile-navbar">
               <div class="navbar-brand">
                  <div class="navbar-burger burger" data-target="Options">
                     <span></span>
                     <span></span>
                     <span></span>
                  </div>
                  <!-- Logo -->
                  <a class="navbar-item" id="logo" href="/">
                  <img src="{{asset('images/logo.svg')}}" alt="">
                  </a>
                  <!-- Modal with the user logo-->
                  <a id="usermodal" class="modal-button" href="">
                  <i class="fa fa-lg fa-user-circle" aria-hidden="true"></i>
                  </a>
               </div>
               <!-- Active burger menu-->
               <div class="navbar-menu" id="Options">
                  <div class="navbar-start" id="mobile-start">
                     <a class="nav-item" href="/">Home</a>
                     <a class="nav-item" href="/catalog?type=movie">Movies</a>
                     <a class="nav-item" href="/catalog?type=series">TV Series</a>
                     <a class="nav-item" href="#">Genres</a>
                     <a class="nav-item" href="/catalog?rating=descending">Charts</a>
                  </div>
               </div>
               <!-- Search bar -->
               <form class="panel-block" method="GET" action="/catalog">
                  <p class="control has-icons-left">
                     <input name="title" class="input is-medium" type="text" placeholder="search">
                     <span class="icon is-medium is-left">
                     <i class="fa fa-search"></i>
                     </span>
                  </p>
                </form>
            </nav>
         </div>
         <!-- Modal -->
         <div class="modal">
            <div class="modal-background"></div>
            <div class="modal-content">
               @if (!Auth::check())
               <header class "modal-card-head">
                  <p class="modal-card-title">Log in or Register</p>
               </header>
               <!-- Any other Bulma elements you want -->
               <form method ="POST" action="/login/checkifdeactivated" >
                  {{ csrf_field() }}
                  <div class="field">
                     <p class="control has-icons-left has-icons-right">
                        <input class="input" type="username" placeholder="Username" name="username" value="{{ old('username') }}" required>
                        <span class="icon is-medium is-left">
                          <i class="fa fa-envelope"></i>
                        </span>
                        <span class="icon is-medium is-right">
                        <i class="fa fa-check"></i>
                        </span>
                     </p>
                  </div>
                  <div class="field">
                     <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password" required>
                        <span class="icon is-medium is-left">
                        <i class="fa fa-lock"></i>
                        </span>
                     </p>
                  </div>
                  <div class="field">
                     <p class="control">
                        <button type="submit" class="button is-success">Login</button>
                        <span class="button is-danger">Cancel</span>
                        <a href="/register"><span class="button is-info" id="register" >Register</span></a>
                     </p>
                  </div>
               </form>
               @endif
            </div>
         </div>
         <!-- Desktop -->
         <div class="is-hidden-mobile">
            <nav class="navbar is-fixed" role="navigation" aria-label="main navigation">
               <div class="navbar-menu" id="navbar-desktop">
                  <div class="columns is-multiline">
                     <div class="column is-12" id="col-1"></div>
                     <div class="columns is-multiline">
                        <div class="column is-3" id="col2-1"></div>
                        <a id="item1" href="/catalog?type=movie">
                           Movies 
                           <div class="is-divider" data-content="OR"></div>
                        </a>
                        <a id="genre1" href="/catalog?type=movie">Genres</a> <a id="chart1" href="/catalog?type=movie&rating=descending">Charts</a>
                        <a id="item2" href="/catalog?type=series">
                           Tv Series 
                           <div class="is-divider" data-content="OR"></div>
                        </a>
                        <a id="genre2" href="/catalog?type=series">Genres</a> <a id="chart2" href="/catalog?type=movie&rating=descending">Charts</a>
                        <form class="field has-addons column is-3" method="GET" action="/catalog">
                           <div class="control desktop-search">
                              <input name="title" class="input is-hovered" id="input-search" type="text" placeholder="Search..">
                           </div>
                           <div class="control button-search">
                              <button type="submit" class="button is-info">Search</button>
                           </div>
                        </form>
                        <div class="column is-2" id="col3-1">
                            <!-- Log in / Register button here -->
                           <div class="field is-grouped" id="sign-reg">
                               <form method="POST" action="/login/checkifdeactivated">
                              <button class="button is-primary modal-button">Sign In</button>
                               </form>
                              <a class="button is-primary" type="submit" href="/register" id="border-button">Register</a>
                           </div>
                        </div>
                        <div class="column is-2 is-offset-8" id="col3-2"></div>
                     </div>
                  </div>
               </div>
            </nav>
         </div>
      </header>
      <main>
