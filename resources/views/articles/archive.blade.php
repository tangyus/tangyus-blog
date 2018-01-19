@extends('layouts.app')

@section('content')
    <div id="archive">
        <ul class="archive-item col-md-9" >
            @foreach($articles as $article)
                <li>
                    <div class="desc">
                        <span>{{ intercept_str($article->published_at) }}</span>
                        <span><a href="{{ $article->link() }}" title="{{ $article->title }}">{{ $article->title }}</a></>
                    </div>
                </li>
            @endforeach
        </ul>

        {{ $articles->links() }}
    </div>
@endsection