@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item" style="margin-bottom: 30px; border: none; border-bottom: 1px solid #dadada;">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="" style="height: 200px; display: block; margin-top: 30px;">
                                <img src="{{ asset('image/demo1.jpg') }}" alt="" width="100%" height="100%">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <h1>Hello, world!</h1>
                            <p style="overflow: hidden; word-break: break-all; word-wrap: break-word; max-height: 120px; line-height: 28px; font-size: 16px;">
                                Apple 终于在 Swift 4 的 Foundation 的模块中添加了对 JSON 解析的原生支持。
                                虽然已经有很多第三方类库实现了 JSON 解析，但是能够看到这样一个功能强大、易于使用的官方实现还是不免有些兴奋。
                                值得注意的是，官方的实现方式适用于任何 Encoder/Decoder ，例如 PropertyListEncoder 。当然如果你需要 XML 格式的内容，可以进行自定义实现。在接下来的内容中，我们将专注于 JSON 格式的解析，因为这是 iOS 开发中最常见的数据格式。
                            </p>
                            <p>
                                作者 2017-12-20 00:00 点击：1000
                                <a class="btn btn-primary btn-sm pull-right" href="#" role="button">阅读更多</a>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col-md-3">
            231312
        </div>
    </div>
@endsection