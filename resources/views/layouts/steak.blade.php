<!DOCTYPE html>
<html lang="en">
<head>

    <title>Become Smart</title>
    <!--

    Template 2083 Steak House

    http://www.tooplate.com/view/2083-steak-house

    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- stylesheets css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/nivo_themes/default/default.css')}}">

    <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<!-- Preloader section -->
<div class="preloader">
    <div class="sk-spinner sk-spinner-pulse"></div>
</div>

<!-- Navigation section -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <a href="{{url('/')}}" class="navbar-brand">Become Smart</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
            @endguest
            <!--
				<li><a href="#top" class="smoothScroll">Home</a></li>
				<li><a href="#feature" class="smoothScroll">Features</a></li>
				<li><a href="#about" class="smoothScroll">About</a></li>
				<li><a href="#menu" class="smoothScroll">Menu</a></li>
				-->
            </ul>
        </div>

    </div>
</div>

<div class="container">
    @include('layouts.partials._alert')
</div>

@yield('content')

<!-- Copyright section -->
<section id="copyright">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-sm-8 col-xs-8">
                <p>Copyright © 2018 Whatever Company - Designed by <a class="designed-by" href="https://plus.google.com/+Tooplate/" target="_blank">Tooplate</a></p>
            </div>
        </div>
    </div>
</section>

<!-- javscript js -->
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>

<script src="{{asset('js/jquery.sticky.js')}}"></script>
<script src="{{asset('js/jquery.backstretch.min.js')}}"></script>

<script src="{{asset('js/isotope.js')}}"></script>
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<script src="{{asset('js/nivo-lightbox.min.js')}}"></script>

<script src="{{asset('js/jquery.flexslider-min.js')}}"></script>

<script src="{{asset('js/jquery.parallax.js')}}"></script>
<script src="{{asset('js/smoothscroll.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>

<script>
    linkForMore = "{{url('/api/random')}}";
</script>

</body>
</html>