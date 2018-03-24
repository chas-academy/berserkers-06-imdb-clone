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
    @foreach ($comments as $comment) 
      <tbody>
        <tr>
          <td>{{$comment->user->username}}</td>
          <td>{{$comment->review->title->id}}</td>
          <td>{{$comment->review->title}}</td>
          <td>{{$comment->body}}</td>
          <td>
            <form method="POST" action="/admin/users/{{$comment->id}}">
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