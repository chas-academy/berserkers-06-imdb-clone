@include('layouts.header')
        <section class="item-header">
            <h1 id="hero-header">{{$movie->title}}</h1>
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
                                <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a></td>
                            </tr>
                        @elseif ($key === 0)
                            <tr>
                                <th span="2">Directors</th>
                                <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a></td>
                            </tr>
                        @elseif ($key === count($title->directors)-1)
                            <tr class="table-flex-end row-padding-botom">
                                <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a></td>
                            </tr>
                        @else
                            <tr class="table-flex-end">
                                <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $director->id }}">{{ $director->name }}</a></td>
                            </tr>
                        @endif
                    @endforeach
                    @for($i = 0; $i < 2; $i++)
                        @if(isset($title->producers[$i]))
                            @if($i === 0 && isset($title->producers[$i+1]))
                                <tr>
                                    <th span="2">Producers</th>
                                    <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a></td>
                                </tr>
                            @elseif ($i === 0 && !isset($title->producers[$i+1]))
                                <tr class="row-padding-botom">
                                    <th span="2">Producer</th>
                                    <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a></td>
                                </tr>
                            @else
                                <tr class="table-flex-end row-padding-botom">
                                    <td class="link"span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->producers[$i]->id }}">{{ $title->producers[$i]->name }}</a></td>
                                </tr>
                            @endif
                        @endif
                    @endfor
                    @foreach($title->screenwriters as $key => $screenwriter)
                        @if ($key === 0 && $key === count($title->screenwriters)-1)
                            <tr class="row-padding-botom">
                                <th span="2">Writer</th>
                                <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a></td>
                            </tr>
                        @elseif ($key === 0)
                            <tr>
                                <th span="2">Writers</th>
                                <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a></td>
                            </tr>
                        @elseif ($key === count($title->screenwriters)-1)
                            <tr class="table-flex-end row-padding-botom">
                                    <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a></td>
                            </tr>
                        @else
                            <tr class="table-flex-end">
                                    <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $screenwriter->id }}">{{ $screenwriter->name }}</a></td>
                            </tr>
                        @endif
                    @endforeach
                    @for($i = 0; $i < 5; $i++)
                        @if(isset($title->actors[$i]))
                            @if($i === 0)
                                <tr>
                                    <th span="2">Cast</th>
                                    <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a></td>
                                </tr>
                            @elseif ($i === 4 || !isset($title->actors[$i+1]))
                                <tr class="table-flex-end row-padding-botom">
                                    <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a></td>
                                </tr>
                                <tr class="table-flex-end alt-color">
                                        <td class="link" span="2"><a>VIEW FULL CAST</a></td>
                                </tr>
                            @else 
                                <tr class="table-flex-end">
                                    <td class="link" span="2"><a href="http://{{ $_SERVER['HTTP_HOST'] }}/people/{{ $title->actors[$i]->id }}">{{ $title->actors[$i]->name }}</a></td>
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
            @foreach($title->photos as $photo)
                @if($photo->width == 1280 && $photo->photo_type == "backdrop")
                    <img id="title-img" src="{{ $photo->photo_path }}" alt="poster">
                    @break
                @endif
                @if($loop->last)
                    <img id="title-img" src="{{ $photo->photo_path }}" alt="poster">
                @endif
            @endforeach
            </section>
        </article>
        <a href="http://{{ $_SERVER['HTTP_HOST'] }}/titles/movies">Back to all movies</a>        
        
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
@include('layouts.footer')