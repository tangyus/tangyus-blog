@extends('layouts.app')

@section('content')
    <div class="row" style="border-top: 1px solid #d3e0e9;">
        <div class="col-md-9" id="article-detail">
            <div class="article-desc">
                <h3>{{ $article->title }}</h3>
                <p>
                    发表于:
                    <span>
                        {{ $article->published_at }}
                    </span>
                    <span>分类:</span>
                    <a href="#">{{ $article->category->name }}</a>
                    <span>标签:</span>
                    @foreach($tags as $tag)
                        <a href="#"># {{ $tag->name }}</a>
                    @endforeach
                </p>
            </div>
            <div class="image-block">
                <img src="{{ asset($article->article_image) }}" alt="" width="100%" height="100%">
            </div>
            <div>
                {!! $article->content !!}
            </div>
        </div>

        <div class="col-md-2 col-md-offset-1" id="sidebar">
            @include('layouts.sidebar')
        </div>
    </div>
@endsection