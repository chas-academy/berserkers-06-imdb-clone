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
    <div class="item-meta-info">
      <h1 id="hero-header">STAR WARS: THE LAST JEDI</h1>
      <ul class="title-genres">
        <li>Action</li>
        <li>Adventure</li>
        <li>Fantasy</li>
      </ul>
      <div class="meta-info-group">
        <div class="seasons-table">
          <table>
            <thead>
              <tr>
                <th span="2">Seasons</th>
                <th span="2">Number of Episodes</th>
                <th span="2">Year</th>  
              </tr>
            </thead>
            <tbody>
              <tr>
                <td span="2"><a>1</a></td>
                <td span="2">20</td>
                <td span="2">1997</td>
              </tr>
              <tr>
                <td span="2"><a>2</a></td>
                <td span="2">21</td>
                <td span="2">1998</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="facts-table">
          <table>     
              <tr>
                <th span="2">Director</th>
                <td span="2"><a>Rian Johnson</a></td>
              </tr>
              <tr>
                <th span="2">Writer</th>
                <td span="2"><a>Rian Johnson</a></td>
              </tr>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>



