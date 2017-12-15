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
  <h1>Top 5 movies this month</h1>
  <figure class="image is-3by2">
  <img src="https://a.ltrbxd.com/resized/sm/upload/z6/e0/vw/uy/pulp-fiction-65-1200-1200-675-675-crop-000000.jpg?k=0e0befe63c">
</figure>
  </div>
  <article>
           <div>
           <button class="button level-item">Add</button>
         </div>
                        <div>
                            <h2>Movie title</h2>
                            <p>PG-rating | length | genre </p>
                            <p>movie plot<p>
                        </div>
                        <div class="column mobile-movie-elements">
                            <h2>rating</h2>
                        </div>
                    </div>
                </article>
            </div>
            <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
         <ul>
            <li><a href="#">Movies</a></li>
            <li><a href="#">Series</a></li>
            <li><a href="#">Upcoming Movies</a></li>
            <li><a href="#">Recommended Movies</a></li>
            <li class="is-active"><a href="#" aria-current="page">Berzerkers</a></li>
      </ul>
   </nav>
            <div>
                <h2> Playlist recommended by site admin/users<h2>
                <article>
                    <div>
                        <img src="">
                        <button><button>
                    </div>
                    <div class="card-content column mobile-movie-elements" >
                        <h3>Playlist title</h3>
                        <i>Created by<i>
                        <p>Genre<p>
                        <p>Average rating<p>
                        <p>Description<p>
                    </div>
                </article>
            </div>
            </div>
        </main>
    </body>
</html>
