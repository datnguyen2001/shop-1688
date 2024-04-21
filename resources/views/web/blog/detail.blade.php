@extends('web.index')
@section('title','Bài viết')

@section('style_page')

@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ  /</a></li>
                <li><a>{{$detail_post->name}}</a></li>
            </ul>
        </div>
    </div>
    <div class="main-child main-child1">
        <div class="container">
            <div class="row">
                @include('web.partials.menu')
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="main-content-product">
                        <div class="content-primary main-detail">
                            <h1 class="title">{{$detail_post->name}}</h1>
                            <p class="date">Ngày đăng: {{ \Carbon\Carbon::parse($detail_post->created_at)->format('d/m/Y') }}</p>
                            <div>{!! $detail_post->content !!}</div>
                        </div>
                        <div class="post-other">
                            <h3>Bài viết khác</h3>
                            @if(isset($post_more) && count($post_more)>0)
                            <ul>
                                @foreach($post_more as $val)
                                <li><img src="{{asset('assets/images/icon.jpg')}}" alt=""><a href="{{route('detail-blog',$val->slug)}}">{{$val->name}}</a></li>
                            @endforeach
                            </ul>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('script_page')

@stop
