<nav class="navbar navbar-default" id="header">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/" title="tangyus">tangyus</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/" title="tangyus">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ route('archive') }}" title="文章归档">文章归档</a></li>
                {{--<li><a href="#" title="学习笔记">学习笔记</a></li>--}}
                {{--<li><a href="{{ route('categories') }}" title="文章分类">文章分类</a></li>--}}
                <li><a href="{{ route('links') }}" title="友情链接">友情链接</a></li>
                {{--<li><a href="{{ route('about') }}" title="关于我">关于我</a></li>--}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="https://fsdhubcdn.phphub.org/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/60/h/60" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::user()->is_admin)
                            <li>
                                <a href="{{ route('admin') }}">后台管理</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="你想找点什么?">
                </div>
            </form>
        </div>
    </div>
</nav>