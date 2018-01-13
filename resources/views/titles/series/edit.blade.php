@include('layouts.header')
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Title</h3>
            <input name="title"value="{{ $series->title }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Plot Summary</h3>
            <textarea name="plot_summary">{{ $series->plot_summary }}"</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Relesae Year</h3>
            <input name="release_year"value="{{ $series->release_year }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>End date</h3>
            <input name="end_date"value="{{ $series->end_date }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Countries</h3>
            <input name="countries"value="{{ $series->countries }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>PG Rating</h3>
            <input name="pg_rating"value="{{ $series->pg_rating }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="PUT" action="/titles/series/{{$title->id}}">
            <h3>Trailer URL</h3>
            <input name="trailer"value="{{ $series->trailer }}">
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Genres:</h3>
            <textarea name="genres">{{$genres}}</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Creators:</h3>
            <textarea name="creators">{{$creators}}</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
          <form method="POST" action="/titles/series/{{$title->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Photos:</h3>
            <textarea name="photos">{{$photos}}</textarea>
            <button type="submit">Submit</button>   
          </form>
        </section>
        <section>
        </section>
@include('layouts.footer')