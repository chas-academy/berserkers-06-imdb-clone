@include('layouts.header')

<div class="container" id="reg-container">

    <h2 id="reg-h2">We are happy to have you here! Please fill out the following lines:</h2>

    <!-- Form -->

    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="field">
            <p class="control has-icons-left">
                <input class="input is-hovered" type="text" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required>
                <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input is-hovered" type="text" name="surname" placeholder="Surname" value="{{ old('surname') }}" required>
                <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input is-hovered" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
                <span class="icon is-small is-left">
                <i class="fa fa-user"></i>
                </span>
            </p>
        </div>
        <div class="field">
        <p class="control has-icons-left has-icons-right">
                <input class="input is-hovered" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="icon is-small is-left">
                <i class="fa fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fa fa-check"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input is-hovered" type="password" name="password" placeholder="Password"  minlength="6"required>
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input is-hovered" type="password" name="password_confirmation" placeholder="Confirm Password" minlength="6" required>
                <span class="icon is-small is-left">
                <i class="fa fa-lock"></i>
                </span>
            </p>
        </div>

    <!-- Buttons -->

        <div class="field is-grouped is-grouped-centered">
            <p class="control">
                <button class="button is-primary" type="submit">
                Submit
                </button>
            </p>
            <p class="control">
                <a class="button is-light" type="submit" href="/">
                Cancel
                </a>
            </p>
        </div>
    </form>
</div>

@include('layouts.footer')

