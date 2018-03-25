@include('layouts.header')
  <article class="handleusers-list">
    <section>
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Create By</th>
            <th>Comment On</th>
            <th>Commented Review Of</th>
            <th>Body</th>
            <th>Status</th>
            <th>Update</th>
          </tr>
        </thead>
      <tbody>
        @foreach ($comments as $comment) 
        <tr>
          <td>{{$comment->user->username}}</td>
          <td>{{$comment->review->title}}</td>
          @if($comment->review->getTitle->type === 'movie')
          <td>{{$comment->review->getTitle->movie->title}}</td>
          @elseif($comment->review->getTitle->type === 'series')
          <td>{{$comment->review->getTitle->series->title}}</td>)
          @elseif($comment->review->getTitle->type === 'episode')
          <td>{{$comment->review->getTitle->episode->name}}</td>)
          @endif
          <td><textarea class="textarea" readonly> {{$comment->body}}</textarea></td>
          <td>
            <form method="POST" action="/admin/comments/{{$comment->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="select">
                  <select name="status">
                    @if($comment->status == 0)
                      <option selected="selected" value="0">Not Aproved</option>
                      <option  value="1">Approved</option>
                      <option value="2">Peeding Aproval</option>
                    @elseif ($comment->status == 2)
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