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
    <div class="page-content">
      <div class="item-header">
        <h1 id="hero-header">STAR WARS: THE LAST JEDI</h1>
      </div>
      <div class="item">
        <div class="item-meta-info">
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
            <div class="row-flex-start">
              <h3>Short</h3><h2>Facts</h2>
            </div>
            <div class="facts-table">
              <table>     
                <tr class="row-padding-botom">
                  <th span="2">Director</th>
                  <td span="2"><a>Rian Johnson</a></td>
                </tr>
                <tr class="row-padding-botom">
                  <th span="2">Writer</th>
                  <td span="2"><a>Rian Johnson</a></td>
                </tr>
                <tr>
                  <th span="2">Lead Cast</th>
                  <td span="2"><a>Daisy Ridley</a></td>
                </tr>
                  <tr class="table-flex-end">
                    <td span="2"><a>Adam Driver</a></td>
                  </tr>
                  <tr class="table-flex-end">
                    <td span="2"><a>Mark Hamill</a></td>
                  </tr>
                  <tr class="table-flex-end row-padding-botom">
                    <td span="2"><a>John Boyega</a></td>
                  </tr>
                  <tr class="table-flex-end alt-color">
                    <td span="2"><a>VIEW FULL CAST</a></td>
                  </tr>
              </table>
              <div class="plot-sumary">
                <h3>PLOT SUMMARY</h3>
                <div class="card">
                  <p>It’s here. Spoiler season. 
                  First out we have the eigth episode in the so called star wars saga. 
                  First thing first: if I want your opinion - I’ll ask for it</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="item-img card">
          <img src="https://image.tmdb.org/t/p/w1280/9In3XGQSdr2yfgUoEdCpqxEGAOO.jpg">
        </div>
      </div>
    </div>
  </body>
</html>



