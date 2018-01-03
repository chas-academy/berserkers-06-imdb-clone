@include('layouts.header')

<!-- extends('layouts.app')

section('content')-->
<!-- div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div-->
<!-- endsection -->

<div class="container" id="reg-container">

    <h2 id="reg-h2">We are happy to have you here! Please fill out the following lines:</h2>

    <!-- Form -->

    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="field">
        <p class="control has-icons-left">
            <input class="input is-hovered" type="text" placeholder="Username">
            <span class="icon is-small is-left">
            <i class="fa fa-user"></i>
            </span>
        </p>
        </div>
        <div class="field">
        <p class="control has-icons-left has-icons-right">
            <input class="input is-hovered" type="email" placeholder="Email">
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
            <input class="input is-hovered" type="password" placeholder="Password">
            <span class="icon is-small is-left">
            <i class="fa fa-lock"></i>
            </span>
        </p>
        </div>
        <div class="field">
        <p class="control has-icons-left">
            <input class="input is-hovered" type="password" placeholder="Confirm Password">
            <span class="icon is-small is-left">
            <i class="fa fa-lock"></i>
            </span>
        </p>
        </div>

    <!-- Buttons -->

        <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <a class="button is-primary" type="submit">
            Submit
            </a>
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

