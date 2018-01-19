

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
    <div class="rating_star">
<span id="star_5" value="5 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_5"> </span>

<span id="star_4"  value="4 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_4"> </span>

<span id="star_3" value="3 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_3"> </span>

<span id="star_2"  value="2 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_2"> </span>

<span id="star_1" value="1 star of 5"/><i class="fa fa-star-o" aria-hidden="true"></i><label for ="star_1"> </span>
</form>

</body>
</div>
</div>









<script src="{{ asset('js/buttons.js') }}"></script>
</body>
</html>

