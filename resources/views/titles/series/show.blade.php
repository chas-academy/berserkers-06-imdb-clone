@include('layouts.header')
<article class="page-content">
    <div class="centered-content">
        <section class="item-header">
        @auth
            @if(Auth::User()->role == 1)
            <form  method="POST" action="/titles/series/{{$series->title_id}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="button is-danger"type="submit">Delete Series</button>
            </form>
            <form  method="GET" action="/titles/series/{{$series->title_id}}/edit">
                {{ csrf_field() }}
                <button class="button is-primary"type="submit">Edit Series</button>
            </form>
            @endif
        @endauth
            <h1 class="hero-header">{{$series->title}}</h1>
        </section>
        <article class="item">
            <section class="item-meta-info">
                <ul class="title-genres">
                    @for($i = 0; $i < 2; $i++)
                        @if (isset($title->genres[$i]))
                            <li>{{ $title->genres[$i]->name }}</li>
                        @endif
                    @endfor
                </ul>
                <div class="meta-info-group">
                    <section class="seasons-table">
                        <table>
                            <thead>
                            <tr>
                                <th span="2">Seasons</th>
                                <th span="2">Number of Episodes</th>
                                <th span="2">Year</th>  
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($seasons as $season)
                            <tr>
                                <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}">{{$season->season_number}}</a></td>
                                @if(count($season->episodes) != 0) 
                                    <td span="2">{{ count($season->episodes) }}</td>
                                    <td span="2">{{ substr($season->episodes[0]['air_date'], 0,4) }}</td>
                                @else
                                    <td span="2">??</td>
                                    <td span="2">????</td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </section>
                    <section class="row-flex-start">
                        <h2><span>short</span><span>Facts</span></h2>
                    </section>
                    <section class="facts-table">
                        <table>
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($title->creators[$i]))
                                    @if ($i === 0 && $i === count($title->creators)-1)
                                        <tr class="row-padding-botom">
                                            <th span="2">Creator</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->creators[$i]->id }}">{{ $title->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0)
                                        <tr>
                                            <th span="2">Creators</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->creators[$i]->id }}">{{ $title->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2  || !isset($title->creators[$i+1]))
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->creators[$i]->id }}">{{ $title->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif (isset($title->creators[$i]))
                                        <tr class="table-flex-end">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->creators[$i]->id }}">{{ $title->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor    
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($directors[$i]))
                                    @if ($i === 0 && !isset($directors[$i+1]))
                                        <tr class="row-padding-botom">
                                            <th span="2">Director</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $directors[$i]['id'] }}">{{ $directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0 && isset($directors[$i+1]))
                                        <tr>
                                            <th span="2">Directors</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $directors[$i]['id'] }}">{{ $directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2)
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $directors[$i]['id'] }}">{{ $directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $directors[$i]['id'] }}">{{ $directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 2; $i++)
                                @if(isset($producers[$i]))
                                    @if($i === 0 && isset($producers[$i+1]))
                                        <tr>
                                            <th span="2">Producers</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $producers[$i]['id'] }}">{{ $producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0 && !isset($producers[$i+1]))
                                        <tr class="row-padding-botom">
                                            <th span="2">Producer</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $producers[$i]['id'] }}">{{ $producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $producers[$i]['id'] }}">{{ $producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($screenwriters[$i]))
                                    @if ($i === 0 && $i === count($screenwriters)-1)
                                        <tr class="row-padding-botom">
                                            <th span="2">Writer</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriters[$i]['id'] }}">{{ $screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0)
                                        <tr>
                                            <th span="2">Writers</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriters[$i]['id'] }}">{{ $screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2)
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriters[$i]['id'] }}">{{ $screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriters[$i]['id'] }}">{{ $screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 5; $i++)
                                @if(isset($actors[$i]))
                                    @if($i === 0)
                                        <tr>
                                            <th span="2">Cast</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $actors[$i]['id'] }}">{{ $actors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 4 || !isset($actors[$i+1]))
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $actors[$i]['id'] }}">{{ $actors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                        <tr class="table-flex-end alt-color">
                                            <td class="link" span="2"><a>VIEW FULL CAST</a></td>
                                        </tr>
                                    @else 
                                        <tr class="table-flex-end">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $actors[$i]['id'] }}">{{ $actors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                        </table>
                        <section class="plot-sumary">
                            <h3>PLOT SUMMARY</h3>
                            <div class="card">
                                <p>{{ $series->plot_summary }}</p>
                            </div>
                        </section>
                    </section>
                </div>
            </section>
            <section class="item-img card">
                <figure class="card-image is-16by9">
                <a class="fa fa-3x fa-youtube-play modal-button2"></a>
                <div class="video-container">
                    <iframe id="video" src="{{$series->trailer}}" frameborder="1" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
            @php
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
            @endphp
        </p>
    </div>
</article>
</p>
{{--  <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons">All Seasons</a><br>  --}}
<div id="hz-carousel">
    @foreach($title->photos as $photo)
        @if($photo->width == 300)
        <div class="slide">
            <img src="{{ $photo->photo_path }}" alt="poster">
        </div>
        @endif
    @endforeach
</div>
<div class="review-container">
    <div class="h1-button">
        <h1 class="review-header">Reviews</h1>
        @if(Auth::check())
            <a class="button is-primary" id="review-button" href="#anchor-review">Review this title</a>
        @endif
    </div>
    @foreach($title->reviews as $review)
        @if($review->status == 1)
            <div class="review-content">
                <div class="title-container">
                    <h2 class="review-title">{{ $review->title }}</h2>
                </div>
                <div class="user-container">
                    <p class="review-date">{{ $review->created_at }} &nbsp;</p>
                    <p class="review-user">|&nbsp;&nbsp;by user: {{ $review->user->username }}</p>
                </div>
                <p class="review-text">{{ $review->body }}</p>
                <!-- Comment form and buttons -->
                @if(Auth::check())
                    <button class="button is-primary comment-button" value="Button One">Comment this review</button>
                    <form class="create-comment" method="post" action="{{ route('comments.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="title_id" value="{{ $title->id }}">
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <div class="field">
                            <div class="control">
                                <textarea class="textarea is-primary" type="text" name="body" placeholder="Comment"></textarea>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <p class="control">
                                <input type="submit" class="button is-primary" id="submit-comment" value="Submit comment">
                            </p>
                            <p class="control">
                                <button type="button" class="button is-light" id="cancel-comment">Cancel</button>
                            </p>
                        </div>
                    </form>
                @endif
                <h2 class="review-header">Comments</h2>
                @foreach($review->comments as $comment)
                    @if($comment->status == 1)
                        <div class="user-comment">
                            <p class="review-date">{{ $comment->created_at }} &nbsp;</p>
                            <p class="review-user">|&nbsp;&nbsp;by user: {{ $comment->user->username }}</p>
                            <p class="comment-content">{{ $comment->body }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
    <!-- Review Form -->
    @if(Auth::check())
        <form class="make-review" id="anchor-review" method="post" action="{{ route('reviews.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="title_id" value="{{ $title->id }}">
            <div class="field">
                <label class="label">Title</label>
                <div class="control" id="rating-container">
                    <input class="input" type="text" name="title" placeholder="Title">
                    <div class="select">
                    <select name="rating">
                        <option value="">Rate this Series</option>
                        <option value="0">0 Stars</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Review</label>
                <div class="control">
                    <textarea class="textarea is-primary" type="text" name="body" placeholder="Your review"></textarea>
                </div>
            </div>
            <div class="field is-grouped">
                <p class="control">
                    <input class="button is-primary" id="submit-review" type="submit" value="Submit review">
                </p>
                <p class="control">
                    <button type="button" class="button is-light" id="cancel-review">Cancel</button>
                </p>
            </div>
        </form>
    @endif
</div>
{{--  <a href="http://{{ $_SERVER['HTTP_HOST'] }}/series">Back to all series</a>
<time datetime="{{ $series->release_year }}">{{ date('d F Y', strtotime($series->release_year)) }}</time><br> --}}
@include('layouts.footer') 