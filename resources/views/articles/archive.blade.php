@extends('layouts.app')

@section('content')
    <div id="archive">
        <ul class="archive-item">
            @foreach($articles as $article)
                <li>
                    <div class="desc">
                        <span>{{ $article->published_at }}</span>
                        <h3><a href="{{ $article->link() }}" title="{{ $article->title }}">{{ $article->title }}</a></h3>
                    </div>
                </li>
            @endforeach
        </ul>

        {{ $articles->links() }}
    </div>
@endsection
<style type="text/css" lang="scss">
    * {
        margin: 0;
        padding: 0;
    }
</style>