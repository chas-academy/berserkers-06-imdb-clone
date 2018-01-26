@include('layouts.header')
    <article>
        <section class="field">
            <form class="control" method="POST" action="{{route('reviews.update', [$review->id])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3 class="label">Title</h3>
            <input class="input"name="title"value="{{ $review->title }}">
            <button class="button is-primary"type="submit">Submit</button>  
            </form>
        </section>
        <section class="field">
            <form class="control" method="POST" action="{{route('reviews.update', [$review->id])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3 class="label">Review</h3>
            <textarea class="textarea" name="body">{{ $review->body }}</textarea>
            <button class="button is-primary"type="submit">Submit</button>   
            </form>
        </section>
        <section class="field">
            <form  class="control"method="POST" action="{{route('reviews.update', [$review->id])}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <h3 class="label">Title ID</h3>
            <input class="input" name="title_id"value="{{ $review->title_id }}">
            <button class="button is-primary"type="submit">Submit</button>   
            </form>
        </section>
        @if($review->status == 1)
            <section class="field">
                <form class="control" method="POST" action="{{route('reviews.update', [$review->id])}}">
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
                <form class="control" method="POST" action="{{route('reviews.update', [$review->id])}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <h3 class="label">Status: Pending</h3>
                <div class="select">
                    <select class="select" name="status">
                        <option value="2">Pending</option>
                        <option value="1">Approved</option>
                    </select>
                </div>
                <button class="button is-sucesss" type="submit">Change Status</button>   
                </form>
            </section>
        @endif
        <form  class="control" method="POST" action="{{ route('reviews.destroy', [$review->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="button is-danger"type="submit">Delete Review</button>
        </form>
    </article>
@include('layouts.footer')