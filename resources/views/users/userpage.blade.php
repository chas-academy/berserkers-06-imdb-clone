@include('layouts.header')
<h1 id="welcome-h1">Hello {{Auth::user()->username}}!</h1>
<!-- Tab links -->
<div class="tab">
    <form  method="GET"  action="/userpage">
        {{ csrf_field() }}
        <button class="tablinks" id="default-tab" type="submit">Home</button>
    </form>
    <form  method="GET"  action="/userpage/lists">
        {{ csrf_field() }}
        <button class="tablinks" type="submit">Lists</button>
    </form>
    <form  method="GET" action="/userpage/reviews">
        {{ csrf_field() }}
        <button class="tablinks" type="submit">Reviews</button>
    </form>
    <form  method="GET" action="/userpage/settings/{{Auth::user()->id}}">
        {{ csrf_field() }}
        <button class="tablinks" type="submit">Settings</button>
    </form> 
</div>
<!-- Tab content -->
<!--Home -->
<div id="Home" class="tabcontent">
   <!-- Latest Reviews -->
   <div id="latest-reviews">
      <h1 id="latest-title">Latest Reviews</h1>
      @if (isset(Auth::user()->reviews[0]))
        @foreach (Auth::user()->reviews as $key => $review)
            @if($key < 1)
            <article class="message is-primary">
                <div class="message-header">
                    <p>{{$review->title}}</p>
                </div>
                <div class="message-body">
                {{$review->body}}
                </div>
            </article>
            @endif
        @endforeach
      @endif
   </div>
   <!-- Watch-list-->
    <div class="watchlist-container">
        <h1 id="watchlist-title">My Watchlist</h1>
        @foreach (Auth::user()->lists as $list)
            @if($list->name == 'Watchlist')
                <div class="watchlist">
                    @foreach ($list->titleLists->sortBy('list_index') as $listItem)
                        <div class="watchlist-box">
                            <!-- Container -->
                            <figure class="image-container">
                                @foreach ($listItem->title->photos as $photo)
                                    @if($photo->width == '300' && $photo->photo_type == 'backdrop')
                                        <img class="box-img" src="{{$photo->photo_path}}">
                                    @endif
                                @endforeach
                            </figure>
                            <div class="box">
                                @switch($listItem->title->type)
                                    @case('movie')
                                        <p class="box-title">{{$listItem->title->movie->title}}</p>
                                        @break
                                    @case('series')
                                        <p class="box-title">{{$listItem->title->series->title}}</p>
                                        @break
                                    @case('episode')
                                        <p class="box-title">{{$listItem->title->episode->name}}</p>
                                        @break
                                @endswitch
                            </div>
                            <div class="field btn-container">
                                <form method="POST" action="/userpage/lists/{{$list->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="title_id" value="{{$listItem->title->id}}">
                                    <input type="hidden" name="old_list_index" value="{{$listItem->list_index}}">
                                    <select name="list_index">
                                        @foreach($list->titleLists->sortBy('list_index') as $titleListIndex)
                                        @if($listItem->list_index == $titleListIndex->list_index )
                                        <option value="{{$titleListIndex->list_index}}" selected="selected">{{$titleListIndex->list_index}}</option>
                                        @else 
                                        <option value="{{$titleListIndex->list_index}}" >{{$titleListIndex->list_index}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <button class="button is-primary" type="submit">Move Up/Move Down</button>
                                </form>
                                <form method="POST" action="/userpage/lists/{{$list->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <input type="hidden" name="title_id" value="{{$listItem->title->id}}">
                                    <input type="hidden" name="list_index" value="{{$listItem->list_index}}">
                                    <input type="hidden" name="remove" value="true">
                                    <button class="button is-danger" type="submit">Remove from List</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>
<!-- List Tab -->
<div id="Lists" class="tabcontent">
    <div class="lists">
        @if(isset($lists))
            @foreach ($lists as $list)
                <div class="list-container"> <!-- List Container -->
                    <h1 class="list-title">{{$list->name}}</h1>
                    <div class="watchlist">
                        @foreach ($list->titleLists->sortBy('list_index') as $listItem)
                            <div class="watchlist-box">
                                <!-- Container -->
                                <figure class="image-container">
                                    @foreach ($listItem->title->photos as $photo)
                                        @if($photo->width == '300' && $photo->photo_type == 'backdrop')
                                            <img class="box-img" src="{{$photo->photo_path}}">
                                        @endif
                                    @endforeach
                                </figure>
                                <div class="box">
                                    @switch($listItem->title->type)
                                        @case('movie')
                                            <p class="box-title">{{$listItem->title->movie->title}}</p>
                                            @break
                                        @case('series')
                                            <p class="box-title">{{$listItem->title->series->title}}</p>
                                            @break
                                        @case('episode')
                                            <p class="box-title">{{$listItem->title->episode->name}}</p>
                                            @break
                                    @endswitch
                                </div>
                                <div class="field is-grouped btn-container">
                                    <form method="POST" action="/userpage/lists/{{$list->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="hidden" name="title_id" value="{{$listItem->title->id}}">
                                        <input type="hidden" name="old_list_index" value="{{$listItem->list_index}}">
                                        <select name="list_index">
                                            @foreach($list->titleLists->sortBy('list_index') as $titleListIndex)
                                            @if($listItem->list_index == $titleListIndex->list_index )
                                            <option value="{{$titleListIndex->list_index}}" selected="selected">{{$titleListIndex->list_index}}</option>
                                            @else 
                                            <option value="{{$titleListIndex->list_index}}" >{{$titleListIndex->list_index}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button class="button is-primary" type="submit">Move Up/Move Down</button>
                                    </form>
                                    <form method="POST" action="/userpage/lists/{{$list->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="hidden" name="title_id" value="{{$listItem->title->id}}">
                                        <input type="hidden" name="list_index" value="{{$listItem->list_index}}">
                                        <input type="hidden" name="remove" value="true">
                                        <button class="button is-danger" type="submit">Remove from List</button>
                                    </form>
                                </div>  
                            </div>
                        @endforeach    
                    </div>
                    <form class="control card" method="POST" action="/userpage/lists/{{$list->id}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div>
                            <lable for="list_index">Placement in List: </lable>
                            <div class="select">
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
                            </div>
                        </div>
                        <div>
                            <lable for="type">Type: </lable>
                            <div class="select">
                                <select name="type">
                                    <option value="movie">Movie</option>
                                    <option value="series">Series</option>
                                    <option value="episode">Episode</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <lable for="name">Title: </lable>
                            <input  class="input" name="name" placeholder="title" required>
                        </div>
                        <button class="button is-primary" type="submit">Add to List</button>
                    </form>
                    <form class="control" method="POST" action="/userpage/lists/{{$list->id}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div>
                            <button class="button is-danger" type="submit">Delete List</button>
                        </div>
                    </form>
                </div>
            @endforeach
        @endif 
    </div>
    <div class="lists">
        <h2>Do you want to create a new list?</h2>
        <form method="GET" action="/userpage/lists/create">
            {{ csrf_field() }}
            <input name="name" placeholder="Name of your new list" required>
            <button class="button is-primary" type="submit">Create new List</button>
        </form>
    </div>
</div>
 <!-- reviews Tab --> 
<div id="Reviews" class="tabcontent">
    @if(isset(Auth::user()->reviews[0]))
        @foreach (Auth::user()->reviews as $review)
            <div class="text-container">
                @switch($review->getTitle->type)
                    @case('movie')
                        <h1 class="my-reviews">{{$review->getTitle->movie->title}}</h1>
                        @break
                    @case('series')
                        <h1 class="my-reviews">{{$review->getTitle->series->title}}</h1>
                        @break
                    @case('episode')
                        <h1 class="my-reviews">{{$review->getTitle->episode->name}}</h1>
                        @break
                @endswitch
                <article class="message is-primary">
                    <div class="message-header">
                        <p>{{$review->title}}</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        {{$review->body}}
                    </div>
                </article>
            </div>
        @endforeach
    @else 
    <div class="text-container">
        <h3>You haven't written any reviews yet</h3>
    </div>
    @endif   
    
</div>
<!-- Settings Tab --> 
<div id="Settings" class="tabcontent">
    <h1>Settings</h1>
    <section>
        <form method="POST" action="userpage/settings/{$user->id}">
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