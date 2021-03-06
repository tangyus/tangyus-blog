@section('title')
    {{ $article->title }}
@endsection

@extends('layouts.app')

@section('content')
    <div class="row" style="border-top: 1px solid #d3e0e9;">
        <div class="col-md-9" id="article-detail">
            <div class="article-desc">
                <h3>{{ $article->title }}</h3>
                <p>
                    发表于<span>{{ $article->published_at }}</span>
                    <span>分类</span>
                    <a href="{{ route('categories', $article->category->id) }}"
                       title="{{ $article->category->name }}">{{ $article->category->name }}</a>
                    <span>标签</span>
                    @foreach($tags as $tag)
                        <a href="#"># {{ $tag->name }}</a>
                    @endforeach
                </p>
            </div>
            @if($article->article_image)
                <div class="image-block">
                    <img src="{{ asset($article->article_image) }}" alt="" width="100%" height="100%">
                </div>
            @endif
            <div class="content">
                {!! $article->content !!}
            </div>
        </div>

        <div id="article-anchor">
            <p style="margin-left: 5px; color: #007982;">文章目录</p>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("h3, h4").each(function (i, item) {
                var tag = $(item).get(0).localName;
                $(item).attr("id", "wow" + i);
                $("#article-anchor").append('<a class="new' + tag + '" href="#wow' + i + '">' + $(this).text() + '</a>');
//                $(".newh2").css("margin-left", 0);
                $(".newh3").css("margin-left", 10);
                $(".newh4").css("margin-left", 20);
//                $(".newh5").css("margin-left", 60);
//                $(".newh6").css("margin-left", 80);
            });
        });
    </script>
@endsection