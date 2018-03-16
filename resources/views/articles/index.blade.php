@extends('layouts.app')

@section('content')
    <div class="row" style="border-top: 1px solid rgb(211, 224, 233); min-height: 790px">
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
                            <div class="col-md-8" style="margin-top: 10px;">
                                <h3 class="title">
                                    <a href="{{ $article->link() }}" title="{{ $article->title }}">{{ $article->title }}</a>
                                </h3>
                                <div class="content">
                                    {!! $article->content !!}
                                </div>
                            </div>
                            <div class="col-md-8 publish-time">
                                <p>
                                    发布于<span class="category">{{ $article->published_at->toDateString() }}</span>
                                    浏览数<span class="category">{{ $article->view_count + cache('article_view_count_' . $article->id) }}</span>
                                    分类<a class="category" href="{{ route('categories', $article->category->id) }}" title="{{ $article->category->name }}" target="_blank">{{ $article->category->name }}</a>
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
