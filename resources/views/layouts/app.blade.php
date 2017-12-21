<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="position: relative; min-height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token()  }}">

    <title>@yield('title', 'tangyus') - tangyus</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        @include('layouts.header')

        <div class="container">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <script type="text/javascript" src="{{ mix('js/home.js') }}"></script>
</body>
</html>