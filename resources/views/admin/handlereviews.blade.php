@include('layouts.header')
  <article class="handleusers-list">
    <section>
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Create By</th>
            <th>Review of</th>
            <th>Title</th>
            <th>Body</th>
            <th>Status</th>
            <th>Update</th>
          </tr>
        </thead>
      <tbody>
        @foreach ($reviews as $review) 
        <tr>
          <td>{{$review->user->username}}</td>
          @if($review->getTitle->type === 'movie')
          <td>{{$review->getTitle->movie->title}}</td>
          @elseif($review->getTitle->type === 'series')
          <td>{{$review->getTitle->series->title}}</td>
          @elseif($review->getTitle->type === 'episode')
          <td>{{$review->getTitle->episode->name}}</td>
          @endif
          <td>{{$review->title}}</td>
          <td><textarea class="textarea" readonly> {{$review->body}}</textarea></td>
          <td>
            <form method="POST" action="/admin/reviews/{{$review->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="select">
                  <select name="status">
                    @if($review->status == 0)
                      <option selected="selected" value="0">Not Aproved</option>
                      <option  value="1">Approved</option>
                      <option value="2">Peeding Aproval</option>
                    @elseif ($review->status == 2)
                    <option value="0">Not Aproved</option>
                    <option  value="1">Approved</option>
                    <option selected="selected" value="2">Peeding Aproval</option>
                    @endif
                  </select>
                </div>
                </td>
                <td>
                <button class="button is-primary" type="submit">Update</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </article>

  
@include('layouts.footer')