<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/icofont.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/main.css') }}" >
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/login.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/fonts/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" />
<body>
<div class="overlay">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{URL::asset('/assets/img/img-01.png')}}" alt="IMG">
                    <h2>Nutrife Management System</h2>
                </div>

                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
					<span class="login100-form-title">
						 Login
					</span>

                    <div class="wrap-input100">
                        <input class="input100"  placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">

							<i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>

                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
             @enderror
             
                    <div class="wrap-input100 ">
                        <input class="input100"  placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button  type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    {{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
                        </span>
                        @if (Route::has('password.request'))
                        <a class="txt2"href="{{ route('password.request') }}">
                            Username / Password?
                        </a>
                        @endif
                    </div> --}}
                </form>
            </div>
        </div>
    </div>



</div>
<link href="{{ asset('assets/js/bootstrap.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/js/jquery.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/js/main.js') }}" rel="stylesheet">

</body>
</html>
