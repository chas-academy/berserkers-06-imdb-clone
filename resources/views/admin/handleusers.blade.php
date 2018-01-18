@include('layouts.header')
  <article class="handleusers-list">
    <section>
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Update</th>
          </tr>
        </thead>
    @foreach ($users as $user) 
      <tbody>
        <tr>
          <td>{{$user->firstname}}</td>
          <td>{{$user->surname}}</td>
          <td>{{$user->username}}</td>
          <td>{{$user->email}}</td>
          <td>
            <form method="POST" action="/admin/users/{{$user->id}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="select">
                  <select name="role">
                    @if($user->role == 1)
                      <option value="0">Deleted User</option>
                      <option selected="selected" value="1">Admin</option>
                      <option value="2">User</option>
                    @elseif ($user->role == 2)
                      <option value="0">Deleted User</option>
                      <option  value="1">Admin</option>
                      <option selected="selected" value="2">User</option>
                    @else ($user->role == 0)
                      <option selected="selected" value="0">Deleted User</option>
                      <option  value="1">Admin</option>
                      <option  value="2">User</option>
                    @endif
                  </select>
                </div>
                </td>
                <td>
                <button class="button is-primary" type="submit">Update User Status</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </section>
  </article>

  
@include('layouts.footer')
