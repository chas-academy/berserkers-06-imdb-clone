@include('layouts.header')
    <div>
        <div class="notification is-hidden-mobile">
            <figure class="image is-16by9">
                <img src="https://image.tmdb.org/t/p/w1280/5Iw7zQTHVRBOYpA0V6z0yypOPZh.jpg">
            </figure>
        </div>
    </div>
    <div class="main-content">
        @include('layouts.components.daily_picks')
        @include('layouts.components.item_chart')
        <nav class="breadcrumb is-centered" aria-label="breadcrumbs">
            <ul>
                <li><a href="#">Movies</a></li>
                <li><a href="#">Series</a></li>
                <li><a href="#">Upcoming Movies</a></li>
                <li><a href="#">Recommended Movies</a></li>
            </ul>
        </nav>
    </div>
@include('layouts.footer')
