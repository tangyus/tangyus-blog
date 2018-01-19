@extends('layouts.app')

@section('content')
    <div id="categories" class="row">
        @foreach($categories as $category)
            <div class="category-item col-md-3">
                <div class="title">
                    <p class="name">
                        <a href="{{ route('categories', $category->id) }}" title="{{ $category->name }}">{{ $category->name }}</a>
                        <span class="badge" title="3">{{ $category->article_count }}</span>
                    </p>
                    <p class="desc">{{ $category->desc }}</p>
                </div>
                <div class="tags">
                    @if(count($category->tags) > 0)
                        @foreach($category->tags as $tag)
                            <span><a href="javascript:void(0)" title="{{ $tag->name }}"># {{ $tag->name }}</a></span>
                        @endforeach
                    @else
                        <span><a href="javascript:void(0)">暂无标签</a></span>
                    @endif
                </div>
            </div>
        @endforeach

        @if(count($articles) > 0)
            <div class="col-md-12" style="margin-top: 40px;">
                <h4>文章列表</h4>
                @foreach($articles as $article)
                    <div class="category-article">
                        <p class="title">
                            <a href="{{ $article->link() }}" title="{{ $article->title }}">{{ $article->title }}</a>
                        </p>
                        <div class="content">
                            {!! $article->content !!}
                        </div>
                    </div>
                @endforeach

                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection