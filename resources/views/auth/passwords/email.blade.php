@include('layouts.header')
<section class="custom-form">
    <form class="field" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <label for="email" class="label">E-Mail Address</label>
        <div class="control has-icons-left">
            <input type="email" class="input" name="email" value="{{ old('email') }}" required>
            <span class="icon is-small is-left">
                    <i class="fa fa-envelope"></i>
            </span>
        </div>
        <button type="submit" class="button is-primary">Send Password Reset Link</button>
    </form>
</section>
@include('layouts.footer')
