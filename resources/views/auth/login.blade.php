@extends('layouts.main')

@section('body')
    <div class="popup">
        <div class="success"></div>
        <div class="a1">
            <div class="a2">
                <div class="a3">
                    <div class="a4">
                        <div class="a5">
                            <!-- Image credits: Pedro luis romani ruiz -->
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Pedro_luis_romani_ruiz.gif">
                            <p>Redirecting. <br />Please wait...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading main-title">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-input-text" name="email" value="{{ old('email') }}" required autofocus>

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
                                <input id="password" type="password" class="form-control form-input-text" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="create-button">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <p class="main-title">Or, login with Google</p>
            </div>
            <div class="col-md-4 col-md-push-5 text-center">
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
        </div>
    </div>
</div>
    <script>
        function onSignIn(googleUser) {
            $('.popup').fadeIn();
            var token = googleUser.getAuthResponse().id_token;
            var data = {
                'id_token' : googleUser.getAuthResponse().id_token,
                '_token'   : $('input[name="_token"]').val()
            };
            $.ajax({
                url : '/googlesignin',
                type : 'POST',
                data : data
            })
                .done(function (data) {
                    window.location.href = '/home';
                })
                .fail(function (data) {
                   console.log(data);
                });
        }
    </script>
@endsection
