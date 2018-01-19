@include('layouts.header')
  <article>
    <h2>Your Lists</h2>
    @foreach ($lists as $list)
      <section class="mylists">
        <h3>{{$list->name}}</h3>
        <ul>
        @foreach ($list->titleLists->sortBy('list_index') as $titleList)
            <li class="list-item">
              @if($titleList->title->type == 'movie')
                <a href="/titles/movies/{{$titleList->title->id}}">
                  {{$titleList->title->movie->title}}
                </a>
              @endif
              @if($titleList->title->type == 'series')
                <a href="/titles/series/{{$titleList->title->id}}">
                  {{$titleList->title->series->title}}            
                </a>
              @endif
              @if($titleList->title->type == 'episode')
                <a href="/titles/series/{{$titleList->title->episode->first()->season->series_id}}/seasons/{{$title->episode->first()->season->season_number}}/episodes/{{$title->episode->first()->episode_number}}">
                  {{$titleList->title->episode->first()->name}}           
                </a> 
              @endif
              <form method="POST" action="/lists/{{$list->id}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="title_id" value="{{$titleList->title->id}}">
                <input type="hidden" name="old_list_index" value="{{$titleList->list_index}}">
                <select name="list_index">
                    @foreach($list->titleLists->sortBy('list_index') as $titleListIndex)
                      @if($titleList->list_index == $titleListIndex->list_index )
                      <option value="{{$titleListIndex->list_index}}" selected="selected">{{$titleListIndex->list_index}}</option>
                      @else 
                      <option value="{{$titleListIndex->list_index}}" >{{$titleListIndex->list_index}}</option>
                      @endif
                    @endforeach
                </select>
                <button class="button is-primary" type="submit">Change Order</button>
              </form>
              <form method="POST" action="/lists/{{$list->id}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="title_id" value="{{$titleList->title->id}}">
                <input type="hidden" name="list_index" value="{{$titleList->list_index}}">
                <input type="hidden" name="remove" value="true">
                <button class="button is-danger" type="submit">Remove from List</button>
              </form>
            </li>
        @endforeach
        <form method="POST" action="/lists/{{$list->id}}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <lable for="list_index">Placement in List: </lable>
          <select name="list_index">
              @if(isset($list->titleLists[0]))
                @foreach($list->titleLists->sortBy('list_index') as $titleList)
                <option value="{{$titleList->list_index}}">{{$titleList->list_index}}</option>
                @endforeach
                <option value ="{{$list->titleLists->last()->list_index +1 }}">{{$list->titleLists->sortBy('list_index')->last()->list_index + 1 }}</option>
              @else
                <option value ="1">1</option>
              @endif
          </select>
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