@include('layouts.header')
<article class="form-container">
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Title</h3>
      <input class="input"name="name"value="{{ $episode->name }}">
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info" type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Plot Summary</h3>
      <textarea class="textarea" name="plot_summary">{{ $episode->plot_summary }}"</textarea>
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Episode Number</h3>
      <input class="input" type="number" name="episode_number"value="{{ $episode->episode_number }}">
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Air Date (Please use the folowing format: YYYY-MM-DD)</h3>
      <input class="input" name="air_date" value="{{ $episode->air_date }}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </section>
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Directors:</h3>
      <textarea class="textarea" name="directors">{{$directors}}</textarea>
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </section>
  <article>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
    <h3>Screenwriters:</h3>
    <textarea class="textarea" name="screenwriters">{{$screenwriters}}</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button class="button is-info"type="submit">Submit</button>   
  </form>
  </article>
  <article>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Actors:</h3>
      <textarea class="textarea" name="actorsAsCharacters">{{$actorsAsCharacters}}</textarea>
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </article>
  <section>
    <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <h3>Photos: (please use the folowing format:  photo_path: https://PATH_TO_FILE | photo_type: PHOTO_TYPE (poster or backdrop) | width: WIDTH_IN_PX | ratio: HEIGHT_TO WIDTH_RATIO (two decimals) )</h3>
      <textarea class="textarea" name="photos">{{$photos}}</textarea>
      <input name="title_id" value="{{$episode->title_id}}" type="hidden">
      <button class="button is-info"type="submit">Submit</button>   
    </form>
  </section>
</article>
@include('layouts.footer')