
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
<div class="star-rating">
<div class="star-rating__wrap">
  <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
  <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
  <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
  <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
  <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
  <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
  <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
  <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
  <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
  <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
</div>
</div>





</body>
</html>