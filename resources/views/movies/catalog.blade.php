<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Styles -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
      <link href="{{ asset('css/catalog.css') }}" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
   </head>
   <body>
      @include('layouts.header')
      <!--Img boxes -->
      <!--
         <div class="card" id="catalog-card">
                <div class="fade-container2">
                    <div class ="fade-overlay2"><a class="overlay-a" href="#">
                    <h2 class="overlay-title2">Title här</h2>
                   <p class ="overlay-content2">Testar den här texten</p>
               <figure class="image is-256x256">
                   <img class="catalog-img" src="https://bulma.io/images/placeholders/256x256.png"> 
               
                   </a></div>    
               </div>
               </figure>
             
         </div> -->
      <div class="card-container">
         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard..<p id="catalog-readmore">Read More &#x21e8;</p></li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
            <div class="image-content">
                <p><a href="#"><i class="fa fa-lg fa-star" aria-hidden="true"></i></a> 4.3 | Drama, Mystery, Sci-fi | Add <a href="#"><i class="fa fa-lg fa-bookmark" aria-hidden="true"></i></a> </p>
            </div>
         </div> <!-- Closes image-container -->

         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who's been missing for thirty years.</li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
         </div> <!-- Closes image-container -->
         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who's been missing for thirty years.</li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
         </div> <!-- Closes image-container -->
         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who's been missing for thirty years.</li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
         </div> <!-- Closes image-container -->
         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who's been missing for thirty years.</li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
         </div> <!-- Closes image-container -->
         <div class="image-container">
            <a class="overlay-a" href="#">
               <article class="fade-container" >
                  <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                  <div class="fade-overlay">
                     <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                     <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down former blade runner Rick Deckard, who's been missing for thirty years.</li>
                     </ul>
                  </div> <!-- Closes fade-overlay -->
               </article>
            </a>
         </div> <!-- Closes image-container --> 
      </div> <!-- Closes card-container -->

      <nav class="pagination is-rounded is-centered" role="navigation" aria-label="pagination">
        <a class="pagination-previous">Previous</a>
        <a class="pagination-next">Next page</a>
        <ul class="pagination-list">
            <li><a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a></li>
            <li><a class="pagination-link" aria-label="Goto page 2">2</a></li>
            <li><a class="pagination-link" aria-label="Goto page 3">3</a></li>
            <li><a class="pagination-link" aria-label="Goto page 4">4</a></li>
            <li><span class="pagination-ellipsis">&hellip;</span></li>
            <li><a class="pagination-link" aria-label="Goto page 12">12</a></li>
        </ul>
    </nav>
   </body>
</html>