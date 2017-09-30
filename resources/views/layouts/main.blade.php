<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="376328505155-1kv7ipkgvb6nvilnhh2ubpbp9qm9u2lj.apps.googleusercontent.com">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300|Open+Sans:700" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/tipsy.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>

    <script>
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
                $('#logout-form').submit();
            });
        }

        function onLoad() {
            gapi.load('auth2', function() {
                gapi.auth2.init();
            });
        }
    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <p class="brand-name">Sudhaar</p>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right right-navbar">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"> @if (session('language') == 'hi') {{'लॉग इन करें'}} @else {{'Login'}} @endif </a></li>
                    <li><a href="{{ route('register') }}"> @if (session('language') == 'hi') {{'साइन अप करें'}} @else {{'Sign up'}} @endif </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @if (session('language') == 'hi') {{'भाषा'}} @else {{'Language'}} @endif <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/en" name="en">English (EN)</a>
                            </li>
                            <li>
                                <a href="/hi" name="en">हिंदी (HI)</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/"> @if (session('language') == 'hi') {{'घर'}} @else  {{'Home'}} @endif </a>
                            </li>
                            <li>
                                <a href="{{route('home')}}"> @if (session('language') == 'hi') {{'डैशबोर्ड'}} @else {{'Dashboard'}} @endif </a>
                            </li>
                            <li>
                                <a href="{{route('document')}}"> @if (session('language') == 'hi') {{'एक केस जोड़ें'}} @else {{'Add a case'}} @endif </a>
                            </li>
                            <li>
                                <a href="{{route('report')}}"> @if (session('language') == 'hi') {{'सभी मामलों को देखें'}} @else {{'View all cases'}} @endif </a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}"
                                   onclick="signOut()">
                                    @if (session('language') == 'hi') {{'लोग आउट'}} @else {{'Log out'}} @endif
                                    <form id="logout-form" method="POST" action="{{route('logout')}}" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            @if (session('language') == 'hi') {{'भाषा'}} @else {{'Language'}} @endif <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/en" name="en">English (EN)</a>
                            </li>
                            <li>
                                <a href="/hi" name="en">हिंदी (HI)</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@yield('body')
</body>
</html>