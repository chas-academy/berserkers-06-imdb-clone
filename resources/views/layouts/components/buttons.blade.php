

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
<div class="movie-rating">
  <div class="movie-rating_wrapper"> 
    <input class="star-rating_input" id="movie-rating" type="radio" name="rating" value="5">
    <label class="star-rating__ico fa fa-star-o falg" for="star-rating-5" title="5 of 5 stars"> 
    <input class="star-rating_input" id="movie-rating" type="radio" name="rating" value="4">
    <label class="star-rating__ico fa fa-star-o falg" for="star-rating-4" title="4 of 5 stars"> 
    <input class="star-rating_input" id="movie-rating" type="radio" name="rating" value="3">
    <label class="star-rating__ico fa fa-star-o falg" for="star-rating-3" title="3 of 5 stars"> 
    <input class="star-rating_input" id="movie-rating" type="radio" name="rating" value="5">
    <label class="star-rating__ico fa fa-star-o falg" for="star-rating-2" title="2 of 5 stars"> 
    <input class="star-rating_input" id="movie-rating" type="radio" name="rating" value="5">
    <label class="star-rating__ico fa fa-star-o falg" for="star-rating-1" title="1 of 5 stars"> 

</label>




<button class="button">Submit</button>
</body>
</html>

