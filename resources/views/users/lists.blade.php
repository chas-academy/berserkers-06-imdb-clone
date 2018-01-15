@include('layouts.header')
  <article>
    <h2>Your Lists</h2>
    @foreach ($lists as $list)
      <section class="mylists">
        <h3>{{$list->name}}</h3>
        <ul>
        @foreach ($list->titles as $title)
          <li class="list-item">
            @if($title->type == 'movie')
              <a href="/titles/movies/{{$title->id}}">
                {{$title->movie->title}}
              </a>
            @endif
            @if($title->type == 'series')
              <a href="/titles/series/{{$title->id}}">
                {{$title->series->title}}            
              </a>
            @endif
            @if($title->type == 'episode')
              <a href="/titles/series/{{$title->episode->first()->season->series_id}}/seasons/{{$title->episode->first()->season->season_number}}/episodes/{{$title->episode->first()->episode_number}}">
                {{$title->episode->first()->name}}           
              </a> 
            @endif
            <form method="POST" action="/lists/{{$list->id}}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" name="type" value="{{$title->type}}">
              <input type="hidden" name="title_id" value="{{$title->id}}">
              <button class="button is-danger" type="submit">Remove from List</button>
            </form>
          </li>
        @endforeach
        <form method="POST" action="/lists/{{$list->id}}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <lable for="type">Type: </lable>
          <select name="type">
            <option value="movie">Movie</option>
            <option value="series">Series</option>
            <option value="episode">Episode</option>
          </select>
          <lable for="name">Title: </lable>
          <input name="name" placeholder="which title would you like to add?" required>
          <button class="button is-primary" type="submit">Add to List</button>
        </form>
        <form method="POST" action="/lists/{{$list->id}}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button class="button is-danger" type="submit">Delete List</button>
        </form>
        </ul>
      </section>
    @endforeach
  </article>
  <article>
    <h2>Do you want to create a new list?</h2>
    <form method="GET" action="/lists/create">
      {{ csrf_field() }}
      <input name="name" placeholder="Name of your new list" required>
      <button class="button is-primary" type="submit">Create new List</button>
    </form>
  </arcticle>
@include('layouts.footer')