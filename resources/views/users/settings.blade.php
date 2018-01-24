@include('layouts.header')
<section>
  <form class="" method="POST" action="{{$user->id}}">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div>
          <label for="firstname" class="">Name</label>
          <input  type="name" class="input" name="firstname" value="{{ $user->firstname or old('firstname') }}" required>
      </div>
      <div>
          <label for="surname" class="">Surname</label>
          <input  type="name" class="input" name="surname" value="{{ $user->surname or old('surname') }}" required>
      </div>
      <div>
        <label for="username" class="">Username</label>
        <input id="name" type="name" class="input" name="username" value="{{ $user->username or old('username') }}" required autofocus>
      </div>
      <div>
        <label for="email" class="">E-Mail Address</label>
        <input type="email" class="input" name="email" value="{{ $user->email or old('email') }}"required>
      </div>
      <div>
        <button type="submit" class="button is-primary">Update Info</button>
      </div>
  </form>
</section>
@include('layouts.footer')
