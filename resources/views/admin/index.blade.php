<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token()  }}">

    <title>@yield('title', 'tangyus') - tangyus</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}"
        }

        window.User = {!! Auth::user() !!}

                window.Language = "{{ config('app.locale') }}"
    </script>
</head>
<body>
    <div id="app">

    </div>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
    {{--<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>--}}
</body>
</html>