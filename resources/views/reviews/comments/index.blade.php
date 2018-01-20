@include('layouts.header')
    <article>
    @foreach($comments as $comment)
        <div class="user-comment">
            <p class="review-date">{{ $comment->created_at }} &nbsp;</p>
            <p class="review-user">|&nbsp;&nbsp;by user: {{ $comment->user->username }}</p>
            <p class="comment-content">{{ $comment->body }}</p>
        </div>
        <section class="field" >
            <form class="control" method="POST" action="{{route('comments.update', [$comment->id])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3 class="label">Comment</h3>
            <input class="input" name="body"value="{{ $comment->body }}">
            <button class="button is-primary" type="submit">Submit</button>  
            </form>
        </section>
        @if($comment->status == 1)
            <section class="field">
                <form class="control" method="POST" action="{{route('comments.update', [$comment->id])}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <h3 class="label">Status: Approved</h3>
                <div class="select">
                    <select name="status">
                        <option value="1">Approved</option>
                        <option value="2">Pending</option>
                    </select>
                </div>
                <button class="button is-success" type="submit">Submit</button>   
                </form>
            </section>
        @else
            <section class="field">
                <form class="control" method="POST" action="{{route('comments.update', [$comment->id])}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <h3 class="label">Status: Pending</h3>
                <div class="select">
                    <select name="status">
                        <option value="2">Pending</option>
                        <option value="1">Approved</option>
                    </select>
                </div>
                <button class="button is-success" type="submit">Submit</button>   
                </form>
            </section>
        @endif
        <form class="control" method="POST" action="{{ route('comments.destroy', [$comment->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="button is-danger" type="submit">Delete</button>
        </form>
    @endforeach
    </article>
@include('layouts.footer')