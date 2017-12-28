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
       <link href="{{asset('css/daily_picks.css')}}" rel="stylesheet">
    </head>
    <body>
      <main>
        <article>
          <section class="flex-container">
            <section>
              <img src="{{asset('images/logo.svg')}}">
              <div>
                <h2>Daily Pics</h2>
                <h3>Community</h4>
              </div>
            </section>
            <section>
              <p>Admins daily selection of reviews and charts <br> - written by our users</p>
            </section>
          </section>
          <section class="daily-pics">
            <article class="point">
              <div>
                <h2>Point Of View</h2>
              </div>
              <section>
                <div>
                  <h2>Star Wars: The Last Jedi</h2>
                  <h3>Reviewed by: <span>m0vi3BZrkR42</span></h3>
                </div>
                <div>
                  <h1>Does non spoiler reviews exist?</h1>
                  <p>It’s here. Spoiler season. First out we have the eigth episode in  the so called star wars saga. 
                    First thing first: if I want your opt your opt your opt yout
                  </p>
                </div>
                <div class="item-img card">
                  <img>
                </div>
              </section>
            </article>
            <article class="ranked">
              <div>
                <h2>Ranked by member</h2>
              </div>
              <section>
              </section>
            </article>
          </section>
        </article>
      <main>
    <body>