<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reembolso</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylesheet.css') }}" rel="stylesheet">
    @yield('stylecss')
</head>
<body class="bg-dark"> 
    <div id="app">
        @include('templates.navbar')
        @yield('content')
    </div>
    <!-- Scripts -->
    @yield('javascript')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>