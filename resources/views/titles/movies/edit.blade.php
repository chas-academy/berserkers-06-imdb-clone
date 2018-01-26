@include('layouts.header')
  <article class="form-container">
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Title</h3>
        <input class="input" name="title"value="{{ $movie->title }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Plot Summary</h3>
        <textarea class="textarea" name="plot_summary">{{ $movie->plot_summary }}"</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Relesae Year</h3>
        <input class="input" name="release_year"value="{{ $movie->release_year }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Runtime</h3>
        <input class="input" name="runtime"value="{{ $movie->runtime }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Countries</h3>
        <input class="input" name="countries"value="{{ $movie->countries }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>PG Rating</h3>
        <input class="input" name="pg_rating"value="{{ $movie->pg_rating }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="PUT" action="/titles/movies/{{$title->id}}">
        <h3>Trailer URL</h3>
        <input class="input" name="trailer"value="{{ $movie->trailer }}">
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Genres:</h3>
        <textarea class="textarea" name="genres">{{$genres}}</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Directors:</h3>
        <textarea class="textarea" name="directors">{{$directors}}</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Producers:</h3>
        <textarea class="textarea" name="producers">{{$producers}}</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
    <article>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
      <h3>Screenwriters:</h3>
      <textarea class="textarea" name="screenwriters">{{$screenwriters}}</textarea>
      <button class="button is-info" type="submit">Submit</button>   
    </form>
    </article>
    <article>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Actors:</h3>
        <textarea class="textarea" name="actorsAsCharacters">{{$actorsAsCharacters}}</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </article>
    <section>
      <form method="POST" action="/titles/movies/{{$title->id}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Photos:</h3>
        <textarea class="textarea" name="photos">{{$photos}}</textarea>
        <button class="button is-info" type="submit">Submit</button>   
      </form>
    </section>
  <article>
@include('layouts.footer')