{{--<div class="panel text-center">--}}
    {{--<div class="panel-body">--}}
        {{--<div class="list-group">--}}
            {{--<a href="{{ route('categories') }}" class="list-group-item" title="文章分类">文章分类</a>--}}
            {{--@foreach($categories as $category)--}}
                {{--<a href="{{ route('categories', $category->id) }}" class="list-group-item"--}}
                   {{--title="{{ $category->name }}">--}}
                    {{--{{ $category->name }}--}}
                    {{--<span class="badge">{{ $category->article_count }}</span>--}}
                {{--</a>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="panel text-center">
    <div class="panel-body">
        <div class="list-group">
            <a href="{{ route('links') }}" class="list-group-item" title="友情链接">友情链接</a>
            @foreach($links as $link)
                <a href="{{ $link->site }}" target="_blank" class="list-group-item"
                   title="{{ $link->name }}">{{ $link->name }}</a>
            @endforeach
        </div>
    </div>
</div>