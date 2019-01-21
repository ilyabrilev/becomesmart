<!DOCTYPE html>
<html lang="en">
<head>

    <title>Become Smart</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- stylesheets css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>

</head>
<body>

<!-- Navigation section -->
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a href="{{url('/')}}" class="navbar-my-icon">Become Smart</a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMain">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMain" class="navbar-menu">
            <div class="navbar-end">
                <!-- Authentication Links -->
                @guest
                    <a class="navbar-item" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="navbar-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="navbar-dropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<div class="container">
    @include('layouts.partials._alert')
</div>

@yield('content')

<!-- Copyright section -->
<section id="copyright">
    <div class="container">
        <div class="">
            <p>Copyright © 2018 Whatever Company - Designed by <a class="designed-by" href="https://plus.google.com/+Tooplate/" target="_blank">Tooplate</a></p>
        </div>
    </div>
</section>

<script src="{{asset('js/app.js')}}"></script>

<script>
    linkForMore = "{{url('/api/random')}}";
</script>

</body>
</html>