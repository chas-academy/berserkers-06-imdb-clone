@include('layouts.header')
    @foreach($comments as $comment)
        <div class="user-comment">
            <p class="review-date">{{ $comment->created_at }} &nbsp;</p>
            <p class="review-user">|&nbsp;&nbsp;by user: {{ $comment->user->username }}</p>
            <p class="comment-content">{{ $comment->body }}</p>
        </div>
        <section>
            <form method="POST" action="{{route('comments.update', [$comment->id])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3>Comment</h3>
            <input name="body"value="{{ $comment->body }}">
            <button type="submit">Submit</button>  
            </form>
        </section>
        @if($comment->status == 1)
            <section>
                <form method="POST" action="{{route('comments.update', [$comment->id])}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <h3>Status: Approved</h3>
                <select name="status">
                    <option value="1">Approved</option>
                    <option value="2">Pending</option>
                </select>
                <button type="submit">Submit</button>   
                </form>
            </section>
        @else
            <section>
                <form method="POST" action="{{route('comments.update', [$comment->id])}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <h3>Status: Pending</h3>
                <select name="status">
                    <option value="2">Pending</option>
                    <option value="1">Approved</option>
                </select>
                <button type="submit">Submit</button>   
                </form>
            </section>
        @endif
        <form method="POST" action="{{ route('comments.destroy', [$comment->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">Delete</button>
        </form>
    @endforeach
@include('layouts.footer')