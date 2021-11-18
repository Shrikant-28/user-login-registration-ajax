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
    </head>
    <body>
        <div id="loader" class="lds-dual-ring hidden overlay"></div>

        @include('partials.nav')

        <div id="content">
            @yield('content')
        </div>

        @yield('jsExtend')
    </body>
</html>
