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
      <link href="{{asset('css/item_chart.css')}}" rel="stylesheet">
   </head>
   <body>
   <main>
    <section>
      <ul class="flex-container">
        <article>
          <div class="card-content column mobile-movie-elements">
            <li class="flex-item5"><h2>Charts</h2>
            <h3>Trending Now</h3></li>
          </div>
        </article>
      </ul>
      <div class="chart">
        <div class="min-item">
          <div  class="item-img">
            <img src="https://image.tmdb.org/t/p/w154/iO9aZzrfmMvm3IqkFiQyuuUMLh2.jpg">
          </div>
          <div class="card">
            <div>
              <div>
                <h4>Office Space</h4>
                <h4>10.0</h4>
              </div>
              <div style="visibility: hidden">
                <h4 class="light">Season 1</h4>
              </div>
            </div>
            <div>
              <div>
                <h4>(1999)</h4>
              </div>
              <div>
                <ul>
                  <li>Comedy</li>
                <ul>
              </div>
            </div>
          </div>
        </div>
        <div class="min-item">
          <div  class="item-img">
            <img src="https://image.tmdb.org/t/p/w154/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg">
          </div>
          <div class="card">
            <div>
              <div>
                <h4>Inception</h4>
                <h4>10.0</h4>
              </div>
              <div style="visibility: hidden">
                <h4 class="light">Season 1</h4>
              </div>
            </div>
            <div>
              <div>
                <h4>(1999)</h4>
              </div>
              <ul>
                <li>Action</li>
                <li>Adventure</li>
                <li>Sci-Fi</li>
              <ul>
            </div>
          </div>
        </div>
        <div class="min-item">
          <div  class="item-img">
            <img src="https://image.tmdb.org/t/p/w154/adw6Lq9FiC9zjYEpOqfq03ituwp.jpg">
          </div>
          <div class="card">
            <div>
              <div>
                <h4>Fight Club</h4>
                <h4>10.0</h4>
              </div>
              <div style="visibility: hidden">
                <h4 class="light">Season 1</h4>
              </div>
            </div>
            <div>
              <div>
                <h4>(2010)</h4>
              </div>
              <ul>
                <li>Drama</li>
              <ul>
            </div>
          </div>
        </div>
        <div class="min-item">
          <div  class="item-img">
            <img src="https://image.tmdb.org/t/p/w154/6W6zWBAay6XVBgJsOu6c2mlFZ8l.jpg">
          </div>
          <div class="card">
            <div>
              <div>
                <h4>Twin Peaks</h4>
                <h4>10.0</h4>
              </div>
              <div>
                <h4 class="light">Season 3</h4>
              </div>
            </div>
            <div>
              <div>
                <h4>(2017)</h4>
              </div>
              <ul>
                <li>Crime</li>
                <li>Drama</li>
                <li>Mystery</li>
              <ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  </body>
</html>

	https://image.tmdb.org/t/p/w154/6W6zWBAay6XVBgJsOu6c2mlFZ8l.jpg