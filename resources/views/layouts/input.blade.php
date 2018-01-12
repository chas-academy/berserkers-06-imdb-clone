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
      <link href="{{asset('css/input.css')}}" rel="stylesheet">
   </head>
  </body>
  <div class="field">
  <div class="control">
    <input class="input is-small" type="text" placeholder="Small input">
  </div>
<!--input field-->
<div class="control">
    <textarea class="textarea" type="text" placeholder="Normal textarea"></textarea>
  </div>
</div>
<div class="control">
    <button type="submit" class="button is-primary">Submit</button>
  </div>
</div>
  </body>
</html>