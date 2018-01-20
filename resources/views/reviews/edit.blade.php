@include('layouts.header')
    <section>
        <form method="POST" action="{{route('reviews.update', [$review->id])}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Title</h3>
        <input name="title"value="{{ $review->title }}">
        <button type="submit">Submit</button>  
        </form>
    </section>
    <section>
        <form method="POST" action="{{route('reviews.update', [$review->id])}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Review</h3>
        <textarea name="body">{{ $review->body }}</textarea>
        <button type="submit">Submit</button>   
        </form>
    </section>
    <section>
        <form method="POST" action="{{route('reviews.update', [$review->id])}}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <h3>Title ID</h3>
        <input name="title_id"value="{{ $review->title_id }}">
        <button type="submit">Submit</button>   
        </form>
    </section>
    @if($review->status == 1)
        <section>
            <form method="POST" action="{{route('reviews.update', [$review->id])}}">
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
            <form method="POST" action="{{route('reviews.update', [$review->id])}}">
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
    <form method="POST" action="{{ route('reviews.destroy', [$review->id]) }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit">Delete</button>
    </form>
@include('layouts.footer')