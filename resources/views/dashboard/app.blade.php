<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Font -->
        <!-- Including the bootstrap CDN -->
        {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
        {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
        {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
        <script src="{{asset('assets/bootstrap/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{asset('assets/style.css')}}">

        <!--  Multi select dropdown js / css -->
        <link href="{{ asset('assets/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
        <script src="{{asset('assets/bootstrap-select/js/bootstrap-select.min.js')}}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var APP_URL = "<?php echo url('/'); ?>";
        </script>

        @yield('cssExtend')
    </head>
    <body>
        <div id="loader" class="lds-dual-ring hidden overlay"></div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register-user-list') }}">Register User</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a href="{{url('dashboard/my-profile')}}" class="dropdown-item" >Profile</a> --}}

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>

                        </li>

                    @endguest


                </ul>
            </div>
        </nav>


        <div id="content" class="dashboard-content">
            @yield('content')
        </div>

        @yield('jsExtend')
    </body>
</html>
