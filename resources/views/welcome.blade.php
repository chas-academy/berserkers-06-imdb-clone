<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel {{ app()->version() }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
      <body>
        <main>
            <div>
                <div class="container">
                    <div class="notification">
                        <figure class="image is-4by3">
                            <img src="http://www.martincuff.com/wp-content/uploads/2016/06/Penny-Dreadful.jpg">
                        </figure>
                    </div> 
                </div>
            </div>
            <div>
                <h2>Community</h2>
                
                <article>
                    <div class="card-content column mobile-movie-elements" >
                        <h3>Daily Pics</h3>
                        <h4>Community</h4>
                       <p>Admins daily selection of reviews and charts <br>- written by our users</p>
                    </div>
                </article>
                <article>
                        <div>
                            <button class="button level-item">Add</button>
                        </div>
                        <div>
                            <p>Movie title<p>
                            <p>PG-rating | length | genre </p>
                            <p>movie plot<p>
                        </div>
                    </article>
                <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
                <ul>
                    <li><a href="#">Movies</a></li>
                    <li><a href="#">Series</a></li>
                    <li><a href="#">Upcoming Movies</a></li>
                    <li><a href="#">Recommended Movies</a></li>
                </ul>
            </nav>
            </div>
            </div>
        </main>
    </body>
</html>
