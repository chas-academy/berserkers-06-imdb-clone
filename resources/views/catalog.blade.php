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
                            <h1 class="overlay-title">{{$title['movie']['title']}}</h1>
                            <ul>
                                <li class="overlay-content">Director:&nbsp; {{$title['directors'][0]['name']}}</li>
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
                                    Plot Summary:&nbsp; {{$title['movie']['plot_summary']}}
                                    <p id="catalog-readmore">Read More &#x21e8;</p>
                                </li>
                            </ul>
                        </div>
                        <!-- Closes fade-overlay -->
                    </article>
                </a>
                <div class="image-content">
                    <p>
                        <a href="#">
                            <i class="fa fa-lg fa-star" aria-hidden="true"></i>
                        </a> 
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
                           |
                        @foreach ($title['genres'] as $key => $genre)
                            @if($key < 3)
                            {{$genre['name']}}
                                @if ($key < 2)
                                {{' '}}
                                @endif
                            @endif
                        @endforeach
                        | Add
                        <a href="#">
                            <i class="fa fa-lg fa-bookmark" aria-hidden="true"></i>
                        </a>
                    </p>
                </div>
            </div>
        @endif
    @endforeach
    <!-- Closes image-container -->
    <div class="image-container">
        <a class="overlay-a" href="#">
            <article class="fade-container">
                <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                <div class="fade-overlay">
                    <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                    <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down
                            former blade runner Rick Deckard, who's been missing for thirty years.</li>
                    </ul>
                </div>
                <!-- Closes fade-overlay -->
            </article>
        </a>
    </div>
    <!-- Closes image-container -->
    <div class="image-container">
        <a class="overlay-a" href="#">
            <article class="fade-container">
                <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                <div class="fade-overlay">
                    <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                    <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down
                            former blade runner Rick Deckard, who's been missing for thirty years.</li>
                    </ul>
                </div>
                <!-- Closes fade-overlay -->
            </article>
        </a>
    </div>
    <!-- Closes image-container -->
    <div class="image-container">
        <a class="overlay-a" href="#">
            <article class="fade-container">
                <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                <div class="fade-overlay">
                    <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                    <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down
                            former blade runner Rick Deckard, who's been missing for thirty years.</li>
                    </ul>
                </div>
                <!-- Closes fade-overlay -->
            </article>
        </a>
    </div>
    <!-- Closes image-container -->
    <div class="image-container">
        <a class="overlay-a" href="#">
            <article class="fade-container">
                <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                <div class="fade-overlay">
                    <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                    <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down
                            former blade runner Rick Deckard, who's been missing for thirty years.</li>
                    </ul>
                </div>
                <!-- Closes fade-overlay -->
            </article>
        </a>
    </div>
    <!-- Closes image-container -->
    <div class="image-container">
        <a class="overlay-a" href="#">
            <article class="fade-container">
                <img class="img is-1by1" src="https://i.pinimg.com/originals/a3/47/b4/a347b4457225972d6865fa077bd5265b.jpg">
                <div class="fade-overlay">
                    <h1 class="overlay-title">Blade Runner 2049 (2017)</h1>
                    <ul>
                        <li class="overlay-content">Director:&nbsp; Denise Villeneuve</li>
                        <li class="overlay-content">Stars:&nbsp; Harrison Ford, Ryan Gosling, Ana de Armas</li>
                        <li class="overlay-content">Plot Summary:&nbsp; A young blade runner's discovery of a long-buried secret leads him to track down
                            former blade runner Rick Deckard, who's been missing for thirty years.</li>
                    </ul>
                </div>
                <!-- Closes fade-overlay -->
            </article>
        </a>
    </div>
    <!-- Closes image-container -->
</div>
<!-- Closes card-container -->
<nav class="pagination is-rounded is-centered" role="navigation" aria-label="pagination">
    <a class="pagination-previous">Previous</a>
    <a class="pagination-next">Next page</a>
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
