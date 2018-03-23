@include('layouts.header')
<article class="form-container">
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Title</h3>
      <input class="input" name="title"value="{{ $series->title }}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Plot Summary</h3>
      <textarea class="textarea" name="plot_summary">{{ $series->plot_summary }}"</textarea>
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Release Date (Please use the folowing format: YYYY-MM-DD)</h3>
      <input class="input" name="release_year" value="{{ $series->release_year }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>End Date (Please use the folowing format: YYYY-MM-DD)</h3>
      <input class="input" name="end_date" value="{{ $series->end_date }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Countries</h3>
      <input class="input" name="countries"value="{{ $series->countries }}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>PG Rating</h3>
      <input class="input" name="pg_rating" value="{{ $series->pg_rating }}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="PUT" action="/titles/series/{{$title->id}}">
      <h3>Trailer URL</h3>
      <input class="input" name="trailer"value="{{ $series->trailer }}">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Genres:</h3>
      <textarea class="textarea" name="genres">{{$genres}}</textarea>
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Creators:</h3>
      <textarea class="textarea" name="creators">{{$creators}}</textarea>
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$title->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Photos: (please use the folowing format: photo_path: https://PATH_TO_FILE | photo_type: PHOTO_TYPE (poster or backdrop) | width: WIDTH_IN_PX | ratio: HEIGHT_TO WIDTH_RATIO (two decimals)</h3>
      <textarea class="textarea" name="photos">{{$photos}}</textarea>
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  </article>
@include('layouts.footer')