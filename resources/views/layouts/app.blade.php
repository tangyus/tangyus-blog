<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
            {{--@yield('content')--}}
            <ul class="list-group">
                <li class="list-group-item" style="margin-bottom: 30px; border: none; border-bottom: 1px solid #dadada;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h1>Hello, world!</h1>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </li>
                <li class="list-group-item" style="margin-bottom: 30px; border: none; border-bottom: 1px solid #dadada;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h1>Hello, world!</h1>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </li>
                <li class="list-group-item" style="margin-bottom: 30px; border: none; border-bottom: 1px solid #dadada;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h1>Hello, world!</h1>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </li>
                <li class="list-group-item" style="margin-bottom: 30px; border: none; border-bottom: 1px solid #dadada;">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <h1>Hello, world!</h1>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p>...1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111</p>
                            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        @include('layouts.footer')
    </div>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>