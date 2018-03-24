@include('layouts.header')
  <article class="handleusers-list">
    <section>
      <form method="POST" action="/admin/users" class="create-user-form">
        {{ csrf_field() }}
        <input class="input" name="firstname" placeholder="firstname" required/>
        <input class="input" name="surname" placeholder="surname" required/>
        <input class="input" name="username" placeholder="username" required/>
        <input class="input" type="email" name="email" placeholder="email" required/>
        <input class="input" minlength="6" name="password" placeholder="password" required/>
        <div class="select">
          <select name="role" required>
            <option value="0">Deactivated</option>
            <option value="1">Admin</option>
            <option selected="selected" value="2">User</option>
          </select>
        </div>
        <button class="button is-primary" type="submit">Add User</button>                
      </form>
      <table class="table is-hoverable">
        <thead>
          <tr>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Email</th>
            <th>New Password</th>
            <th>Role</th>
            <th>Update</th>
          </tr>
        </thead>
    @foreach ($users as $user) 
      <tbody>
        <form method="POST" action="/admin/users/{{$user->id}}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <tr>
            <td><input class="input" name="firstname" value="{{$user->firstname}}"/></td>
            <td><input class="input" name="surname" value="{{$user->surname}}"/></td>
            <td><input class="input" name="username" value="{{$user->username}}"/></td>
            <td><input class="input" type="email" name="email" value="{{$user->email}}"/></td>
            <td><input class="input" type="password" minlength="6" name="password" placeholder="fill to change password else leave blank"/></td>
            <td>
                <div class="select">
                    <select name="role">
                      @if($user->role == 1)
                        <option value="0">Deactivated</option>
                        <option selected="selected" value="1">Admin</option>
                        <option value="2">User</option>
                      @elseif ($user->role == 2)
                        <option value="0">Deactivated</option>
                        <option  value="1">Admin</option>
                        <option selected="selected" value="2">User</option>
                      @else ($user->role == 0)
                        <option selected="selected" value="0">Deactivated</option>
                        <option  value="1">Admin</option>
                        <option  value="2">User</option>
                      @endif
                    </select>
                  </div>
                  </td>
                  <td>
                  <button class="button is-primary" type="submit">Update User</button>                
                </td>
              </tr>
            </form>
          @endforeach
        </tbody>
      </table>
    </section>
  </article>

  
@include('layouts.footer')
