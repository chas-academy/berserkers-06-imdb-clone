

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
    <div class="rating"> 

<span class="heading">User Rating</span>

<p>based on user rates.</p>
<hr style="border:3px solid #f1f1f1">
  <button class="star1"><i class="fa fa-star"></i></button>
  <button class="star2"><i class="fa fa-star"></i></button> 
  <button class="star3"><i class="fa fa-star"></i></button>
  <button class="star4"><i class="fa fa-star"></i></button>
  <button class="star5"><i class="fa fa-star"></i></button>

</div>
</div>









<script src="{{ asset('js/buttons.js') }}"></script>
</body>
</html>

