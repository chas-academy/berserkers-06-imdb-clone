@include('layouts.header')
<article class="page-content">
    <div class="centered-content">
        <section class="item-header">
            <h1  class="hero-header link"><a href="http://{{$_SERVER['HTTP_HOST'] }}/titles/series/{{$series->title_id}}">{{$series->title}}</a></h1> <h2 class="hero-header">{{$episode->name}}</h1>
        </section>
        <article class="item">
            <section class="item-meta-info">
                <ul class="title-genres">
                    @for($i = 0; $i < 2; $i++)
                        @if (isset($series->titles->genres[$i]))
                            <li>{{ $series->titles->genres[$i]->name }}</li>
                        @endif
                    @endfor
                </ul>
                <div class="meta-info-group">
                    <section class="seasons-table">
                        <table>
                            <thead>
                            <tr>
                                <th span="2">Season</th>
                                <th span="2">Episode number</th>
                                <th span="2">Air date</th>  
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/series/{{ $series->title_id }}/seasons/{{ $season->season_number }}">{{$season->season_number}}</a></td>
                                <td span="2">{{ $episode->episode_number }}</td>
                                <td span="2">{{ $episode['air_date'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </section>
                    <section class="row-flex-start">
                        <h2><span>short</span><span>Facts</span></h2>
                    </section>
                    <section class="facts-table">
                        <table>
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($series->titles->creators[$i]))
                                    @if ($i === 0 && $i === count($series->titles->creators)-1)
                                        <tr class="row-padding-botom">
                                            <th span="2">Creator</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $series->titles->creators[$i]->id }}">{{ $series->titles->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0)
                                        <tr>
                                            <th span="2">Creators</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $series->titles->creators[$i]->id }}">{{ $series->titles->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2  || !isset($series->titles->creators[$i+1]))
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $series->titles->creators[$i]->id }}">{{ $series->titles->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @elseif (isset($series->titles->creators[$i]))
                                        <tr class="table-flex-end">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $series->titles->creators[$i]->id }}">{{ $series->titles->creators[$i]->name }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor    
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($episode->directors[$i]))
                                    @if ($i === 0 && !isset($episode->directors[$i+1]))
                                        <tr class="row-padding-botom">
                                            <th span="2">Director</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->directors[$i]['id'] }}">{{ $episode->directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0 && isset($episode->directors[$i+1]))
                                        <tr>
                                            <th span="2">Directors</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->directors[$i]['id'] }}">{{ $episode->directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2 || !isset($episode->directors[$i+1]) )
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->directors[$i]['id'] }}">{{ $episode->directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->directors[$i]['id'] }}">{{ $episode->directors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 2; $i++)
                                @if(isset($episode->producers[$i]))
                                    @if($i === 0 && isset($episode->producers[$i+1]))
                                        <tr>
                                            <th span="2">Producers</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->producers[$i]['id'] }}">{{ $episode->producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0 && !isset($episode->producers[$i+1]))
                                        <tr class="row-padding-botom">
                                            <th span="2">Producer</th>
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->producers[$i]['id'] }}">{{ $episode->producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link"span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->producers[$i]['id'] }}">{{ $episode->producers[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 3; $i++)
                                @if(isset($episode->screenwriters[$i]))
                                    @if ($i === 0 && $i === count($episode->screenwriters)-1)
                                        <tr class="row-padding-botom">
                                            <th span="2">Writer</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->screenwriters[$i]['id'] }}">{{ $episode->screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 0)
                                        <tr>
                                            <th span="2">Writers</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->screenwriters[$i]['id'] }}">{{ $episode->screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 2 || !isset($episode->screenwriters[$i+1]))
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->screenwriters[$i]['id'] }}">{{ $episode->screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="table-flex-end">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->screenwriters[$i]['id'] }}">{{ $episode->screenwriters[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                            @for($i = 0; $i < 5; $i++)
                                @if(isset($episode->actors[$i]))
                                    @if($i === 0)
                                        <tr>
                                            <th span="2">Cast</th>
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->actors[$i]['id'] }}">{{ $episode->actors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                    @elseif ($i === 4 || !isset($episode->actors[$i+1]))
                                        <tr class="table-flex-end row-padding-botom">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->actors[$i]['id'] }}">{{ $episode->actors[$i]['name'] }}</a>
                                            </td>
                                        </tr>
                                        <tr class="table-flex-end alt-color">
                                            <td class="link" span="2"><a>VIEW FULL CAST</a></td>
                                        </tr>
                                    @else 
                                        <tr class="table-flex-end">
                                            <td class="link" span="2">
                                                <a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $episode->actors[$i]['id'] }}">{{ $episode->actors[$i]['name'] }}</a>
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
                @foreach($series->titles->photos as $photo)
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
                foreach ($episode->title->ratings as $rating) {
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
</p>
<div id="hz-carousel">
    @foreach($series->titles->photos as $photo)
        @if($photo->width == 300)
        <div class="slide">
            <img src="{{ $photo->photo_path }}" alt="poster">
        </div>
        @endif
    @endforeach
</div>
@include('layouts.footer') 