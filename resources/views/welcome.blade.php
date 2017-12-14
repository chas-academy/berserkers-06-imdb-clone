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
            <div class="container">
                <h1>Top 5 movies this month</h1>
                <article class="card black">
                    <div>
                        <img  class="card-image movie-card-img" src="https://images-na.ssl-images-amazon.com/images/M/MV5BZjk3YThkNDktNjZjMS00MTBiLTllNTAtYzkzMTU0N2QwYjJjXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg">
                    </div>
                    <div class="columns is-mobile card-content">
                        <div class="column mobile-movie-elements">
                            <button class="button">Add/Rate</button>
                        </div> 
                        <div class="column">
                            <h2 class="card-header-title">Movie title</h2>
                            <p>PG-rating | length | genre </p>
                            <p>movie plot<p>
                        </div>
                        <div class="column mobile-movie-elements">
                            <h2>rating</h2>
                        </div>
                    </div>
                </article>
            </div>
            <div>
                <h2> Playlist recomended by site admin/users<h2>
                <article class="card black columns is-mobile">
                    <div class="column mobile-movie-elements">
                        <img class="card-image movie-thumb-img" src="https://images-na.ssl-images-amazon.com/images/M/MV5BMTkxMTA5OTAzMl5BMl5BanBnXkFtZTgwNjA5MDc3NjE@._V1_UX182_CR0,0,182,268_AL_.jpg">
                    </div>
                    <div class="card-content column mobile-movie-elements" >
                        <h3>Playlist title</h3>
                        <i>Created by<i>
                        <p>Genre<p>
                        <p>Avrage rating<p>
                        <p>Description<p>
                    </div>
                </article>
            </div>
        </main>
    </body>
</html>
