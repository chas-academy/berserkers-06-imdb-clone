@include('layouts.header')
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Title</h3>
            <input name="title"value="{{ $movie->title }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Plot Summary</h3>
            <textarea name="plot_summary">{{ $movie->plot_summary }}"</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Relesae Year</h3>
            <input name="release_year"value="{{ $movie->release_year }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Runtime</h3>
            <input name="runtime"value="{{ $movie->runtime }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Countries</h3>
            <input name="countries"value="{{ $movie->countries }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>PG Rating</h3>
            <input name="pg_rating"value="{{ $movie->pg_rating }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="PUT" action="/titles/movies/{{$title->id}}">
            <h3>Trailer URL</h3>
            <input name="trailer"value="{{ $movie->trailer }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/movies/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Genres:</h3>
            <textarea name="genres">{{$genres}}</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
            <h3>Directors:</h3>
            <textarea name="directors"></textarea>
        </section>
        <section>
          <h3>Producers:</h3>
          <textarea name="producers"></textarea>
        </section>
        <article>
          <h3>Screenwriters:</h3>
          <textarea name="screenwriters"></textarea>
        </article>
        <article>
            <h3>Actors:</h3>
            <textarea name="actorsAsCharacters"></textarea>
        </article>
        <h3>Images</h3>
        @foreach($title->photos as $photo)
          <section>
            <input value="{{ $photo->photo_type }}"/>
            <input value="{{ $photo->width }}"/>
            <input value="{{ $photo->ratio }}"/>
            <input value="{{ $photo->photo_path }}"/>
          </section>
        @endforeach
        <section>
        </section>
@include('layouts.footer')