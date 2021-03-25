<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/icofont.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/main.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/leads.css') }}" />

</head>
<body>

<div class="system-control">
    <div class="logo">
        <h2>Nutrife</h2> <i id="menu-colapse" class="icofont-navigation-menu"></i>
        <i id="menu-excentend" class="icofont-navigation-menu"></i>
    </div>
    <div class="links">
        <ul>
            <li class="{{(request()->is('home')) ? 'active' : '' }}">
                <a href="{{url('/home')}}"><i class="icofont-dashboard"></i> <span>Dashboard</span> </a>
            </li>
            <li class="{{ (request()->is('/')) ? 'active' : '' }} " >
                <a href="{{url('/')}}"> <i class="icofont-users-alt-5"></i> <span>Leads</span> </a>
            </li>
            <li class="{{ (request()->is('shippings')) ? 'active' : '' }} " >
                <a href="{{url('/shippings')}}"><i class="icofont-fast-delivery"></i> <span>Shipping</span> </a>
            </li>
            @can('manage-users')
            <li class="{{ ( request()->is('admin/users') || request()->is('admin/users/*/edit') || request()->is('admin/users/create') ) ? 'active' : '' }}" >
                <a href="{{route('admin.users.index')}}">  <i class="icofont-ui-settings"></i> <span>Users</span> </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
<div class="system-body">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    {{--                            <a class="nav-link" href="/">Leads</a>--}}
                </li>
            </ul>
            <ul class="navbar-nav mr-auto user-account">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
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
            </ul>

        </div>
    </nav>

    <section class="body-yeild">
        @yield('content')
    </section>
</div>




<link href="{{ asset('assets/js/bootstrap.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/js/jquery.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/js/main.js') }}" rel="stylesheet">
<script>

    $( '#menu-colapse' ).click(function() {
        $('.system-control').css('width','5%');
        $('.system-body').css('width','95%');
        $(this).css('display','none');
        $('#menu-excentend').css('display','block');
        $('#menu-excentend').css('right','20px');
        $('#menu-excentend').css('font-size','24px');
        $('.logo h2').css('opacity','0');
        $('.links ul li a span').fadeOut(0);
        $('.links ul li a i').css('font-size','25px');
    });
    $('#menu-excentend').click(function() {
        $('.system-control').css('width','17%');
        $('.system-body').css('width','83%');
        $(this).css('display','none');
        $(this).css('font-size','20px');
        $('#menu-colapse').css('display','block');
        $('.logo h2').css('opacity','1');
        $('.links ul li a span').delay(500).fadeIn( 400 );
        $('.links ul li a i').css('font-size','17px');
    });
</script>
</body>
</html>
