@include('layouts.header')
<h1 id="welcome-h1">Hello Filmcritic007!</h1>
<!-- Tab links -->
<div class="tab">
   <button class="tablinks" id="default-tab">Home</button>
    
        <button class="tablinks" type="submit">Lists</button>
    
        <button class="tablinks" type="submit">Reviews</button>

        <button class="tablinks" type="submit">Settings</button>
   
</div>
<!-- Tab content -->
<!--Home -->
<div id="Home" class="tabcontent">
   <!-- Latest Reviews -->
   <div id="latest-reviews">
      <h1 id="latest-title">Latest Reviews</h1>
      <!-- Review 1 -->
      <article class="message is-primary">
         <div class="message-header">
            <p>My favorite movie by far</p>
            <button class="delete" aria-label="delete"></button>
         </div>
         <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
         </div>
      </article>
      <!-- Review 2 -->
      <article class="message is-primary">
         <div class="message-header">
            <p>Kind of dissapointed..</p>
            <button class="delete" aria-label="delete"></button>
         </div>
         <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
         </div>
      </article>
   </div>
   <!-- Watch-list-->
   <div class="watchlist-container">
      <h1 id="watchlist-title">My Watchlist</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<!-- List Tab -->
<div id="Lists" class="tabcontent">

<article>
    <h2>Your Lists</h2>
    @if(isset($lists))
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
                    <form method="POST" action="/userpage/lists/{{$list->id}}">
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
                    <form method="POST" action="/userpage/lists/{{$list->id}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="title_id" value="{{$titleList->title->id}}">
                        <input type="hidden" name="list_index" value="{{$titleList->list_index}}">
                        <input type="hidden" name="remove" value="true">
                        <button class="button is-danger" type="submit">Remove from List</button>
                    </form>
                    </li>
                @endforeach
                <form method="POST" action="/userpage/lists/{{$list->id}}">
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
                <form method="POST" action="/userpage/lists/{{$list->id}}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button class="button is-danger" type="submit">Delete List</button>
                </form>
                </ul>
            </section>
        @endforeach
    @endif
  </article>
  <article>
    <h2>Do you want to create a new list?</h2>
    <form method="GET" action="/userpage/lists/create">
      {{ csrf_field() }}
      <input name="name" placeholder="Name of your new list" required>
      <button class="button is-primary" type="submit">Create new List</button>
    </form>
  </article>




   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Planning to Review</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Have Reviewed</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Currently Reviewing</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Romantic</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="list-container"> <!-- List Container -->
      <h1 class="list-title">Crime</h1>
      <div class="watchlist">
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
         <div class="watchlist-box">
            <!-- Container -->
            <figure class="image-container">
               <img class="box-img" src="https://bulma.io/images/placeholders/256x256.png">
            </figure>
            <div class="box">
               <p class="box-title">Movie Title (2017)</p>
               <div class="field is-grouped btn-container">
                  <a class="button is-primary">Move up/down</a>
                  <a class="button is-danger">Remove</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div id="Reviews" class="tabcontent">
    <div class="text-container">
        <h1 class="my-reviews">Game of Thrones (2011)</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror (2011)</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Westworld</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.

            Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
    <div class="text-container">
        <h1 class="my-reviews">Black Mirror</h1>
        <article class="message is-primary">
            <div class="message-header">
                <p>My favorite movie by far</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus ac ex sit amet fringilla. Nullam gravida purus diam, et dictum <a>felis venenatis</a> efficitur. Aenean ac <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis sodales sem.
            </div>
         </article>
    </div>
</div>    

<div id="Settings" class="tabcontent">
    <h1></h1>
<section>
  <form class="" method="POST" action="userpage/settings/{$user->id}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div>
          <label for="firstname" class="">Name</label>
          <input  type="name" class="input" name="firstname" value="{{ $user->firstname or old('firstname') }}" required>
      </div>
      <div>
          <label for="surname" class="">Surname</label>
          <input  type="name" class="input" name="surname" value="{{ $user->surname or old('surname') }}" required>
      </div>
      <div>
        <label for="username" class="">Username</label>
        <input id="name" type="name" class="input" name="username" value="{{ $user->username or old('username') }}" required autofocus>
      </div>
      <div>
        <label for="email" class="">E-Mail Address</label>
        <input type="email" class="input" name="email" value="{{ $user->email or old('email') }}"required>
      </div>
      <div>
        <button type="submit" class="button is-primary">Update Info</button>
      </div>
  </form>
</section>
</div>
@include('layouts.footer')