<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token()  }}">

    <title>tangyug个人博客 - @yield('title', '首页')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}"
        }
    </script>
</head>
<body>
    <div id="app">
        @include('layouts.header')

        <div class="container">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script type="text/javascript" src="{{ mix('js/home.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#header input').on('click', function () {
                $(this).animate({'width': '250px'}, 'slow');
            });
            $('#header input').on('blur', function () {
                $(this).animate({'width': '180px'}, 'slow');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>