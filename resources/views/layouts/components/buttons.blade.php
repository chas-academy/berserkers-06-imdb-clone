

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
  <!--User can rate star of movies-->
<div class="container">

<div class="box has-text-centered">
  <div class="rating"> 
  <span class="fa fa-star icon is-medium"></span>
  <span class="fa fa-star icon is-medium"></span>
  <span class="fa fa-star icon is-medium"></span>
  <span class="fa fa-star icon is-medium"></span>
  <span class="fa fa-star icon is-medium"></span>
</div>
</div> 




</body>
</html>

