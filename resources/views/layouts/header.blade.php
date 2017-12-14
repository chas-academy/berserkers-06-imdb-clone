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
        <!-- Burger logo -->
         <nav class="navbar">
            <div class="navbar-brand">
               <div class="navbar-burger burger" data-target="Options">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
               <!-- Logo -->
               <a class="navbar-item" id="testing" href="/">
               <img src="{{asset('images/logo.png')}}" alt="">
               </a>
               <!-- Modal with the user logo-->
               <a class="button" id="testing2" >
                  <i class="fa fa-lg fa-user-circle" aria-hidden="true"></i>
                  <div class="modal is-active">
                     <div class="modal-background"></div>
                     <div class="modal-content">
                        <!-- Any other Bulma elements you want -->
                        <div class="field">
                           <p class="control has-icons-left has-icons-right">
                              <input class="input" type="email" placeholder="Email">
                              <span class="icon is-small is-left">
                              <i class="fa fa-envelope"></i>
                              </span>
                              <span class="icon is-small is-right">
                              <i class="fa fa-check"></i>
                              </span>
                           </p>
                        </div>
                        <div class="field">
                           <p class="control has-icons-left">
                              <input class="input" type="password" placeholder="Password">
                              <span class="icon is-small is-left">
                              <i class="fa fa-lock"></i>
                              </span>
                           </p>
                        </div>
                        <div class="field">
                           <p class="control">
                              <button class="button is-success">
                              Login
                              </button>
                              <span class="button is-danger">Cancel</span>
                              <span class="button is-info" id="register">Register</span>
                           </p>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <!-- Active burger menu-->
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
            <!-- Search bar -->
            <div class="panel-block">
               <p class="control has-icons-left">
                  <input class="input is-large" type="text" placeholder="search">
                  <span class="icon is-large is-left">
                  <i class="fa fa-search"></i>
                  </span>
               </p>
            </div>
         </nav>
      </header>
      <main>
      </main>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}"></script>
   </body>
</html>