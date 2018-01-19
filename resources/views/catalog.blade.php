 @include('layouts.header')
<div class="card-container">
    @foreach ($titles->items() as $title)
        @if (isset($title['movie']))
            <div class="image-container">
                <a class="overlay-a" href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies/{{$title['id']}}">
                    <article class="fade-container">
                        @foreach($title['photos'] as $photo)
                            @if ($photo['width'] == 300 && $photo['photo_type'] == 'backdrop')
                            <img class="img is-1by1" src="{{$photo['photo_path']}}">
                            @endif
                        @endforeach
                        <div class="fade-overlay">
                            <h1 class="overlay-title">{{$title['movie']['title']}} ({{substr($title['movie']['release_year'], 0, 4)}})</h1>
                            <ul>
                                @if(isset($title['directors'][0]))
                                <li class="overlay-content">Director:&nbsp; {{$title['directors'][0]['name']}}</li>
                                @endif
                                <li class="overlay-content">Stars:&nbsp; 
                                    @foreach ($title['actors'] as $key => $actor)
                                    @if ($key < 4)
                                    {{$actor['name']}}
                                        @if($key < 3) 
                                            {{ ', ' }}
                                        @endif
                                    @endif      
                                    @endforeach
                                </li>
                                <li class="overlay-content">
                                    Plot Summary:&nbsp; {{substr($title['movie']['plot_summary'], 0, 80)}} 
                                    @if(strlen($title['movie']['plot_summary']) > 80)
                                        {{'...'}}
                                    @endif
                                    <p id="catalog-readmore">Read More &#x21e8;</p>
                                </li>
                            </ul>
                        </div>
                        <!-- Closes fade-overlay -->
                    </article>
                </a>
                <div class="image-content">
                    <p>
                        <form method="POST" action="/titles/{{$title['id']}}/rate">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <select type="hidden" name="rating">
                                @foreach ($all_ratings as $rating)
                                <option value="{{$rating->id}}">{{$rating->rating}}</option>
                                @endforeach
                            </select>
                            <button class="rating" type="submit" border="none"><i class="fa fa-lg fa-star" aria-hidden="true"></i></button>
                            <?php
                                $ratingSummary = 0;
                                $i = 0;
                                foreach ($title['ratings'] as $rating) {
                                    $ratingSummary = $ratingSummary + $rating['rating'];
                                    $i++;
                                }
                                if ($i == 0) {
                                    echo "-";
                                } else {
                                    $ratingSummary = $ratingSummary / $i;
                                    echo $ratingSummary;
                                }
                            ?>
                        </form>
                        |
                        @foreach ($title['genres'] as $key => $genre)
                            @if($key < 2)
                            {{$genre['name']}}
                                @if ($key < 1)
                                {{' '}}
                                @endif
                            @endif
                        @endforeach
                        | 
                        <a href="#"> 
                            Add 
                            <i class="fa fa-lg fa-bookmark" aria-hidden="true"></i>
                        </a>
                    </p>
                </div>
            </div>
        @endif
        @if (isset($title['series']))
            <div class="image-container">
                <a class="overlay-a" href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{$title['id']}}">
                    <article class="fade-container">
                        @foreach($title['photos'] as $photo)
                            @if ($photo['width'] == 300 && $photo['photo_type'] == 'backdrop')
                                <img class="img is-1by1" src="{{$photo['photo_path']}}">
                            @endif
                        @endforeach
                        <div class="fade-overlay">
                            <h1 class="overlay-title">{{$title['series']['title']}}</h1>
                            <ul>
                                <li class="overlay-content">Creators:&nbsp; 
                                    @foreach ($title['creators'] as $creator)
                                        {{$creator['name']}}
                                        @if(!$loop->last)
                                        {{', '}}
                                        @endif
                                    @endforeach
                                </li>
                                <li class="overlay-content">Stars:&nbsp; 
                                    @foreach ($title['actors'] as $key => $actor)
                                    @if ($key < 4)
                                    {{$actor['name']}}
                                        @if($key < 3) 
                                            {{ ', ' }}
                                        @endif
                                    @endif      
                                    @endforeach
                                </li>
                                <li class="overlay-content">
                                    Plot Summary:&nbsp; {{substr($title['series']['plot_summary'], 0, 80)}}
                                    @if(strlen($title['series']['plot_summary']) > 80)
                                    {{'...'}}
                                    @endif
                                    <p id="catalog-readmore">Read More &#x21e8;</p>
                                </li>
                            </ul>
                        </div>
                        <!-- Closes fade-overlay -->
                    </article>
                </a>
                <div class="image-content">
                    <p>
                        <form method="POST" action="/titles/{{$title['id']}}/rate">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <select type="hidden" name="rating">
                                @foreach ($all_ratings as $rating)
                                <option value="{{$rating->id}}">{{$rating->rating}}</option>
                                @endforeach
                            </select>
                            <button class="rating" type="submit" border="none"><i class="fa fa-lg fa-star" aria-hidden="true"></i></button>
                            <?php
                                $ratingSummary = 0;
                                $i = 0;
                                foreach ($title['ratings'] as $rating) {
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
                        </form>
                      
                        |
                        @foreach ($title['genres'] as $key => $genre)
                            @if($key < 2)
                            {{$genre['name']}}
                                @if ($key < 1)
                                {{' '}}
                                @endif
                            @endif
                        @endforeach
                        |
                        <a href="#">
                            Add 
                            <i class="fa fa-lg fa-bookmark" aria-hidden="true"></i>
                        </a>
                    </p>
                </div>
            </div>
        @endif
        @if (isset($title['episode']))
        <div class="image-container">
            <a class="overlay-a" href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{$title['series_id']}}/seasons/{{$title['season_number']}}/episodes/{{$title['episode'][0]['episode_number']}}">
                <article class="fade-container">
                    @foreach($title['photos'] as $photo)
                        @if ($photo['width'] == 300 && $photo['photo_type'] == 'backdrop')
                        <img class="img is-1by1" src="{{$photo['photo_path']}}">
                        @endif
                    @endforeach
                    <div class="fade-overlay">
                        <h1 class="overlay-title">{{$title['episode'][0]['name']}} ({{$title['series_title']}})</h1>
                        <ul>
                            <li class="overlay-content">Directors:&nbsp; 
                                @foreach ($title['directors'] as $key => $director)
                                @if($key < 2)
                                {{$director['name']}}
                                @endif
                                @if($key < 1)
                                {{', '}}
                                @endif
                                @endforeach
                            </li>
                            <li class="overlay-content">Stars:&nbsp; 
                                @foreach ($title['actors'] as $key => $actor)
                                @if ($key < 4)
                                {{$actor['name']}}
                                    @if($key < 3) 
                                        {{ ', ' }}
                                    @endif
                                @endif      
                                @endforeach
                            </li>
                            <li class="overlay-content">
                                Plot Summary:&nbsp;  {{substr($title['episode'][0]['plot_summary'], 0, 80)}}
                                @if(strlen($title['episode'][0]['plot_summary']) > 80)
                                {{'...'}}
                                @endif
                                <p id="catalog-readmore">Read More &#x21e8;</p>
                            </li>
                        </ul>
                    </div>
                    <!-- Closes fade-overlay -->
                </article>
            </a>
            <div class="image-content">
                <p>
                    <form method="POST" action="/titles/{{$title['id']}}/rate">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <select type="hidden" name="rating">
                            @foreach ($all_ratings as $rating)
                            <option value="{{$rating->id}}">{{$rating->rating}}</option>
                            @endforeach
                        </select>
                        <button class="rating" type="submit" border="none"><i class="fa fa-lg fa-star" aria-hidden="true"></i></button>
                        <?php
                        $ratingSummary = 0;
                        $i = 0;
                        foreach ($title['ratings'] as $rating) {
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
                    </form>
                    |
                    @foreach ($title['genres'] as $key => $genre)
                        @if($key < 2)
                        {{$genre['name']}}
                            @if ($key < 1)
                            {{' '}}
                            @endif
                        @endif
                    @endforeach
                    | 
                    <a href="#">
                        Add 
                        <i class="fa fa-lg fa-bookmark" aria-hidden="true"></i>
                    </a>
                </p>
            </div>
        </div>
    @endif
    @endforeach
    <!-- Closes image-container -->
</div>
<!-- Closes card-container -->
<nav class="pagination is-rounded is-centered" role="navigation" aria-label="pagination">
    
    @if($titles->currentPage() != 1)
    <a class="pagination-previous" href="{{$titles->previousPageUrl()}}">Previous page</a>
    @endif
    @if($titles->hasMorePages())
    <a class="pagination-next" href="{{$titles->nextPageUrl()}}">Next page</a>
    @endif
    <ul class="pagination-list">
        <li>
            <a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
        </li>
        <li>
            <a class="pagination-link" aria-label="Goto page 2">2</a>
        </li>
        <li>
            <a class="pagination-link" aria-label="Goto page 3">3</a>
        </li>
        <li>
            <a class="pagination-link" aria-label="Goto page 4">4</a>
        </li>
        <li>
            <span class="pagination-ellipsis">&hellip;</span>
        </li>
        <li>
            <a class="pagination-link" aria-label="Goto page 12">12</a>
        </li>
    </ul>
</nav>

@include('layouts.footer')
