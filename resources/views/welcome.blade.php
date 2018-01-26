@include('layouts.header')
    <div>
        <div class="hero is-hidden-mobile">
            <figure class="image is-16by9">
                <img src="https://image.tmdb.org/t/p/w1280/5Iw7zQTHVRBOYpA0V6z0yypOPZh.jpg">
            </figure>
        </div>
    </div>
    <div class="main-content">
        @include('layouts.components.daily_picks')
        @include('layouts.components.item_chart')
    </div>
@include('layouts.footer')
