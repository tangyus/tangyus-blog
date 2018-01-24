@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="errors" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>

                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">邮箱地址</label>

                                <div class="col-md-6">
                                    <input id="username" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="login">
                                        登录
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        忘记密码?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#login').click(function () {
                event.preventDefault();

                var username = $('#username').val();
                var password = $('#password').val();
                $.ajax({
                    type: 'post',
                    url: '/login',
                    dataType: 'json',
                    data: {
                        email: username,
                        password: password
                    },
                    success: function (response) {
                        if (response.status && response.data) {
                            window.localStorage.token_type = response.data.token.token_type;
                            window.localStorage.access_token = response.data.token.access_token;

                            window.location.href = '/';
                        } else {
                            if (response.data.errors) {
                                for (var i in response.data.errors) {
                                    $('#errors ul').append('<li>'+ response.data.errors[i] +'</li>');
                                }
                                $('#errors').css('display', 'block');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
