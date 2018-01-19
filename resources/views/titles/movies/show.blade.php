@include('layouts.header')
<article class="page-content">
   <div class="centered-content">
      <section class="item-header">
         <h1 class="hero-header">{{$movie->title}}</h1>
         <p>Add icons here for review title, add to WL and rating</p>
      </section>
      <article class="item">
         <section class="item-meta-info">
            <ul class="title-genres">
               @for($i = 0; $i < 3; $i++)
               @if (isset($title->genres[$i]))
               <li>{{ $title->genres[$i]->name }}</li>
               @endif
               @endfor
            </ul>
            <div class="meta-info-group">
               <section class="row-flex-start">
                  <h2><span>short</span><span>Facts</span></h2>
               </section>
               <section class="facts-table">
                  <table>
                     @foreach($title->directors as $key => $director)
                     @if ($key === 0 && $key === count($title->directors)-1)
                     <tr class="row-padding-botom">
                        <th span="2">Director</th>
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a>
                        </td>
                     </tr>
                     @elseif ($key === 0)
                     <tr>
                        <th span="2">Directors</th>
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a>
                        </td>
                     </tr>
                     @elseif ($key === count($title->directors)-1)
                     <tr class="table-flex-end row-padding-botom">
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a>
                        </td>
                     </tr>
                     @else
                     <tr class="table-flex-end">
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a>
                        </td>
                     </tr>
                     @endif
                     @endforeach
                     @for($i = 0; $i < 2; $i++)
                     @if(isset($title->producers[$i]))
                     @if($i === 0 && isset($title->producers[$i+1]))
                     <tr>
                        <th span="2">Producers</th>
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a>
                        </td>
                     </tr>
                     @elseif ($i === 0 && !isset($title->producers[$i+1]))
                     <tr class="row-padding-botom">
                        <th span="2">Producer</th>
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a>
                        </td>
                     </tr>
                     @else
                     <tr class="table-flex-end row-padding-botom">
                        <td class="link"span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a>
                        </td>
                     </tr>
                     @endif
                     @endif
                     @endfor
                     @foreach($title->screenwriters as $key => $screenwriter)
                     @if ($key === 0 && $key === count($title->screenwriters)-1)
                     <tr class="row-padding-botom">
                        <th span="2">Writer</th>
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a>
                        </td>
                     </tr>
                     @elseif ($key === 0)
                     <tr>
                        <th span="2">Writers</th>
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a>
                        </td>
                     </tr>
                     @elseif ($key === count($title->screenwriters)-1)
                     <tr class="table-flex-end row-padding-botom">
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a>
                        </td>
                     </tr>
                     @else
                     <tr class="table-flex-end">
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a>
                        </td>
                     </tr>
                     @endif
                     @endforeach
                     @for($i = 0; $i < 5; $i++)
                     @if(isset($title->actors[$i]))
                     @if($i === 0)
                     <tr>
                        <th span="2">Cast</th>
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a>
                        </td>
                     </tr>
                     @elseif ($i === 4 || !isset($title->actors[$i+1]))
                     <tr class="table-flex-end row-padding-botom">
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a>
                        </td>
                     </tr>
                     <tr class="table-flex-end alt-color">
                        <td class="link" span="2"><a>VIEW FULL CAST</a></td>
                     </tr>
                     @else 
                     <tr class="table-flex-end">
                        <td class="link" span="2">
                           <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a>
                        </td>
                     </tr>
                     @endif
                     @endif
                     @endfor
                  </table>
                  <section class="plot-sumary">
                     <h3>PLOT SUMMARY</h3>
                     <div class="card">
                        <p>{{ $movie->plot_summary }}</p>
                     </div>
                  </section>
               </section>
            </div>
         </section>
         <section class="item-img card">
            <figure class="card-image is-16by9">
               <a class="fa fa-3x fa-youtube-play modal-button2"></a>
               <div class="video-container">
                  <iframe id="video" src="{{$movie->trailer}}" frameborder="1" allow="autoplay; encrypted-media" allowfullscreen></iframe>
               </div>
               @foreach($title->photos as $photo)
               @if($photo->width == 780 && $photo->photo_type == "backdrop")
               <img id="title-img" src="{{ $photo->photo_path }}" alt="poster">
               @break
               @endif
               @if($loop->last)
               <img id="title-img" src="{{ $photo->photo_path }}" alt="poster">
               @endif
               @endforeach
            </figure>
         </section>
      </article>
      <p>Rating: 
         <?php
            $ratingSummary = 0;
            $i = 0;
            foreach ($title->ratings as $rating) {
                $ratingSummary = $ratingSummary + $rating->rating;
                $i++;
            }
            if ($i == 0) {
                echo "-";
            } else {
                $ratingSummary = $ratingSummary / $i;
                echo $ratingSummary;
            }
            ?>
      </p>
      @if(Auth::check())
      <a href="http://{{ $_SERVER['HTTP_HOST'] }}/reviews/create">Create a review</a>
      @endif
   </div>
</article>

<!-- Carousel-->

<div id="hz-carousel">
   @foreach($title->photos as $photo)
   @if($photo->width == 300)
   <div class="slide">
      <img src="{{ $photo->photo_path }}" alt="poster">
   </div>
   @endif
   @endforeach
</div>

<!-- Reviews and Comments -->

<div class="review-container">
   <div class="h1-button">
      <h1 class="review-header">Reviews & Comments</h1>
      <a class="button is-primary" id="review-button" href="#anchor-review">Review this title</a>
   </div>
   <div class="review-content">
      <div class="title-container">
         <h2 class="review-title">I really disliked this movie</h2>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
      </div>
      <div class="user-container">
         <p class="review-date">15/01-2017 &nbsp;</p>
         <p class="review-user">|&nbsp;&nbsp;by user: Dukogso</p>
      </div>
      <p class="review-text">Tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok. Lorem ipsum har inte bara överlevt fem århundraden, utan även övergången till elektronisk typografi utan större förändringar. Det blev allmänt känt på 1960-talet i samband med lanseringen av Letraset-ark med avsnitt av Lorem Ipsum, och senare med mjukvaror som Aldus PageMaker.</p>
      <!-- Comment form and buttons -->
      <button class="button is-primary comment-button" value="Button One">Comment this review</button>
      <div class="create-comment">
         <div class="field">
            <div class="control">
               <input class="input" type="text" placeholder="Title">
            </div>
         </div>
         <div class="field">
            <div class="control">
               <textarea class="textarea is-primary" type="text" placeholder="Comment"></textarea>
            </div>
         </div>
         <div class="field is-grouped">
            <p class="control">
               <button class="button is-primary" id="submit-comment">
               Submit
               </button>
            </p>
            <p class="control">
               <button class="button is-light" id="cancel-comment">
               Cancel
               </button>
            </p>
         </div>
      </div>
      <div class="user-comment">
         <h2 class="comment-title">What's your problem dude?</h2>
         <p class="review-date">15/01-2017 &nbsp;</p>
         <p class="review-user">|&nbsp;&nbsp;by user: FilmCritic</p>
         <p class="comment-content">Det är ett välkänt faktum att läsare distraheras av läsbar text på en sida när man skall studera layouten. Poängen med Lorem Ipsum är att det ger ett normalt ordflöde, till skillnad från "Text här, Text här".</p>
      </div>
   </div>
   <!-- review 2 -->
   <div class="review-content">
      <div class="title-container">
         <h2 class="review-title">Best movie ever!!!</h2>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
         <i class="fa fa-2x fa-star" aria-hidden="true"></i>
      </div>
      <div class="user-container">
         <p class="review-date">16/01-2017 &nbsp;</p>
         <p class="review-user">|&nbsp;&nbsp;by user: ILikeCartoons</p>
      </div>
      <p class="review-text">Tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok. Lorem ipsum har inte bara överlevt fem århundraden, utan även övergången till elektronisk typografi utan större förändringar. Det blev allmänt känt på 1960-talet i samband med lanseringen av Letraset-ark med avsnitt av Lorem Ipsum, och senare med mjukvaror som Aldus PageMaker.</p>
      <button class="button is-primary comment-button" value="Button Two">Comment this review</button>
      <div class="create-comment">
         <div class="field">
            <div class="control">
               <input class="input" type="text" placeholder="Title">
            </div>
         </div>
         <div class="field">
            <div class="control">
               <textarea class="textarea is-primary" type="text" placeholder="Comment"></textarea>
            </div>
         </div>
         <div class="field is-grouped">
            <p class="control">
               <a class="button is-primary" id="submit-comment">
               Submit
               </a>
            </p>
            <p class="control">
               <a class="button is-light" id="cancel-comment">
               Cancel
               </a>
            </p>
         </div>
      </div>
      <div class="user-comment">
         <h2 class="comment-title">3/5 at best dude..</h2>
         <p class="review-date">17/01-2017 &nbsp;</p>
         <p class="review-user">|&nbsp;&nbsp;by user: FilmWatcher7</p>
         <p class="comment-content">Det är ett välkänt faktum att läsare distraheras av läsbar text på en sida när man skall studera layouten. Poängen med Lorem Ipsum är att det ger ett normalt ordflöde, till skillnad från "Text här, Text här".</p>
      </div>
   </div>

   <!-- Review Form -->
   <div class="make-review" id="anchor-review">
      <div class="field">
         <label class="label">Title</label>
         <div class="control" id="rating-container">
            <input class="input" type="text" placeholder="Title">
            <div class="select">
               <select>
                  <option>Rate this movie</option>
                  <option>1 Star</option>
                  <option>2 Stars</option>
                  <option>3 Stars</option>
                  <option>4 Stars</option>
                  <option>5 Stars</option>
               </select>
            </div>
         </div>
      </div>
      <div class="field">
         <label class="label">Review</label>
         <div class="control">
            <textarea class="textarea is-primary" type="text" placeholder="Comment"></textarea>
         </div>
      </div>
      <div class="field is-grouped">
         <p class="control">
            <a class="button is-primary" id="submit-review">
            Submit review
            </a>
         </p>
         <p class="control">
            <a class="button is-light" id="cancel-review">
            Cancel
            </a>
         </p>
      </div>
   </div>
</div>
</div>
@include('layouts.footer')