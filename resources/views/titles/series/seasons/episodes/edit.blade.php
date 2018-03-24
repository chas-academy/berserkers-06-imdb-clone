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
      <h3>Photos:</h3>
      <form method="POST"  action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}" class="photo-form" >
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input class="input" type="text" name="photo_path" required>
        <div class="select">
          <select type="text" name="photo_type" required>
            <option value="poster" selected>poster<option/>
            <option value="backdrop">backdrop<option/>
            <option value="profile">profile</option>
          </select>
        </div>
        <input class="input" type="number" name="width" required >
        <input class="input" type="number" name="ratio" step="0.01" min="0.01" required >
        <input name="title_id" value="{{$episode->title_id}}" type="hidden">
        <button class="button is-info" type="submit">Add new photo!</button>   
      </form>
      @foreach($photos as $photo)
      <div class="photo-form">
        <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}" class="photo-form" >
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input class="input" type="text" name="photo_path" value="{{$photo->photo_path}}" required>
          <div class="select">
            <select  type="text" name="photo_type" required>
              @if($photo["photo_type"] === "poster" )
                <option value="poster" selected>poster<option/>
                <option value="backdrop">backdrop<option/>
                <option value="profile">profile</option>
              @elseif($photo["photo_type"] === "backdrop")
                <option value="poster">poster<option/>
                <option value="backdrop" selected>backdrop<option/>
                <option value="profile">profile</option>
              @else
                <option value="poster" >poster<option/>
                <option value="backdrop">backdrop<option/>
                <option value="profile" selected>profile</option>
              @endif
            </select>
          </div>
          <input class="input" type="number" name="width" value="{{$photo->width}}" required>
          <input  class="input" type="number" name="ratio" step="0.01" min="0.01" value="{{$photo->ratio}}" required>
          <input  class="input" type="hidden" name="photo_id" value="{{$photo->id}}">
          <input name="title_id" value="{{$episode->title_id}}" type="hidden">
          <button class="button is-info" type="submit">Update</button>   
        </form>
        <form method="POST" action="/titles/series/{{$series->title_id}}/seasons/{{$season->season_number}}/episodes/{{$episode->episode_number}}" class="photo-delete-form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="photo_id" value="{{$photo->id}}">
            <input type="hidden" name="delete" value=true>
            <input name="title_id" value="{{$episode->title_id}}" type="hidden">
            <button class="button is-danger" type="submit">delete</button>   
        </form>
      </div>
    @endforeach
  </section>
</article>
@include('layouts.footer')