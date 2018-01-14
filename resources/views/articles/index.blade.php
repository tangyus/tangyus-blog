@extends('layouts.app')

@section('content')
    <div class="row" style="border-top: 1px solid #00b5ad; min-height: 790px">
        <div class="col-md-9" id="article">
            <ul class="list-group">
                @foreach($articles as $article)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 article-img">
                                <a href="{{ $article->link() }}">
                                    @if($article->article_image)
                                        <img src="{{ asset($article->article_image) }}" width="100%" height="100%">
                                    @else
                                        <img src="{{ asset('image/demo1.jpg') }}" width="100%" height="100%">
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-8">
                                <h2 class="title">
                                    <a href="{{ $article->link() }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h2>
                                <div class="content">
                                    {!! $article->content !!}
                                </div>
                            </div>
                            <div class="col-md-8 publish-time">
                                <p>
                                    发布于：<span>{{ $article->published_at }}</span>
                                    阅读：<span>{{ $article->view_count }}</span>
                                    <a class="btn btn-primary btn-sm pull-right" href="{{ $article->link() }}" role="button" style="color: #fff;">阅读更多</a>
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{ $articles->links() }}
        </div>

        <div class="col-md-2 col-md-offset-1" id="sidebar">
            @include('layouts.sidebar')
        </div>
    </div>
@endsection