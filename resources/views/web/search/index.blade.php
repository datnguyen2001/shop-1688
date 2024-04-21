@extends('web.index')
@section('title','Tìm kiếm sản phẩm')

@section('style_page')

@stop
{{--content of page--}}
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="{{route('home')}}">Trang chủ /</a></li>
                <li><a >Từ khóa: {{$key_search}}</a></li>
            </ul>
        </div>
    </div>
    <div class="main-child main-child1">
        <div class="container">
            <div class="row">
                @include('web.partials.menu')
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="main-content-product">
                        <h1 class="title-pr">Từ khóa: {{$key_search}}</h1>
                        <div class="content-product" style="margin-top: 0px">
                            <div class="row">
                                @if(isset($listData) && count($listData)>0)
                                    @foreach($listData as $val)
                                        <div class="col-md-3 col-sm-6 col-xs-6">
                                            <div class="item-product wow fadeInUp">
                                                <div class="image">
                                                    <a href="{{route('detail-product',$val->slug)}}"
                                                       title="{{$val->name}}"><img
                                                            src="{{asset($val->src)}}"
                                                            alt="{{$val->name}}"></a>
                                                </div>
                                                <div class="nav-img">
                                                    <h3 class="title"><a href="{{route('detail-product',$val->slug)}}"
                                                                         title="{{$val->name}}">{{$val->name}}</a>
                                                    </h3>
                                                    <p class="masp">Mã sản
                                                        phẩm: {{$val->code}}</p>
                                                    <p class="price">Giá <span>{{number_format($val->price)}}đ</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <p style="color: red;text-align: center;margin-top: 30px">Không tìn thấy kết quả phù hợp</p>
                                @endif
                            </div>
                        </div>
                            <div>
                                {{ $listData->appends(request()->all())->links('web.partials.pagination') }}
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
