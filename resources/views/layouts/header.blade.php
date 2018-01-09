@php 

    use Illuminate\Support\Facades\Route;

    $routeName = Route::currentRouteName();
    
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
    @if (!isset($routeName)) 
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @elseif ($routeName === "register" && isset($routeName))
    <link href="{{ asset('css/' . $routeName . '.css') }}" rel="stylesheet">
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
  
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
                  <img src="{{asset('images/LOGO.svg')}}" alt="">
                  </a>
                  <!-- Modal with the user logo-->
                  <a id="usermodal" href="">
                  <i class="fa fa-lg fa-user-circle" aria-hidden="true"></i>
                  </a>
                  <div class="modal">
                     <div class="modal-background"></div>
                     <div class="modal-content">
                        <header class "modal-card-head">
                           <p class="modal-card-title">Log in or Register</p>
                        </header>
                        <!-- Any other Bulma elements you want -->
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <input class="input" type="email" placeholder="Email">
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
                              <input class="input" type="password" placeholder="Password">
                              <span class="icon is-medium is-left">
                              <i class="fa fa-lock"></i>
                              </span>
                           </p>
                        </div>
                        <div class="field">
                           <p class="control">
                              <button class="button is-success">Login</button>
                              <span class="button is-danger">Cancel</span>
                              <span class="button is-info" id="register">Register</span>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Active burger menu-->
               <div class="navbar-menu" id="Options">
                  <div class="navbar-start" id="mobile-start">
                     <a class="nav-item" href="#">Home</a>
                     <a class="nav-item" href="#">Movies</a>
                     <a class="nav-item" href="#">TV Series</a>
                     <a class="nav-item" href="#">Genres</a>
                     <a class="nav-item" href="#">Charts</a>
                  </div>
               </div>
               <!-- Search bar -->
               <div class="panel-block">
                  <p class="control has-icons-left">
                     <input class="input is-medium" type="text" placeholder="search">
                     <span class="icon is-medium is-left">
                     <i class="fa fa-search"></i>
                     </span>
                  </p>
               </div>
            </nav>
         </div>
         <!-- Desktop -->
         <div class="is-hidden-mobile">
            <nav class="navbar is-fixed" role="navigation" aria-label="main navigation">
               <div class="navbar-menu" id="navbar-desktop">
                  <div class="columns is-multiline">
                     <div class="column is-12" id="col-1"></div>
                     <div class="columns is-multiline">
                        <div class="column is-3" id="col2-1"></div>
                        <a id="item1" href="#">
                           Movies 
                           <div class="is-divider" data-content="OR"></div>
                        </a>
                        <a id="genre1" href="#">Genres</a> <a id="chart1" href="#">Charts</a>
                        <a id="item2" href="#">
                           Tv Series 
                           <div class="is-divider" data-content="OR"></div>
                        </a>
                        <a id="genre2" href="#">Genres</a> <a id="chart2" href="#">Charts</a>
                        <div class="field has-addons column is-3">
                           <div class="control desktop-search">
                              <input class="input is-hovered" id="input-search" type="text" placeholder="Search..">
                           </div>
                           <div class="control button-search">
                              <a class="button is-info">Search</a>
                           </div>
                        </div>
                        <div class="column is-2" id="col3-1"></div>
                        <div class="column is-2 is-offset-8" id="col3-2">
                           <!-- Log in / Register button here -->
                           <div class="field is-grouped" id="sign-reg">
                              <a class="button is-primary" id="border-button">Sign In</a>
                              <a class="button is-primary" type="submit" href="/register">Register</a>
                              <div class="modal modal2">
                                 <div class="modal-background"></div>
                                 <div class="modal-content">
                                    <header class "modal-card-head">
                                       <p class="modal-card-title">Log in or Register</p>
                                    </header>
                                    <div class="field">
                                       <p class="control has-icons-left has-icons-right">
                                          <input class="input" type="email" placeholder="Email">
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
                                          <input class="input" type="password" placeholder="Password">
                                          <span class="icon is-medium is-left">
                                          <i class="fa fa-lock"></i>
                                          </span>
                                       </p>
                                    </div>
                                    <div class="field">
                                       <p class="control">
                                          <button class="button is-success">Login</button>
                                          <span class="button is-danger" id="desktop-cancel">Cancel</span>
                                          <a class="button is-info" id="register" type="submit" href="/register">Register</a>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>
                <a class="navbar-item" id="desktop-logo" href="/">
                    <img src="{{asset('images/LOGO.svg')}}" id="bzrk2" alt="">
                </a>
        </div>
        </nav>
        </div>
    </header>
    <main>

