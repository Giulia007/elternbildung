<!DOCTYPE html>
<link rel="alternate" href="{{url()->current()}}" hreflang="de-at">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>

        @yield('title')

    </title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/_tablepress_default.css') }}" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>

    @include('layouts.header')

    <div class="container">

        @if (session('status'))
            <div class="alert alert-primary mt-4">
                {{ session('status') }}
            </div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('code') }} mt-4">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif

        @yield('content')

    </div>

    @yield('bottom')

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/comments.js') }}"></script>
    <script src="{{ asset('js/accordion.js') }}"></script>


    @include('layouts.footer')

</body>
</html>
