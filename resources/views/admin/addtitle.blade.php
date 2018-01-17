@include('layouts.header')
<article class="title-to-add-search">
  <section>
    <div>
    <form method="GET" action="/titles/create">
      {{ csrf_field() }}
      <select name="type" required>
        <option value="movie">Movie</option>
        <option value="series">Series</option>
      </select>
      <input name="name" placeholder="title name here" required>
      <button type="submit" >Search</button>
    </form>
  </div>
  </section>
  <section>
    @isset($titles)
      @foreach ($titles as $title)
        <div>
          @if($title->poster_path != null)
          <img src="https://image.tmdb.org/t/p/w90{{$title->poster_path}}">
          @elseif ($title->poster_path != null)
          <img src="https://image.tmdb.org/t/p/w90{{$title->backdrop_path}}">
          @else 
            <h4>No Image available</h4>
          @endif
          @if(isset($title->name))
          <h3>{{$title->name}}</h3>
          @else 
          <h3>{{$title->title}}</h3>
          @endif
          <form method="POST" action="/titles/store">
            {{ csrf_field() }}
            <input name="title_id" type="hidden" value="{{$title->id}}">
            @if($type == 'episode')
            <input name="series" required>
            <input name="season" required>
            @endif
            <input name="type" type="hidden" value="{{$type}}">
            <button type="submit">Add to Database</button>
          </form>
        </div>
      @endforeach
    @endisset
  </section>
</article>
@include('layouts.footer')