

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
      <link href="{{asset('css/buttons.css')}}" rel="stylesheet">
   </head>
  </body>
  <div class="buttons has-addons is-centered">
    <div class="container"> 
<div id="user_rating"> 
  <h1>User rating</h2> 
</div> 
<form class="movie_rating" name="movie_form">  
<input type="radio" id="star_5" name="rating" value="5 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_5"> 

<input type="radio" id="star_4" name="rating" value="4 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_4"> 

<input type="radio" id="star_3" name="rating" value="3 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_3"> 

<input type="radio" id="star_2" name="rating" value="2 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_2"> 

<input type="radio" id="star_1" name="rating" value="1 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_1"> 
</form>

<div id="submit_link"></div> 
            <div id="rating_link">
                <button type="button" onclick="movieRate()">Send Rating</button>
            </div>
        </div>
        <div id="review">
            <h2>Thanks for submitting</h2>
            <p id="description"></p>
        </div>  
    </div> 
</body>
</div>
</div>









<script src="{{ asset('js/buttons.js') }}"></script>
</body>
</html>

