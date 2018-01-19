@include('layouts.header')
    @foreach($reviews as $review)
        <div class="review-content">
            <div class="title-container">
                <h2 class="review-title">{{ $review->title }}</h2>
                @for($i=0;$i<$review->stars;$i++)
                    <i class="fa fa-2x fa-star" aria-hidden="true"></i>
                @endfor
            </div>
            <div class="user-container">
                <p class="review-date">{{ $review->created_at }} &nbsp;</p>
                <p class="review-user">|&nbsp;&nbsp;by user: {{ $review->user->username }}</p>
            </div>
            <p class="review-text">{{ $review->body }}</p>
        </div>
        <form method="POST" action="{{ route('reviews.destroy', [$review->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @if($review->status == 1)
                <label>Status: Approved</label>
            @else
                <label>Status: Pending</label>
            @endif
            <button type="submit">Delete</button>
        </form>
    @endforeach
@include('layouts.footer')