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
      <link href="{{asset('css/item_meta_info.css')}}" rel="stylesheet">
   </head>
  </body>
    <div>
      <h1>STAR WARS: THE LAST JEDI</h1>
      <ul>
        <li>Action</li>
        <li>Adveture</li>
        <li>Fantasy</li>
      <ul>
    </div>
  </body>
</html>



