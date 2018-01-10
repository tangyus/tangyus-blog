@extends('layouts.app')

@section('content')
    <div id="links" class="row" style="border-top: 1px solid rgb(0, 181, 173)">
        @if(count($links) > 0)
            <h4>友情链接</h4>
            <div class="link-item col-md-6">
                @foreach($links as $link)
                    <span><a href="{{ $link->site }}" target="_blank" title="{{ $link->name }}">{{ $link->name }}</a></span>
                @endforeach
            </div>
        @endif
        @if(count($errors) > 0)
            <div class="alert alert-danger col-md-8 alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('message'))
            <div class="alert alert-success col-md-8 alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="/links/exchange" method="post">
            {{ csrf_field() }}
            <div class="form-group col-md-8">
                <label for="blog_name">博客名称</label>
                <input type="text" class="form-control" id="blog_name" name="blog_name" value="{{ old('blog_name') }}" placeholder="请输入您的博客名称">
            </div>
            <div class="form-group col-md-8">
                <label for="blog_site">站点网址</label>
                <input type="text" class="form-control" id="blog_site" name="blog_site" value="{{ old('blog_site') }}" placeholder="请输入您的站点网址">
            </div>
            <div class="form-group col-md-8">
                <label for="email">邮箱</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="请输入您的邮箱">
            </div>
            <div class="form-group col-md-8">
                <label for="message">留言</label>
                <textarea class="form-control" rows="3" name="message" value="{{ old('message') }}" placeholder="提交友链信息或联系我互换友链，如有其他建议请留言..."></textarea>
            </div>
            <div class="form-group col-md-8">
                <button type="submit" class="btn btn-default" style="width: 100px;">提交</button>
            </div>
        </form>
    </div>
@endsection