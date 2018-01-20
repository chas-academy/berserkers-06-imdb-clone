@include('layouts.header')
<section class="custom-form">
    <form class="field" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email" class="label">Email</label>
        <div class="control has-icons-left">
            <input type="email" class="input has-icons-left is-hovered" name="email" value="{{ $email or old('email') }}" required autofocus>
            <span class="icon is-small is-left">
                <i class="fa fa-envelope"></i>
            </span>
        </div>
        <label for="password" class="label">Password</label>  
        <div class="control has-icons-left">      
            <input type="password" class="input is-hovered" name="password" required>
            <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
            </span>
        </div>
        <label for="password-confirmation" class="label">Confirm Password</label>
        <div class="control has-icons-left ">
            <input type="password" class="input is-hovered" name="password_confirmation" required>
            <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
            </span>   
        </div>
        <button type="submit" class="button is-success">Reset Password</button>
    </form>
</section>
@include('layouts.footer')
