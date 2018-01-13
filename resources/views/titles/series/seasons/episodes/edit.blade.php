@include('layouts.header')
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Title</h3>
    <input name="name"value="{{ $episode->name }}">
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Plot Summary</h3>
    <textarea name="plot_summary">{{ $episode->plot_summary }}"</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Relesae Year</h3>
    <input name="release_year"value="{{ $episode->episode_number }}">
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Air Date</h3>
    <input name="air_date"value="{{ $episode->air_date }}">
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Directors:</h3>
    <textarea name="directors">{{$directors}}</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Producers:</h3>
    <textarea name="producers">{{$producers}}</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<article>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <h3>Screenwriters:</h3>
  <textarea name="screenwriters">{{$screenwriters}}</textarea>
  <input name="title_id" value="{{$episode->title_id}}" type="hidden">
  <button type="submit">Submit</button>   
</form>
</article>
<article>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Actors:</h3>
    <textarea name="actorsAsCharacters">{{$actorsAsCharacters}}</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</article>
<section>
  <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <h3>Photos:</h3>
    <textarea name="photos">{{$photos}}</textarea>
    <input name="title_id" value="{{$episode->title_id}}" type="hidden">
    <button type="submit">Submit</button>   
  </form>
</section>
<section>
</section>
@include('layouts.footer')