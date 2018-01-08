<div class="panel text-center">
    <div class="panel-body">
        <div class="list-group">
            <a href="#" class="list-group-item">我的分类</a>
            @foreach($categories as $category)
                <a href="#" class="list-group-item">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
</div>

<div class="panel text-center">
    <div class="panel-body">
        <div class="list-group">
            <a href="#" class="list-group-item">友情链接</a>
            @foreach($links as $link)
            <a href="{{ $link->site }}" target="_blank" class="list-group-item">{{ $link->name }}</a>
            @endforeach
        </div>
    </div>
</div>